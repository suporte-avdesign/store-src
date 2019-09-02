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
use AVD\Interfaces\Web\ConfigFreightInterface as ConfigFreight;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ConfigShippingInterface as ConfigShipping;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;


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
        ConfigFreight $configFreight,
        ConfigProduct $configProduct,
        ConfigShipping $configShipping)
    {
        $this->phatFiles      = env('APP_PANEL_URL');
        $this->interGrid      = $interGrid;
        $this->interModel     = $interModel;
        $this->interState     = $interState;
        $this->configSite     = $configSite;
        $this->interSection   = $interSection;
        $this->interProduct   = $interProduct;
        $this->configImages   = $configImages;
        $this->configKeyword  = $configKeyword;
        $this->configFreight  = $configFreight;
        $this->configProduct  = $configProduct;
        $this->configShipping = $configShipping;
    }


    public function index()
    {

        (session('undo') ? $message = session('undo') : $message = null);

        $menu    = $this->interSection->getMenu();
        $states  = $this->interState->getAll();

        $configImages   = $this->configImages->setName('default', 'T');
        $photoUrl       = $this->phatFiles.$configImages->path;
        $configKeyword  = $this->configKeyword->random();
        $configFreight  = $this->configFreight->setId(1);
        $configShipping = $this->configShipping->getAll();



        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);

        $configSite = $this->configSite->setId(1);
        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interModel->getAll();

        }

        $total = $this->interModel->getTotal($cart);


        return view("{$this->view}.cart-1", compact(
            'menu','cart','total','states','message','photoUrl',
            'configFreight','configKeyword','configShipping'));
    }

    public function endpoint(Request $request)
    {
        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);

        $ac = $request->input('ajax');


        if ($ac == 'apply_coupon'){
            $this->coupon($request->all());
        }

        if ($ac == 'remove_item'){
            /* guardar session */
            //$undo = $this->interModel->setKey($request->input('item'));
            $configSite = $this->configSite->setId(1);
            if ($user_id != 0 && $configSite->order == 'wishlist'){
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

    /**
     * Date: 07/01/2019
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fragments(Request $request)
    {

        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);

        $configSite = $this->configSite->setId(1);
        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interModel->getAll();
        }


        $getTotal       = $this->interModel->getTotal($cart);
        $total          = setReal($getTotal['price_cash']);
        $total_quantity = $getTotal['quantity'];
        $configImages   = $this->configImages->setName('default', 'T');
        $photoUrl       = $this->phatFiles.$configImages->path;

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
        //sleep(30);
        $quantity        = $request->input('quantity');
        $product_id      = $request->input('product_id');
        $grid_product_id = $request->input('variation_id');

        $user = Auth::user();
        if ($user) {
            $user_id = Auth::id();
            $profile_id = $user->profile_id;
        } else {
            $user_id = 0;
            $profile_id = 0;
        }

        $product = $this->interProduct->setId($product_id);
        $grids   = $this->interGrid->setId($grid_product_id);
        $color   = $grids->color()->first();

        $exist = $this->interModel->existProduct($grid_product_id);
        if ($exist) {
            $input = [
                'quantity' => $quantity
            ];
            $data = $this->interModel->update($input, $exist->id);

        } else {

            $dataForm = $this->insert($_SERVER['REMOTE_ADDR'], $user_id, $profile_id, $product, $color, $grids, $quantity);
            $data   = $this->interModel->create($dataForm);
        }

        if ($data) {

            $configSite = $this->configSite->setId(1);
            if (Auth::user() && $configSite->order == 'wishlist'){
                dd('Cart = Lista de desejo');
            } else {
                $cart = $this->interModel->getAll();
            }

            $getTotal       = $this->interModel->getTotal($cart);
            $total          = setReal($getTotal['price_cash']);
            $total_quantity = $getTotal['quantity'];

            $configImages   = $this->configImages->setName('default', 'T');
            $photoUrl       = $this->phatFiles.$configImages->path;


            $notices       = view("{$this->view}.render.cart-1-notices", compact('product','quantity'))->render();
            $fragments     = view("{$this->view}.render.cart-1-fragments", compact('cart','photoUrl', 'total'))->render();
            $cart_total    = view("{$this->view}.render.cart-1-total", compact('total'))->render();
            $cart_quantity = view("{$this->view}.render.cart-1-quantity", compact('total_quantity'))->render();

            $out = array(
                "notices" => $notices,
                "fragments" => array(
                    "div.widget_shopping_cart_content" => $fragments,
                    "span.basel-cart-number" => $cart_quantity,
                    "span.basel-cart-subtotal" => $cart_total
                ),
                "cart_hash" =>  md5($_SERVER['REMOTE_ADDR'])
            );
        }



        return response()->json($out);



    }


    /**
     * Date: 07/01/2019
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $json     = $request['wc-ajax'];
        $list     = 1;
        $quantity = 0;
        $total    = '0,00';



        $user = Auth::user();
        if ($user) {
            $user_id = Auth::id();
            $profile_id = $user->profile_id;
        } else {
            $user_id = 0;
            $profile_id = 0;
        }

        $notices       = view("{$this->view}.render.cart-1-notices", compact('product','quantity'))->render();
        $fragments     = view("{$this->view}.render.cart-1-fragments", compact('cart','photoUrl', 'total'))->render();
        $cart_total    = view("{$this->view}.render.cart-1-total", compact('total'))->render();
        $cart_quantity = view("{$this->view}.render.cart-1-quantity", compact('total_quantity'))->render();

        $out = array(
            "notices" => $notices,
            "fragments" => array(
                "div.widget_shopping_cart_content" => $fragments,
                "span.basel-cart-number" => $cart_quantity,
                "span.basel-cart-subtotal" => $cart_total
            ),
            "cart_hash" => md5($_SERVER['REMOTE_ADDR'])
        );

        return response()->json($out);

    }


    /**
     * Date: 07/01/2019
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {

        $dataForm = $request['cart'];
        $update   = $this->interModel->updateAll($dataForm);
        if ($update) {

            $message = 'success_login';
            $success = view('frontend.messages.success-1', compact('message'))->render();

            $request->session()->flash('success', $success);
            return $this->index();
        }
    }




/*

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
*/




    public function shipping(Request $request)
    {
        dd($request);
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

        return $render;
    }

    public function undo(Request $request)
    {
        $undo_item = $request['undo_item'];
    }

    public function insert($ip, $user_id, $profile_id, $product, $color, $grids, $quantity)
    {
        $configProduct = $this->configProduct->setId(1);
        foreach ($product->prices as $price) {

            if ($price->profile == $configProduct->price_default) {
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
            'session' =>  md5($_SERVER['REMOTE_ADDR']),
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
            'declare' => $product->declare,
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
