<?php

namespace AVD\Http\Controllers\Web;

use AVD\Http\Controllers\Controller;
use AVD\Interfaces\Web\UserInterface as InterModel;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $view = 'frontend.accounts';

    public function __construct(
        InterModel $interModel,
        InterState $interState,
        ConfigSite $configSite,
        InterSection $interSection,
        ConfigImages $configImages,
        ConfigKeyword $configKeyword,
        ConfigProduct $configProduct)
    {
       $this->middleware('auth');

        $this->interModel    = $interModel;
        $this->interState    = $interState;
        $this->configSite    = $configSite->setId(1);
        $this->interSection  = $interSection;
        $this->phatFiles     = env('APP_PANEL_URL');
        $this->configImages  = $configImages->setName('default', 'T');
        $this->configKeyword = $configKeyword->random();
        $this->configProduct = $configProduct->setId(1);

    }

    public function index()
    {
        $user     = $this->interModel->setId(Auth::id());
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'dashboard';
        $configKeyword = $this->configKeyword;



        return view("{$this->view}.dashboard-1", compact(
            'user',
            'menu',
            'sidebar',
            'configKeyword')
        );
    }

    public function wishlist()
    {
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'wishlist';

        $id = 3;

        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );

        return view("{$this->view}.wishlist-1", compact(
            'menu',
            'sidebar',
            'product',
            'id'
        ));
    }

    public function order()
    {
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'orders';
        $id = 12345;

        return view("{$this->view}.order-1", compact(
            'menu',
            'sidebar',
            'id'
        ));
    }

    public function orderView($id)
    {
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'orders';


        return view("{$this->view}.order-1-view", compact(
            'menu',
            'sidebar'
        ));

    }

    public function profile(Request $request)
    {
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'profile';

        return view("{$this->view}.profile-1", compact(
            'menu',
            'sidebar'
        ));

    }

    public function address()
    {
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'address';

        return view("{$this->view}.address-1", compact(
            'menu', 'sidebar'
        ));

    }

    public function addressUpdate(Request $request)
    {
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'address';

        return view("{$this->view}.address-1", compact(
            'menu', 'sidebar'
        ));
    }






}
