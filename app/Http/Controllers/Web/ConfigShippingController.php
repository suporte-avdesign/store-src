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
        $this->phatFiles      = env('APP_PANEL_URL');

        $this->interCart      = $interCart;
        $this->interModel     = $interModel;
        $this->configSite     = $configSite;
        $this->interState     = $interState;
        $this->configFreight  = $configFreight;
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

            $states   = $this->interState->getAll();
            $configShipping = $this->interModel->getAll();

            $configSite = $this->configSite->setId(1);
            (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
            $session = md5($_SERVER['REMOTE_ADDR']);


            if ($user_id != 0 && $configSite->order == 'wishlist'){
                dd('Cart = Lista de desejo');
            } else {
                $cart = $this->interCart->getAll($session);
            }

            $values  = $this->interCart->getTotal($cart);
            $methods = $this->interModel->getAll();
            foreach ($methods as $method) {
                if ( $method->id == $selected ) {
                    $tax = $method->tax_unique;
                }
            }

            $total['quantity']   = $values['quantity'];
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


        $city     = $request['calc_shipping_city'];
        $route    = $request['http_referer'];
        $state    = $request['calc_shipping_state'];
        $country  = $request['calc_shipping_country'];

        $local = constLang('messages.shipping.local_text')." {$city}, {$state}";

        $selected   = $request['shipping_method'][0];
        if ($selected == 1) {
            return false;
            //Transportadora
        }

        if ($selected == 2 || $selected == 2) {

            $postcode = str_replace('-','', $request['calc_shipping_postcode']);
            $session  = md5($_SERVER['REMOTE_ADDR']);
            $cart     = $this->interCart->getAll($session);

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
        $cart = collect($cart)->toArray();

        if ($selected == 2) {

            $units = $this->calculatorBox( $cart );



            //$freight  = $this->configFreight->calculatePac($postcode, $cart);



        }

        if($selected == 3) {


            $freight  = $this->configFreight->calculateSedex($postcode, $cart);
        }





    }


    public function renderFreight($selected, $local)
    {

        $states   = $this->interState->getAll();
        $configShipping = $this->interModel->getAll();

        $configSite = $this->configSite->setId(1);
        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
        $session = md5($_SERVER['REMOTE_ADDR']);


        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interCart->getAll($session);
        }

        $values  = $this->interCart->getTotal($cart);
        $methods = $this->interModel->getAll();
        foreach ($methods as $method) {
            if ( $method->id == $selected ) {
                $tax = $method->tax_unique;
            }
        }

        $total['quantity']   = $values['quantity'];
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



    public function calculatorBox( $cart = null )
    {


        $box = $this->pattern();
        // percorrendo lista de produtos realizando calculos devidos ...
        foreach ($cart as $item) {

            // incrementa quantidade de itens dentro da caixa...
            $box->qtd_itens += $item['quantity'];
            $box->kilos += $item['weight'];
            // @opcional - calculando volume de itens dentro da caixa ...
            $box->volume_itens += ($item['height'] * $item['width'] * $item['length']) * $item['quantity'];
            if ($box->volume_itens >= 200) 

            // verifica se produto cabe no espaco remanescente ...
            if ($box->comprimento_remanescente >= $item['length'] * $item['quantity'] &&
                $box->largura_remanescente >= $item['width'] * $item['quantity']
            ) {
                // se altura do novo produto maior que altura disponivel, incrementa altura da caixa...
                if ($item['height'] * $item['quantity'] > $box->altura_remanescente) {
                    $box->altura += ($item['height'] * $item['quantity']) - $box->altura_remanescente;
                }

                if ($item['length'] * $item['quantity'] > $box->comprimento)
                    $box->comprimento = $item['length'] * $item['quantity'];

                // calculando volume remanescente do valor remanescente!!!
                $box->comprimento_remanescente = $box->comprimento - $item['length'] * $item['quantity'];

                // largura restante
                $box->largura_remanescente = $box->largura_remanescente - $item['width'] * $item['quantity'];

                $box->altura_remanescente = $item['height'] * $item['quantity'] > $box->altura_remanescente ?
                    $item['height'] * $item['quantity'] : $box->altura_remanescente;
                // pula para proxima iteracao...
                continue;
            }

            // passo (N-1) - altura e' a variavel que sempre incrementa independente de condicao ...
            $box->altura += $item['height'] * $item['quantity'];

            // passo N - verificando se item tem dimensoes maiores que a caixa...
            if ($item['width'] * $item['quantity'] > $box->largura)
                $box->largura = $item['width'] * $item['quantity'];

            if ($item['length'] * $item['quantity'] > $box->comprimento)
                $box->comprimento = $item['length'] * $item['quantity'];

            // calculando volume remanescente...
            $box->comprimento_remanescente = $box->comprimento;
            $box->largura_remanescente = $box->largura - ($item['width'] * $item['quantity']);
            $box->altura_remanescente = $item['height'] * $item['quantity'];


        }

        // @opcional - calculando volume da caixa ...
        $box->volume = ( $box->altura*$box->largura*$box->comprimento ) ;

        // @opcional - calculando volume vazio! Ar dentro da caixa!
        $box->volume_vazio = $box->volume - $box->volume_itens ;

        // checa se temos produtos e se conseguimos alcancar a dimensao minima ...
        if( !empty( $cart ) ) {
            // verificando se dimensoes minimas sao alcancadas ...
            if ($box->altura > 0 && $box->altura < MIN_ALTURA) $box->altura = MIN_ALTURA;
            if ($box->largura > 0 && $box->largura < MIN_LARGURA) $box->largura = MIN_LARGURA;
            if ($box->comprimento > 0 && $box->comprimento < MIN_COMPRIMENTO) $box->comprimento = MIN_COMPRIMENTO;
        }

        // verifica se as dimensoes nao ultrapassam valor maximo
        if( $box->altura > MAX_ALTURA ) $box->message = "Erro: Altura maior que o permitido.";
        if( $box->largura > MAX_LARGURA ) $box->message = "Erro: Largura maior que o permitido.";
        if( $box->comprimento > MAX_COMPRIMENTO ) $box->message = "Erro: Comprimento maior que o permitido.";

        // @nota - nao sei se e' uma regra, mas por via das duvidas esta ai
        // Soma (C+L+A)	MIN 29 cm  e  MAX 200 cm
        if( ($box->comprimento+$box->comprimento+$box->comprimento) < MIN_SOMA_CLA )
            $box->message = "Erro: Soma dos valores C+L+A menor que o permitido.";

        if( ($box->comprimento+$box->comprimento+$box->comprimento) > MAX_SOMA_CLA )
            $box->message = "Erro: Soma dos valores C+L+A maior que o permitido.";


        dd($box);

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
            'kilos' => 0, 		 /* total kilos */
            'altura' => 0, 		 /* altura final da caixa */
            'largura' => 0, 	 /* largura */
            'comprimento' => 0,  /* ... */
            'qtd_itens' => 0, 	 /* qtd de itens dentro da caixa */
            'message' => null,   /* caso erro guarda mensagem */
            'volume' => 0, 		 /* capacidade total de armazenamento da caixa */
            'volume_itens' => 0, /* volume armazenado */
            'volume_vazio' => 0, /* volume livre */
            'comprimento_remanescente' => 0,
            'largura_remanescente' => 0,
            'altura_remanescente' => 0
        );

        return json_decode(json_encode($_box_,false));

    }


}
