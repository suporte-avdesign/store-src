<?php

namespace AVD\Services\Web;

use AVD\Traits\PagSeguroTrait;
use AVD\Interfaces\Web\CartInterface as InterCart;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Client as Guzzle;
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
        $uniqid          = uniqid(date('YmdHis'));
        $this->reference = returnNumber($uniqid);
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
        $params = http_build_query($params);

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

        try {
            $guzzle = new Guzzle();
            $response = $guzzle->request('POST', config('pagseguro.url_payment_transparent'), [
                'form_params' => $params,
            ]);

            $body = $response->getBody();
            $contents = $body->getContents(); //receber code para redirecionar o usuário
            $xml = simplexml_load_string($contents); // xml para json

            $out = [
                'success'      => true,
                'payment_link' => (string)$xml->paymentLink,
                'reference'    => $this->reference,
                'code'         => (string)$xml->code,
                'status'       => (string)$xml->status,
                'reference'    => $this->reference,
                'error'        => false
            ];
        } catch (ClientException $e) {
            $out = [
                'success'      => false,
                'reference'    => (string)$e->getMessage(),
                'code'         => (string)$e->getCode(),
                'error'        => (string)$e->getMessage()
            ];
        }

        return typeJson($out);
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
            'notificationURL' => 'https://sualoja.com.br/notificacao.html',

        ];

        $params = array_merge($params, $this->getConfigs());
        $params = array_merge($params, $this->getItems($request->price));
        $params = array_merge($params, $this->getSender());
        $params = array_merge($params, $this->getHolder($request));
        $params = array_merge($params, $this->getShipping());
        $params = array_merge($params, $this->getBilling());
        $params = array_merge($params, $this->getShippingType(
            $request->shipping_method, $request->freight, $request->extraAmount)
        );
       
        try {
            $guzzle = new Guzzle();
            $response = $guzzle->request('POST', config('pagseguro.url_payment_transparent'), [
                'form_params' => $params,
            ]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();

            $contents = $body->getContents(); //receber code para redirecionar o usuário
            $xml = simplexml_load_string($contents); // xml para json

            $out = [
                'success'       => true,
                'reference'     => $this->reference,
                'code'          => (string)$xml->code,
                'reference'     => $this->reference,
                'status'        => (string)$xml->status,
                'error'         => false,
            ];

        } catch (Throwable | ServerException | ClientException $e) {
            $out = [
                'success'       => false,
                'reference'     => (string)$e->getMessage(),
                'code'          => (string)$e->getCode(),
                'status'        => false,
                'error'         => (string)$e->getMessage()
            ];
        }

        return typeJson($out);
    }




}