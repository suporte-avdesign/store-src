<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {

        dd('index');
        // Route('products')
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );

        $cart = [1];

        return view('carts.cart-1', compact('product', 'cart'));
    }

    public function store(Request $request)
    {
        dd('store');
        sleep(2);
        $json = $request['wc-ajax'];
        $list = 1;
        $quantity = 2;
        $total = '159,00';

        $fragments = view('carts.cart-1-fragments', compact('list','quantity','total', 'json'))->render();
        $cart_quantity = view('carts.cart-1-quantity', compact('quantity'))->render();
        $cart_total = view('carts.cart-1-total', compact('total'))->render();

        $out = array(
            "fragments" => array (
                "div.widget_shopping_cart_content" => $fragments,
                "span.basel-cart-number" => $cart_quantity,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => "0befc4f1367d4bf7341fb19d577d37a1"
        );

        return response()->json($out);


    }

    public function product(Request $request)
    {
        dd($request->all());
        sleep(2);
        $action = $request->input('action');
        $attribute_pa_color = $request->input('attribute_pa_color');
        $attribute_pa_size = $request->input('attribute_pa_size');
        $quantity = $request->input('quantity');
        $add_to_cart = $request->input('add-to-cart');
        $product_id = $request->input('product_id');
        $variation_id = $request->input('variation_id');

        if ($action == 'basel_ajax_add_to_cart') {
            $product = 'Produto 2';
            $list = 1;
            $quantity = 3;
            $total = '259,00';

            $notices = view('carts.cart-1-notices', compact('product','quantity'))->render();
            $fragments = view('carts.cart-1-fragments', compact('list','quantity','total'))->render();
            $cart_quantity = view('carts.cart-1-quantity', compact('quantity'))->render();
            $cart_total = view('carts.cart-1-total', compact('total'))->render();

            $out = array(
                "notices" => $notices,
                "fragments" => array(
                    "div.widget_shopping_cart_content" => $fragments,
                    "span.basel-cart-number" => $cart_quantity,
                    "span.basel-cart-subtotal" => $cart_total
                ),
                "cart_hash" => "0befc4f1367d4bf7341fb19d577d37a1"
            );
        }



        return response()->json($out);


    }


    public function endpoint(Request $request)
    {

        $ac = $request->input('ajax');
        if ($ac == 'update_shipping_method') {
            $this->method($request->all());
        }

        if ($ac == 'apply_coupon'){
            $this->coupon($request->all());
        }

        if ($ac == 'remove_item'){
            $this->remove($request->all());
        }


    }


    public function shipping(Request $request)
    {
        $shipping  = $request['shipping_method'];
        $method    = '';


        $this->index();
    }


    public function method($input)
    {
        $shipping_method = $input['shipping_method'];
        $method = $shipping_method[0];

        $render = view('carts.cart-1-method', compact('method'))->render();

        print $render;

    }


    public function coupon($input)
    {
        $render = '';
        if(!$input['coupon_code']) {
            $message = 'Favor prenche';
            $render =view('messages.message-1-erro', compact('message'))->render();
        }

        print $render;
    }


    public function remove($input)
    {
        $item = $input['item'];
        $_wpnonce = $input['_wpnonce'];

    }

    public function fragments(Request $request)
    {
        sleep(2);
        $action = $request->input('wc-ajax');
        $list = 1;
        $quantity = 2;
        $total = '159,00';

        $fragments = view('carts.cart-1-fragments', compact('list','quantity','total'))->render();
        $cart_quantity = view('carts.cart-1-quantity', compact('quantity'))->render();
        $cart_total = view('carts.cart-1-total', compact('total'))->render();

        $out = array(
            "fragments" => array (
                "div.widget_shopping_cart_content" => $fragments,
                "span.basel-cart-number" => $cart_quantity,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => "0befc4f1367d4bf7341fb19d577d37a1"
        );

        return response()->json($out);


    }

    public function update(Request $request)
    {
        // Route('products')
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );

        $cart = [1];

        return view('carts.cart-1', compact('product', 'cart'));
    }

    public function undo(Request $request)
    {
        $undo_item = $request['undo_item'];
    }

    public function destroy(Request $request)
    {
        $json = $request['wc-ajax'];
        $list = 1;
        $quantity = 0;
        $total = '0,00';

        $fragments = view('carts.cart-1-fragments', compact('list', 'quantity', 'total','json'))->render();
        $cart_quantity = view('carts.cart-1-quantity', compact('quantity'))->render();
        $cart_total = view('carts.cart-1-total', compact('total'))->render();

        $out = array(
            "fragments" => array (
                "div.widget_shopping_cart_content" => $fragments,
                "span.basel-cart-number" => $cart_quantity,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => ""
        );

        return response()->json($out);

    }


}
