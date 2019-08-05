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




    public function getItems()
    {
        $itemsCart =$this->interCart->getAll();
        $i=1;
        $items=[];
        foreach ($itemsCart as $item) {
            $items["itemId{$i}"]          = $item->product_id;
            $items["itemWeight{$i}"]      = $item->width;
            $items["itemAmount{$i}"]      = $item->price_cash;
            $items["itemQuantity{$i}"]    = $item->quantity;
            $items["itemDescription{$i}"] = $item->name;
            $i++;
        }
        return $items;
    }


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
        $numero = preg_replace("/[^0-9]/", "", $user->cell);
        $ddd_cliente = preg_replace('/\A.{2}?\K[\d]+/', '', $numero);
        $numero_cliente = preg_replace('/^\d{2}/', '', $numero);
        $environment = env('PAGSEGURO_ENVORINMENT');
        $isSandbox   = ($environment == 'sandbox') ? true : false;
        $email = ($isSandbox) ? uniqid(date('YmdHsi'))."@sandbox.pagseguro.com.br" : $user->email;

        return [
            'senderName' => $name,
            $senderDoc => preg_replace("/[^0-9]/", "", $user->document1),
            'senderAreaCode' => $ddd_cliente,
            'senderPhone' => $numero_cliente,
            'senderEmail' => $email,
        ];
    }

    /**
     * @return array
     */
    public function getShipping()
    {
        $data = Auth::user()->adresses()->orderBy('id','desc')->first();
        return [
            'shippingType' => '1',
            'shippingAddressRequired' => 'true',
            'shippingAddressStreet' => utf8_decode($data->address),
            'shippingAddressNumber' => $data->number,
            'shippingAddressComplement' => utf8_decode($data->complement),
            'shippingAddressDistrict' => utf8_decode($data->district),
            'shippingAddressPostalCode' => preg_replace("/[^0-9]/", "", $data->zip_code),
            'shippingAddressCity' => utf8_decode($data->city),
            'shippingAddressState' => $data->state,
            'shippingAddressCountry' => 'BRA',
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