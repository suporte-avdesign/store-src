<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $method = $this->get('shipping_method');
        $transport = $this->get('transport');
        #Método
        $rules['shipping_method'] = "required";
        #Indicate Transport
        if (isset($transport['indicate'])) {
            $rules['transport.name']  = "required";
            $rules['transport.phone'] = "required";
        }
        #Payment
        $rules['payment_method'] = "required";

        return $rules;
    }

    public function messages()
    {
        $messages = [
            #Método
            "shipping_method.required"          => "O Método de envio é obrigatório.",
            #Indicate Transport
            "transport.name.required"           => "O nome do transporte é obrigatório.",
            "transport.phone.required"          => "O telefone de contato do transporte é obrigatório.",
            #Payment
            "payment_method.required"           => "A forma de pagamento é obrigatória.",
        ];

        return $messages;
    }

}
