<?php

namespace App\Traits;

trait VideoconferenceHearingTrait
{
    public function rules()
    {
        if (empty($this->videoconference_hearing_model)) {
            return [
                'date_of_service'           => 'required|max:10|min:10',
                'time_of_service'           => 'required|max:5|min:5',
                'status'                    => 'required|max:10',
                'remark'                    => 'nullable',
                'user_create'               => 'required|max:10',
                'prison_unit_id'            => 'required|max:10',
                'prisoner_id'               => 'required|max:10',
                'district_id'               => 'required|max:10',
                'criminal_court_id'         => 'required|max:10',
            ];
        } 

        if (!empty($this->videoconference_hearing_model)) {
            return [
                'date_of_service'           => 'required|max:10|min:10',
                'time_of_service'           => 'required|max:5|min:5',
                'status'                    => 'required|max:10',
                'remark'                    => 'nullable',
                'user_update'               => 'required|max:10',
                'prison_unit_id'            => 'required|max:10',
                'prisoner_id'               => 'required|max:10',
                'district_id'               => 'required|max:10',
                'criminal_court_id'         => 'required|max:10',
            ];
        }
    }

    protected array $messages = [
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

        'district_id.required'=> 'O campo Comarca é obrigatório.',
        'district_id.max'=> 'O campo Comarca deve ter no máximo 10 caracteres.',
        
        'criminal_court_id.required'=> 'O campo Vara Criminal é obrigatório.',
        'criminal_court_id.max'=> 'O campo Vara Criminal deve ter no máximo 10 caracteres.',

        'title.required'=>'O campo Título do Documento é obrigatório.',
        'title.max'=>'O campo Título do Documento deve ter no máximo 255 caracteres.',
        
        'path.required'=>'O campo Documento é obrigatório.',
        'path.max'=>'O campo Documento deve ter no máximo 255 caracteres.',
    ];
}
