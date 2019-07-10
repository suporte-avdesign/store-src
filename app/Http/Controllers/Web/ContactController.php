<?php

namespace AVD\Http\Controllers\Web;

use AVD\Http\Controllers\Controller;

use AVD\Http\Requests\Web\ContactRequest;
use AVD\Interfaces\Web\ContactInterface as InterModel;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;


class ContactController extends Controller
{
    private $view = 'frontend.contacts';

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu          = $this->interSection->getMenu();
        $types         = $this->interAccountType->getAll();
        $profiles      = $this->interProfile->getAll();
        $configKeyword = $this->configKeyword->random();

        return view("{$this->view}.contact-1", compact(
            'menu',
            'types',
            'profiles',
            'configKeyword')

        );
    }


    public function store(ContactRequest $request)
    {


        $out = array(
            "into" => "#wpcf7-f4-p456-o1",
            "status" => "mail_failed",
            "message" => "Falha no envio de sua mensagem. Por favor, tente mais tarde ou entre em contato com o administrador por outro método."
        );

        //return response()->json($out);

        return view("{$this->view}.contact-1");
    }

}
