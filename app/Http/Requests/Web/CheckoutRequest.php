<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutRequest extends FormRequest
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
        $register = $this->get('register');
        $type = $register['type_id'];
        $new_account = $this->get('new_account');
        $method = $this->get('shipping_method');
        $transport = $this->get('transport');
        //dd($transport);
        $terms_conditions = $this->get('terms');

        #User
        (Auth::user() ? $id = auth()->user()->id : $id = null);
        $rules['register.profile_id'] = "required";
        $rules['register.type_id']    = "required";
        if ($type == 1) {
            $rules['register.document1_1']  = "required|cnpj|formato_cnpj|unique:users,document1,{$id},id";
            $rules['register.document2_1']  = "required";
            $rules['register.first_name_1'] = "required";
            $rules['register.last_name_1']  = "required";
        }
        if ($type == 2) {
            $rules['register.document1_2']  = "required|cpf|formato_cpf|unique:users,document1,{$id},id";
            $rules['register.document2_2']  = "required";
            $rules['register.first_name_2'] = "required";
            $rules['register.last_name_2']  = "required";
        }
        $rules['register.email'] = "required|email|unique:users,email,{$id},id";
        $rules['register.date']  = "required|data";
        $rules['register.cell']  = "required|celular_com_ddd";
        if ($new_account == 1) {
            if ($this->method() == 'POST') {
                $password           = "required|";
                $password_min       = "min:6|";
                $password_string    = "string|";
                $password_confirmed = "confirmed";
            }
            $rules['register.password'] = $password.$password_string.$password_min.$password_confirmed;
        }
        #Address
        $rules['address.address']  = "required|min:3";
        $rules['address.number']   = "required";
        $rules['address.district'] = "required";
        $rules['address.city']     = "required";
        $rules['address.zip_code'] = "required|formato_cep";
        $rules['address.state']    = "required";
        #Método
        $rules['shipping_method'] = "required";
        #Indicate Transport
        if (isset($transport['indicate'])) {
            $rules['transport.name']  = "required";
            $rules['transport.phone'] = "required";
        }
        #Payment
        $rules['payment_method'] = "required";
        #Terms
        if (empty($terms_conditions)) {
            $rules['terms.conditions'] = "required";
        }

        return $rules;
    }


    public function messages()
    {
        $messages = [
            #Users
            'register.profile_id.required'      => 'O Perfil do cadastro é obrigatório.',
            'register.type_id.required'         => 'O Perfil do cadastro é obrigatório.',
            'register.first_name_1.required'    => 'A Razão Social é obrigatória.',
            'register.last_name_1.required'     => 'O nome fantasia é obrigatório',
            'register.document1_1.required'     => 'O CNPJ é obrigatório.',
            'register.document1_1.cnpj'         => 'Este CNPJ não é um número válido, ',
            'register.document1_1.unique'       => 'Já existe um cadastro com este CNPJ.',
            'register.document1_1.formato_cnpj' => 'O CNPJ não possui um formato válido.',
            'register.document2_1.required'     => 'A Inscrção Estadual é obrigatória',
            'register.first_name_2.required'    => 'O nome é obrigatório',
            'register.last_name_2.required'     => 'O Sobrenome é obrigatório',
            'register.document1_2.required'     => 'O CPF é obrigatório.',
            'register.document1_2.cpf'          => 'Este CPF não é um número válido, ',
            'register.document1_2.unique'       => 'Já existe um cadastro com este CPF.',
            'register.document1_2.formato_cpf'  => 'O CPF não possui um formato válido.',
            'register.document2_2.required'     => 'O RG é obrigatório',
            'register.email.required'           => "O Email é obrigatório.",
            'register.email.email'              => "Digite um email valído.",
            'register.email.unique'             => "Já existe um cadastro com este email.",
            'register.date.required'            => "A data de nascimento é obrigatória",
            'register.date.data'                => "A data de nascimento não é valida",
            'register.cell.required'            => "O Celular é obrigatório.",
            'register.cell.celular_com_ddd'     => "Digite o celular neste formato (99)99999-9999",
            'register.phone.required'           => "O Telefone é obrigatório",
            'register.password.required'        => "A Senha é obrigatória.",
            'register.password.min'             => "A Senha deverá conter no mínimo 6 caracteres.",
            'register.password_confirmation'    => "A Confirmação da senha é obrigatória.",
            'register.password.confirmed'       => "A Confirmação da senha não coincide.",
            #Address             *
            "address.address.required"          => "O Endereço é obrigatório.",
            "address.address.min"               => "O Endereço deve ter no mínimo 3 caracters",
            "address.number.required"           => "O Número é obrigatório.",
            "address.district.required"         => "O Bairro é obrigatório.",
            "address.city.required"             => "A Cidade é obrigatória.",
            "address.zip_code.required"         => "O CEP é obrigatório.",
            "address.zip_code.formato_cep"      => "Digite um CEP válido.",
            "address.state.required"            => "O Estado é obrigatório.",
            #Método
            "shipping_method.required"          => "O Método de envio é obrigatório.",
            #Indicate Transport
            "transport.name.required"           => "O nome do transporte é obrigatório.",
            "transport.phone.required"          => "O telefone de contato do transporte é obrigatório.",
            #Payment
            "payment_method.required"           => "A forma de pagamento é obrigatória.",
            #Terms
            "terms.conditions.required"          => "É necessário ler e aceitar o termo e condições do site.",
        ];

        return $messages;
    }
}