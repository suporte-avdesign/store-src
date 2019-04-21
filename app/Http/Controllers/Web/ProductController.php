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

        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "yellow",
                "attribute_pa_size" => "xl"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "woman (7)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 19747,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $out[] = array(
            "attributes" => array(
                "attribute_pa_color" => "red",
                "attribute_pa_size" => "s"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
                "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
                "title" => "woman (4)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19503",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 19748,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $out[] = array(
            "attributes" => array(
            "attribute_pa_color" => "blue",
                "attribute_pa_size" => "m"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
            "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
            "title" => "woman (22)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19512",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 19749,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $out[] = array(
            "attributes" => array(
            "attribute_pa_color" => "blue",
                "attribute_pa_size" => "xl"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
            "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
            "title" => "woman (22)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19512",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23725,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $out[] = array(
            "attributes" => array(
            "attribute_pa_color" => "blue",
                "attribute_pa_size" => "s"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
            "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
            "title" => "woman (22)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-22-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19512",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23726,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $out[] = array(
            "attributes" => array(
            "attribute_pa_color" => "red",
                "attribute_pa_size" => "xl"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
            "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
            "title" => "woman (4)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19503",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23727,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $out[] = array(
            "attributes" => array(
            "attribute_pa_color" => "red",
                "attribute_pa_size" => "m"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
            "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
            "title" => "woman (7)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23728,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $out[] = array(
            "attributes" => array(
            "attribute_pa_color" => "yellow",
                "attribute_pa_size" => "s"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
            "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
            "title" => "woman (7)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23729,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );


        $out[] = array(
            "attributes" => array(
            "attribute_pa_color" => "yellow",
                "attribute_pa_size" => "m"
            ),
            "availability_html" => "",
            "backorders_allowed" => false,
            "dimensions" => array(
            "length" => "",
                "width" => "",
                "height" => ""
            ),
            "dimensions_html" => "N/A",
            "display_price" => 559,
            "display_regular_price" => 559,
            "image" => array(
            "title" => "woman (7)",
                "caption" => "",
                "url" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "alt" => "",
                "src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "srcset" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-526x671.jpg 526w",
                "sizes" => "(max-width => 870px) 100vw, 870px",
                "full_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "full_src_w" => 870,
                "full_src_h" => 1110,
                "gallery_thumbnail_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg",
                "gallery_thumbnail_src_w" => 870,
                "gallery_thumbnail_src_h" => 1110,
                "thumb_src" => "https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg",
                "thumb_src_w" => 273,
                "thumb_src_h" => 348,
                "src_w" => 870,
                "src_h" => 1110
            ),
            "image_id" => "19506",
            "is_downloadable" => false,
            "is_in_stock" => true,
            "is_purchasable" => true,
            "is_sold_individually" => "no",
            "is_virtual" => false,
            "max_qty" => "",
            "min_qty" => 1,
            "price_html" => "",
            "sku" => "",
            "variation_description" => "",
            "variation_id" => 23730,
            "variation_is_active" => true,
            "variation_is_visible" => true,
            "weight" => "",
            "weight_html" => "N/A"
        );

        $product_variations = json_encode($out);


        return view('products.product-1-view', compact('product_variations'));
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
