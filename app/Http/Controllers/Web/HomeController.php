<?php

namespace AVD\Http\Controllers\Web;

use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\SectionInterface as InterSection;
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
        InterSection $interSection,
        ConfigKeyword $configKeyword)
    {
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

        $menu = $this->interSection->getMenu();

        $content = typeJson($this->content);

        $configKeyword = $this->configKeyword->random();



        return view("{$this->view}.home-1", compact(
            'menu','content','configKeyword'));


    }
}
