<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\ConfigShippingInterface as InterModel;
use AVD\Interfaces\Web\ConfigFreightInterface as ConfigFreight;
use AVD\Interfaces\Web\CartInterface as InterCart;


class ConfigShippingController extends Controller
{
    private $view = 'frontend.shipping';

    public function __construct(
        InterCart $interCart,
        InterModel $interModel,
        ConfigFreight $configFreight)
    {
        $this->interCart = $interCart;
        $this->interModel = $interModel;
        $this->configFreight = $configFreight;
    }

    /**
     * Define o método de envio
     *
     * @return \Illuminate\Http\Response
     */
    public function method(Request $request)
    {

        $configShipping = $this->interModel->getAll();

        return view("{$this->view}.method-1", compact('configShipping'));

    }


    /**
     * Define o método de envio
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateFreight(Request $request)
    {
        return redirect()->route('cart');

    }


}
