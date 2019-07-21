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

                    $sum    = $this->sum($cart, $price, $fator); # Soma os valores
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
    private function sum($cart, $price, $fator)
    {
        $sum  = $this->patternSum();

        $items = json_decode(json_encode($cart, false));
        foreach ($items as $item) {
            $sum->total_cubagem += ($item->length * $item->width * $item->height *  $item->quantity);
            $sum->kg_cubicos += ($item->length * $item->width * $item->height)/$fator;
            $sum->total_peso += ($item->weight * $item->quantity);
            $sum->comprimento += ($item->length * $item->quantity);
            $sum->largura += ($item->width * $item->quantity);
            $sum->altura += ($item->height * $item->quantity);
            $sum->peso += ($item->weight * $item->quantity);
            if ($item->kit == 1) {
                $sum->qtd_itens += ($item->quantity * $item->unit);
            } else {
                $sum->qtd_itens += $item->quantity;
            }
            if ($item->declare == 1) {
                $sum->valor_declarado += $item->$price * $item->quantity;
            }

        }
        $box   = $this->selectBox($sum, $fator);
        $count = (int) ceil($sum->total_cubagem /$box->total_cubagem);

        dd($count);

        if ($sum->total_cubagem > $box->total_cubagem) {

            $sum->next_cubagem = $sum->total_cubagem - $box->total_cubagem;
            $sum->next_kg_cubicos = $sum->kg_cubicos - $box->kg_cubicos;
            $sum->altura = $box->altura;
            $sum->largura = $box->largura;
            $sum->comprimento = $box->comprimento;
            $sum->total_cubagem = $box->total_cubagem;
            $sum->kg_cubicos = $box->kg_cubicos;
            $sum->raiz_cubica = round(pow($box->total_cubagem, (1 / 3)));
            // Caso o volume seja menor ou igual ao box
            if ($count == 1) {
                $percent = (float) getPercent($box->total_cubagem, $sum->next_cubagem);
                $sum->next_valor_declarado = (float) numFormat($this->nextPercent($sum->valor_declarado, $percent), 2);
                $sum->next_qtd_itens = (int) $this->nextPercent($sum->qtd_itens, $percent);
                $sum->next_peso = (float) numFormat($this->nextPercent($sum->peso, $percent),3);

            } else {
                $sum->next_valor_declarado =  $sum->valor_declarado / $count;
                $sum->next_qtd_itens = $sum->qtd_itens / $count;
                $sum->next_peso = $sum->peso / $count;

            }



            $sum->qtd_itens = $sum->qtd_itens - $sum->next_qtd_itens;
            $sum->valor_declarado = $sum->valor_declarado - $sum->next_valor_declarado;
            $sum->peso =  $sum->peso - $sum->next_peso;

        } else {
            $sum->raiz_cubica = round(pow($sum->total_cubagem, (1 / 3)));
            if ($sum->raiz_cubica < $sum->comprimento) {
                $sum->comprimento = $sum->raiz_cubica;
            } elseif ($sum->raiz_cubica < MIN_COMPRIMENTO) {
                $sum->comprimento = MIN_COMPRIMENTO;
            }
            if ($sum->raiz_cubica < $sum->largura) {
                $sum->largura = $sum->raiz_cubica;
            } elseif ($sum->raiz_cubica < MIN_LARGURA) {
                $sum->largura = MIN_LARGURA;
            }
            $sum->altura = round($sum->total_cubagem / ($sum->comprimento * $sum->largura)); // em centimetros
        }
        // Validação
        if ($sum->altura > MAX_ALTURA) {
            $sum->error = "Erro: Altura maior que  " . MAX_ALTURA . 'cm';
        } elseif ($sum->largura > MAX_LARGURA) {
            $sum->error = "Erro: Largura maior que  " . MAX_LARGURA . 'cm';
        } elseif ($sum->comprimento > MAX_COMPRIMENTO) {
            $sum->error = "Erro: Comprimento maior que " . MAX_COMPRIMENTO . 'cm';
        } elseif (($sum->comprimento + $sum->largura + $sum->altura) < MIN_SOMA_CLA) {
            $sum->error = "Erro: Soma dos valores C+L+A menor que " . MIN_SOMA_CLA . 'cm';
        } elseif (($sum->comprimento + $sum->largura + $sum->altura) > MAX_SOMA_CLA) {
            $sum->error = "Erro: Soma dos valores C+L+A maior que " . MAX_SOMA_CLA . 'cm';
        }


        return $sum;
    }

    /**
     *
     * @param $sum
     */
    private function divide($sum, $fator)
    {
        $send[] = $this->groupBox($sum, $fator);
        $box = $this->selectBox($sum, $fator);
        $sumTotal = $sum->total_cubagem;
        $boxTotal = $box->total_cubagem;
        $boxKgc = $box->kg_cubicos;
        $sumKgc = $sum->kg_cubicos;
        $count = (int) ceil($sumTotal/$boxTotal);
        if ($count >= 1) {
            for ($i = 1; $i <= 3; $i++) {
                $next = $this->nextBox($sum, $fator);
                $send[] = $this->groupBox($next);
            }
            # SORT_REGULAR sinalizador para comparar os elementos como eles são.
            //$next->send = array_unique($send, SORT_REGULAR);
            $next->send = $send;
            return $next;
        } else {
            return $sum;
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
            'qtd_itens' => 0,
            'total_peso' => 0,
            'kg_cubicos' => 0,
            'total_cubagem' => 0,
            'raiz_cubica' => 0,
            'next_cubagem' => 0,
            'next_kg_cubicos' => 0,
            'next_valor_declarado' => 0,
            'next_qtd_itens' => 0,
            'next_peso' => 0,
            'remnant_cubagem' => 0,
            'remnant_kg_cubicos' => 0,
            'send' => array(),
            'error' => null
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
        $total_cubagem = $sum->total_cubagem;

        $box1 = $this->boxsSize(1, $fator);
        $box2 = $this->boxsSize(2, $fator);
        $box3 = $this->boxsSize(3, $fator);

        $box1_total_cubagem = $box1->total_cubagem;
        $box3_total_cubagem = $box3->total_cubagem;


        # verificamos em qual box os produtos se encaixam
        if ($total_cubagem >= $box1_total_cubagem) {
            return $box1;
        } elseif ($total_cubagem < $box1_total_cubagem && $total_cubagem > $box3_total_cubagem) {
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
                $total_cubagem = ($box->length*$box->width*$box->height);
                $kg_cubicos = ($box->length*$box->width*$box->height)/$fator;
                $raiz_cubica = round(pow($total_cubagem, (1/3)));
                $_box_ = array(
                    'comprimento' => $box->length,
                    'largura' => $box->width,
                    'altura' => $box->height,
                    'peso' => 0,
                    'quantidade' => 0,
                    'kg_cubicos' => $kg_cubicos,
                    'raiz_cubica' => $raiz_cubica,
                    'total_cubagem' => $total_cubagem,
                    'valor_declarado' => $valor_declarado
                );
            }
        }

        return json_decode(json_encode($_box_, false));
    }

    /**
     * Monta o proximo box
     *
     * @param $sum
     * @param $fator
     */
    private function nextBox($sum, $fator)
    {
        $next  = $this->patternSum();
        $next->total_peso = $sum->total_peso;
        $next->raiz_cubica = $sum->raiz_cubica;
        $next->peso = $sum->next_peso;
        $next->qtd_itens = $sum->next_qtd_itens;
        $next->kg_cubicos = $sum->next_kg_cubicos;
        $next->total_cubagem = $sum->next_cubagem;
        $next->valor_declarado = $sum->next_valor_declarado;


        $box = $this->selectBox($next, $fator);

        $next->altura = $box->altura;
        $next->largura = $box->largura;
        $next->comprimento = $box->comprimento;

        if ($next->total_cubagem > $box->total_cubagem) {

            $next->next_cubagem = $next->total_cubagem - $box->total_cubagem;
            $next->next_kg_cubicos = $next->kg_cubicos - $box->kg_cubicos;

            $count = (int) ceil($next->next_cubagem /$box->total_cubagem);
            // Caso o volume seja menor ou igual ao box
            if ($count === 1) {
                $percent = (float) getPercent($box->total_cubagem, $next->next_cubagem);

                $next->next_valor_declarado = (float) numFormat($this->nextPercent($next->valor_declarado, $percent), 2);
                $next->next_qtd_itens = (int) $this->nextPercent($next->qtd_itens, $percent);
                $next->next_peso = (float) numFormat($this->nextPercent($next->peso, $percent),3);

            } else {
                $next->next_valor_declarado =  $next->valor_declarado / $count;
                $next->next_qtd_itens = $next->valor_declarado / $count;
                $next->next_peso = $next->valor_declarado / $count;
            }

        } else {
            $next->raiz_cubica = round(pow($next->total_cubagem, (1 / 3)));

            if ($next->raiz_cubica < $next->comprimento) {
                $next->comprimento = $next->raiz_cubica;
            } elseif ($next->raiz_cubica < MIN_COMPRIMENTO) {
                $next->comprimento = MIN_COMPRIMENTO;
            }

            if ($next->raiz_cubica < $next->largura) {
                $next->largura = $next->raiz_cubica;
            } elseif ($next->raiz_cubica < MIN_LARGURA) {
                $next->largura = MIN_LARGURA;
            }

            $next->valor_declarado = $sum->next_valor_declarado;
            $next->peso = $sum->next_peso;
            $next->qtd_itens = $sum->next_qtd_itens;

            $next->altura = round($next->total_cubagem / ($next->comprimento * $next->largura)); // em centimetros
        }
        return $next;
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
    private function groupBox($sum)
    {


        $send = [
            'comprimento' => $sum->comprimento,
            'largura' => $sum->largura,
            'altura' => $sum->altura,
            'peso' => $sum->peso,
            'valor' => $sum->valor_declarado,
            'qtd_itens' => $sum->qtd_itens,
            'total_cubagem' => $sum->total_cubagem,
            'kg_cubicos' => $sum->kg_cubicos
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

}