<?php

namespace AVD\Http\Controllers\Auth;

use AVD\User;
use AVD\Http\Controllers\Controller;
use AVD\Http\Requests\Web\RegisterUserRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function register(RegisterUserRequest $request)
    {
        $dataForm  = $request->all();
        $address   = $dataForm['address'];
        $user      = $dataForm['user'];
        $ip        = $request->ip();

        dd($dataForm);

        /*

        $user['email']     = strtolower($user['email']);
        $user['token']     = str_random(40);
        $user['ip']        = $ip;
        $user['password']  = bcrypt($user['password']);

        if (isset($user['newsletter'])){
            $user['newsletter'] = 1;
        }

        $create = $this->interModel->create($user);
        if ($create) {

            $address['user_id']  = $create->id;
            $address['delivery'] = 1;

            event(new UserAddressCreatedEvent($address));

            $location =  \Location::get($ip);
            $desc     =  "Local: {$location->cityName}, ";
            $desc    .=  "Estado:{$location->regionName}, ";
            $desc    .=  "CEP:{$location->zipCode}, ";
            $desc    .=  "IP:{$ip}, ";
            $desc    .=  "Latitude:{$location->latitude}, ";
            $desc    .=  "Longitude:{$location->longitude}";


            $note = [
                'user_id' => $create->id,
                'Admin' => 'Cliente',
                'label' => 'Cadastro',
                'description' => $desc
            ];

            event(new UserNoteCreatedEvent($note));


            if ($request->ajax()){

                return response()->json(["success" => 'Foi enviado um código de validação para '.$create->email.'. 
                    Abra este email para concluir o registro.<br/>
                    Se você não receber este e-mail em sua caixa de entrada dentro de 15 minutos,
                    procure na pasta de lixo eletrônico. Se ele estiver ali, marque-o como "Não é lixo eletrônico".']);

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

        */
    }
}
