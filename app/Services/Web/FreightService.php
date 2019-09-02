<?php

namespace AVD\Services\Web;

use AVD\Models\Web\ConfigBox;
use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Interfaces\Web\ConfigFreightInterface as ConfigFreight;
use AVD\Interfaces\Web\ConfigShippingInterface as ConfigShipping;

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



class FreightService
{
    /**
     * @var InterCart
     */
    private $interCart;
    /**
     * @var ConfigFreight
     */
    private $configFreight;

    public function __construct(
        InterCart $interCart,
        ConfigFreight $configFreight,
        ConfigShipping $configShipping)
    {
        $this->interCart      = $interCart;
        $this->configFreight  = $configFreight;
        $this->configShipping = $configShipping;
    }

    /**
     * Define o método de envio
     *
     * @return \Illuminate\Http\Response
     */
    public function calculate($dataForm, $products, $page)
    {
        $price    = $dataForm['price'];
        $country  = $dataForm['country'];
        $selected = $dataForm['selected'];
        $postcode = str_replace('-', '', $dataForm['postcode']);
        $local    = constLang('messages.shipping.local_text') . " {$dataForm['city']}, {$dataForm['state']}";


        if ($selected == 1) {
            $data = $this->configShipping->setId(1);
            $_msg_ = array(
                'valor' => $data->tax_unique,
                'prazo' => 0,
                'domicilio' => 0,
                'error' => 0,
                'description' => $data->description
            );

            return $response = typeJson($_msg_);

        } elseif ($selected == 2 || $selected == 3) {
            $fator = number_format(6, 3, '.', '');
            $cart  = collect($products)->toArray();

            $configFreight = $this->configFreight->setId(1);
            if ($configFreight->distribute_box == 1) {
                $sum    = $this->distribute($cart, $price, $fator);
                $divide = $this->divide($sum, $fator);
                $submits = typeJson($divide->send);
                foreach ($submits as $submit) {
                    if ($selected == 2) {
                        $send[] = $this->configFreight->pac($postcode, $submit);
                        //$send[] = $this->configFreight->multiplo($postcode, $submit);

                        //dd($send);

                    } elseif ($selected == 3) {
                        $send[] = $this->configFreight->sedex($postcode, $submit);
                    }
                }
            } else {
                $separate = $this->separate($cart, $price, $fator);
                if (!empty($separate->kits)){
                    $submits = typeJson($separate->kits);
                    foreach ($submits as $submit) {
                        if ($selected == 2) {
                            $send[] = $this->configFreight->pac($postcode, $submit);
                        } elseif ($selected == 3) {
                            $send[] = $this->configFreight->sedex($postcode, $submit);
                        }
                    }
                }
                if (!empty($separate->units)){
                    $sum = $this->distribute($separate->units, $price, $fator);
                    $units = $this->divide($sum, $fator);
                    $submits = typeJson($units->send);
                    foreach ($submits as $submit) {
                        if ($selected == 2) {
                            $send[] = $this->configFreight->pac($postcode, $submit);
                        } elseif ($selected == 3) {
                            $send[] = $this->configFreight->sedex($postcode, $submit);
                        }
                    }
                }
            }

            $note='';
            if ($page == "cart") {

                $response = $this->messagesCart($send, $selected, $note);
                if (isset($response->error)) {
                    $html = $response->error;
                } else {
                    $html = $response;
                }
                $out = array("html" => $html);

                return response()->json($out);

            } elseif ($page == 'checkout') {
                return $this->messagesCheckout($send, $selected, $note);
            }

        } elseif ($selected == 4) {
            $data = $this->configShipping->setId($selected);
            $_msg_ = array(
                'valor' => $data->tax_unique,
                'description' => $data->description,
                'error' => 0
            );

            return $response = typeJson($_msg_);

        } elseif ($selected == 5) {
            $data = $this->configShipping->setId($selected);
            $_msg_ = array(
                'valor' => $data->tax_unique,
                'description' => $data->description,
                'error' => 0
            );

            return $response = typeJson($_msg_);
        } else {
            return false;
        }


    }

    /**
     * Soma o total CLA QVK e Cubagem
     *
     * @param $price
     * @param $fator
     * @return json
     */
    private function distribute($cart, $price, $fator)
    {
        $sum = $this->patternSum();
        $amount = $this->amountBox();
        $items = typeJson($cart);
        foreach ($items as $item) {
            $sum->comprimento += (int)($item->length * $item->quantity);
            $sum->largura += (int)($item->width * $item->quantity);
            $sum->altura += (int)($item->height * $item->quantity);
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
        $sum->kg_cubicos = $amount->kg_cubicos;
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

            if ($amount->divide == 1) {
                # Proximo: se o volume seja menor ou igual ao box
                $sum->next_peso = (float) numFormat(($amount->peso/$amount->divide), 3);
                $sum->next_itens = (int)($amount->itens/ $amount->divide);
                $sum->next_valor_declarado = ($amount->valor_declarado/$amount->divide);
                $sum->next_volume = $next_volume;
                $sum->next_kg_cubicos = $amount->kg_cubicos/$amount->divide;
                $sum->raiz_cubica = (int) round(pow($amount->volume, (1 / 3)));

            } else {
                # Proximo: se o volume seja maior ou igual ao box
                $sum->peso = (float) numFormat(($amount->peso/$amount->divide), 3);
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
            $sum->valor_declarado = $amount->valor_declarado;

            $sum->raiz_cubica = (int) round(pow($amount->volume, (1 / 3)));
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
     * Separa caixas de unidades
     *
     * @param $cart
     * @param $price
     * @param $fator
     * @return mixed
     */
    private function separate($cart, $price, $fator)
    {
        $separate = $this->separateBox();
        $kits  = [];
        $units = [];
        foreach ($cart as $key => $item) {
            if ($item['kit'] == 1) {
                $kits[$key]['comprimento'] = (int)($item['length'] * $item['quantity']);
                $kits[$key]['largura'] = (int)($item['width'] * $item['quantity']);
                $kits[$key]['altura'] = (int)($item['height'] * $item['quantity']);
                $kits[$key]['peso'] = ($item['weight'] * $item['quantity']);
                $kits[$key]['itens'] = $item['quantity'];
                $kits[$key]['valor'] = $item[$price] * $item['quantity'];
                if ($item['declare'] == 1) {
                    $kits[$key]['valor_declarado'] = $item[$price] * $item['quantity'];
                }
                $kits[$key]['volume'] = ($item['length'] * $item['width'] * $item['height'] * $item['quantity']);
                $kits[$key]['kg_cubicos'] = formatCubic(($item['length'] * $item['width'] * $item['height'] * $item['quantity'])/$fator);
            } else {
                $units[] = $item;
            }
        }
        if (!empty($kits)) {
            $separate->kits = $kits;
        }

        if (!empty($units)) {
            $separate->units = $units;
        }
        return $separate;
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

        return typeJson($total);
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

        return typeJson($total);
    }

    /**
     * Separa Kit de Unidades
     *
     * @return mixed
     */
    private function separateBox()
    {
        $total = array(
            'kits'=> array(),
            'units' => array()
        );

        return typeJson($total);
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
            'raiz_cubica' => $sum->raiz_cubica
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

        return typeJson($_sum_);
    }

    /**
     * Seleciona o tamanho do box
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

        return typeJson($_box_);
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
            'raiz_cubica' => $sum->raiz_cubica
        ];

        return $send;
    }

    /**
     * Mensagens para oa página cart
     *
     * @param $freight
     * @param null $error
     * @return mixed
     */
    private function messagesCart($freight,$selected,$note=null)
    {
        if (isset($freight[0]['error'])) {
            $message = 'error_freight';
            $error = $freight[0]['message'];
            $html = view('frontend.messages.error-1', compact('message', 'error'))->render();
            $_msg_ = array('error' => $html);
            $response = typeJson($_msg_);
        } else {
            $data = $this->configShipping->setId($selected);
            $_msg_ = array(
                'valor' => 0,
                'prazo' => 0,
                'domicilio' => 'Não',
                'description' => $data->description,
                'error' => null
            );

            $response = typeJson($_msg_);

            $domicile = constLang('messages.shipping.delivery_domicile');
            $days_text = constLang('messages.shipping.days_text');
            $value_text = constLang('messages.shipping.value');
            $day  = constLang('days');
            $yes  = $domicile.constLang('yes');
            $not  = $domicile.constLang('not');
            $value =0;

            foreach ($freight as $keys) {
                $services[] = $keys->cServico;
            }
            foreach ($services as $val) {
                $value += (float) $val['Valor'];
                $days = $days_text.' '.$val['PrazoEntrega'].' '.$day;
                $delivery = ($val['EntregaDomiciliar'] == 'S' ? ' '.$yes : ' '.$not);
            }

            $value = $value_text.' '. setReal($value);

            $message = 'response_freight';
            $response = view('frontend.carts.messages.success-1', compact(
                'message',
                'value',
                'days',
                'delivery',
                'note'))->render();
        }

        return $response;
    }

    /**
     * Mensage para página ckeckout
     *
     * @param $freight
     * @param null $note
     * @return array|mixed|string
     */
    private function messagesCheckout($freight,$selected,$note=null)
    {

        $days=0; $error=0; $value=0; $delivery=0;
        $data = $this->configShipping->setId($selected);
        $_msg_ = array(
            'valor' => $value,
            'prazo' => $days,
            'domicilio' => $delivery,
            'description' => $data->description,
            'error' => $error
        );
        $response = typeJson($_msg_);

        if (isset($freight[0]['error'])) {
            $response->error = $freight[0]['message'];
        } else {
            $domicile = constLang('messages.shipping.delivery_domicile');
            $days_text = constLang('messages.shipping.days_text');
            $value_text = constLang('messages.shipping.value');
            $day  = constLang('days');
            $yes  = $domicile.constLang('yes');
            $not  = $domicile.constLang('not');

            foreach ($freight as $keys ) {
                $services[] = $keys->cServico;
            }
            foreach ($services as $val) {
                $value += (float) $val['Valor'];
                $days = $days_text.' '.$val['PrazoEntrega'].' '.$day;
                $delivery = ($val['EntregaDomiciliar'] == 'S' ? ' '.$yes : ' '.$not);
            }

            $response->valor = $value;
            $response->prazo = $days;
            $response->domicilio = $delivery;
            $response->error = $error;
        }


        return $response;
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