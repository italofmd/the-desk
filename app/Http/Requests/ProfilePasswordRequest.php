<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [            
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'            
        ];
    }

    public function messages()
    {
        return [                        
            'password.confirmed' => 'As senhas não conferem',
            'password.required' => 'O campo senha é obrigatório',
            'password_confirmation.required' => 'O campo confirmar senha é obrigatório'
        ];
    }
}
