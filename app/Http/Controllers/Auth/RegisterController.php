<?php

namespace AVD\Http\Controllers\Auth;

use AVD\Events\UserRegisteredNoteEvent;
use AVD\Http\Controllers\Controller;
use AVD\Http\Requests\Web\Register as ValidateRegister;
use AVD\Interfaces\Web\UserInterface as InterModel;

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


    protected function register(ValidateRegister $request)
    {
        $dataForm = $request->all();

        $input               = $dataForm['register'];
        $input['first_name'] = $input["first_name_{$input['type_id']}"];
        $input['last_name']  = $input["last_name_{$input['type_id']}"];
        $input['document1']  = $input["document1_{$input['type_id']}"];
        $input['document2']  = $input["document2_{$input['type_id']}"];
        $input['token']      = Str::random(40);
        $input['ip']         = $request->ip();

        $message = 'user_register';

        $create = $this->interModel->create($input);
        if ($create) {

            $note = [
                'user_id' => $create->id,
                'admin' => constLang('profile_name.user'),
                'label' => constLang('register'),
                'description' => ipLocation('179.197.25.108') //$_SERVER['REMOTE_ADDR']
            ];

            event(new UserRegisteredNoteEvent($note));

            $email = $create->email;
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
                $update = $user->update(['status' => 1, 'token' => NULL]);
                if ($update) {

                    //event(new UserRegisterConfirmedEvent($user));

                    return redirect(route('login'))->with('success', 'A sua conta foi confirmada com sucesso. Entre com seu email e senha abaixo:');

                } else {

                    return redirect(route('register'))->with('error', 'Desculpe, houve um erro no sistema tente mais tarde.');
                }
            } elseif ($user->token == NULL && $user->status == 1) {

                return redirect(route('login'))->with('success', 'Sua conta já se encontra ativa. Faça o login abaixo:');

            } elseif ($user->token == NULL && $user->status == 0) {

                return redirect(route('contact'))->with('error', 'A sua conta está inativa, entre em contato com o administrador. Para reativala entre em contato com nossa equipe');
            }

        }

        return redirect(route('register'))->with('error', 'Não existe nenhum registro com essas credenciais, Para ter acesso a área do revendedor preencha os dados abaixo.');


    }
}
