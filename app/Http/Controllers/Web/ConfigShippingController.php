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

            $limit_c   = MAX_COMPRIMENTO;
            $limit_l   = MAX_LARGURA;
            $limit_a   = MAX_ALTURA;
            $limit_cla = MAX_SOMA_CLA;

            $total = $this->calculatorItems($collection);

            $total_c    = $total->comprimento;
            $total_l    = $total->largura;
            $total_a    = $total->altura;
            $total_cla  = 1000;//$total->soma_cla;
            $total_cash = $total->price_cash_declare;
            $total_card = $total->price_card_declare;

            $equal_cla  =  ceil($total_cla/$limit_cla);
            $equal_c    =  (int)($total_c / $equal_cla);
            $equal_l    =  (int)($total_l / $equal_cla);
            $equal_a    =  (int)($total_a / $equal_cla);
            $equal_cash =  ($total_cash / $equal_cla);
            $equal_card =  ($total_card / $equal_cla);


            $diff_cla  = (int) ($equal_cla-1) * $limit_cla;
            for ($x = 0; $x <= ($equal_cla-2); $x++) {
                $array[$x] = $limit_cla;
                $submit['comprimento'][$x] = $equal_c;
                $submit['largura'][$x] = $equal_l;
                $submit['altura'][$x] = $equal_a;
                $submit['valor'][$x] = $equal_cash;

            }
            $array[] = ($total_cla -$diff_cla);
            $submit['comprimento'][] = $equal_c;
            $submit['largura'][] = $equal_l;
            $submit['altura'][] = $equal_a;
            $submit['valor'][] = $equal_cash;



            dd($submit);








            //$freight  = $this->configFreight->calculatePac($postcode, $cart);


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
        $box = $this->patternUnit();
        foreach ($cart as $item) {
            $box->qtd_itens += $item['quantity'];
            $box->peso += $item['weight'] * $item['quantity'];
            $box->altura += $item['height'] * $item['quantity'];
            $box->largura += $item['width'] * $item['quantity'];
            $box->comprimento += $item['length'] * $item['quantity'];
            if ($item['declare'] == 1) {
                $box->price_cash_declare += $item['price_cash'] * $item['quantity'];
                $box->price_card_declare += $item['price_card'] * $item['quantity'];
            } else {
                $box->price_cash_not_declare += $item['price_cash'] * $item['quantity'];
                $box->price_card_not_declare += $item['price_card'] * $item['quantity'];
            }
        }

        $box->soma_cla = ($box->altura + $box->largura + $box->comprimento);

        if ($box->altura > MAX_ALTURA) $box->erros->max_altura = "Erro: Altura maior que  " . MAX_ALTURA . 'cm';
        if ($box->largura > MAX_LARGURA) $box->erros->max_largura = "Erro: Largura maior que  " . MAX_LARGURA . 'cm';
        if ($box->comprimento > MAX_COMPRIMENTO) $box->erros->max_comprimento = "Erro: Comprimento maior que " . MAX_COMPRIMENTO . 'cm';

        if (($box->comprimento + $box->largura + $box->altura) < MIN_SOMA_CLA)
            $box->erros->min_soma_cla = "Erro: Soma dos valores C+L+A menor que " . MIN_SOMA_CLA . 'cm';

        if (($box->comprimento + $box->largura + $box->altura) > MAX_SOMA_CLA)
            $box->erros->max_soma_cla = "Erro: Soma dos valores C+L+A maior que " . MAX_SOMA_CLA . 'cm';

        if (($box->price_cash_declare || $box->price_card_declare) > MAX_VALOR)
            $box->erros->max_valor = "Erro: O valor máximo permitido é ".setReal(MAX_VALOR);


        return $box;
    }


    /**
     * Default desig
     *
     * @return json
     */
    public function patternUnit()
    {
        $_box_ = array(
            'peso' => 0,
            'altura' => 0,
            'largura' => 0,
            'comprimento' => 0,
            'soma_cla' => 0,
            'qtd_itens' => 0,
            'price_cash_declare' => 0,
            'price_cash_not_declare' => 0,
            'price_card_declare' => 0,
            'price_card_not_declare' => 0,
            'erros' => array(
                'max_altura' => null,
                'max_largura' => null,
                'max_comprimento' => null,
                'max_soma_cla' => null,
                'min_soma_cla' => null,
            )
        );


        return json_decode(json_encode($_box_, false));
    }

    /**
     * Retorna um array dividido por limite.
     *
     * @param $total
     * @param $limit
     * @return array
     */
    public function partsUnit($total, $limit)
    {
        $equal = ceil($total/$limit);
        $diff  = (int) ($equal-1) * $limit;

        for ($x = 0; $x <= ($equal-2); $x++) {
            $array[$x] = $limit;
        }
        $array[] = ($total-$diff);

        return $array;

    }

}