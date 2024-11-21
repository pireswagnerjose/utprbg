<?php

namespace App\Traits\Main;

trait PrisonerRuleTrait
{
    public function rules()
    {
        return [
            'name'                  =>'required|max:100',
            'nickname'              =>'nullable|max:100',
            'date_birth'            =>'required|min:10|max:10',
            'cpf'                   =>$this->prisoner ? "nullable|min:14|max:14|unique:prisoners,cpf,{$this->prisoner->id},id" : "nullable|min:14|max:14|unique:prisoners",
            'rg'                    =>$this->prisoner ? "nullable|max:50|unique:prisoners,rg,{$this->prisoner->id},id" : 'nullable|max:50|unique:prisoners',
            'title'                 =>$this->prisoner ? "nullable|min:14|max:14|unique:prisoners,title,{$this->prisoner->id},id" : 'nullable|min:14|max:14|unique:prisoners',
            'birth_certificate'     =>$this->prisoner ? "nullable|max:60|unique:prisoners,birth_certificate,{$this->prisoner->id},id" : 'nullable|max:60|unique:prisoners',
            'reservist'             =>$this->prisoner ? "nullable|max:60|unique:prisoners,reservist,{$this->prisoner->id},id" : 'nullable|max:60|unique:prisoners',
            'sus_card'              =>$this->prisoner ? "nullable|min:19|max:19|unique:prisoners,sus_card,{$this->prisoner->id},id" : 'nullable|min:19|max:19|unique:prisoners',
            'rji'                   =>$this->prisoner ? "nullable|min:12|max:12|unique:prisoners,rji,{$this->prisoner->id},id" : 'nullable|min:12|max:12|unique:prisoners',
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
            'user_create'           =>$this->prisoner ? 'nullable|max:10' : 'required|max:10',
            'user_update'           =>$this->prisoner ? 'required|max:10' : 'nullable|max:10',
            'remarks'               =>'nullable',
        ];
    }
}
