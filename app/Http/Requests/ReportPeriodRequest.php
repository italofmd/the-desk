<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportPeriodRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start_date' => 'required',
            'end_date' => 'required',
            'status_id' => 'required'
        ];
    }

    public function messages()
    {
        return [            
            'start_date.required' => 'O campo início é obrigatório',
            'end_date.required' => 'O campo término é obrigatório',
            'status_id.required' => 'O campo status é obrigatório'
        ];
    }

}
