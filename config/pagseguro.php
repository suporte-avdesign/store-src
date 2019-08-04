<?php

$environment = env('PAGSEGURO_ENVORINMENT');
$isSandbox = ($environment == 'sandbox') ? true : false;

#urls redirect
$urlCheckout                = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout' : 'https://ws.pagseguro.uol.com.br/v2/checkout';
$urlCheckoutAfterRequest    = ($isSandbox) ? 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=' : 'https://ws.pagseguro.uol.com.br/v2/checkout/payment.html?code=';
# urls lightbox
$urlLightbox                = ($isSandbox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js';

$urlSessionTranparent       = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions' : 'https://ws.pagseguro.uol.com.br/v2/sessions';
$urlTransparentJs           = ($isSandbox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
$urlPaymentTransparent      = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions' : 'https://ws.pagseguro.uol.com.br/v2/transactions';
$urlNotification            = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications' : 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications';

return [
    'environment'   => $environment,
    'email'         => env('PAGSEGURO_EMAIL'),
    'token'         => env('PAGSEGURO_TOKEN'),

    'url_checkout'                  => $urlCheckout,
    'url_redirect_after_request'    => $urlCheckoutAfterRequest,
    'url_lightbox'                  => $urlLightbox,
    'url_transparent_session'       => $urlSessionTranparent,
    'url_transparent_js'            => $urlTransparentJs,
    'url_payment_transparent'       => $urlPaymentTransparent,
    'url_notification'              => $urlNotification,


    'teste_email' => 'c26301320426701778469@sandbox.pagseguro.com.br',
    'teste_senha' => 'yrplHgtLv3l18DnW',
    'teste_cartao_bandeira' => 'VISA',
    'teste_cartao_numero' => '4111111111111111',
    'teste_cartao_data' => '12/2030',
    'teste_cartao_cvv' => '123',
];