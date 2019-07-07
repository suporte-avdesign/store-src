<?php

namespace AVD\Http\Controllers\Web;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\CartInterface as InterModel;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ProductInterface as InterProduct;
use AVD\Interfaces\Web\GridProductInterface as interGrid;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;

use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;



/*
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
        InterState $interState,
        ConfigSite $configSite,
        InterSection $interSection,
        InterProduct $interProduct,
        ConfigImages $configImages,
        ConfigKeyword $configKeyword,
        ConfigProduct $configProduct)
    {
        $this->interGrid     = $interGrid;
        $this->interModel    = $interModel;
        $this->interState    = $interState;
        $this->configSite    = $configSite->setId(1);
        $this->interSection  = $interSection;
        $this->interProduct  = $interProduct;
        $this->phatFiles     = env('APP_PANEL_URL');
        $this->configImages  = $configImages->setName('default', 'T');
        $this->configKeyword = $configKeyword->random();
        $this->configProduct = $configProduct->setId(1);

    }


    public function index()
    {
        (session('undo') ? $message = session('undo') : $message = null);

        $menu     = $this->interSection->getMenu();
        $states   = $this->interState->getAll();

        $photoUrl = $this->phatFiles.$this->configImages->path;
        $configKeyword = $this->configKeyword;

        $user = Auth::user();

        if ($user) {
            $user_id = Auth::id();
            $session = md5($user_id);
        } else {
            $user_id = 0;
            $session = md5($_SERVER['REMOTE_ADDR']);
        }

        if ($user_id != 0 && $this->configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interModel->getall($session);
        }

        $total = $this->getTotal($cart);

        return view("{$this->view}.cart-1", compact(
            'menu',
            'cart',
            'total',
            'states',
            'session',
            'message',
            'photoUrl',
            'configKeyword')
        );
    }

    public function endpoint(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user_id = Auth::id();
        } else {
            $user_id = 0;
        }

        $ac = $request->input('ajax');

        if ($ac == 'update_shipping_method') {
            $this->method($request->all());
        }

        if ($ac == 'apply_coupon'){
            $this->coupon($request->all());
        }

        if ($ac == 'remove_item'){
            /* guardar session */
            //$undo = $this->interModel->undo($request->input('item'));
            if ($user_id != 0 && $this->configSite->order == 'wishlist'){
                dd('Cart = Lista de desejo');
            } else {
                $delete = $this->interModel->delete($request->input('item'));
            }
            if ($delete){
                //$request->session()->flash('undo', $undo);
                return redirect('cart');
            }
        }
    }

    public function fragments(Request $request)
    {

        $user = Auth::user();
        if ($user) {
            $user_id = Auth::id();
            $session = md5($user_id);
        } else {
            $user_id = 0;
            $session = md5($_SERVER['REMOTE_ADDR']);
        }

        if ($user_id != 0 && $this->configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interModel->getall($session);
        }


        $getTotal = $this->getTotal($cart);
        $total = setReal($getTotal['price_cash']);
        $total_quantity = $getTotal['quantity'];

        $photoUrl = $this->phatFiles.$this->configImages->path;

        $fragments = view("{$this->view}.render.cart-1-fragments", compact('cart','photoUrl', 'total'))->render();
        $cart_quantity = view("{$this->view}.render.cart-1-quantity", compact('total_quantity'))->render();
        $cart_total = view("{$this->view}.render.cart-1-total", compact('total'))->render();


        $out = array(
            "fragments" => array(
                "div.widget_shopping_cart_content" => $fragments,
                "span.basel-cart-number" => $cart_quantity,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => md5(route('cart'))
        );

        return response()->json($out);

    }


    /**
     * Date: 07/01/2019
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function product(Request $request)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
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
            $session = md5($ip);
        }

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

        if ($data) {

            if ($user != 0 && $this->configSite->order == 'wishlist'){
                dd('Cart = Lista de desejo');
            } else {
                $cart = $this->interModel->getall($session);
            }

            $getTotal = $this->getTotal($cart);
            $total = setReal($getTotal['price_cash']);
            $total_quantity = $getTotal['quantity'];


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

        $user = Auth::user();
        if ($user) {
            $user_id = Auth::id();
            $profile_id = $user->profile_id;
            $session = md5($user_id);
        } else {
            $user_id = 0;
            $profile_id = 0;
            $session = md5($_SERVER['REMOTE_ADDR']);
        }


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

        return response()->json($out);

    }





    public function store(Request $request)
    {
        $json = $request['wc-ajax'];
        $list = 1;
        $quantity = 10;
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
            'key' => md5(time()),
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

    /**
     * Date: 07/02/2019
     *
     * @param $cart
     * @return mixed
     */
    public function getTotal($cart)
    {
        $quantity   = 0;
        $price_cash = 0;
        $price_card = 0;
        foreach ($cart as $item) {
            $quantity   += $item->quantity;
            $price_cash += $item->price_cash * $item->quantity;
            $price_card += $item->price_card * $item->quantity;
        }

        $total['quantity']   = $quantity;
        $total['price_cash'] = $price_cash;
        $total['price_card'] = $price_card;

        return $total;

    }


}
