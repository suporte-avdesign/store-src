<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\ContentDeliveryInterface as Delivery;
use AVD\Interfaces\Web\ContentContractInterface as Contract;
use AVD\Interfaces\Web\ContentFormPaymentInterface as FormPayment;
use AVD\Interfaces\Web\ContentPrivacyPolicyInterface as PrivacyPolicy;
use AVD\Interfaces\Web\ContentDeliveryReturnInterface as DeliveryReturn;
use AVD\Interfaces\Web\ContentTermsConditionsInterface as TermsConditions;

class PagesController extends Controller
{

    private $view = 'frontend.pages';

    public function __construct(
        Contract $contract,
        Delivery $delivery,
        FormPayment $formPayment,
        InterSection $interSection,
        PrivacyPolicy $privacyPolicy,
        ConfigKeyword $configKeyword,
        DeliveryReturn $deliveryReturn,
        TermsConditions $termsConditions)
    {
        $this->delivery = $delivery;
        $this->contract = $contract;
        $this->formPayment = $formPayment;
        $this->interSection = $interSection;
        $this->privacyPolicy = $privacyPolicy;
        $this->configKeyword = $configKeyword;
        $this->deliveryReturn = $deliveryReturn;
        $this->termsConditions = $termsConditions;

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




    public function terms()
    {
        $menu    = $this->interSection->getMenu();
        $terms   = $this->termsConditions->getAll();
        $contracts = $this->contract->getAll();
        $content = typeJson($this->content);
        $configKeyword = $this->configKeyword->random();

        return view("$this->view.terms-conditions-1", compact(
            'menu', 'terms', 'content', 'contracts', 'configKeyword'
        ));
    }

    public function privacy()
    {
        $menu = $this->interSection->getMenu();
        $content = typeJson($this->content);
        $privacities = $this->privacyPolicy->getAll();
        $configKeyword  = $this->configKeyword->random();


        return view("$this->view.privacy-policy-1", compact(
            'menu', 'content', 'privacities', 'configKeyword'
        ));
    }

    public function contract()
    {
        $menu = $this->interSection->getMenu();
        $content = typeJson($this->content);
        $contracts = $this->contract->getAll();
        $configKeyword  = $this->configKeyword->random();


        return view("$this->view.contract-1", compact(
            'menu', 'content', 'contracts', 'configKeyword'
        ));
    }

    public function deliveries()
    {
        $menu = $this->interSection->getMenu();
        $content = typeJson($this->content);
        $deliveries = $this->delivery->getAll();
        $configKeyword  = $this->configKeyword->random();


        return view("$this->view.delivery-1", compact(
            'menu', 'content', 'deliveries', 'configKeyword'
        ));
    }

    public function deliveryReturn()
    {
        $menu = $this->interSection->getMenu();
        $content = typeJson($this->content);
        $returns = $this->deliveryReturn->getAll();
        $configKeyword  = $this->configKeyword->random();


        return view("$this->view.delivery-return-1", compact(
            'menu', 'content', 'returns', 'configKeyword'
        ));
    }

    public function payment()
    {
        $menu = $this->interSection->getMenu();
        $content = typeJson($this->content);
        $payments = $this->formPayment->getAll();
        $configKeyword  = $this->configKeyword->random();


        return view("$this->view.form-payment-1", compact(
            'menu', 'content', 'payments', 'configKeyword'
        ));
    }





}
