<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\CategoryInterface as InterModel;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;

class CategoryController extends Controller
{

    public function __construct(
        ConfigSite $configSite,
        InterModel $interModel,
        InterSection $interSection,
        ConfigImages $configImages,
        ConfigKeyword $configKeyword,
        ConfigProduct $configProduct)
    {
        //$this->middleware('auth');

        $this->configSite    = $configSite->setId(1);
        $this->interModel    = $interModel;
        $this->interSection  = $interSection;
        $this->configImages  = $configImages;
        $this->configKeyword = $configKeyword->random();
        $this->configProduct = $configProduct->setId(1);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

        $menu          = $this->interSection->getMenu();
        $path          = env('APP_PANEL_URL');
        $configSite    = $this->configSite;
        $configImage   = $this->configImages->setName('default', 'N');
        $photoUrl      = $path.$configImage->path;
        $configProduct = $this->configProduct;
        $configKeyword = $this->configKeyword;

        if ($configSite->list == 1) {
            $category = $this->interModel->getProducts($configSite, $configProduct, $slug);
        } else if ($configSite->list == 2) {
            $category = $this->interModel->getColors($configSite, $configProduct, $slug);
        }


        //sleep(10);
        $_pjax = '';
        $orderby = '';
        $min_price = '';
        $max_price = '';
        $filter_color = '';
        $filter_size = '';

        $num = 2;
        $page = 'page';
        $section = 'shop';
        $parameter = '';


        if ($_pjax) {
            return view('categories.category-1-filtered',
                compact('slug','section','page','num','_pjax','parameter','orderby','min_price','max_price','filter_color','filter_size')
            );
        }
        else {
            return view('frontend.categories.category-1', compact(
                'configSite',
                'configKeyword',
                'configProduct',
                'configImage',
                'category',
                'photoUrl',
                'menu',
                'slug',
                'section','page','num','_pjax','parameter','orderby','min_price','max_price','filter_color','filter_size')
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
            return view('categories.category-1-filtered',
                compact('section','page','num','parameter','orderby','min_price','max_price','filter_color','filter_size')
            );
        }
    }

}
