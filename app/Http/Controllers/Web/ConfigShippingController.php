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


use AVD\Interfaces\Web\SectionInterface as InterSection;

use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
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
        ConfigImages $configImages,
        InterSection $interSection,
        ConfigKeyword $configKeyword,
        ConfigFreight $configFreight)
    {
        $this->phatFiles      = env('APP_PANEL_URL');

        $this->interCart      = $interCart;
        $this->interModel     = $interModel;
        $this->configSite     = $configSite;
        $this->interState     = $interState;
        $this->interSection   = $interSection;
        $this->configImages   = $configImages;
        $this->configKeyword  = $configKeyword;
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
        } elseif ($selected == 2) {

            $postcode = str_replace('-','', $request['calc_shipping_postcode']);
            $session  = md5($_SERVER['REMOTE_ADDR']);
            $cart     = $this->interCart->getAll($session);
            $freight  = $this->configFreight->calculatePac($postcode, $cart);

        } elseif ($selected == 3) {

            $postcode = str_replace('-','', $request['calc_shipping_postcode']);
            $session  = md5($_SERVER['REMOTE_ADDR']);
            $cart     = $this->interCart->getAll($session);

            $freight  = $this->configFreight->calculateSedex($postcode, $cart);
        }

        //$html = $this->renderCart($freight, $local, $selected);
        $message = 'error_freight';
        $error = 'O CEP é invalido';
        $success = view('frontend.messages.error-1', compact('message', 'error'))->render();

        $out = array(
            "success" => false,
            "message" => $success
        );

        return response()->json($out);


    }


    public function renderCart($freight, $local, $selected)
    {
        $message  = null;
        $menu     = $this->interSection->getMenu();
        $states   = $this->interState->getAll();

        $configImages   = $this->configImages->setName('default', 'T');
        $photoUrl       = $this->phatFiles.$configImages->path;
        $configKeyword  = $this->configKeyword->random();
        $configFreight  = $this->configFreight->setId(1);
        $configShipping = $this->interModel->getAll();

        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
        $session = md5($_SERVER['REMOTE_ADDR']);

        $configSite = $this->configSite->setId(1);
        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interCart->getAll($session);

        }

        $total = $this->interCart->getTotal($cart);

        $freight_value = str_replace(',', '.', $freight['cServico']['Valor']);
        $freight_days  = $freight['cServico']['PrazoEntrega'];

        return view("frontend.carts.cart-1", compact(
            'menu',
            'cart',
            'total',
            'local',
            'states',
            'freight',
            'freight_value',
            'freight_days',
            'selected',
            'session',
            'message',
            'photoUrl',
            'configFreight',
            'configKeyword',
            'configShipping')
        )->render();

    }


}
