<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EquipmentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required_if:'.Auth::user()->type_id.',1|exists:users,id',
            'name' => 'required|max:50',
            'network_name' => 'nullable|max:30',
            'tag_name' => 'nullable|max:30',
            'ip' => 'nullable|max:30',
            'type_id' => 'nullable|exists:type_equipment,id',
            'manufacturer_id' => 'nullable|exists:manufacturer,id',
            'model' => 'nullable|max:50',
            'serial_number' => 'nullable|max:50',
            'note' => 'nullable|max:200',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required_if' => 'O campo proprietário é obrigatório',
            'name.required' => 'O campo nome é obrigatório',                        
            'name.max' => 'O campo nome deve ter no máximo 50 caracteres',
            'type_id.required' => 'O campo tipo de equipamento é obrigatório',
            'model.max' => 'O campo modelo deve ter no máximo 50 caracteres',
            'serial_number.max' => 'O campo número de série deve ter no máximo 50 caracteres',
            'note.max' => 'O campo descrição deve ter no máximo 200 caracteres',
            'network_name.max' => 'O campo nome de rede deve ter no máximo 30 caracteres',
            'tag_name.max' => 'O campo etiqueta deve ter no máximo 30 caracteres',
            'ip.max' => 'O campo IP deve ter no máximo 30 caracteres',
        ];
    }

}
