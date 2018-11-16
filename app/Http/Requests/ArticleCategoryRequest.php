<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required|unique:article_category|max:100',
            'description' => 'nullable|max:200',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.unique' => 'O nome informado já existe',
            'name.max' => 'O campo nome deve ter no máximo 100 caracteres',            
            'description.max' => 'O campo descrição deve ter no máximo 200 caracteres'
        ];
    }

}
