<?php

namespace AVD\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        ($this->method() == 'POST' ? $id = 0 : $id = auth()->user()->id);
        $page = $this->get('page');

        if ($page) {
            $rules['page.email']    = "required|email";
            $rules['page.password'] = 'required';
        }


        return $rules;
    }


    public function messages()
    {
        $messages = [
            'page.email.required' => 'O Email é obrigatório.',
            'page.email.email' => 'Digite um email valído.',
            'page.password.required' => 'A senha é obrigatória.',
        ];

        return $messages;
    }


}
