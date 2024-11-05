<?php

namespace App\Traits\Main\IdentificationCard;

trait IdentificationCardPropertyTrait
{
    public $prisoners = [];
    public $visitants = [];
    public $degree_of_kinships = [];
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';
    public $visitant_id = '';
    public $prisoner_id = '';
    public $date_of_creation = '';
    public $expiration_date = '';
    public $type = '';
    public $status = '';
    public $remark = '';
    public $degree_of_kinship_id = '';

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('date_of_creation','expiration_date','type','status','remark',
            'prisoner_id','visitant_id','degree_of_kinship_id');
    }
}
