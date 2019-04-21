<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //sleep(10);
        $_pjax = $request->input('_pjax');
        $orderby = $request->input('orderby');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $filter_color = $request->input('filter_color');
        $filter_size = $request->input('filter_size');

        $num = 2;
        $page = 'page';
        $section = 'shop';

        $str = '?';
        foreach ($request->input() as $key => $value) {
            $str .= $key.'='.$value.'&';
        }

        $parameter = substr($str, 0, -1);

        if ($_pjax) {
            return view('categories.theme-1-filtered',
                compact('section','page','num','_pjax','parameter','orderby','min_price','max_price','filter_color','filter_size')
            );
        }
        else {
            return view('categories.theme-1-list',
                compact('section','page','num','_pjax','parameter','orderby','min_price','max_price','filter_color','filter_size')
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function infinitScroll(Request $request, $section, $pag, $num)
    {
        $loop = $request->input('loop');
        $page = 'page';
        $section = 'shop';


        $input = $request->input();
        $str = '/?';
        foreach ($input as $key => $value) {
            if ($key == 'loop' && $value == 12){
                $value = 24;
            }
            $str .= $key.'='.$value.'&';
        }

        $parameter = substr($str, 0, -1);

        if($loop == 24) {
            $num = 3;
            $status = 'no-more-posts';
            $nextPage = "";
        } else {
            $status = "have-posts";
            $nextPage = route('category.infinit', [$section, $page, $num]).$parameter;
        }

        $products = view('categories.category-1-products')->render();

        $out = array(
            "items" => $products,
            "status" => $status,
            "nextPage" => $nextPage
        );

        return response()->json($out);
    }


    public function filter(Request $request) {

        $_pjax = $request->input('_pjax');
        $orderby = $request->input('orderby');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');
        $filter_color = $request->input('filter_color');
        $filter_size = $request->input('filter_size');

        $input = $request->input();
        $str = '?';
        foreach ($input as $key => $value) {
            $str .= $key.'='.$value.'&';
        }

        $parameter = substr($str, 0, -1);

        if ($_pjax) {
            return view('categories.theme-1-filtered',
                compact('section','page','num','parameter','orderby','min_price','max_price','filter_color','filter_size')
            );
        }
    }

}
