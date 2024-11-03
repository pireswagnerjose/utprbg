<?php

namespace App\Traits\Main\Visitant;

trait VisitantMessageTrait
{
    protected array $messages = [
        'name.required'=>'o campo é obrigatório',
        'name.max'=>'o campo deve ter no máximo 100 caracteres',
        'photo.required'=>'o campo é obrigatório',
        'photo.image'=>'o campo deve tem que ser uma imagem',
        'photo.mimes'=>'o imagem tem que ser nas extensões jpeg, jpg ou png',
        'date_of_birth.required'=>'o campo é obrigatório',
        'date_of_birth.max'=>'o campo deve ter no máximo 10 caracteres',
        'date_of_birth.min'=>'o campo deve ter no mínimo 10 caracteres',
        'cpf.required'=>'o campo é obrigatório',
        'cpf.max'=>'o campo deve ter no máximo 14 caracteres',
        'cpf.min'=>'o campo deve ter no mínimo 14 caracteres',
        'cpf.unique'=>'o campo deve ser único',
        'phone.required'=>'o campo é obrigatório',
        'phone.max'=>'o campo deve ter no máximo 15 caracteres',
        'phone.min'=>'o campo deve ter no mínimo 15 caracteres',
        'street.required'=>'o campo é obrigatório',
        'street.max'=>'o campo deve ter no máximo 255 caracteres',
        'number.max'=>'o campo deve ter no máximo 50 caracteres',
        'complement.max'=>'o campo deve ter no máximo 255 caracteres',
        'barrio.max'=>'o campo deve ter no máximo 255 caracteres',
        'type_of_residence.required'=>'o campo é obrigatório',
        'type_of_residence.max'=>'o campo deve ter no máximo 255 caracteres',
        'status.required'=>'o campo é obrigatório',
        'status.max'=>'o campo deve ter no máximo 10 caracteres',
        'civil_status_id.required'=>'o campo é obrigatório',
        'sex_id.required'=>'o campo é obrigatório',
        'municipality_id.required'=>'o campo é obrigatório',
        'state_id.required'=>'o campo é obrigatório',
    ];
}
