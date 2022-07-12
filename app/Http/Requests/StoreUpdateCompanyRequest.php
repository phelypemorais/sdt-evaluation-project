<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:companies|min:1|max:100'
        ];
    } 

    public function messages()
    {
        return [
            'name.required' => 'O nome deve ser obrigatório!',
            'name.unique' => 'Esse nome já existe!'
        ];
    }
}
