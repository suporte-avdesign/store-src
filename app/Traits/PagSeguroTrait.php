<?php
/**
 * Created by Anselmo Velame.
 * Email: design@anselmovelame.com.br
 * Date: 04/08/19
 * Time: 18:51
 */

namespace AVD\Traits;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\Auth;


trait PagSeguroTrait
{

    /**
     * Configuração da Loja
     *
     * @return array
     */
    public function getConfigs()
    {
        return [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
        ];

    }




    public function getItems($price)
    {

        $itemsCart =$this->interCart->getAll();
        $i=1;
        $items=[];
        foreach ($itemsCart as $item) {

            $items["itemId{$i}"]          = $item->product_id;
            $items["itemWeight{$i}"]      = $item->width;
            $items["itemAmount{$i}"]      = number_format($item->$price, 2, '.', '');
            $items["itemQuantity{$i}"]    = $item->quantity;
            $items["itemDescription{$i}"] = $item->name;
            $i++;
        }
        return $items;
    }


    /**
     *  Retorna informações do cliente
     * @return array
     */
    public function getSender()
    {
        $user = Auth::user();
        if ($user->profile_id == 1) {
            $senderDoc = 'senderCNPJ';
            $name = $user->first_name;

        } else {
            $senderDoc = 'senderCPF';
            $name = $user->first_name. ' '.$user->last_name;
        }
        $number = $user->phone != '' ? dddPhone($user->phone) : dddPhone($user->cell);
        $environment = env('PAGSEGURO_ENVORINMENT');
        $isSandbox   = ($environment == 'sandbox') ? true : false;
        $email = ($isSandbox) ? uniqid(date('YmdHsi'))."@sandbox.pagseguro.com.br" : $user->email;

        return [
            'senderName' => $name,
            $senderDoc => returnNumber($user->document1),
            'senderAreaCode' => $number->ddd,
            'senderPhone' => $number->phone,
            'senderEmail' => $email,
            'sender.ip' => $_SERVER["REMOTE_ADDR"]
        ];
    }

    /**
     * Retorna o endereço do clienet
     *
     * @return array
     */
    public function getShipping()
    {
        $data = Auth::user()->adresses()->orderBy('id','desc')->first();

        return [
            'shippingAddressRequired' => 'true',
            'shippingAddressStreet' => utf8_decode($data->address),
            'shippingAddressNumber' => utf8_decode($data->number),
            'shippingAddressComplement' => utf8_decode($data->complement),
            'shippingAddressDistrict' => utf8_decode($data->district),
            'shippingAddressPostalCode' => returnNumber($data->zip_code),
            'shippingAddressCity' => utf8_decode($data->city),
            'shippingAddressState' => $data->state,
            'shippingAddressCountry' => $data->country
        ];
    }


    public function getShippingType($type, $freight, $amount)
    {
        if ($type == 2) {
            $shippingType = 1;
        } elseif ($type == 3) {
            $shippingType = 2;
        } else {
            $shippingType = 3;
        }

        return [
            'shippingType' => $shippingType,
            'shippingCost' => '0'.number_format($freight, 2, '.', ''),
        ];

    }

    public function getBilling()
    {
        $data = Auth::user()->adresses()->orderBy('id','desc')->first();
        return [
            'billingAddressStreet' => utf8_decode($data->address),
            'billingAddressNumber' => utf8_decode($data->number),
            'billingAddressComplement' => utf8_decode($data->complement),
            'billingAddressDistrict' => utf8_decode($data->district),
            'billingAddressPostalCode' => returnNumber($data->zip_code),
            'billingAddressCity' => utf8_decode($data->city),
            'billingAddressState' => $data->state,
            'billingAddressCountry' => $data->country
        ];
    }


    public function getHolder($request)
    {
        if ($request->holder == 1) {

            $user = auth()->user();
            $holderBirthDate = $user->date;
            $number = $user->phone != '' ? dddPhone($user->phone) : dddPhone($user->cell);

        } else {

            $holderBirthDate = $request->holderBirthDate;
            $number = dddPhone($request->holderPhone);
        }

        $doc_type = $request->doc_type;
        if ($doc_type == 1) {
            $doc_name   = 'creditCardHolderCNPJ';
            $doc_number = $request->holderCNPJ;

        } else {
            $doc_name   = 'creditCardHolderCPF';
            $doc_number = $request->holderCPF;
        }

        return [
            'creditCardHolderName' => $request->holderName,
            'creditCardHolderBirthDate' => $holderBirthDate,
            'creditCardHolderAreaCode' => $number->ddd,
            'creditCardHolderPhone' => $number->phone,
            $doc_name => returnNumber($doc_number)
        ];
    }

    /**
     * Moeda
     *
     * @param $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }


    public function setCountry($country)
    {
        $this->country = $country;
    }

}