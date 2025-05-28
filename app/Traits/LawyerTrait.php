<?php

namespace App\Traits;

trait LawyerTrait
{
    public function rules()
    {
        if (empty($this->lawyer_model)) {
            return [
                'photo' => 'required|file|mimes:jpeg,jpg,png',
                'lawyer' => 'required|max:100',
                'register' => "required|max:100|unique:lawyers,register",
                'contact' => 'required|max:100',
                'remark' => 'nullable',
                'user_create' => 'nullable|max:10',
                'prison_unit_id' => 'required|max:10',
            ];
        }
        if ($this->user_update != null) {
            return [
                'photo' => 'required|file|mimes:jpeg,jpg,png',
                'lawyer' => 'required|max:100',
                'register' => "required|max:100|unique:lawyers,register,{$this->lawyer_model->id},id",
                'contact' => 'required|max:100',
                'remark' => 'nullable',
                'user_update' => 'nullable|max:10',
                'prison_unit_id' => 'required|max:10',
            ];
        }

    }

    protected array $messages = [
        'photo.mimes' => 'O arquivo tem que ser no formado JPEG, JPG ou PNG.',
        'photo.max' => 'O campo Foto deve ter no máximo 255 caracteres.',

        'lawyer.required' => 'O campo Advogado é obrigatório.',
        'lawyer.max' => 'O campo Advogado deve ter no máximo 255 caracteres.',

        'register.required' => 'O campo Registro é obrigatório.',
        'register.unique' => 'Já esiste outro cadastro com esse Registro.',
        'register.max' => 'O campo Registo deve ter no máximo 255 caracteres.',

        'contact.required' => 'O campo Contato  é obrigatório.',
        'contact.max' => 'O campo Contato deve ter no máximo 255 caracteres.',
    ];
}
