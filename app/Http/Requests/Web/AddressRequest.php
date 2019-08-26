<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        $transport = $this->get('transport');

        /*********************************************************************************/
        /*                           A D D R R S S
        /*********************************************************************************/
        $rules['address.address']  = "required|min:3";
        $rules['address.number']   = "required";
        $rules['address.district'] = "required";
        $rules['address.city']     = "required";
        $rules['address.zip_code'] = "required|formato_cep";
        $rules['address.state']    = "required";
        /*********************************************************************************/
        /*                         T R A N S P O R T
        /*********************************************************************************/
        if (isset($transport['indicate'])) {
            $rules['transport.name']  = "required";
            $rules['transport.phone'] = "required";
        }


        return $rules;
    }


    public function messages()
    {

        $messages = [

            /*********************************************************************************/
            /*                            A D D R E S S
            /*********************************************************************************/
            "address.address.required"          => "O Endereço é obrigatório.",
            "address.address.min"               => "O Endereço deve ter no mínimo 3 caracters",
            "address.number.required"           => "O Número é obrigatório.",
            "address.district.required"         => "O Bairro é obrigatório.",
            "address.city.required"             => "A Cidade é obrigatória.",
            "address.zip_code.required"         => "O CEP é obrigatório.",
            "address.zip_code.formato_cep"      => "Digite um CEP válido.",
            "address.state.required"            => "O Estado é obrigatório.",
            /*********************************************************************************/
            /*                         T R A N S P O R T
            /*********************************************************************************/
            "transport.name.required"           => "O nome do transporte é obrigatório.",
            "transport.phone.required"          => "O telefone de contato do transporte é obrigatório.",

        ];

        return $messages;
    }
}
