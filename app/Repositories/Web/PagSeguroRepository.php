<?php

namespace AVD\Repositories\Web;

use AVD\Interfaces\Web\PagSeguroInterface;
use GuzzleHttp\Client as Guzzle;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Throwable;



class PagSeguroRepository implements PagSeguroInterface
{


    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct()
    {

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
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
        ];

        $params = http_build_query($params); //email=xpto&token=xpto etc...

        try {
            $guzzle = new Guzzle();
            $response = $guzzle->request('POST', config('pagseguro.url_transparent_session'), [
                'query' => $params,
            ]);
            $body = $response->getBody();
            $contents = $body->getContents(); //receber code para redirecionar o usuário

            $xml = simplexml_load_string($contents); // xml para json

            return $xml->id;
        }  catch (Throwable | ServerException | ClientException $e) {
            return $e->getResponse();
        }
    }


    /**
     * Post em forma de array
     * @param $sendHash
     * @return null|\Psr\Http\Message\ResponseInterface|string
     */
    public function paymentBillet($senderHash)
    {
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
            'senderHash' => $senderHash,
            'paymentMode' => 'default',
            'paymentMethod' => 'boleto',
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
            'senderCPF' => '19410462070', #cpf do cliente
            'senderAreaCode' => '99',
            'senderPhone' => '999999999',
            'senderEmail' => 'c26301320426701778469@sandbox.pagseguro.com.br',
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

        try {
            $guzzle = new Guzzle();
            $response = $guzzle->request('POST', config('pagseguro.url_payment_transparent'), [
                'form_params' => $params,
            ]);
            $body = $response->getBody();
            $contents = $body->getContents(); //receber code para redirecionar o usuário

            $xml = simplexml_load_string($contents); // xml para json

            return $xml->paymentLink;

        }  catch (Throwable | ServerException | ClientException $e) {
            return $e->getResponse();
        }

    }


}