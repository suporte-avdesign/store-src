<?php

namespace AVD\Http\Controllers\Web;

use AVD\Http\Controllers\Controller;


use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSliderInterface as ConfigSlider;
use AVD\Interfaces\Web\ConfigBannerInterface as ConfigBanner;

use AVD\Interfaces\Web\ImageSliderInterface as ImageSlider;
use AVD\Interfaces\Web\ImageBannerInterface as ImageBanner;


use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;



class HomeController extends Controller
{
    public $content;
    public $view = "frontend.home";



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ImageSlider $imageSlider,
        ImageBanner $imageBanner,
        InterSection $interSection,
        ConfigSlider $configSlider,
        ConfigBanner $configBanner,
        ConfigKeyword $configKeyword)
    {
        $this->imageSlider   = $imageSlider;
        $this->imageBanner   = $imageBanner;
        $this->configSlider  = $configSlider;
        $this->configBanner  = $configBanner;
        $this->interSection  = $interSection;
        $this->configKeyword = $configKeyword;


        $this->content = array(
            "title" => "Bem vindo ao site da ".config('company.name'),
        );

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $path = env('APP_PANEL_URL');
        $menu = $this->interSection->getMenu();


        //dd($menu);

        $content = typeJson($this->content);

        $configSlider    = $this->configSlider->setId(1);
        $configBanner    = $this->configBanner->setId(1);
        $imageSlider     = collect($this->imageSlider->getAll('banner'));
        $imageBanner     = collect($this->imageBanner->getAll('four'));
        $pathBanner      = "{$path}{$configBanner->path}{$configBanner->width}x{$configBanner->height}/";
        $pathSlider      = "{$path}{$configSlider->path}{$configSlider->width}x{$configSlider->height}/";
        $pathSliderThumb = "{$path}{$configSlider->path}{$configSlider->width_thumb}x{$configSlider->height_thumb}/";

        $configKeyword   = $this->configKeyword->random();





        return view("{$this->view}.home-1", compact(
            'menu','content','pathSlider','pathBanner', 'pathSliderThumb',
            'imageSlider','imageBanner','configSlider','configBanner','configKeyword'));


    }
}
