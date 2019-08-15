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


        $user     = auth()->user();
        $holder   = $this->get('holder');
        $doc_type = $this->get('doc_type');

        # Info card
        $rules["cardCVV"]             = "required";
        $rules["cardNumber"]          = "required";
        $rules["installments"]        = "required";
        $rules["cardExpiryYear"]      = "required";
        $rules["maxInstallment"]      = "required";
        $rules["cardExpiryMonth"]     = "required";
        $rules["holderName"]          = "required";



        # Pessoa Física: Outro Titular
        if ($holder == 2 && $user->profile_id == 2) {
            if ($doc_type== 1) {
                $rules["holderCNPJ"]  = "required|formato_cnpj";
            } else {
                $rules["holderCPF"]   = "required|formato_cpf";
            }
            $rules["holderPhone"]     = "required";
            $rules["holderBirthDate"] = "required|data";
        }

        # Pessoa Jurídica: Titular do Cartão
        if ($holder == 1 && $user->profile_id == 1) {
            if ($doc_type== 1) {
                $rules["holderCNPJ"]  = "required|formato_cnpj";
            } else {
                $rules["holderCPF"]   = "required|formato_cpf";
            }
        }

        # Pessoa Jurídica: Outro Titular
        if ($holder == 2 && $user->profile_id == 1) {
            if ($doc_type== 1) {
                $rules["holderCNPJ"]  = "required|formato_cnpj";
            } else {
                $rules["holderCPF"]   = "required|formato_cpf";
            }
            $rules["holderPhone"]     = "required";
            $rules["holderBirthDate"] = "required|data";
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
            "holderBirthDate.required"         =>  "A data de nascimento do titular do cartão é obrigatória",
            "holderBirthDate.data"             =>  "Digite uma data de nascimento valida",
            "holderCNPJ.required"              =>  "O CNPJ do titular do cartão é obrigatório",
            "holderCNPJ.formato_cnpj"          =>  "Digite um CNPJ valido",
            "holderCPF.required"               =>  "O CPF do titular do cartão é obrigatório",
            "holderCPF.formato_cpf"            =>  "Digite um CPF valido",


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
