<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEmployeeRequest extends FormRequest
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
            'name' => 'required',
            'charge' => 'required',
            'company_id' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório!',
            'charge.required' => 'O campo do cargo é obrigatório!',
            'company_id.required' => 'O campo empresa é obrigatório!',
            
        ];
    }
    
}
