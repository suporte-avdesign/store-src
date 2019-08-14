<?php

namespace AVD\Services\Web;

use AVD\Traits\PagSeguroTrait;
use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Services\Web\PagSeguroServicesInterface;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Client as Guzzle;

use Illuminate\Support\Facades\Auth;
use Throwable;



class PagSeguroServices implements PagSeguroServicesInterface
{

    use PagSeguroTrait;

    private $interCart;
    private $reference;
    private $currency = 'BRL';
    private $country = 'BRA';



    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(InterCart $interCart)
    {

        $this->interCart = $interCart;
        $this->reference = onlyNumber(uniqid(date('YmdHis')));
    }

    /**
     * LightBox
     *
     * @param  array $input
     * @return mixed
     */
    public function generate()
    {
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
            'currency' => 'BRL',
            'itemId1' => '0001',
            'itemDescription1' => 'Produto PagSeguroI',
            'itemAmount1' => '99999.99',
            'itemQuantity1' => '1',
            'itemWeight1' => '1000',
            'itemId2' => '0002',
            'itemDescription2' => 'Produto PagSeguroII',
            'itemAmount2' => '99999.98',
            'itemQuantity2' => '2',
            'itemWeight2' => '750',
            'reference' => 'REF1234',
            'senderName' => 'Jose Comprador',
            'senderAreaCode' => '99',
            'senderPhone' => '999999999',
            'senderEmail' => 'comprador@uol.com.br',
            'shippingType' => '1',
            'shippingAddressRequired' => 'true',
            'shippingAddressStreet' => 'Av. PagSeguro',
            'shippingAddressNumber' => '9999',
            'shippingAddressComplement' => '99o andar',
            'shippingAddressDistrict' => 'Jardim Internet',
            'shippingAddressPostalCode' => '99999999',
            'shippingAddressCity' => 'Cidade Exemplo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'BRA',
            'timeout' => '25',
            'enableRecover' => 'false'
        ];

        $params = http_build_query($params); //email=xpto&token=xpto etc...

        try {
            $guzzle = new Guzzle();
            $response = $guzzle->request('POST', config('pagseguro.url_checkout'), [
                'query' => $params,
            ]);
            $body = $response->getBody();
            $contents = $body->getContents(); //receber code para redirecionar o usuário

            $xml = simplexml_load_string($contents); // xml para json

            return $xml->code;

        }  catch (Throwable | ServerException | ClientException $e) {
            return $e->getResponse();
        }

    }


    public function getSessionId()
    {
        $params = $this->getConfigs();
        $params = http_build_query($params); //email=xpto&token=xpto etc...

        $guzzle = new Guzzle();
        $response = $guzzle->request('POST', config('pagseguro.url_transparent_session'), [
            'query' => $params,
        ]);
        $body = $response->getBody();
        $contents = $body->getContents(); //receber code para redirecionar o usuário

        $xml = simplexml_load_string($contents); // xml para json

        return $xml->id;
    }


    /**
     * Post em forma de array
     * @param $sendHash
     * @return null|\Psr\Http\Message\ResponseInterface|string
     */
    public function paymentBillet($request)
    {
        $params = [
            'senderHash'    => $request->senderHash,
            'paymentMode'   => 'default',
            'paymentMethod' => 'boleto',
            'currency'      => $this->currency,
            'reference'     => $this->reference,
            'timeout'       => '25',
            'enableRecover' => 'false'
        ];

        $params = array_merge($params, $this->getConfigs());
        $params = array_merge($params, $this->getItems($request->price));
        $params = array_merge($params, $this->getSender());
        $params = array_merge($params, $this->getShipping());
        $params = array_merge($params, $this->getShippingType(
            $request->shipping_method, $request->freight, $request->extraAmount)
        );


        //dd($params);

        $guzzle = new Guzzle();
        $response = $guzzle->request('POST', config('pagseguro.url_payment_transparent'), [
            'form_params' => $params,
        ]);

        $body = $response->getBody();
        $contents = $body->getContents(); //receber code para redirecionar o usuário
        $xml = simplexml_load_string($contents); // xml para json

        return [
            'success' => true,
            'payment_link' => (string)$xml->paymentLink,
            'reference' => $this->reference,
            'code' => (string)$xml->code
        ];
    }


    public function paymentCredCard($request)
    {
        $installments = explode('|', $request->installments);
        $installmentQuantity = $installments[0];
        $installmentValue = number_format($installments[1], 2, '.', '');
        $params = [
            'paymentMode' => 'default',
            'paymentMethod' => 'creditCard',
            'currency' => $this->currency,
            'senderHash' => $request->senderHash,
            'creditCardToken' => $request->cardToken,
            'reference' => $this->reference,
            'extraAmount' =>  $request->extraAmount,
            'installmentQuantity' => $installmentQuantity,
            'installmentValue' => $installmentValue,
            'noInterestInstallmentQuantity' => $request->maxInstallment,
            'creditCardHolderName' => 'Jose Comprador',
            'creditCardHolderCPF' => '22111944785',
            'creditCardHolderBirthDate' => '27/10/1987',
            'creditCardHolderAreaCode' => '11',
            'creditCardHolderPhone' => '56273440',
            'notificationURL' => 'https://sualoja.com.br/notificacao.html',
        ];

        $params = array_merge($params, $this->getConfigs());
        $params = array_merge($params, $this->getItems($request->price));
        $params = array_merge($params, $this->getSender());
        $params = array_merge($params, $this->getShipping());
        $params = array_merge($params, $this->getBilling());
        $params = array_merge($params, $this->getShippingType(
            $request->shipping_method, $request->freight, $request->extraAmount)
        );

        $guzzle = new Guzzle();
        $response = $guzzle->request('POST', config('pagseguro.url_payment_transparent'), [
            'form_params' => $params,
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $contents = $body->getContents(); //receber code para redirecionar o usuário
        $xml = simplexml_load_string($contents); // xml para json

        return $xml->code;

    }

    /**
     * Usar para teste
     *
     * @param $request
     * @return array
     */
    public function defaultBillet($request)
    {
        $user     = Auth::user();
        $adresses = $user->adresses()->orderBy('id','desc')->first();
        return [
            'paymentMode' => 'default',
            'paymentMethod' => 'boleto',
            'currency' => $this->currency,
            'extraAmount' => '0.00',
            'itemId1' => '85765',
            'itemDescription1' => 'Notebook Prata',
            'itemAmount1' => $request->value,
            'itemQuantity1' => 1,
            'notificationURL' => 'http://anselmovelame.com.br',
            'senderName' => 'Jose Comprador',
            'senderCPF' => '22111944785',
            'senderAreaCode' => '75',
            'senderPhone' => '36272414',
            'senderEmail' => 'teste@sandbox.pagseguro.com.br',
            'senderHash' => $request->senderHash,
            'shippingAddressRequired' => 'true',
            'shippingType' => $request->shipping_method,
            'shippingCost' => '0'.$request->freight,

            'shippingAddressStreet' => $adresses->address,
            'shippingAddressNumber' => $adresses->number,
            'shippingAddressComplement' => $adresses->complement,
            'shippingAddressDistrict' => $adresses->district,
            'shippingAddressPostalCode' => preg_replace("/[^0-9]/", "", $adresses->zip_code),
            'shippingAddressCity' => $adresses->city,
            'shippingAddressState' => $adresses->state,
            'shippingAddressCountry' => $adresses->country,

        ];
    }

    /**
     * Usar para teste
     *
     * @param $request
     * @return array
     */
    public function defaultCredit($request)
    {

        $user     = Auth::user();
        $adresses = $user->adresses()->orderBy('id','desc')->first();
        // Pega as informações de parcelas (installments) selecionada pelo usuário
        $installments = explode('|', $request->installments);
        // Quantidade de parcelas
        $installmentQuantity = $installments[0];
        // (O valor da parcela também pode ser calculado dividindo o total do carrinho pela quantidade de parcelas:
        // $this->cart->total() / $installmentQuantity)
        $installmentValue = number_format($installments[1], 2, '.', '');

        return [
            'paymentMode' => 'default',
            'paymentMethod' => 'creditCard',
            'currency' => 'BRL',
            'extraAmount' => '0.00',
            'itemId1' => '174788848',
            'itemDescription1' => 'Notebook Prata',
            'itemAmount1' => '435.36',
            'itemQuantity1' => '1',
            'notificationURL' => 'http://anselmovelame.com.br',
            'reference' => $this->reference,
            'senderName' => 'Jose Comprador',
            'senderCPF' => '22111944785',
            'senderAreaCode' => '75',
            'senderPhone' => '36272414',
            'senderEmail' => 'teste@sandbox.pagseguro.com.br',
            'senderHash' => $request->senderHash,

            'shippingAddressStreet' => $adresses->address,
            'shippingAddressNumber' => $adresses->number,
            'shippingAddressComplement' => $adresses->complement,
            'shippingAddressDistrict' => $adresses->district,
            'shippingAddressPostalCode' => preg_replace("/[^0-9]/", "", $adresses->zip_code),
            'shippingAddressCity' => $adresses->city,
            'shippingAddressState' => $adresses->state,
            'shippingAddressCountry' => $adresses->country,

            'shippingType' => '3',
            'shippingCost' => '0'.$request->freight,
            'creditCardToken' => $request->cardToken,
            'installmentQuantity' => $installmentQuantity,
            'installmentValue' => $installmentValue,
            'noInterestInstallmentQuantity' => $request->maxInstallment,
            'creditCardHolderName' => 'Jose Comprador',
            'creditCardHolderCPF' => '22111944785',
            'creditCardHolderBirthDate' => '27/10/1987',
            'creditCardHolderAreaCode' => '75',
            'creditCardHolderPhone' => '36272414',

            'billingAddressStreet' => $adresses->address,
            'billingAddressNumber' => $adresses->number,
            'billingAddressComplement' => $adresses->complement,
            'billingAddressDistrict' => $adresses->district,
            'billingAddressPostalCode' => preg_replace("/[^0-9]/", "", $adresses->zip_code),
            'billingAddressCity' => $adresses->city,
            'billingAddressState' => $adresses->state,
            'billingAddressCountry' => $adresses->country,
        ];


    }




}