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
            'zip_code' => 'required|formato_cep',
            'number' => 'nullable',
            'complement' => 'nullable',
            'city' => 'required',
            'state' => 'required'
        ];
    }

    public function messages()
    {
        [
            'street.required' => 'Insira o nome da rua',
            'district.required' => 'Insira o nome do bairro',
            'zip_code.required' => 'insira o CEP',
            'zip_code.formato_cep' => 'Não possui formato de CEP válido',
            'city.required' => 'Insira o nome da cidade',
            'state.required' => 'Insira o nome do estado',
        ];
    }
}
