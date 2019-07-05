<?php

namespace AVD\Http\Controllers\Auth;

use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;


use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    private $view = 'frontend.auth';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        InterSection $interSection,
        InterProfile $interProfile,
        InterAccountType $interAccountType)
    {
        $this->middleware('guest')->except('logout');

        $this->interSection      = $interSection;
        $this->interProfile      = $interProfile;
        $this->interAccountType  = $interAccountType;
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $menu     = $this->interSection->getMenu();
        $types    = $this->interAccountType->getAll();
        $profiles = $this->interProfile->getAll();

        return view("{$this->view}.login-1", compact(
            'menu',
            'types',
            'profiles')
        );
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $menu = $this->interSection->getMenu();
        $types = $this->interAccountType->getAll();

        return view("{$this->view}.login-1", compact(
            'menu',
            'types',
            'profiles')
        );
    }


}
