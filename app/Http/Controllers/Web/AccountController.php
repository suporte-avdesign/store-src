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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function orderView($id)
    {
        return view('accounts.order-1-view');
    }

    public function profile()
    {
        return view('accounts.profile-1');
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
    public function destroy($id)
    {
        //
    }
}
