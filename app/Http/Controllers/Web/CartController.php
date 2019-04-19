<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = $request['wc-ajax'];
        $list = 1;
        $qty = 2;
        $total = '159,00';

        $cart       = view('carts.mini-cart-list-1', compact('list','qty','total', 'json'))->render();
        $cart_qty   = view('carts.mini-cart-qty-1', compact('qty'))->render();
        $cart_total = view('carts.mini-cart-total-1', compact('total'))->render();

        $out = array(
            "fragments" => array (
                "div.widget_shopping_cart_content" => $cart,
                "span.basel-cart-number" => $cart_qty,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => "0befc4f1367d4bf7341fb19d577d37a1"
        );

        return response()->json($out);


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function undo($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $json = $request['wc-ajax'];
        $list = 1;
        $qty = 0;
        $total = '0,00';

        $cart       = view('carts.mini-cart-list-1', compact('list', 'qty', 'total','json'))->render();
        $cart_qty   = view('carts.mini-cart-qty-1', compact('qty'))->render();
        $cart_total = view('carts.mini-cart-total-1', compact('total'))->render();

        $out = array(
            "fragments" => array (
                "div.widget_shopping_cart_content" => $cart,
                "span.basel-cart-number" => $cart_qty,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => ""
        );

        return response()->json($out);

    }


    public function addProduct(Request $request)
    {
        $json = $request['wc-ajax'];
        $list = 1;
        $qty = 2;
        $total = '159,00';

        $cart       = view('carts.mini-cart-list-1', compact('list','qty', 'total', 'json'))->render();
        $cart_qty   = view('carts.mini-cart-qty-1-total', compact('qty'))->render();
        $cart_total = view('carts.mini-cart-total-1-total', compact('total'))->render();

        $out = array(
            "fragments" => array (
                "div.widget_shopping_cart_content" => $cart,
                "span.basel-cart-number" => $cart_qty,
                "span.basel-cart-subtotal" => $cart_total,
                "cart_hash" => "0befc4f1367d4bf7341fb19d577d37a1"
            )
        );

        return response()->json($out);


    }


    public function fragments(Request $request)
    {
        $json = $request['wc-ajax'];

        $list = 1;
        $qty = 2;
        $total = '159,00';

        $cart       = view('carts.mini-cart-list-1', compact('list','qty', 'total', 'json'))->render();
        $cart_qty   = view('carts.mini-cart-qty-1', compact('qty'))->render();
        $cart_total = view('carts.mini-cart-total-1', compact('total'))->render();

        $out = array(
            "fragments" => array (
                "div.widget_shopping_cart_content" => $cart,
                "span.basel-cart-number" => $cart_qty,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => "0befc4f1367d4bf7341fb19d577d37a1"
        );

        return response()->json($out);


    }

}
