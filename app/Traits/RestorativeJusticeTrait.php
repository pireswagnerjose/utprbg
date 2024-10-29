<?php

namespace App\Traits;

trait RestorativeJusticeTrait
{
    public function rules()
    {
        if (empty($this->restorative_justice_model)) {
            return [
                'facilitator_conciliator'   => 'required|max:255',
                'date_of_service'           => 'required|max:10|min:10',
                'time_of_service'           => 'required|max:5|min:5',
                'status'                    => 'required|max:10',
                'remark'                    => 'nullable',
                'user_create'               => 'required|max:10',
                'prison_unit_id'            => 'required|max:10',
                'prisoner_id'               => 'required|max:10',
                'modality_care_id'          => 'required|max:10', 
            ];
        } 

        if (!empty($this->restorative_justice_model)) {
            return [
                'facilitator_conciliator'   => 'required|max:255',
                'date_of_service'           => 'required|max:10|min:10',
                'time_of_service'           => 'required|max:5|min:5',
                'status'                    => 'required|max:10',
                'remark'                    => 'nullable',
                'user_update'               => 'required|max:10',
                'prison_unit_id'            => 'required|max:10',
                'prisoner_id'               => 'required|max:10',
                'modality_care_id'          => 'required|max:10', 
            ];
        }
    }

    protected array $messages = [
        'facilitator_conciliator.required'=> 'O campo Facilitador/Conciliador é obrigatório.',
        'facilitator_conciliator.max'=> 'O campo Facilitador/Conciliador deve ter no máximo 255 caracteres.',

        'date_of_service.required'=> 'O campo Data do Atendimento é obrigatório.',
        'date_of_service.max'=> 'O campo Data do Atendimento deve ter no máximo 10 caracteres.',
        'date_of_service.min'=> 'O campo Data do Atendimento deve ter no mínimo 10 caracteres.',

        'time_of_service.required'=> 'O campo Hora do Atendimento é obrigatório.',
        'time_of_service.max'=> 'O campo Hora do Atendimento deve ter no máximo 5 caracteres.',
        'time_of_service.min'=> 'O campo Hora do Atendimento deve ter no mínimo 5 caracteres.',

        'status.required'=> 'O campo Status é obrigatório.',
        'status.max'=> 'O campo Status deve ter no máximo 10 caracteres.',
        
        'prisoner_id.required'=> 'O campo Preso é obrigatório.',
        'prisoner_id.max'=> 'O campo Preso deve ter no máximo 10 caracteres.',

        'modality_care_id.required'=> 'O campo Tipo do Atendimento é obrigatório.',
        'modality_care_id.max'=> 'O campo Tipo do Atendimento deve ter no máximo 10 caracteres.',

        'title.required'=>'O campo Título do Documento é obrigatório.',
        'title.max'=>'O campo Título do Documento deve ter no máximo 255 caracteres.',
        
        'path.required'=>'O campo Documento é obrigatório.',
        'path.max'=>'O campo Documento deve ter no máximo 255 caracteres.',
    ];
}
