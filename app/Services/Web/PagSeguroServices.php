<?php

namespace AVD\Services\Web;

use AVD\Traits\PagSeguroTrait;
use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Services\Web\PagSeguroServicesInterface;

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
    public function paymentBillet($senderHash)
    {
        $params = [
            'senderHash'    => $senderHash,
            'paymentMode'   => 'default',
            'paymentMethod' => 'boleto',
            'currency'      => $this->currency,
            'reference'     => $this->reference,
            'timeout'       => '25',
            'enableRecover' => 'false',
            'shippingType' => '1', #metodo de envio
            'shippingCost' => '01.00', #frete
        ];

        $params = array_merge($params, $this->getConfigs());
        $params = array_merge($params, $this->getItems());
        $params = array_merge($params, $this->getSender());
        $params = array_merge($params, $this->getShipping());


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
        // Pega as informações de parcelas (installments) selecionada pelo usuário
        $installments = explode('|', $request->installments);
        // Quantidade de parcelas
        $installmentQuantity = $installments[0];
        // (O valor da parcela também pode ser calculado dividindo o total do carrinho pela quantidade de parcelas:
        // $this->cart->total() / $installmentQuantity)
        $installmentValue = number_format($installments[1], 2, '.', '');

        $params = [
            'paymentMode' => 'default',
            'paymentMethod' => 'creditCard',
            'currency' => $this->currency,
            'senderHash' => $request->senderHash,
            'creditCardToken' => $request->cardToken,
            'reference' => $this->reference,
            'extraAmount' => number_format($request->extraAmount,2),

            'installmentQuantity' => $installmentQuantity,
            'installmentValue' => $installmentValue,
            'noInterestInstallmentQuantity' => $request->maxInstallment,// Quantidade de parcelas sem juros

            'senderName' => 'Jose Comprador',
            'senderCPF' => '22111944785',
            'senderAreaCode' => '11',
            'senderPhone' => '56273440',

            'senderEmail' => 'comprador@sandbox.pagseguro.com.br',
            'creditCardHolderName' => 'Jose Comprador',
            'creditCardHolderCPF' => '22111944785',
            'creditCardHolderBirthDate' => '27/10/1987',
            'creditCardHolderAreaCode' => '11',
            'creditCardHolderPhone' => '56273440',
            'notificationURL' => 'https://sualoja.com.br/notificacao.html',

            
        ];

        $params = array_merge($params, $this->getConfigs());
        $params = array_merge($params, $this->getItems($request->price));
        $params = array_merge($params, $this->getShipping());
        $params = array_merge($params, $this->getBilling());
        $params = array_merge($params, $this->getShippingType(
            $request->shipping_method, $request->freight)
        );




        //dd($params);

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



    /*
    $params = [
        'paymentMode' => 'default',
        'paymentMethod' => 'creditCard',
        'currency' => 'BRL',
        'extraAmount' => '0.00',
        'itemId1' => '0001',
        'itemDescription1' => 'Notebook Prata',
        'itemAmount1' => '10300.00',
        'itemQuantity1' => '1',
        'itemId2' => '0002',
        'itemDescription2' => 'Notebook Azul',
        'itemAmount2' => '10000.00',
        'itemQuantity2' => '1',
        'notificationURL' => 'http://anselmovelame.com.br',
        'reference' => $this->reference,
        'senderName' => 'Jose Comprador',
        'senderCPF' => '22111944785',
        'senderAreaCode' => '11',
        'senderPhone' => '56273440',
        'senderEmail' => 'comprador@sandbox.pagseguro.com.br',
        'senderHash' => $request->senderHash,
        'shippingAddressStreet' => 'Av. Brig. Faria Lima',
        'shippingAddressNumber' => '1384',
        'shippingAddressComplement' => '5o andar',
        'shippingAddressDistrict' => 'Jardim Paulistano',
        'shippingAddressPostalCode' => '01452002',
        'shippingAddressCity' => 'Sao Paulo',
        'shippingAddressState' => 'SP',
        'shippingAddressCountry' => 'BRA',
        'shippingType' => '1',
        'shippingCost' => '01.00',
        'creditCardToken' => $request->cardToken,
        'installmentQuantity' => '7',
        'installmentValue' => '3030.94',
        'noInterestInstallmentQuantity' => '5',
        'creditCardHolderName' => 'Jose Comprador',
        'creditCardHolderCPF' => '22111944785',
        'creditCardHolderBirthDate' => '27/10/1987',
        'creditCardHolderAreaCode' => '11',
        'creditCardHolderPhone' => '56273440',
        'billingAddressStreet' => 'Av. Brig. Faria Lima',
        'billingAddressNumber' => '1384',
        'billingAddressComplement' => '5o andar',
        'billingAddressDistrict' => 'Jardim Paulistano',
        'billingAddressPostalCode' => '01452002',
        'billingAddressCity' => 'Sao Paulo',
        'billingAddressState' => 'SP',
        'billingAddressCountry' => 'BRA',

    ];

    $params = array_merge($params, $this->getConfigs());
    */


}