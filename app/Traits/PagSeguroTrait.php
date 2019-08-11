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

            $items["itemId{$i}"]          = (string) $item->product_id;
            $items["itemWeight{$i}"]      = (string) $item->width;
            $items["itemAmount{$i}"]      = number_format($item->$price, 2, '.', '');
            $items["itemQuantity{$i}"]    = (string) $item->quantity;
            $items["itemDescription{$i}"] = (string) $item->name;
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
     * Retorna o endereço do clienet
     *
     * @return array
     */
    public function getShipping()
    {
        $data = Auth::user()->adresses()->orderBy('id','desc')->first();

        return [
            'shippingAddressRequired' => 'true',
            'shippingAddressStreet' => $data->address,
            'shippingAddressNumber' => $data->number,
            'shippingAddressComplement' => $data->complement,
            'shippingAddressDistrict' => $data->district,
            'shippingAddressPostalCode' => preg_replace("/[^0-9]/", "", $data->zip_code),
            'shippingAddressCity' => $data->city,
            'shippingAddressState' => $data->state,
            'shippingAddressCountry' => $data->country
        ];
    }


    public function getShippingType($type, $freight)
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
            'shippingCost' => number_format($freight, 2, '.', ''),
        ];

    }

    public function getBilling()
    {
        $data = Auth::user()->adresses()->orderBy('id','desc')->first();
        return [
            'billingAddressStreet' => $data->address,
            'billingAddressNumber' => $data->number,
            'billingAddressComplement' => $data->complement,
            'billingAddressDistrict' => $data->district,
            'billingAddressPostalCode' => preg_replace("/[^0-9]/", "", $data->zip_code),
            'billingAddressCity' => $data->city,
            'billingAddressState' => $data->state,
            'billingAddressCountry' => $data->country
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