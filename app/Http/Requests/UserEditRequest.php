<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id.',id',
            'cpf' => 'nullable|min:11|unique:profile,cpf,'.$this->id.',user_id',
            'zipcode' => 'nullable|min:8',
            'telephone' => 'nullable|min:10',
            'cellphone' => 'nullable|min:11',
            'whatsapp' => 'nullable|min:11',
            'state_id' => 'nullable|exists:state,id',
            'city_id' => 'nullable|exists:city,id',
            'gender_id' => 'nullable|exists:gender,id',
            'marital_id' => 'nullable|exists:marital,id',
            'number' => 'nullable|numeric',
            'city' => 'nullable|max:50',
            'neighborhood' => 'nullable|max:50',
            'street' => 'nullable|max:100',
            'complement' => 'nullable|max:100',
            'file' => 'nullable|image|max:2000',            
            'password' => 'nullable|confirmed',
            'password_confirmation' => 'nullable',
            'type_id' => 'required|exists:type_user,id'            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'O e-mail informado já existe',
            'number.numeric' => 'Número inválido',
            'city.max' => 'O campo nome deve ter no máximo 50 caracteres',
            'neighborhood.max' => 'O campo nome deve ter no máximo 50 caracteres',
            'street.max' => 'O campo nome deve ter no máximo 100 caracteres',
            'complement.max' => 'O campo nome deve ter no máximo 100 caracteres',
            'file.image' => 'O arquivo deve ser uma imagem',
            'file.max' => 'A imagem deve ter no máximo 2mb',
            'file.uploaded' => 'Ocorreu uma falha ao tentar enviar a imagem',
            'cpf.unique' => 'O cpf informado já existe',
            'cpf.min' => 'Cpf inválido',
            'zipcode.min' => 'CEP inválido',
            'telephone.min' => 'Telefone inválido',
            'cellphone.min' => 'Celular inválido',
            'whatsapp.min' => 'WhatsApp inválido',            
            'password.confirmed' => 'As senhas não conferem',
            'type_id.required' => 'O campo tipo de usuário é obrigatório'
        ];
    }
}
