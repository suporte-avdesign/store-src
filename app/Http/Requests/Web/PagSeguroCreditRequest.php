<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class PagSeguroCreditRequest extends FormRequest
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
        $holder = $this->get('holder');
        $user   = auth()->user();

        # Info card
        $rules["cardCVV"]             = "required";
        $rules["cardNumber"]          = "required";
        $rules["installments"]        = "required";
        $rules["cardExpiryYear"]      = "required";
        $rules["maxInstallment"]      = "required";
        $rules["cardExpiryMonth"]     = "required";
        $rules["holderName"]          = "required";

        #info user
        if ($holder == 2) {
            $rules["holderPhone"]     = "required";
            $rules["holderBirthDate"] = "required";

            if ($user->type_id == 1) {
                $rules["holderCNPJ"]  = "required";
            } else {
                $rules["holderCPF"]   = "required";
            }
        }

        # Info Cart
        $rules["price"]               = "required";
        $rules["amount"]              = "required";
        $rules["payment_method"]      = "required";
        $rules["shipping_method"]     = "required";

        # Info PagSeguro
        $rules["brandName"]           = "required";
        $rules["cardToken"]           = "required";
        $rules["senderHash"]          = "required";
        $rules["company_name"]        = "required";

        return $rules;

    }


    public function messages()
    {
        $messages = [
            # Info card
            "cardCVV.required"                 =>  "O código de segurança é obrigatório",
            "cardNumber.required"              =>  "O número do cartão é obrigatório",
            "installments.required"            =>  "O número de parcelas é obrigatório",
            "cardExpiryYear.required"          =>  "O ano de expiração é obrigatório",

            "cardExpiryMonth.required"         =>  "O mês de expiração é obrigatório",

            "holderName.required"              =>  "O nome impresso no cartão é obrigatório",
            "holderPhone.required"             =>  "O telefone do titular do cartão é obrigatório",
            "holderBirthDate.required"         =>  "A data de nascimento é obrigatória",
            "holderCNPJ.required"              =>  "O CNPJ é obrigatório",
            "holderCPF.required"               =>  "O CPF do titular do cartão é obrigatório",


            # Info Cart
            "price.required"                   =>  "Erro: O sistema não identificou a forma de pagamento",
            "amount.required"                  =>  "Erro: O sistema não calculou o valor total do pedido",
            "payment_method.required"          =>  "Erro: O sistema não identificou a forma de pagamento",
            "shipping_method.required"         =>  "Erro: O sistema não identificou o método de envio",
            "maxInstallment.required"          =>  "Erro: Faltou o administrador definir o máximo de parcelas sem juros",
            # Info PagSeguro
            "brandName.required"               =>  "Erro: Não identificamos a bandeira do cartão",
            "cardToken.required"               =>  "Erro: Não gerou o token da transação, tente novamente mais tarde",
            "senderHash.required"              =>  "Erro: O sistema não gerou o hash do cartão, tente novamente mais tarde",
            "company_name.required"            =>  "Erro: O sistema não identificou a administradora",


        ];


        return $messages;

    }
}
