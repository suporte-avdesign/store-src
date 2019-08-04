<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Interfaces\Web\PagSeguroInterface as InterPagSeguro;
use AVD\Http\Controllers\Controller;

class PagSeguroController extends Controller
{
    /**
     * @var InterPagSeguro
     */
    private $pagSeguro;
    private $view = 'frontend.pagseguro';

    public function __construct(InterPagSeguro $pagSeguro)
    {

        $this->pagSeguro = $pagSeguro;
    }

    public function pagseguro()
    {
        $code = $this->pagSeguro->generate();

        $urlRedirect = config('pagseguro.url_redirect_after_request').$code;

        return redirect()->away($urlRedirect);

    }

    public function lightbox()
    {
        return view("{$this->view}.lightbox-1");
    }

    public function lightboxCode()
    {
        return $this->pagSeguro->generate();
    }

    public function transparente()
    {
        return view("{$this->view}.transparent-1");
    }


    public function transparenteCode()
    {
        return $this->pagSeguro->getSessionId();
    }

    public function card()
    {
        return view("{$this->view}.card-1");
    }

    public function cardTransaction(Request $request)
    {
        return $this->pagSeguro->paymentCredCard($request);
    }

    public function billet()
    {
        return view("{$this->view}.billet-1");
    }

    public function billetCode(Request $request)
    {
        return $this->pagSeguro->paymentBillet($request->senderHash);
    }



    public function button()
    {
        return view("{$this->view}.button-1");
    }



}
