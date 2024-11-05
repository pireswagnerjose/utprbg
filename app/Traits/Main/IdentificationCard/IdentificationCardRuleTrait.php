<?php

namespace App\Traits\Main\IdentificationCard;

trait IdentificationCardRuleTrait
{
    public function rules()
    {
        // create
        if (empty($this->identificationCard)) {
            return [
                'date_of_creation'      =>'required|min:10|max:10',
                'expiration_date'       =>'required|min:10|max:10',
                'type'                  =>'required|max:255',
                'status'                =>'required|max:255',
                'remark'                =>'nullable',
                'visitant_id'           =>'required|max:10',
                'prisoner_id'           =>'required|max:10',
                'degree_of_kinship_id'  =>'required|max:10',
                'user_create'           =>'required|max:10',
                'prison_unit_id'        =>'required|max:10',
            ];
        }

        // update
        if (!empty($this->identificationCard)) {
            return [
                'date_of_creation'      =>'required|min:10|max:10',
                'expiration_date'       =>'required|min:10|max:10',
                'type'                  =>'required|max:255',
                'status'                =>'required|max:255',
                'remark'                =>'nullable',
                'visitant_id'           =>'required|max:10',
                'prisoner_id'           =>'required|max:10',
                'degree_of_kinship_id'  =>'required|max:10',
                'user_update'           =>'required|max:10',
                'prison_unit_id'        =>'required|max:10',
            ];
        }
    }
}
