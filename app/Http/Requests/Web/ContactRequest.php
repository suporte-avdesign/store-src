<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        $rules['contact.subject_id']   = 'required';
        $rules['contact.name']         = 'required|min:5';
        $rules['contact.email']        = 'required|email';
        $rules['contact.phone']        = 'required';
        $rules['contact.message']      = 'required|min:10';

        return $rules;
    }


    public function messages()
    {
        $messages = [
            "contact.subject_id.required"   => "O Assunto é obrigatŕio",
            "contact.name.required"         => "O Nome é obrigatŕio",
            "contact.name.min"              => "O Nome tem que ter no mínimo 5 caracteries",
            "contact.email.required"        => "O Email é obrigatŕio",
            "contact.email.email"           => "Digite um email valído",
            "contact.phone.required"        => "O Telefone é obrigatŕio",
            "contact.message.required"      => "A Mensagem é obrigatória",
            "contact.message.min"           => "A Mensagem tem que ter no mínimo 10 caracteries",

        ];

        return $messages;
    }
}
