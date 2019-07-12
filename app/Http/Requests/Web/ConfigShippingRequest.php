<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ConfigShippingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "calc_shipping_postcode" => "required|formato_cep",
            "calc_shipping_country" => "required",
            "calc_shipping_state" => "required",
            "calc_shipping_city" => "required",
            "shipping_method" => "required",
            "http_referer" => "required"
        ];
    }

    public function messages()
    {
        return [
            'calc_shipping_postcode.required' => 'O CEP é obrigatório.',
            'calc_shipping_postcode.formato_cep' => 'Digite um CEP válido.',
            'calc_shipping_country.required' => 'A senha é obrigatória.',
            'calc_shipping_state.required' => 'O Estado é obrigatório.',
            'calc_shipping_city.required' => 'A Cidade é obrigatória.',
            'shipping_method.required' => 'O Método é obrigatório.',
            'http_referer.required' => 'A url é obrigatória.'
        ];
    }

}
