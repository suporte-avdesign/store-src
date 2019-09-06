<?php

namespace AVD\Http\Controllers\Auth;

use AVD\Http\Controllers\Controller;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    private $content;
    private $view = 'frontend.auth';
    /**
     * @var ConfigKeyword
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
            'label' => 'Digite seu Email',
            'btn_send' => 'Recuperar Senha',
            'text_send' => 'O email de redefinição de senha foi enviado.',
            'text_info' => 'Perdeu sua senha? Digite seu email. Você receberá um link para criar uma nova senha por email.',
            'text_error' => '',
            'text_success' => 'Um email de redefinição de senha foi enviado para o endereço de email registrado em sua conta, mas pode levar alguns minutos para aparecer na sua caixa de entrada. Aguarde pelo menos 10 minutos antes de tentar outra redefinição.',
        );
    }


    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $menu    = $this->interSection->getMenu();
        $content = typeJson($this->content);
        $configKeyword  = $this->configKeyword->random();

        return view("$this->view.passwords.email", compact('menu','content','configKeyword'));
    }







}
