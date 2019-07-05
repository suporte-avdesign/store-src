<?php

namespace AVD\Http\Controllers\Auth;

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
        $input = $dataForm['register'];
        $input['first_name'] = $input["first_name_{$input['type_id']}"];
        $input['last_name']  = $input["last_name_{$input['type_id']}"];
        $input['document1']  = $input["document1_{$input['type_id']}"];
        $input['document2']  = $input["document2_{$input['type_id']}"];
        $input['token']      = Str::random(40);
        $input['ip']         = $request->ip();

        $create = $this->interModel->create($input);
        if ($create) {
            $email = $create->email;
            if ($request->ajax()){
                $success = view('frontend.auth.render.register-success-1', compact('email'))->render();
                return response()->json(["success" => $success]);

            } else {
                $request->session()->flash('success', 'Foi enviado um código de validação para '.$create->email.'. 
                    Se você não receber este e-mail em sua caixa de entrada dentro de 15 minutos,
                    procure na pasta de lixo eletrônico. Se ele estiver ali, marque-o como "Não é lixo eletrônico".');

                return redirect(route('messages'));
            }
        } else {

            if ($request->ajax()){
                return response()->json(["success" => "Desculpe! Infelizmente houve um erro não identificado. Tente novamente mais tarde."]);
            } else {
                $request->session()->flash('error', 'Desculpe! Infelizmente houve um erro não identificado. Tente novamente mais tarde');
                return redirect(route('register'));
            }
        }

    }
}
