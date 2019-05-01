<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class AccountController extends Controller
{

    public function index()
    {
        return view('accounts.dashboard-1');
    }

    public function wishlist()
    {
        $id = 3;
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );

        return view('accounts.wishlist-1', compact(
            'product', 'id'
        ));
    }

    public function order()

    {
        $id = 12345;
        return view('accounts.order-1', compact('id'));
    }

    public function orderView($id)
    {
        return view('accounts.order-1-view');
    }

    public function profile(Request $request)
    {
        return view('accounts.profile-1');
    }

    public function address()
    {
        return view('accounts.address-1');
    }

    public function addressUpdate(Request $request)
    {
        return view('accounts.address-1');
    }






}
