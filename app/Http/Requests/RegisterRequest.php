<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'            
        ];
    }

    public function messages()
    {
        return [            
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'O e-mail informado está indisponível',
            'password.required' => 'O campo senha é obrigatório',
            'password.confirmed' => 'A confirmação de senha não confere',
            'password_confirmation.required' => 'O campo confirmar senha é obrigatório',            
        ];
    }

}
