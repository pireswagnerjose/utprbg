<?php

namespace App\Traits\Main\Visitant;

trait VisitantRuleTrait
{
    public function rules()
    {
        // create
        if (empty($this->visitant)) {
            return [
                'name'              =>'required|max:100',
                'photo'             =>'required|mimes:jpeg,jpg,png',
                'date_of_birth'     =>'required|min:10|max:10',
                'cpf'               =>'required|min:14|max:14|unique:visitants',
                'phone'             =>'required|min:15|max:15',
                'street'            =>'required|max:255',
                'number'            =>'nullable|max:50',
                'complement'        =>'nullable|max:255',
                'barrio'            =>'nullable|max:255',
                'type_of_residence' =>'required|max:255',
                'status'            =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
                'civil_status_id'   =>'required|max:10',
                'sex_id'            =>'required|max:10',
                'municipality_id'   =>'required|max:10',
                'state_id'          =>'required|max:10',
                'user_create'       =>'required|max:10',
                'remark'            =>'nullable',
            ];
        }

        // update
        if (!empty($this->visitant['photo'])) {
            return [
                'name'              =>'required|max:100',
                'photo'             =>'nullable|image|mimes:jpeg,jpg,png',
                'date_of_birth'     =>'required|min:10|max:10',
                'cpf'               =>"required|min:14|max:14|unique:visitants,cpf,{$this->visitant->id},id",
                'phone'             =>'required|min:15|max:15',
                'street'            =>'required|max:255',
                'number'            =>'nullable|max:50',
                'complement'        =>'nullable|max:255',
                'barrio'            =>'nullable|max:255',
                'type_of_residence' =>'required|max:255',
                'status'            =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
                'civil_status_id'   =>'required|max:10',
                'sex_id'            =>'required|max:10',
                'municipality_id'   =>'required|max:10',
                'state_id'          =>'required|max:10',
                'user_update'       =>'required|max:10',
                'remark'            =>'nullable',
            ];
        }else{
            return [
                'name'              =>'required|max:100',
                'photo'             =>'nullable',
                'date_of_birth'     =>'required|min:10|max:10',
                'cpf'               =>"required|min:14|max:14|unique:visitants,cpf,{$this->visitant->id},id",
                'phone'             =>'required|min:15|max:15',
                'street'            =>'required|max:255',
                'number'            =>'nullable|max:50',
                'complement'        =>'nullable|max:255',
                'barrio'            =>'nullable|max:255',
                'type_of_residence' =>'required|max:255',
                'status'            =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
                'civil_status_id'   =>'required|max:10',
                'sex_id'            =>'required|max:10',
                'municipality_id'   =>'required|max:10',
                'state_id'          =>'required|max:10',
                'user_update'       =>'required|max:10',
                'remark'            =>'nullable',
            ];
        }
    }
}
