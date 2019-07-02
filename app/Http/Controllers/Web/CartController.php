<?php

namespace AVD\Http\Controllers\Web;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\CartInterface as InterModel;
use AVD\Interfaces\Web\ProductInterface as InterProduct;
use AVD\Interfaces\Web\GridProductInterface as interGrid;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;

/*
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\SocialShareInterface as InterSocial;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
*/


class CartController extends Controller
{
    private $view = 'frontend.carts';
    private $phatFiles;

    public function __construct(
        interGrid $interGrid,
        InterModel $interModel,
        ConfigSite $configSite,
        InterProduct $interProduct,
        ConfigImages $configImages,
        ConfigProduct $configProduct)
    {
        $this->interGrid     = $interGrid;
        $this->interModel    = $interModel;
        $this->configSite    = $configSite->setId(1);
        $this->interProduct  = $interProduct;
        $this->configImages  = $configImages->setName('default', 'T');
        $this->configProduct = $configProduct->setId(1);

    }


    /**
     * Date: 07/01/2019
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function product(Request $request)
    {
        $ip = $request->ip();
        $this->phatFiles = env('APP_PANEL_URL');
        $quantity = $request->input('quantity');
        $product_id = $request->input('product_id');
        $grid_product_id = $request->input('variation_id');

        $user = Auth::user();
        if ($user) {
            $user_id = Auth::id();
            $profile_id = $user->profile_id;
            $session = md5($user_id);
        } else {
            $user_id = 0;
            $profile_id = 0;
            $session = md5($request->ip());
        }


        if ($this->configSite->order == 'cart'){

            $product = $this->interProduct->setId($product_id);
            $grids   = $this->interGrid->setId($grid_product_id);
            $color   = $grids->color()->first();

            $exist = $this->interModel->existProduct($session, $grid_product_id);
            if ($exist) {
                $input = [
                    'quantity' => $quantity
                ];
                $data = $this->interModel->update($input, $exist->id);

            } else {

                $dataForm = $this->insert($ip, $user_id, $profile_id, $session, $product, $color, $grids, $quantity);
                $data   = $this->interModel->create($dataForm);
            }

            $cart = $this->interModel->getall($session);



        } elseif($this->configSite->order == 'wishlist') {

        }


        if ($data) {

            $total_quantity   = 0;
            $total_price_cash = 0;
            $total_price_card = 0;
            foreach ($cart as $item) {
                $total_quantity   += $item->quantity;
                $total_price_cash += $item->price_cash * $item->quantity;
                $total_price_card += $item->price_card * $item->quantity;
            }
            $total = setReal($total_price_cash);
            $total_quantity = $total_quantity;
            $photoUrl = $this->phatFiles.$this->configImages->path;


            $notices   = view("{$this->view}.render.cart-1-notices", compact('product','quantity'))->render();
            $fragments = view("{$this->view}.render.cart-1-fragments", compact('cart','photoUrl', 'total'))->render();
            $cart_quantity = view("{$this->view}.render.cart-1-quantity", compact('total_quantity'))->render();
            $cart_total = view("{$this->view}.render.cart-1-total", compact('total'))->render();


            $out = array(
                "notices" => $notices,
                "fragments" => array(
                    "div.widget_shopping_cart_content" => $fragments,
                    "span.basel-cart-number" => $cart_quantity,
                    "span.basel-cart-subtotal" => $cart_total
                ),
                "cart_hash" => $session
            );
        }



        return response()->json($out);



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



    public function insert($ip, $user_id, $profile_id, $session, $product, $color, $grids, $quantity)
    {

        foreach ($product->prices as $price) {
            if ($price->profile == $this->configProduct->price_default) {
                $percent = $price->price_cash_percent;
                $price_card = $price->price_card;
                $price_cash = $price->price_cash;

                if ($product->offer == 1) {
                    $percent = $price->offer_percent;
                    $price_card = $price->offer_card;
                    $price_cash = $price->offer_cash;
                }
            }
        }

        $insert = [
            'user_id' => $user_id,
            'session' => $session,
            'product_id' => $product->id,
            'image_color_id' => $color->id,
            'grid_product_id' => $grids->id,
            'grid' => $grids->grid,
            'quantity' => $quantity,
            'image' => $color->image,
            'color' => $color->color,
            'code' => $color->code,
            'profile' => $profile_id,
            'offer' => $product->offer,
            'percent' => $percent,
            'price_card' => $price_card,
            'price_cash' => $price_cash,
            'slug' => $color->slug,
            'kit' => $product->kit,
            'kit_name' => $product->kit_name,
            'name' => $product->name,
            'category' => $product->category,
            'section' => $product->section,
            'brand' => $product->brand,
            'unit' => $product->unit,
            'measure' => $product->measure,
            'weight' => $product->weight,
            'width' => $product->width,
            'height' => $product->height,
            'length' => $product->length,
            'cost' => $product->cost,
            'ip' => $ip
        ];

        return $insert;

    }


}
