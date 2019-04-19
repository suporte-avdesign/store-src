<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.product-1');

    }

    public function search(Request $request)
    {
        $post_type = $request['post_type'];
        $action = $request['action'];
        $number = $request['number'];
        $query = $request['query'];


        $products[] = array(
            "value" => "Produto 1",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img1-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 2",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img2-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 3",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img3-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 4",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img4-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 5",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img5-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 6",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img6-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 7",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img7-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 8",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img8-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 9",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img9-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 10",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>71,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img10-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 11",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>82,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img11-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );

        $products[] = array(
            "value" => "Produto 12",
            "permalink" => "#",
            "price" => '<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">R$ </span>76,00</span>',
            "thumbnail" => '<img width="273" height="273" src="'.asset('faker/product_photos/img12-f.jpg').'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />',
        );




        $out = array(
            "suggestions" => $products
        );


        return response()->json($out);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('products.product-1-view');
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
