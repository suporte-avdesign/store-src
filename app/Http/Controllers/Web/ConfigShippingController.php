<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use AVD\Models\Web\ConfigBox;
use AVD\Http\Controllers\Controller;
use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ConfigShippingInterface as InterModel;
use AVD\Interfaces\Web\ConfigFreightInterface as ConfigFreight;


use AVD\Http\Requests\Web\ConfigShippingRequest;

class ConfigShippingController extends Controller
{
    /**
     * $box1  = (64*42*30);# C=80640 K=13440
     * $box2  = (50*27*31);# C=41850 K=6975
     * $box3  = (43*20*28);# C=24080 K=4013.3
     *
     * (70*60*10)= 42000/6.000 = 7.000 Kg cúbicos - até 7k 81,05
     * (50*60*15)= 45000/6.000 = 7.500 Kg cúbicos - até 8k 99,55
     * (43*28*52)= 62608/6.000 = 10.434 Kg cúbicos - até 8k 115,95
     * (55*31*40)= 68200/6.000 = 11.366 Kg cúbicos - até 14k 142,91
     */


    private $view = 'frontend.shipping';
    private $phatFiles;


    public function __construct(
        InterCart $interCart,
        InterModel $interModel,
        InterState $interState,
        ConfigSite $configSite,
        ConfigFreight $configFreight)
    {
        $this->phatFiles = env('APP_PANEL_URL');

        $this->interCart = $interCart;
        $this->interModel = $interModel;
        $this->configSite = $configSite;
        $this->interState = $interState;
        $this->configFreight = $configFreight;
    }

    /**
     * Define o método de envio
     *
     * @return \Illuminate\Http\Response
     */
    public function method(Request $request)
    {
        $selected = $request['shipping_method'][0];
        if ($selected) {

            $states = $this->interState->getAll();
            $configShipping = $this->interModel->getAll();

            $configSite = $this->configSite->setId(1);
            (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
            $session = md5($_SERVER['REMOTE_ADDR']);


            if ($user_id != 0 && $configSite->order == 'wishlist') {
                dd('Cart = Lista de desejo');
            } else {
                $cart = $this->interCart->getAll($session);
            }

            $values = $this->interCart->getTotal($cart);
            $methods = $this->interModel->getAll();
            foreach ($methods as $method) {
                if ($method->id == $selected) {
                    $tax = $method->tax_unique;
                }
            }

            $total['quantity'] = $values['quantity'];
            $total['price_cash'] = $values['price_cash'];
            $total['price_card'] = $values['price_card'];

            return view("{$this->view}.method-1", compact(
                    'configShipping',
                    'selected',
                    'states',
                    'total',
                    'cart',
                    'tax')
            );
        }


    }

    /**
     * Define o método de envio
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateFreight(ConfigShippingRequest $request)
    {

        $price   = $request['price'];
        $city    = $request['calc_shipping_city'];
        $route   = $request['http_referer'];
        $state   = $request['calc_shipping_state'];
        $country = $request['calc_shipping_country'];



        $local = constLang('messages.shipping.local_text') . " {$city}, {$state}";

        $selected = $request['shipping_method'][0];
        if ($selected == 1) {

            dd('Transportadora');
            return false;
            //
        }

        if ($selected == 2 || $selected == 2) {


            $postcode = str_replace('-', '', $request['calc_shipping_postcode']);
            $fator    = number_format(6, 3, '.', '');
            $session  = md5($_SERVER['REMOTE_ADDR']);
            $cart     = collect($this->interCart->getAll($session))->toArray();

            $types = $this->types($cart);
            if ($types->kits >= 1) {
                $configFreight = $this->configFreight->setId(1);
                if ($configFreight->distribute_box == 1) {

                    $sum    = $this->sumCart($cart, $price, $fator); # Soma os valores
                    $divide = $this->divide($sum, $fator); # Divide os valores (cell)

                    dd($divide);

                }
            } else {
                $configFreight = $this->configFreight->setId(1);
                if ($configFreight->distribute_box == 1) {

                    $sum    = $this->sumCart($cart, $price, $fator); # Soma os valores
                    $divide = $this->divide($sum, $fator); # Divide os valores (cell)

                    dd($divide);

                }
            }

        }
        //$html = $this->renderCart($freight, $local, $selected);
        $message = 'error_freight';
        $error = 'O CEP é invalido';
        $success = view('frontend.messages.error-1', compact('message', 'error'))->render();
        $html = $this->renderFreight($selected, $local);

        $out = array(
            "success" => true,
            "html" => $html
        );

        return response()->json($out);


    }

    /**
     * Separa Kits/Units
     *
     * @param $items
     * @return json
     */
    private function types($cart)
    {
        $types['kits']  = null;
        $types['units'] = null;

        foreach ($cart as $items) {
            if ($items['kit'] == 1) {
                $types['kits'][] = $items;
            } else {
                $types['units'][] = $items;
            }
        }

        return json_decode(json_encode($types, false));
    }

    /**
     * Soma o total CLA QVK e Cubagem
     *
     * @param $price
     * @param $fator
     * @return json
     */
    private function sumCart($cart, $price, $fator)
    {
        $sum = $this->patternSum();
        $amount = $this->amountBox();
        $items = json_decode(json_encode($cart, false));
        foreach ($items as $item) {
            $sum->comprimento += ($item->length * $item->quantity);
            $sum->largura += ($item->width * $item->quantity);
            $sum->altura += ($item->height * $item->quantity);
            $amount->peso += ($item->weight * $item->quantity);
            if ($item->kit == 1) {
                $amount->itens += ($item->quantity * $item->unit);
            } else {
                $amount->itens += $item->quantity;
            }
            $amount->valor += $item->$price * $item->quantity;
            if ($item->declare == 1) {
                $amount->valor_declarado += $item->$price * $item->quantity;
            }
            $amount->volume += ($item->length * $item->width * $item->height * $item->quantity);
            $amount->kg_cubicos += formatCubic(($item->length * $item->width * $item->height * $item->quantity)/$fator);
        }

        $sum->volume = $amount->volume;
        $box = $this->selectBox($sum, $fator);
        $amount->divide = (int) ceil($sum->volume/$box->volume);
        # Total da soma do carrinho
        $sum->total = $amount;
        if ($sum->volume > $box->volume) {
            $sum->altura = $box->altura;
            $sum->largura = $box->largura;
            $sum->comprimento = $box->comprimento;
            $sum->volume = $box->volume;
            $sum->kg_cubicos = $box->kg_cubicos;
            $sum->raiz_cubica = $box->raiz_cubica;

            $next_volume = ($amount->volume-$box->volume);
            $percent = (float) getPercent($next_volume, $box->volume);

            if ($amount->divide == 1) {
                # Proximo: se o volume seja menor ou igual ao box
                $sum->next_peso = (float) numFormat($this->nextPercent($amount->peso, $percent),3);
                $sum->next_itens = (int) $this->nextPercent($amount->itens, $percent);
                $sum->next_valor_declarado = ($amount->valor_declarado/$amount->divide);
                $sum->next_volume = $next_volume;
                $sum->next_kg_cubicos = $this->nextPercent($amount->volume, $percent);;

            } else {
                # Proximo: se o volume seja maior ou igual ao box
                $sum->peso = (float) numFormat(($amount->peso/ $amount->divide), 3);
                $sum->next_peso = (float) numFormat($amount->peso-$sum->peso, 3);
                $sum->itens = (int)($amount->itens/ $amount->divide);
                $sum->next_itens = $amount->itens-$sum->itens;
                $sum->valor_declarado = ($amount->valor_declarado/$amount->divide);
                $sum->next_valor_declarado = ($amount->valor_declarado-$sum->valor_declarado);
                $sum->next_volume = $amount->volume-$box->volume;
                $sum->next_kg_cubicos = $amount->kg_cubicos-$box->kg_cubicos;
            }
        } else {

            $sum->peso = $amount->peso;
            $sum->itens = $amount->itens;

            $sum->raiz_cubica = round(pow($amount->volume, (1 / 3)));
            if ($sum->raiz_cubica < $sum->comprimento) {
                $sum->altura = $sum->raiz_cubica;
            } elseif ($sum->raiz_cubica < MIN_COMPRIMENTO) {
                $sum->comprimento = MIN_COMPRIMENTO;
            }
            if ($sum->raiz_cubica < $sum->largura) {
                $sum->largura = $sum->raiz_cubica;
            } elseif ($sum->raiz_cubica < MIN_LARGURA) {
                $sum->largura = MIN_LARGURA;
            }
            $sum->altura = round($sum->volume / ($sum->comprimento * $sum->largura)); // em centimetros
        }

        $sum->remnant_peso = $sum->total->peso-$sum->peso;
        $sum->remnant_itens = $sum->total->itens-$sum->itens;
        $sum->remnant_valor = $sum->total->valor_declarado-$sum->valor_declarado;
        $sum->remnant_volume = $sum->total->volume-$sum->volume;
        $sum->remnant_kg_cubicos = $sum->total->kg_cubicos-$sum->kg_cubicos;




        return $sum;
    }

    /**
     * Retorna o total da soma do cart
     *
     * @param $count
     * @param $valor
     * @param $sum
     * @return json
     */
    private function sumTotal($count,$valor,$vd,$qtd,$peso,$sum)
    {
        $total = array(
            'divide' => $count,
            'peso' => $peso,
            'itens' => $qtd,
            'valor' => $valor,
            'valor_declarado' => $vd,
            'volume' => $sum->volume,
            'kg_cubicos' => $sum->kg_cubicos,
        );

        return json_decode(json_encode($total, false));
    }

    /**
     * Adiciona o total da soma do cart
     *
     * @return mixed
     */
    private function amountBox()
    {
        $total = array(
            'divide'=> 0,
            'peso' => 0,
            'itens' => 0,
            'valor' => 0,
            'valor_declarado' => 0,
            'volume' => 0,
            'kg_cubicos' => 0,
        );

        return json_decode(json_encode($total, false));
    }

    /**
     * Faz o loop para criar os boxes
     * @param $sum
     */
    private function divide($sum, $fator)
    {
        $count = $sum->total->divide;
        $i=1; # Número do último box

        # Primeiro Box
        $send[0] = [
            'key' => $count,
            'comprimento' => $sum->comprimento,
            'largura' => $sum->largura,
            'altura' => $sum->altura,
            'peso' => $sum->peso,
            'valor_declarado' => $sum->valor_declarado,
            'itens' => $sum->itens,
            'volume' => $sum->volume,
            'kg_cubicos' => $sum->kg_cubicos,
        ];
        if ($count >= 3) {
            for ($i = 1; $i <= $count-2; $i++) {
                $sum->remnant_volume = $sum->remnant_volume-$sum->volume;
                $sum->remnant_kg_cubicos = $sum->remnant_kg_cubicos-$sum->kg_cubicos;
                $divide = $sum->total->divide-1;
                $send[$i] = $this->nextBox($sum,$divide,$fator);
            }
        }
        if ($count >= 2) {
            $divide = $sum->total->divide-1;
            $send[$i] = $this->nextBox($sum, $divide, $fator);
            $sum->remnant_volume = $sum->remnant_volume-$sum->volume;
            $sum->remnant_kg_cubicos = $sum->remnant_kg_cubicos-$sum->kg_cubicos;
        }

        $sum->send = array_unique($send, SORT_REGULAR);

        dd($sum);

        return $sum;

    }

    private function nextBox($sum,$divide,$fator)
    {
        $sum->total->divide = $divide;

        if ($divide >=1) {
            $amount = $this->amountBox();
            $amount->volume = $sum->next_volume;
            $amount->kg_cubicos = $sum->next_kg_cubicos;
            $box = $this->selectBox($amount, $fator);
            if ($amount->volume >= $box->volume) {
                //$next_volume = ($amount->volume-$box->volume);
                $amount->peso = $sum->next_peso;
                $amount->itens = $sum->next_itens;
                $amount->valor_declarado = $sum->next_valor_declarado;

                if ($divide == 1) {
                    # Proximo: se o volume seja menor ou igual a caixa
                    $sum->volume = $sum->remnant_volume;
                    $sum->kg_cubicos = $sum->remnant_kg_cubicos;


                } else {
                    # Proximo: se o volume seja maior ou igual a caixa
                    $sum->peso = (float) numFormat($sum->peso, 3);
                    $sum->next_peso = (float) numFormat($amount->peso-$sum->peso, 3);
                    $sum->itens = (int) ($sum->itens);
                    $sum->next_itens = $amount->itens-$sum->itens;
                    $sum->valor_declarado = ($sum->valor_declarado);
                    $sum->next_valor_declarado = ($amount->valor_declarado-$sum->valor_declarado);
                    $sum->next_volume = $amount->volume-$box->volume;
                    $sum->next_kg_cubicos = $amount->kg_cubicos-$box->kg_cubicos;
                }

            } else {
                #Proximo: se o volume for menor que a caixa
                $sum->volume = $sum->remnant_volume;
                $sum->kg_cubicos = $sum->remnant_kg_cubicos;


                $sum->raiz_cubica = round(pow($amount->volume, (1 / 3)));
                if ($sum->raiz_cubica < $sum->comprimento) {
                    $sum->altura = $sum->raiz_cubica;
                } elseif ($sum->raiz_cubica < MIN_COMPRIMENTO) {
                    $sum->comprimento = MIN_COMPRIMENTO;
                }
                if ($sum->raiz_cubica < $sum->largura) {
                    $sum->largura = $sum->raiz_cubica;
                } elseif ($sum->raiz_cubica < MIN_LARGURA) {
                    $sum->largura = MIN_LARGURA;
                }
                $sum->altura = round($sum->volume / ($sum->comprimento * $sum->largura));
            }


            $send = $this->groupBox($sum, $divide);


            return $send;
        }

    }

    /**
     * Modelo do json para montar o box
     *
     * @return json
     */
    private function patternSum()
    {
        $_sum_ = array(
            'comprimento' => 0,
            'largura' => 0,
            'altura' => 0,
            'peso' => 0,
            'valor_declarado' => 0,
            'itens' => 0,
            'kg_cubicos' => 0,
            'volume' => 0,
            'raiz_cubica' => 0,
            'total' => array(),
            'next_peso' => 0,
            'next_itens' => 0,
            'next_valor_declarado' => 0,
            'next_volume' => 0,
            'next_kg_cubicos' => 0,
            'remnant_peso' => 0,
            'remnant_itens' => 0,
            'remnant_valor' => 0,
            'remnant_volume' => 0,
            'remnant_kg_cubicos' => 0,
            'send' => array(),
            'error_cla' => null
        );

        return json_decode(json_encode($_sum_, false));
    }

    /**
     * Seleciona o tamanho do box
     *
     * (70*60*10)= 42000/6.000 = 7.000 Kg cúbicos - até 7k 81,05
     * (50*60*15)= 45000/6.000 = 7.500 Kg cúbicos - até 8k 99,55
     * (43*28*52)= 62608/6.000 = 10.434 Kg cúbicos - até 8k 115,95
     * (55*31*40)= 68200/6.000 = 11.366 Kg cúbicos - até 14k 142,91
     *
     * @param $cart
     * @param $fator
     * @return json|bool
     */
    private function selectBox($sum, $fator)
    {
        /**
         * $box1  = (60*42*30);# C=80640 K=13440
         * $box2  = (50*27*31);# C=41850 K=6975
         * $box3  = (43*20*28);# C=24080 K=4013.3
         */
        $volume = $sum->volume;

        $box1 = $this->boxsSize(1, $fator);
        $box2 = $this->boxsSize(2, $fator);
        $box3 = $this->boxsSize(3, $fator);

        $box1_volume = $box1->volume;
        $box2_volume = $box2->volume;
        $box3_volume = $box3->volume;


        # verificamos em qual box os produtos se encaixam
        if ($volume >= $box1_volume) {
            return $box1;
        } elseif ($volume >= $box2_volume && $volume < $box1_volume) {
            return $box2;
        } else {
            return $box3;
        }
    }

    /**
     * Retorna o tamanho do box
     *
     * @param $size
     * @param $fator
     * @return json
     */
    private function boxsSize($size, $fator)
    {
        $boxes = ConfigBox::all();
        foreach ($boxes as $box) {
            if ($box->id == $size) {
                $valor_declarado = 0;
                $volume = ($box->length*$box->width*$box->height);
                $kg_cubicos = formatCubic(($box->length*$box->width*$box->height)/$fator);
                $raiz_cubica = round(pow($volume, (1/3)));
                $_box_ = array(
                    'comprimento' => $box->length,
                    'largura' => $box->width,
                    'altura' => $box->height,
                    'peso' => 0,
                    'quantidade' => 0,
                    'kg_cubicos' => $kg_cubicos,
                    'raiz_cubica' => $raiz_cubica,
                    'volume' => $volume,
                    'valor_declarado' => $valor_declarado
                );
            }
        }

        return json_decode(json_encode($_box_, false));
    }

    /**
     * Calcula o proximo valor do box
     *
     * @param $value
     * @param $percent
     * @return float|int
     */
    private function nextPercent($value, $percent)
    {
        $total = $value-($percent*$value);
        $result = ($value-$total)/100;
        return $result;
    }

    /**
     * Agrupa os boxes para ser enviado
     *
     * @param $sum
     * @param $fator
     * @return array
     */
    private function groupBox($sum,$key)
    {
        //dd($sum);
        $send = [
            'key' => $key,
            'comprimento' => $sum->comprimento,
            'largura' => $sum->largura,
            'altura' => $sum->altura,
            'peso' => $sum->peso,
            'valor_declarado' => $sum->valor_declarado,
            'itens' => $sum->itens,
            'volume' => $sum->volume,
            'kg_cubicos' => $sum->kg_cubicos,
        ];

        return $send;
    }

    /**
     * Reinderiza a view de retorno
     *
     * @param $selected
     * @param $local
     * @return array|string
     */
    private function renderFreight($selected, $local)
    {

        $states = $this->interState->getAll();
        $configShipping = $this->interModel->getAll();

        $configSite = $this->configSite->setId(1);
        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
        $session = md5($_SERVER['REMOTE_ADDR']);


        if ($user_id != 0 && $configSite->order == 'wishlist') {
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interCart->getAll($session);
        }

        $values = $this->interCart->getTotal($cart);
        $methods = $this->interModel->getAll();
        foreach ($methods as $method) {
            if ($method->id == $selected) {
                $tax = $method->tax_unique;
            }
        }

        $total['quantity'] = $values['quantity'];
        $total['price_cash'] = $values['price_cash'];
        $total['price_card'] = $values['price_card'];

        return view("{$this->view}.calculator-1", compact(
                'configShipping',
                'selected',
                'states',
                'total',
                'local',
                'cart',
                'tax')
        )->render();

    }

    /**
     * Mensagens dos resultados
     *
     * @param $freight
     * @param null $error
     * @return mixed
     */
    private function messages($freight, $error=null)
    {
        $_msg_ = array(
            'valor' => 0,
            'prazo' => 0,
            'domicilio' => 'Não',
            'error' => array()
        );

        $message = json_decode(json_encode($_msg_, false));

        foreach ($freight['unit'] as $value) {
            $array[] = $value->cServico;
        }

        $delivery = constLang('messages.shipping.delivery_domicile');
        $days = constLang('days');
        $yes  = $delivery.constLang('yes');
        $not  = $delivery.constLang('not');

        foreach ($array as $val) {
            $message->valor += (float) str_replace (',', '.', $val['Valor']);
            $message->prazo = $val['PrazoEntrega'].' '.$days;
            $message->domicilio = ($val['EntregaDomiciliar'] == 'S' ? $yes : $not);
        }

        return $message;
    }

    /**
     * Validação CLA
     *
     * @param $sum
     */
    private function validateCLA($sum)
    {
        $error=null;
        if ($sum->altura > MAX_ALTURA) {
            $error = "Erro: Altura maior que  " . MAX_ALTURA . 'cm';
        } elseif ($sum->largura > MAX_LARGURA) {
            $error = "Erro: Largura maior que  " . MAX_LARGURA . 'cm';
        } elseif ($sum->comprimento > MAX_COMPRIMENTO) {
            $error = "Erro: Comprimento maior que " . MAX_COMPRIMENTO . 'cm';
        } elseif (($sum->comprimento + $sum->largura + $sum->altura) < MIN_SOMA_CLA) {
            $error = "Erro: Soma dos valores C+L+A menor que " . MIN_SOMA_CLA . 'cm';
        } elseif (($sum->comprimento + $sum->largura + $sum->altura) > MAX_SOMA_CLA) {
            $error = "Erro: Soma dos valores C+L+A maior que " . MAX_SOMA_CLA . 'cm';
        }
        return $error;
    }




}