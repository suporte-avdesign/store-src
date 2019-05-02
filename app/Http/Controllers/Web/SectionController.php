<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class SectionController extends Controller
{




    public function index()
    {
        //
    }

    public function tabs(Request $request)
    {
        $ac = $request['action'];
        if ($ac == 'basel_get_products_tab_shortcode') {
            /*
            $title = $request['atts']['title'];
            $layout = $request['atts']['layout'];
            $post_type = $request['atts']['post_type'];
            $items_per_page = $request['atts']['items_per_page'];
            $product_hover = $request['atts']['product_hover'];
            $slides_per_view = $request['atts']['slides_per_view'];
            $hide_pagination_control = $request['atts']['hide_pagination_control'];
            $include = $request['atts']['include'];
            $carousel_js_inline = $request['atts']['carousel_js_inline'];
            $title = $request['atts']['title'];
            */

            $featured = view('home.carousel.featured-1-ajax')->render();
            $out = array(
                "html" => $featured
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
