<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TicketRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required_if:'.Auth::user()->type_id.',1|exists:users,id',
            'equipment_id' => 'nullable|exists:equipment,id',            
            'subject' => 'required|max:30',            
            'priority_id' => 'required|exists:priority,id',
            'file' => 'nullable|image|max:2000',
            'description' => 'nullable|max:250'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required_if' => 'O campo proprietário é obrigatório',
            'subject.required' => 'O campo assunto é obrigatório',
            'subject.max' => 'O campo assunto deve ter no máximo 30 caracteres',            
            'priority_id.required' => 'O campo prioridade é obrigatório',                 
            'description.max' => 'O campo descrição deve ter no máximo 250 caracteres',
            'file.image' => 'O anexo deve ser uma imagem',
            'file.max' => 'O anexo deve ter no máximo 2mb',
            'file.uploaded' => 'Ocorreu uma falha ao tentar enviar o anexo',
        ];
    }

}
