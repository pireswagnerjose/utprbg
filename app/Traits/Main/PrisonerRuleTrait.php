<?php

namespace App\Traits\Main;

trait PrisonerRuleTrait
{
    public function rules()
    {
        // create
        if (empty($this->prisoner)) {
            return [
                'name'                  =>'required|max:100',
                'nickname'              =>'nullable|max:100',
                'date_birth'            =>'required|min:10|max:10',
                'cpf'                   =>'nullable|min:14|max:14|unique:prisoners',
                'rg'                    =>'nullable|max:50|unique:prisoners',
                'title'                 =>'nullable|min:14|max:14|unique:prisoners',
                'birth_certificate'     =>'nullable|max:60|unique:prisoners',
                'reservist'             =>'nullable|max:60|unique:prisoners',
                'sus_card'              =>'nullable|min:19|max:19|unique:prisoners',
                'rji'                   =>'nullable|min:12|max:12|unique:prisoners',
                'profession'            =>'nullable|max:100',
                'mother'                =>'nullable|max:100',
                'father'                =>'nullable|max:100',
                'status_prison_id'      =>'required|max:100',
                'education_level_id'    =>'required|max:20',
                'civil_status_id'       =>'required|max:20',
                'sex_id'                =>'required|max:20',
                'sexual_orientation_id' =>'required|max:20',
                'ethnicity_id'          =>'required|max:20',
                'municipality_id'       =>'required|max:20',
                'country_id'            =>'required|max:20',
                'state_id'              =>'required|max:20',
                'prison_unit_id'        =>'required|max:10',
                'user_create'           =>'required|max:10',
                'remarks'               =>'nullable',
            ];
        }

        // update
        if (!empty($this->prisoner)) {
            return [
                'name'                  =>'required|max:100',
                'nickname'              =>'nullable|max:100',
                'date_birth'            =>'required|min:10|max:10',
                'cpf'                   =>"nullable|min:14|max:14|unique:prisoners,cpf,{$this->prisoner->id},id",
                'rg'                    =>"nullable|max:50|unique:prisoners,rg,{$this->prisoner->id},id",
                'title'                 =>"nullable|min:14|max:14|unique:prisoners,title,{$this->prisoner->id},id",
                'birth_certificate'     =>"nullable|max:60|unique:prisoners,birth_certificate,{$this->prisoner->id},id",
                'reservist'             =>"nullable|max:60|unique:prisoners,reservist,{$this->prisoner->id},id",
                'sus_card'              =>"nullable|min:19|max:19|unique:prisoners,sus_card,{$this->prisoner->id},id",
                'rji'                   =>"nullable|min:12|max:12|unique:prisoners,rji,{$this->prisoner->id},id",
                'profession'            =>'nullable|max:100',
                'status_prison_id'      =>'required|max:100',
                'mother'                =>'nullable|max:100',
                'father'                =>'nullable|max:100',
                'education_level_id'    =>'required|max:20',
                'civil_status_id'       =>'required|max:20',
                'sex_id'                =>'required|max:20',
                'sexual_orientation_id' =>'required|max:20',
                'ethnicity_id'          =>'required|max:20',
                'municipality_id'       =>'required|max:20',
                'country_id'            =>'required|max:20',
                'state_id'              =>'required|max:20',
                'prison_unit_id'        =>'required|max:10',
                'user_update'           =>'nullable|max:10',
                'remarks'               =>'nullable',
            ];
        }
    }
}
