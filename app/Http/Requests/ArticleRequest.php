<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'category_id' => 'required|exists:article_category,id',
            'content' => 'required|max:16777215'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório',
            'title.max' => 'O campo título deve ter no máximo 100 caracteres',            
            'category_id.required' => 'O campo categoria é obrigatório',
            'content.required' => 'O campo conteúdo é obrigatório',
            'content.max' => 'O campo conteúdo excedeu o limite de caracteres'
        ];
    }
}
