<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCategoryEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:20|unique:ticket_category,name,'.$this->id.',id'            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.max' => 'O campo nome deve ter no máximo 20 caracteres',
            'name.unique' => 'O nome informado já existe',
        ];
    }
}
