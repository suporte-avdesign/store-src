<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\SectionInterface as InterModel;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\CategoryInterface as InterCategory;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;


class SectionController extends Controller
{
    private $view = 'frontend.sections';

    public function __construct(
        ConfigSite $configSite,
        InterModel $interModel,
        ConfigImages $configImages,
        InterCategory $interCategory,
        ConfigKeyword $configKeyword,
        ConfigProduct $configProduct)
    {
        //$this->middleware('auth');

        $this->configSite    = $configSite->setId(1);
        $this->interModel    = $interModel;
        $this->configImages  = $configImages;
        $this->interCategory = $interCategory;
        $this->configKeyword = $configKeyword->random();
        $this->configProduct = $configProduct->setId(1);
    }


    public function index($slug)
    {


        $menu          = $this->interModel->getMenu();
        $section       = $this->interModel->get($slug);
        $path          = env('APP_PANEL_URL');
        $configImage   = $this->configImages->setName('default', 'N');
        $photoUrl      = $path.$configImage->path;
        $configSite    = $this->configSite;
        $configProduct = $this->configProduct;
        $configKeyword = $this->configKeyword;

        if ($configSite->list == 1) {
            $categories = $this->interCategory->getSectionProducts($this->configSite, $this->configProduct, $section->id);
        } elseif ($configSite->list == 2) {
            $categories = $this->interCategory->getSectionColors($this->configSite, $this->configProduct, $section->id);
        }


        //dd($configKeyword);



        //sleep(10);
        $_pjax = '';
        $orderby = '';
        $min_price = '';
        $max_price = '';
        $filter_color = '';
        $filter_size = '';

        $num = 2;
        $page = 'page';
        $parameter = '';


        if ($_pjax) {
            return view("{$this->view}.section-1-filtered",
                compact('slug','section','page','num','_pjax','parameter','orderby','min_price','max_price','filter_color','filter_size')
            );
        }
        else {

            return view("{$this->view}.section-1",compact(
                'configSite',
                'configKeyword',
                'configProduct',
                'configImage',
                'menu',
                'slug',
                'section',
                'categories',
                'photoUrl',
                'page',
                'num','_pjax','parameter','orderby','min_price','max_price','filter_color','filter_size')
            );
        }
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
