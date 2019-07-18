<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return false;
            //Transportadora
        }

        if ($selected == 2 || $selected == 2) {

            $postcode = str_replace('-', '', $request['calc_shipping_postcode']);
            $session = md5($_SERVER['REMOTE_ADDR']);
            $cart = $this->interCart->getAll($session);

            $calculator = $this->calculator($price, $postcode, $cart, $selected);


            dd($calculator);

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
     * Date 07/13/2019
     *
     * @param $price
     * @param $postcode
     * @param $cart
     * @param $selected
     * @return array
     */
    public function calculator($price, $postcode, $cart, $selected)
    {
        $collection = collect($cart)->toArray();


        if ($selected == 2 || $selected == 3) {

            $fator = number_format(6, 3, '.', '');

            $sumCart = $this->sumCart($price, $collection, $fator);

            if (count($sumCart->error)) {
                return $sumCart->error;
            } else {



                $freight[0]  = $this->configFreight->calculatePac($postcode, $sumCart);

                if ($sumCart->next_qtd_itens){
                   // Verifica se existe kit
                   $count_kit = count($sumCart->kit);
                   if ($count_kit >=1) {


                       //$freight[]  = $this->configFreight->calculatePac($postcode, $sumCart);
                   }

                   // Verifica se existe unit
                   $count_unit = count($sumCart->unit);
                   if ($count_unit >=1) {

                       $next1 = $this->nextUnitCart($price, $sumCart->unit, $fator);
                       $freight[1] = $this->configFreight->calculatePac($postcode, $next1);


                       if ($next1->next_qtd_itens >= 1) {
                           $next2 = $this->nextUnitCart($price, $next1->unit, $fator);
                           $freight[2] = $this->configFreight->calculatePac($postcode, $next2);

                           if ($next2->next_qtd_itens >= 1) {
                               $next3 = $this->nextUnitCart($price, $next2->unit, $fator);
                               $freight[3] = $this->configFreight->calculatePac($postcode, $next3);

                               if ($next3->next_qtd_itens >= 1) {
                                   $next4 = $this->nextUnitCart($price, $next3->unit, $fator);
                                   $freight[4] = $this->configFreight->calculatePac($postcode, $next4);

                                   if ($next4->next_qtd_itens >= 1){
                                       $next5 = $this->nextUnitCart($price, $next4->unit, $fator);
                                       $freight[5] = $this->configFreight->calculatePac($postcode, $next5);

                                       if ($next5->next_qtd_itens >= 1) {
                                           $next6 = $this->nextUnitCart($price, $next5->unit, $fator);
                                           $freight[6] = $this->configFreight->calculatePac($postcode, $next6);

                                           if ($next6->next_qtd_itens >= 1) {
                                               $next7 = $this->nextUnitCart($price, $next6->unit, $fator);
                                               $freight[7] = $this->configFreight->calculatePac($postcode, $next7);

                                               if ($next7->next_qtd_itens >= 1) {
                                                   $next8 = $this->nextUnitCart($price, $next7->unit, $fator);
                                                   $freight[8] = $this->configFreight->calculatePac($postcode, $next8);

                                                   if ($next8->next_qtd_itens >= 1) {
                                                       $next9 = $this->nextUnitCart($price, $next8->unit, $fator);
                                                       $freight[9] = $this->configFreight->calculatePac($postcode, $next9);

                                                       if ($next9->next_qtd_itens >= 1) {
                                                           $next10 = $this->nextUnitCart($price, $next9->unit, $fator);
                                                           $freight[10] = $this->configFreight->calculatePac($postcode, $next10);

                                                           if ($next10->next_qtd_itens >= 1) {
                                                               $message = constLang('messages.shipping.limit_postcode');
                                                           }
                                                       }
                                                   }
                                               }
                                           }
                                       }
                                   }
                               }
                           }
                       }
                   }
                }
            }


            $message = $this->messages($freight);

            dd($message);
        }

        return $message;


    }





    /**
     *
     * Se o peso cúbico, diferente do peso físico em quilogramas, considera o volume da encomenda.
     * Se o peso cúbico da encomenda for menor ou igual a 10 kg, será atribuído o peso físico (ou real).
     * Para encomendas com peso cúbico maior que 10 kg, valerá o maior resultado após a comparação
     * dos resultados entre o peso físico (kg) e o peso cúbico (C x L x A)/6.000.
     *
     * (70*60*10)= 42000/6.000 = 7.000 Kg cúbicos - até 7k 81,05
     * (50*60*15)= 45000/6.000 = 7.500 Kg cúbicos - até 8k 99,55
     * (43*28*52)= 62608/6.000 = 10.434 Kg cúbicos - até 8k 115,95
     * (55*31*40)= 68200/6.000 = 11.366 Kg cúbicos - até 14k 142,91
     *
     * rodoviário: 1m³ =300kg
     * aéreo: 1m³ = 166,7kg
     * marítimo: 1m³ = 1.000kg
     *
     * @param $price
     * @param $cart
     * @param $factor
     * @return json
     */
    public function sumCart($price, $cart, $fator)
    {
        $box  = $this->selectBox($cart, $fator);
        $sum  = $this->patternSum();
        $kit  = array();
        $unit = array();

        foreach ($cart as $item) {

            if ($item['kit'] == 1) {

                $kit[] = array(
                    'id' => $item['id'],
                    'kit' => 1,
                    'quantity' => $item['quantity'],
                    'length' => $item['length'],
                    'width' => $item['width'],
                    'height' => $item['height'],
                    'quantity' => $item['quantity'],
                    'weight' => $item['weight'],
                    'weight' => $item['weight'],
                    'declare' => $item['declare'],
                    'price_cash' => $item['price_cash'],
                    'price_card' => $item['price_card']
                );


            } else {

                $sum->total_cubagem += ($item['length'] * $item['width'] * $item['height'] *  $item['quantity']);
                $sum->kg_cubicos += ($item['length'] * $item['width'] * $item['height'])/$fator;
                $sum->total_peso += ($item['weight'] * $item['quantity']);

                $sum->comprimento += ($item['length'] * $item['quantity']);
                $sum->largura += ($item['width'] * $item['quantity']);
                $sum->altura += ($item['height'] * $item['quantity']);
                $sum->peso += ($item['weight'] * $item['quantity']);
                $sum->qtd_itens += $item['quantity'];

                if ($item['declare'] == 1) {
                    $sum->valor_declarado += $item[$price] * $item['quantity'];
                }

                if ($sum->total_cubagem > $box->total_cubagem) {

                    $sum->next_cubagem += ($item['length'] * $item['width'] * $item['height'] *  $item['quantity']);
                    $cubagem_atual = $sum->total_cubagem - $sum->next_cubagem;

                    $sum->next_kg_cubicos += ($item['length'] * $item['width'] * $item['height'])/$fator;
                    $kg_cubicos_atual = $sum->kg_cubicos - $sum->next_kg_cubicos;

                    $sum->next_valor_declarado += ($item[$price] * $item['quantity']);
                    $declarado_atual = $sum->valor_declarado - $sum->next_valor_declarado;

                    $sum->next_qtd_itens += $item['quantity'];
                    $qtd_itens_atual = $sum->qtd_itens - $sum->next_qtd_itens;

                    $sum->next_peso += ($item['weight'] * $item['quantity']);
                    $peso_atual = $sum->peso - $sum->next_peso;

                    $unit[] = array(
                        'id' => $item['id'],
                        'kit' => 0,
                        'quantity' => $item['quantity'],
                        'length' => $item['length'],
                        'width' => $item['width'],
                        'height' => $item['height'],
                        'quantity' => $item['quantity'],
                        'weight' => $item['weight'],
                        'declare' => $item['declare'],
                        'price_cash' => $item['price_cash'],
                        'price_card' => $item['price_card']
                    );
                }
            }
        }

        $sum->kit  = $kit;
        $sum->unit = $unit;

        $sum->total_cubagem = $cubagem_atual;
        $sum->kg_cubicos = $kg_cubicos_atual;
        $sum->valor_declarado = $declarado_atual;
        $sum->qtd_itens = $qtd_itens_atual;
        $sum->peso = $peso_atual;

        $raiz_cubica = (int) round(pow($cubagem_atual, (1 / 3)));

        if ($raiz_cubica < 16) {
            $sum->comprimento = 16;
        } else {
            $sum->comprimento = (int)$raiz_cubica;
        }

        if ($raiz_cubica < 11) {
            $sum->largura = 11;
        } else {
            $sum->largura = (int)$raiz_cubica;
        }

        $sum->altura = (int) round($cubagem_atual / ($sum->comprimento * $sum->largura));

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


    private function nextUnitCart($price, $cart, $fator)
    {
        $box  = $this->selectBox($cart, $fator);
        $sum  = $this->patternSum();
        $kit  = array();
        $unit = array();



        foreach ($cart as $item) {

            $sum->total_cubagem += ($item['length'] * $item['width'] * $item['height'] *  $item['quantity']);
            $sum->kg_cubicos += ($item['length'] * $item['width'] * $item['height'])/$fator;
            $sum->total_peso += ($item['weight'] * $item['quantity']);

            $sum->comprimento += ($item['length'] * $item['quantity']);
            $sum->largura += ($item['width'] * $item['quantity']);
            $sum->altura += ($item['height'] * $item['quantity']);
            $sum->peso += ($item['weight'] * $item['quantity']);
            $sum->qtd_itens += $item['quantity'];

            if ($item['declare'] == 1) {
                $sum->valor_declarado += $item[$price] * $item['quantity'];
            }

            if ($sum->total_cubagem > $box->total_cubagem) {

                $sum->next_cubagem += ($item['length'] * $item['width'] * $item['height'] *  $item['quantity']);
                $cubagem_atual = $sum->total_cubagem - $sum->next_cubagem;

                $sum->next_kg_cubicos += ($item['length'] * $item['width'] * $item['height'])/$fator;
                $kg_cubicos_atual = $sum->kg_cubicos - $sum->next_kg_cubicos;

                $sum->next_valor_declarado += ($item[$price] * $item['quantity']);
                $declarado_atual = $sum->valor_declarado - $sum->next_valor_declarado;

                $sum->next_qtd_itens += $item['quantity'];
                $qtd_itens_atual = $sum->qtd_itens - $sum->next_qtd_itens;

                $sum->next_peso += ($item['weight'] * $item['quantity']);
                $peso_atual = $sum->peso - $sum->next_peso;

                $unit[] = array(
                    'id' => $item['id'],
                    'kit' => 0,
                    'quantity' => $item['quantity'],
                    'length' => $item['length'],
                    'width' => $item['width'],
                    'height' => $item['height'],
                    'quantity' => $item['quantity'],
                    'weight' => $item['weight'],
                    'declare' => $item['declare'],
                    'price_cash' => $item['price_cash'],
                    'price_card' => $item['price_card']
                );
            } else {


                $sum->next_cubagem = 0;
                $cubagem_atual = $sum->total_cubagem - $sum->next_cubagem;

                $sum->next_kg_cubicos = 0;
                $kg_cubicos_atual = $sum->kg_cubicos - $sum->next_kg_cubicos;

                $sum->next_valor_declarado = 0;
                $declarado_atual = $sum->valor_declarado - $sum->next_valor_declarado;

                $sum->next_qtd_itens = 0;
                $qtd_itens_atual = $sum->qtd_itens - $sum->next_qtd_itens;

                $sum->next_peso = 0;
                $peso_atual = $sum->peso - $sum->next_peso;

            }
        }

        $sum->kit  = $kit;
        $sum->unit = $unit;

        $sum->total_cubagem = $cubagem_atual;
        $sum->kg_cubicos = $kg_cubicos_atual;
        $sum->valor_declarado = $declarado_atual;
        $sum->qtd_itens = $qtd_itens_atual;
        $sum->peso = $peso_atual;

        $raiz_cubica = (int) round(pow($cubagem_atual, (1 / 3)));

        if ($raiz_cubica < 16) {
            $sum->comprimento = 16;
        } else {
            $sum->comprimento = (int)$raiz_cubica;
        }

        if ($raiz_cubica < 11) {
            $sum->largura = 11;
        } else {
            $sum->largura = (int)$raiz_cubica;
        }

        $sum->altura = (int) round($cubagem_atual / ($sum->comprimento * $sum->largura));

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


    public function selectBox($cart, $fator)
    {

        $total_cubagem = 0;

        foreach ($cart as $item) {
            $total_cubagem += ($item['length'] * $item['width'] * $item['height'] *  $item['quantity']);
        }

        $box1 = $this->boxsSize(1, $fator);
        $box2 = $this->boxsSize(2, $fator);
        $box3 = $this->boxsSize(3, $fator);

        $box1_total_cubagem = $box1->total_cubagem;
        $box3_total_cubagem = $box3->total_cubagem;

        # verificamos em qual box os produtos se encaixam
        if ($total_cubagem >= $box1_total_cubagem) {
            return $box1;
        } elseif ($total_cubagem > $box3_total_cubagem && $total_cubagem < $box1_total_cubagem) {
            return $box2;
        } elseif ($total_cubagem <= $box3_total_cubagem) {
            return $box2;
        } else {
           return false;
        }
    }


    /**
     * (70*60*10)= 42000/6.000 = 7.000 Kg cúbicos - até 7k 81,05
     * (50*60*15)= 45000/6.000 = 7.500 Kg cúbicos - até 8k 99,55
     * (43*28*52)= 62608/6.000 = 10.434 Kg cúbicos - até 8k 115,95
     * (55*31*40)= 68200/6.000 = 11.366 Kg cúbicos - até 14k 142,91
     *
     * @return mixed
     */
    public function boxsSize($size, $fator)
    {

        if ($size == 1) {

            $valor_declarado = setReal(500);
            $total_cubagem   = (64 * 42 * 30 * 1); //80640
            $kg_cubicos      = (64 * 42 * 30)/$fator; //13440.0
            $raiz_cubica     = round(pow($total_cubagem, (1 / 3)));
            $_box_ = array(
                'comprimento' => 62,
                'largura' => 42,
                'altura' => 30,
                'peso' => 12.000,
                'quantidade' => 12,
                'kg_cubicos' => $kg_cubicos,
                'raiz_cubica' => $raiz_cubica,
                'total_cubagem' => $total_cubagem,
                'valor_declarado' => $valor_declarado,
                'total_cubado' => 0,
                'cart' => array()
            );
        } elseif($size == 2) {

            $valor_declarado = setReal(500);
            $total_cubagem   = (50 * 27 * 31 * 1);
            $kg_cubicos      = (50 * 27 * 31)/$fator;
            $raiz_cubica     = round(pow($total_cubagem, (1 / 3)));


            $_box_ = array(
                'comprimento' => 50,
                'largura' => 27,
                'altura' => 31,
                'peso' => 7.000,
                'quantidade' => 12,
                'kg_cubicos' => $kg_cubicos,
                'raiz_cubica' => $raiz_cubica,
                'total_cubagem' => $total_cubagem,
                'valor_declarado' => $valor_declarado,
                'total_cubado' => 0,
                'cart' => array()
            );

        } elseif($size == 3) {

            $valor_declarado = setReal(500);
            $total_cubagem   = (43 * 20 * 28 * 1);
            $kg_cubicos      = (43 * 20 * 28)/$fator;
            $raiz_cubica     = round(pow($total_cubagem, (1 / 3)));

            $_box_ = array(
                'comprimento' => 43,
                'largura' => 20,
                'altura' => 28,
                'peso' => 3.000,
                'quantidade' => 12,
                'kg_cubicos' => $kg_cubicos,
                'raiz_cubica' => $raiz_cubica,
                'total_cubagem' => $total_cubagem,
                'valor_declarado' => $valor_declarado,
                'total_cubado' => 0,
                'cart' => array()
            );
        }

        return json_decode(json_encode($_box_, false));
    }

    /**
     * Default desig
     *
     * @return json
     */
    public function patternSum()
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
            'next_peso' => 0,
            'next_qtd_itens' => 0,
            'next_valor_declarado' => 0,
            'next_cubagem' => 0,
            'next_kg_cubicos' => 0,
            'kit' => array(),
            'unit' => array(),
            'error' => null

        );

        return json_decode(json_encode($_sum_, false));
    }


    private function messages($freight, $error=0)
    {
        $_msg_ = array(
            'valor' => 0,
            'prazo' => 0,
            'domicilio' => 'Não',
            'error' => array()
        );

        $message = json_decode(json_encode($_msg_, false));

        foreach ($freight as $value) {
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
     * Valor Cubico
     *
     * @param $fator
     * @return float|int
     */
    public function valueCubico($fator)
    {
        return number_format((1.000/$fator), 3, '.', '');
    }

    /**
     * Valor Cubico
     *
     * @param $c comprimento
     * @param $l largura
     * @param $a altura
     * @param $v valor cubagem
     * @return float
     */
    public function pesoCubado($c, $l, $a, $f)
    {
        $x = ($c*$l*$a)/$f;
        $n = number_format($x, 0, '.', '');
        $d = substr($n,(strlen($n)-3),strlen($n));
        $i = substr($n, 0, -3);
        return floatval("{$i}.{$d}");
    }

    public function renderFreight($selected, $local)
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


    public function revisar($price, $postcode, $cart, $selected)
    {
        $collection    = collect($cart)->toArray();

        $fator = number_format(6, 3, '.', '');



        if ($selected == 2) {
            $total = $this->sumCart($collection, $fator);
            $divisao = ceil($total->soma_cla / MAX_SOMA_CLA);

            dd($total);

            // Comprimento
            $dividir_c =  ($total->unit_comprimento / $divisao);

            if (is_int($dividir_c)) {
                $decimal_c = 0;
                $inteiro_c = (int) $dividir_c;
            } else {
                $decimal_c = 1;
                $inteiro_c = (str_replace($decimal_c,"", (int) $dividir_c));
            }

            // Largura
            $dividir_l =  ($total->unit_largura / $divisao);
            if (is_int($dividir_l)) {
                $decimal_l = 0;
                $inteiro_l = (int) $dividir_l;
            } else {
                $decimal_l = 1;
                $inteiro_l = (str_replace($decimal_l,"", (int) $dividir_l));
            }

            // Altura
            $dividir_a =  ($total->unit_altura / $divisao);
            if (is_int($dividir_a)) {
                $decimal_a = 0;
                $inteiro_a = (int) $dividir_a;
            } else {
                $decimal_a = 1;
                $inteiro_a = (str_replace($decimal_a,"", (int) $dividir_a));
            }

            // Peso
            $dividir_p = number_format(($total->unit_peso / $divisao), 3, '.', '');
            $decimal_p = substr($dividir_p,(strlen($dividir_p)-4),strlen($dividir_p));
            $inteiro_p = (str_replace($decimal_p,"",$dividir_p));

            ($price == 'price_cash' ? $values = $total->unit_prices->cash_declare : $values = $total->unit_prices->card_declare);

            // Values
            $declare = number_format($values, 2, '.', '');
            $decimal_declare = substr($declare,(strlen($declare)-3),strlen($declare));
            $total_declare   = (str_replace($decimal_declare,"",$declare));
            $inteiro_declare = number_format(($total_declare / $divisao), 2, '.', '');

            for ($x = 0; $x <= ($divisao-2); $x++) {
                $_arr_['valor_declarado'][$x] = $inteiro_declare;
                $_arr_['comprimento'][$x] = $inteiro_c;
                $_arr_['largura'][$x] = $inteiro_l;
                $_arr_['altura'][$x] = $inteiro_a;
                $_arr_['peso'][$x] = $inteiro_p;
                $submit = json_decode(json_encode($_arr_, false));
                $freight[]  = $this->configFreight->calculatePac($postcode, $submit);

            }

            $_arr_['valor_declarado'][] = $inteiro_declare + $decimal_declare;
            $_arr_['comprimento'][] = $inteiro_c + $decimal_c;
            $_arr_['largura'][] = $inteiro_l + $decimal_l;
            $_arr_['altura'][] = $inteiro_a + $decimal_a;
            $_arr_['peso'][] = $inteiro_p + $decimal_p;

            /* teste
            $c = (12.2 * 12); // 146.4
            $l = (10.2 * 12); // 122.4
            $a = (30.4  * 12); //364.8


            $dc = ceil($c / MAX_COMPRIMENTO);
            $dl = ceil($l / MAX_LARGURA);
            $da = ceil($a / MAX_ALTURA);
            $sum = ceil(($c+$l+$a) / MAX_SOMA_CLA);


            $x = [$dc, $dl, $da, $sum];
            $max = collect($x)->max();
            */
            /*


            $_arr_['valor_declarado'][] = '300,00';
            $_arr_['comprimento'][] = 10;
            $_arr_['largura'][] = 10;
            $_arr_['altura'][] = 10;
            $_arr_['peso'][] = 6;


            $kgc = $this->pesoCubado(55, 55, 55, $this->valueCubico($fator));

            //dd($kgc);


             * Se o peso cúbico, diferente do peso físico em quilogramas, considera o volume da encomenda.
             * Se o peso cúbico da encomenda for menor ou igual a 10 kg, será atribuído o peso físico (ou real).
             * Para encomendas com peso cúbico maior que 10 kg, valerá o maior resultado após a comparação
             * dos resultados entre o peso físico (kg) e o peso cúbico (C x L x A)/6.000.
             *
             * (70*60*10)= 42000/6.000 = 7.000 Kg cúbicos - até 7k 81,05
             * (50*60*15)= 45000/6.000 = 7.500 Kg cúbicos - até 8k 99,55
             * (43*28*52)= 62608/6.000 = 10.434 Kg cúbicos - até 8k 115,95
             * (55*31*40)= 68200/6.000 = 11.366 Kg cúbicos - até 14k 142,91
             *
             * Fator Cúbico de Peso.
             * 50cm x 60cm x 15cm
             *
             * $kgc = $this->pesoCubado(50, 60, 15, $this->valueCubico($fator));
             *
            */



            $resultante = json_decode(json_encode($_arr_, false));

            $freight[]  = $this->configFreight->calculatePac($postcode, $resultante);

            return $freight;

        }

        if ($selected == 3) {


            $freight = $this->configFreight->calculateSedex($postcode, $cart);
        }
    }







}