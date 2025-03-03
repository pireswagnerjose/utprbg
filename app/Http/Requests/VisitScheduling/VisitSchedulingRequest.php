<?php

namespace App\Http\Requests\VisitScheduling;

use Illuminate\Foundation\Http\FormRequest;

class VisitSchedulingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type'=>'required',
            'code' => 'required',
            'cpf' => 'required|max:14|min:14'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.required' => 'O campo tipo de visita é obrigatório',
            'code.required' => 'O campo código do visitante é obrigatório',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.min' => 'O campo CPF deve ter 14 caracteres',
        ];
    }
}
