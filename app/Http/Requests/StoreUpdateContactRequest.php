<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateContactRequest extends FormRequest
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
                'number' => 'required|celular_com_ddd',
        ];
    }

    public function messages()
    {
       return [
        
        'number.required' =>  'Insira seu numero de contato!',
        'number.celular_com_ddd' => 'Insira o DDD de seu numero! exemplo: (55)0000-0000'
       ];
    }
}
