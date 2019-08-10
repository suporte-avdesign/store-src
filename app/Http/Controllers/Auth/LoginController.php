<?php

namespace AVD\Http\Controllers\Auth;

//use Illuminate\Http\Exceptions\ThrottleRequestsException;

use AVD\Http\Controllers\Controller;
use AVD\Http\Requests\Web\LoginRequest;
use AVD\Http\Requests\Web\LogoutRequest;
use AVD\Interfaces\Web\UserInterface as InterModel;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;



use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = 'account';
    private $view = 'frontend.auth';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        InterModel $interModel,
        InterSection $interSection,
        InterProfile $interProfile,
        ConfigKeyword $configKeyword,
        InterAccountType $interAccountType)
    {
        $this->middleware('guest')->except('logout');

        $this->interModel        = $interModel;
        $this->interSection      = $interSection;
        $this->interProfile      = $interProfile;
        $this->configKeyword     = $configKeyword;
        $this->interAccountType  = $interAccountType;

    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $menu          = $this->interSection->getMenu();
        $types         = $this->interAccountType->getAll();
        $profiles      = $this->interProfile->getAll();
        $configKeyword = $this->configKeyword->random();

        return view("{$this->view}.login-1", compact(
            'menu',
            'types',
            'profiles',
            'configKeyword')
        );
    }


    /**
     * Date: 07/09/2019
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function pageLogin(LoginRequest $request)
    {
        if($request->ajax()) {

            if( isset($request['page'])) {
                $dataForm = $request['page'];
            } elseif (isset($request['user'])) {
                $dataForm = $request['user'];
            }

            if(isset($dataForm)) {


                $email   = $dataForm['email'];
                $password = $dataForm['password'];
                $remember = (isset($dataForm['remember']) ? true : false);

                $exist = $this->interModel->setEmail($email);
                if ($exist) {
                    if ($exist->active == constLang('active_true')) {

                        if (Auth::attempt(['email' => $email, 'password' => $password ], $remember)) {

                            if(Auth::check()) {

                                $visits = $exist->visits + 1;
                                $ip = $_SERVER['REMOTE_ADDR'];
                                $access = [
                                    "visits" => $visits,
                                    "last_login	" => date('Y-m-d H:i:s'),
                                    "ip" => $ip
                                ];

                                $note = $this->interModel->access($access, $exist->id);
                                if ($note) {
                                    $message = 'success_login';
                                    $success = view('frontend.messages.success-1', compact('message'))->render();

                                    return response()->json(['success' => $success, 'redirect' => route('account')]);
                                }

                            } else {

                                return response()->json(['success' => true, 'redirect' => back()]);
                            }

                        }

                    } else {
                        $message = 'account_inactive';
                        $error = view('frontend.messages.error-1', compact('message'))->render();

                        return response()->json(['success' => $error, 'redirect' => route('contact')]);
                    }

                } else {
                    $message = 'no_account';
                    $error = view('frontend.messages.error-1', compact('message'))->render();

                    return response()->json(['success' => $error]);
                }
            }
        }
    }





    /**
     * Obrigatório para limitar as tentativas de accesso..
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }


    public function logout(LogoutRequest $request)
    {
        if (Auth::check()) {
            $id = Auth::user()->getAuthIdentifier();
            $logout = $this->interModel->logout($id);
            if ($logout) {
                $this->guard()->logout();
            }
        }

        return redirect(route('login'));

    }

}
