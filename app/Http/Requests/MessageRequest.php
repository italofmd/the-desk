<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'message' => 'required|max:250'            
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'O campo mensagem é obrigatório',
            'message.max' => 'O campo mensagem deve ter no máximo 250 caracteres'            
        ];
    }
}
