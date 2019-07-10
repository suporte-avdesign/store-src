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
        $form = $this->get('form');


        if ($form == 'page') {
            $rules['page.email']    = "required|email";
            $rules['page.password'] = 'required';

        } elseif ($form == 'sidbar') {
            $rules['user.email']    = "required|email";
            $rules['user.password'] = 'required';
        }





        return $rules;
    }


    public function messages()
    {
            $messages = [
                'page.email.required' => 'O Email é obrigatório.',
                'page.email.email' => 'Digite um email valído.',
                'page.password.required' => 'A senha é obrigatória.',
                'user.email.required' => 'O Email é obrigatório.',
                'user.email.email' => 'Digite um email valído.',
                'user.password.required' => 'A senha é obrigatória.',
            ];


        return $messages;
    }


}
