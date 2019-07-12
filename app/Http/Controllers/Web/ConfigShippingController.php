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

            $totals = $this->calculatorItems($collection);

            dd($totals);


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
        $box = $this->patternItems();
        foreach ($cart as $item) {
            $box->qtd_itens += $item['quantity'];
            $box->kilos += $item['weight'] * $item['quantity'];
            $box->altura += $item['height'] * $item['quantity'];
            $box->largura += $item['width'] * $item['quantity'];
            $box->comprimento += $item['length'] * $item['quantity'];
            $box->price_cash += $item['price_cash'] * $item['quantity'];
            $box->price_card += $item['price_card'] * $item['quantity'];
        }
        $box->resultante_cla = ($box->altura + $box->largura + $box->comprimento);

        if ($box->altura > MAX_ALTURA) $box->erros->max_altura = "Erro: Altura maior que  " . MAX_ALTURA . 'cm';
        if ($box->largura > MAX_LARGURA) $box->erros->max_largura = "Erro: Largura maior que  " . MAX_LARGURA . 'cm';
        if ($box->comprimento > MAX_COMPRIMENTO) $box->erros->max_comprimento = "Erro: Comprimento maior que " . MAX_COMPRIMENTO . 'cm';

        if (($box->comprimento + $box->largura + $box->altura) < MIN_SOMA_CLA)
            $box->erros->min_soma_cla = "Erro: Soma dos valores C+L+A menor que " . MIN_SOMA_CLA . 'cm';

        if (($box->comprimento + $box->largura + $box->altura) > MAX_SOMA_CLA)
            $box->erros->max_soma_cla = "Erro: Soma dos valores C+L+A maior que " . MAX_SOMA_CLA . 'cm';

        if (($box->price_cash || $box->price_card) > MAX_VALOR)
            $box->erros->max_valor = "Erro: O valor máximo permitido é ".setReal(MAX_VALOR);

        return $box;
    }


    /**
     * Default desig
     *
     * @return json
     */
    public function patternItems()
    {
        $_box_ = array(
            'kilos' => 0,
            'altura' => 0,
            'largura' => 0,
            'comprimento' => 0,
            'qtd_itens' => 0,
            'price_cash' => 0,
            'price_card' => 0,
            'resultante_cla' => 0,
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

}