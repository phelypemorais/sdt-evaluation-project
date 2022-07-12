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
        [
            'street.required' => 'Nome da rua  obrigatório',
            'district.required' => 'Nome do bairro obrigatório',
            'zip_code.required' => 'Não possui formato de CEP válido',
            'city.required' => 'Nome da cidade obrigatório',
            'state.required' => 'Estado Obrigatório',
        ];
    }
}
