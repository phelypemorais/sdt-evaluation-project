<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAddressRequest extends FormRequest
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
            'street' => 'required',
            'district' => 'required',
            'zip_code' => 'required',
            'number' => 'nullable',
            'complement' => 'nullable',
            'city' => 'required',
            'state' => 'required'
        ];
    }

    public function messages()
    {
       return [
            'street.required' => 'O campo Rua é obrigatório!',
            'district.required' => 'O campo Bairro é obrigatório!',
            'zip_code.required' => 'O campo CEP é obrigatório!',
            'city.required' => 'O campo Cidade é obrigatório!',
            'state.required' => 'O campo Estado é obrigatório!',
        ];
    }
}
