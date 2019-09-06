<?php

namespace AVD\Http\Controllers\Auth;

use AVD\Http\Controllers\Controller;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    private $content;
    private $view = 'frontend.auth';

    /**
     * @var onfigKeyword
     */
    private $configKeyword;
    /**
     * @var InterSection
     */
    private $interSection;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ConfigKeyword $configKeyword, InterSection $interSection)
    {
        $this->middleware('guest');

        $this->interSection = $interSection;
        $this->configKeyword = $configKeyword;

        $this->content = array(
            'title' => 'Recuperar Senha',
            'label' => 'Nova Senha',
            'email' => 'Digite seu Email',
            'confirm' => 'Digite novamente a nova senha',
            'btn_send' => 'Salvar',
            'text_info' => 'Digite uma nova senha abaixo.',
            'text_error' => '',
            'text_success' => 'Um email de redefinição de senha foi enviado para o endereço de email registrado em sua conta, mas pode levar alguns minutos para aparecer na sua caixa de entrada. Aguarde pelo menos 10 minutos antes de tentar outra redefinição.',
        );
    }


    public function showResetForm(Request $request, $token = null)
    {
        $menu    = $this->interSection->getMenu();
        $email   = $request->email;
        $content = typeJson($this->content);
        $configKeyword  = $this->configKeyword->random();

        return view("$this->view.passwords.reset", compact(
            'menu', 'email', 'token', 'content','configKeyword')
        );

    }



}
