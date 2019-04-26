<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 3;
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );


        return view('wishlists.wishlist-1', compact('product','id'));
    }

    /**
     * Adiciona a qtd no icone na lista de desejo.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $action = $request['action'];
        $qty = 10;


        return  $qty;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = $request->input('action');

        if ($action == 'basel_wishlist_number') {

            // count(totaL) table

            return 2;
        }

        if ($action == 'add_to_wishlist')  {

            $add_to_wishlist = $request->input('add_to_wishlist');
            $product_type    = $request->input('product_type');

            // Salvar no Banco de Dados

                $user_wishlists[] = array(
                    "ID" => "6047",
                    "user_id" => "7159",
                    "wishlist_slug" => "",
                    "wishlist_name" => "",
                    "wishlist_token" => "Y2XKS2STEUIY",
                    "wishlist_privacy" => "0",
                    "is_default" => "1",
                    "dateadded" => "2019-04-16 23:36:58"
                );

                $out = array(
                    "result" => "true",
                    "message" => "Produto adicionado!",
                    "user_wishlists" => $user_wishlists,
                    "wishlist_url" => route('wishlist')
                );

            return response()->json($out);

        }






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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


    public function cart(Request $request)
    {
        $id = 3;
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );


        return view('wishlists.wishlist-1', compact('product','id'));
    }

    public function destroy(Request $request)
    {
        $id = 3;
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );


        return view('wishlists.wishlist-1-list', compact('product','id'));
    }
}
