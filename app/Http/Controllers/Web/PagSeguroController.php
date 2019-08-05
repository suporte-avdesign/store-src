<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Services\Web\PagSeguroServicesInterface as ServicePagSeguro;
use AVD\Interfaces\Web\PagSeguroPaymentInterface as InterPagSeguro;
use AVD\Http\Controllers\Controller;

class PagSeguroController extends Controller
{
    private $interPagSeguro;
    private $servicePagSeguro;
    private $view = 'frontend.pagseguro';


    public function __construct(
        InterPagSeguro $interPagSeguro,
        ServicePagSeguro $servicePagSeguro)
    {

        $this->interPagSeguro   = $interPagSeguro;
        $this->servicePagSeguro = $servicePagSeguro;

    }

    public function pagseguro()
    {
        $code = $this->servicePagSeguro->generate();

        $urlRedirect = config('pagseguro.url_redirect_after_request').$code;

        return redirect()->away($urlRedirect);

    }

    public function lightbox()
    {
        return view("{$this->view}.lightbox-1");
    }

    public function lightboxCode()
    {
        return $this->servicePagSeguro->generate();
    }

    public function transparente()
    {
        return view("{$this->view}.transparent-1");
    }


    public function transparenteCode()
    {
        return $this->servicePagSeguro->getSessionId();
    }

    public function card()
    {
        return view("{$this->view}.card-1");
    }

    public function cardTransaction(Request $request)
    {
        return $this->servicePagSeguro->paymentCredCard($request);
    }

    public function billet()
    {
        return view("{$this->view}.billet-1");
    }

    public function billetCode(Request $request)
    {
        $response = $this->servicePagSeguro->paymentBillet($request->senderHash);

        $input = [
            'order_id' => 1,
            'user_id' => auth()->id(),
            'reference' => $response['reference'],
            'code' => $response['code'],
            'status' => 1,
            'method_payment' => 2,
            'value' => '',
            'date' => date('Ymd')
        ];

        $create = $this->interPagSeguro->paymentBillet($input);
        if ($create) {

            return $response()->json($response);

        }

    }



    public function button()
    {
        return view("{$this->view}.button-1");
    }



}
