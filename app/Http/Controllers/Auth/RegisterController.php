<?php

namespace AVD\Http\Controllers\Auth;

use AVD\Http\Controllers\Controller;
use AVD\Events\UserRegisteredNoteEvent;
use AVD\Events\UserRegisterConfirmedEvent;
use AVD\Interfaces\Web\UserInterface as InterModel;
use AVD\Http\Requests\Web\Register as ValidateRegister;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    /**
     * @var InterModel
     */
    private $interModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InterModel $interModel)
    {
        $this->middleware('guest');

        $this->interModel = $interModel;
    }

    /**
     * Date: 07/07/2019
     *
     * @param ValidateRegister $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function register(ValidateRegister $request)
    {
        $dataForm = $request->all();

        $input               = $dataForm['register'];
        $input['first_name'] = $input["first_name_{$input['type_id']}"];
        $input['last_name']  = $input["last_name_{$input['type_id']}"];
        $input['document1']  = $input["document1_{$input['type_id']}"];
        $input['document2']  = $input["document2_{$input['type_id']}"];
        $input['active']     = constLang('active_false');
        $input['token']      = Str::random(40);
        $input['ip']         = $request->ip();

        $create = $this->interModel->create($input);
        if ($create) {

            $note = [
                'user_id' => $create->id,
                'admin' => constLang('profile_name.user'),
                'label' => constLang('register'),
                'description' => ipLocation()
            ];

            event(new UserRegisteredNoteEvent($note));

            $email   = $create->email;
            $message = 'user_register';
            $success = view('frontend.messages.success-1', compact('email','message'))->render();

            if ($request->ajax()){
                return response()->json(["success" => $success, "redirect" => route('login')]);

            } else {
                $request->session()->flash('success', $success);

                return redirect(route('messages'));
            }
        } else {
            $error = view('frontend.messages.error-1', compact('message'))->render();

            if ($request->ajax()){
                return response()->json(["success" => $error]);
            } else {
                $request->session()->flash('error', $error);
                return redirect(route('register'));
            }
        }
    }


    protected function verifyToken($email, $token)
    {
        $user = $this->interModel->setEmail($email);
        if ($user) {
            if ($user->token == $token) {
                $update = $user->update(['active' => constLang('active_true'), 'token' => NULL]);
                if ($update) {

                    event(new UserRegisterConfirmedEvent($user));

                    return redirect(route('login'))->with('success', constLang('success_confirmed'));

                } else {

                    return redirect(route('register'))->with('error', 'Desculpe, houve um erro no sistema tente mais tarde.');
                }
            } elseif ($user->token == NULL && $user->active == constLang('active_true')) {

                return redirect(route('login'))->with('success', constLang('active_token_null'));

            } elseif ($user->token == NULL && $user->active == constLang('active_false')) {

                return redirect(route('contact'))->with('error', constLang('account_inactive'));
            }

        }

        return redirect(route('register'))->with('error', constLang('no_account'));


    }
}
