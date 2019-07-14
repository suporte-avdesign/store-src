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


        $city = $request['calc_shipping_city'];
        $route = $request['http_referer'];
        $state = $request['calc_shipping_state'];
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

            $calculator = $this->calculator($postcode, $cart, $selected);


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

    public function calculator($postcode, $cart, $selected)
    {
        /**
         * O peso maximo nacional 30 kg estadual 50kg
         * O comprimento não pode ser maior que 105 cm.
         * A largura não pode ser maior que 105 cm.
         * A altura não pode ser maior que 105 cm.
         * A altura não pode ser inferior a 2 cm.
         * A largura não pode ser inferior a 11 cm.
         * O comprimento não pode ser inferior a 16 cm.
         * A soma resultante do comprimento + largura + altura não deve superar a 200 cm.
         * O comprimento não pode ser maior que 105 cm.
         * O diâmetro não pode ser maior que 91 cm.
         * O comprimento não pode ser inferior a 18 cm.
         * O diâmetro não pode ser inferior a 5 cm.
         * A soma resultante do comprimento + o dobro do diâmetro não deve superar a 200 cm.         *
         */
        $collection = collect($cart)->toArray();


        if ($selected == 2) {


            $total = $this->calculatorItems($collection);
            $divisao = ceil($total->unit_soma_cla / MAX_SOMA_CLA);

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

            // Cash
            $cash = number_format($total->price_cash_declare, 2, '.', '');
            $decimal_cash = substr($cash,(strlen($cash)-3),strlen($cash));
            $total_cash   = (str_replace($decimal_cash,"",$cash));
            $inteiro_cash = number_format(($total_cash / $divisao), 2, '.', '');

            // Card
            $card = number_format($total->price_card_declare, 2, '.', '');
            $decimal_card = substr($card,(strlen($card)-3),strlen($card));
            $total_card   = (str_replace($decimal_card,"",$card));
            $inteiro_card = number_format(($total_card / $divisao), 2, '.', '');

            for ($x = 0; $x <= ($divisao-2); $x++) {
                $_arr_['valor_declarado'][$x] = $inteiro_cash;
                $_arr_['comprimento'][$x] = $inteiro_c;
                $_arr_['largura'][$x] = $inteiro_l;
                $_arr_['altura'][$x] = $inteiro_a;
                $_arr_['peso'][$x] = $inteiro_p;
                $submit = json_decode(json_encode($_arr_, false));
                $freight[]  = $this->configFreight->calculatePac($postcode, $submit);

            }

            $_arr_['valor_declarado'][] = $inteiro_cash + $decimal_cash;
            $_arr_['comprimento'][] = $inteiro_c + $decimal_c;
            $_arr_['largura'][] = $inteiro_l + $decimal_l;
            $_arr_['altura'][] = $inteiro_a + $decimal_a;
            $_arr_['peso'][] = $inteiro_p + $decimal_p;

            $resultante = json_decode(json_encode($_arr_, false));

            $freight[]  = $this->configFreight->calculatePac($postcode, $resultante);



        }

        if ($selected == 3) {


            $freight = $this->configFreight->calculateSedex($postcode, $cart);
        }


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


    public function calculatorItems($cart)
    {
        $box = $this->pattern();
        foreach ($cart as $item) {

            if ($item['kit'] == 1) {
                $box->kit_qtd_itens += $item['quantity'];
                $box->kit_peso += $item['weight'] * $item['quantity'];
                $box->kit_altura += $item['height'] * $item['quantity'];
                $box->kit_largura += $item['width'] * $item['quantity'];
                $box->kit_comprimento += $item['length'] * $item['quantity'];
            } else {
                $box->unit_qtd_itens += $item['quantity'];
                $box->unit_peso += $item['weight'] * $item['quantity'];
                $box->unit_altura += $item['height'] * $item['quantity'];
                $box->unit_largura += $item['width'] * $item['quantity'];
                $box->unit_comprimento += $item['length'] * $item['quantity'];
            }


            if ($item['declare'] == 1) {
                $box->price_cash_declare += $item['price_cash'] * $item['quantity'];
                $box->price_card_declare += $item['price_card'] * $item['quantity'];
            } else {
                $box->price_cash_not_declare += $item['price_cash'] * $item['quantity'];
                $box->price_card_not_declare += $item['price_card'] * $item['quantity'];
            }
        }

        /************************************************************************************************/
        /*                                UNITS                                                       */
        /************************************************************************************************/
        $box->unit_soma_cla = ($box->unit_altura + $box->unit_largura + $box->unit_comprimento);

        if ($box->unit_altura > MAX_ALTURA) $box->unit_erros->max_altura = "Erro: Altura maior que  " . MAX_ALTURA . 'cm';
        if ($box->unit_largura > MAX_LARGURA) $box->unit_erros->max_largura = "Erro: Largura maior que  " . MAX_LARGURA . 'cm';
        if ($box->unit_comprimento > MAX_COMPRIMENTO) $box->unit_erros->max_comprimento = "Erro: Comprimento maior que " . MAX_COMPRIMENTO . 'cm';

        if (($box->unit_comprimento + $box->unit_largura + $box->unit_altura) < MIN_SOMA_CLA)
            $box->unit_erros->min_soma_cla = "Erro: Soma dos valores C+L+A menor que " . MIN_SOMA_CLA . 'cm';

        if (($box->unit_comprimento + $box->unit_largura + $box->unit_altura) > MAX_SOMA_CLA)
            $box->unit_erros->max_soma_cla = "Erro: Soma dos valores C+L+A maior que " . MAX_SOMA_CLA . 'cm';

        /************************************************************************************************/
        /*                                K I T S                                                       */
        /************************************************************************************************/
        $box->kit_soma = ($box->kit_unit_altura + $box->kit_unit_largura + $box->kit_unit_comprimento);

        if ($box->kit_altura > MAX_ALTURA) $box->kit_erros->max_altura = "Erro: Altura maior que  " . MAX_ALTURA . 'cm';
        if ($box->kit_largura > MAX_LARGURA) $box->kit_erros->max_largura = "Erro: Largura maior que  " . MAX_LARGURA . 'cm';
        if ($box->kit_comprimento > MAX_COMPRIMENTO) $box->kit_erros->max_comprimento = "Erro: Comprimento maior que " . MAX_COMPRIMENTO . 'cm';

        if (($box->kit_comprimento + $box->kit_largura + $box->kit_altura) < MIN_SOMA_CLA)
            $box->kit_erros->min_soma_cla = "Erro: Soma dos valores C+L+A menor que " . MIN_SOMA_CLA . 'cm';

        if (($box->kit_comprimento + $box->kit_largura + $box->kit_altura) > MAX_SOMA_CLA)
            $box->kit_erros->max_soma_cla = "Erro: Soma dos valores C+L+A maior que " . MAX_SOMA_CLA . 'cm';

        /************************************************************************************************/
        /*                                VALUES DECLARE                                                     */
        /************************************************************************************************/
        if (($box->price_cash_declare || $box->price_card_declare) > MAX_VALOR)
            $box->erros->max_valor = "Erro: O valor máximo permitido é ".setReal(MAX_VALOR);


        return $box;
    }





    /**
     * Default desig
     *
     * @return json
     */
    public function pattern()
    {
        $_box_ = array(
            'unit_peso' => 0,
            'unit_altura' => 0,
            'unit_largura' => 0,
            'unit_comprimento' => 0,
            'unit_soma_cla' => 0,
            'unit_qtd_itens' => 0,
            'unit_erros' => array(
                'max_altura' => null,
                'max_largura' => null,
                'max_comprimento' => null,
                'max_soma_cla' => null,
                'min_soma_cla' => null
            ),
            'kit_peso' => 0, # kit
            'kit_altura' => 0,
            'kit_largura' => 0,
            'kit_comprimento' => 0,
            'kit_soma' => 0,
            'kit_qtd_itens' => 0,
            'kit_erros' => array(
                'max_altura' => null, # kit
                'max_largura' => null,
                'max_comprimento' => null,
                'max_soma' => null,
                'min_soma' => null
            ),
            'price_cash_declare' => 0,
            'price_cash_not_declare' => 0,
            'price_card_declare' => 0,
            'price_card_not_declare' => 0

        );

        return json_decode(json_encode($_box_, false));
    }


}