<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'remover';
        $id = 12345;
        // Route('products')
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );

        return view('compare.compare-1', compact(
            'page', 'id', 'product'
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id =  $request->input('id'); // product_id
        $action =  $request->input('action');//basel_add_to_compare

        $page = 'remover';
        // Route('products')
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );



        $compare = view('compare.compare-1-table', compact(
            'page','id', 'product'))->render();
        $out = array(
            "count" => 1,
            "table" => $compare
        );

        return response()->json($out);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $page, $id)
    {
        $id = $request->input('id');
        $ac = $request->input('action');
        $page = 'remover';
        // Route('products')
        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );



        if ($ac == 'remove') {

            $compare = view('compare.compare-1-table', compact(
                'page','id', 'product'))->render();
            $out = array(
                "count" => 1,
                "table" => $compare
            );

            return response()->json($out);
        }

        return redirect()->route('compare');


    }
}
