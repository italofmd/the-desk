<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
{
 
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                        
            'status_id'   => 'required|exists:status,id'            
        ];
    }

    public function messages()
    {
        return [                        
            'status_id.required' => 'O campo status é obrigatório'            
        ];
    }

}
