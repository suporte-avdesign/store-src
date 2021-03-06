<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        sleep(2);
        /*********************************************************************************/
        /*                           U S E R
        /*********************************************************************************/
        $register = $this->get('register');
        $transport = $this->get('transport');
        $type = $register['type_id'];

        ($this->method() == 'POST' ? $id = 0 : $id = auth()->user()->id);

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

        if ($this->method() == 'POST') {
            $password           = "required|";
            $password_min       = "min:6|";
            $password_string    = "string|";
            $password_confirmed = "confirmed";
        }

        $rules['register.password'] = $password.$password_string.$password_min.$password_confirmed;

        /*********************************************************************************/
        /*                           A D D R R S S
        /*********************************************************************************/
        $rules['address.address']  = "required|min:3";
        $rules['address.number']   = "required";
        $rules['address.district'] = "required";
        $rules['address.city']     = "required";
        $rules['address.zip_code'] = "required|formato_cep";
        $rules['address.state']    = "required";
        #Indicate Transport
        if (isset($transport['indicate'])) {
            $rules['transport.name']  = "required";
            $rules['transport.phone'] = "required";
        }


        return $rules;
    }


    public function messages()
    {

        $messages = [

            /***************************************************************************/
            /*                            U S E R
            /***************************************************************************/

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

            /***************************************************************************/
            /*                      A D D R E S S
            /***************************************************************************/
            "address.address.required"          => "O Endereço é obrigatório.",
            "address.address.min"               => "O Endereço deve ter no mínimo 3 caracters",
            "address.number.required"           => "O Número é obrigatório.",
            "address.district.required"         => "O Bairro é obrigatório.",
            "address.city.required"             => "A Cidade é obrigatória.",
            "address.zip_code.required"         => "O CEP é obrigatório.",
            "address.zip_code.formato_cep"      => "Digite um CEP válido.",
            "address.state.required"            => "O Estado é obrigatório.",

            "transport.name.required"           => "O nome do transporte é obrigatório.",
            "transport.phone.required"          => "O telefone de contato do transporte é obrigatório.",

        ];

        return $messages;
    }
}
