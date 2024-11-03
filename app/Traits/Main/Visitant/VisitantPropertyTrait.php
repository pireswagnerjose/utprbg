<?php

namespace App\Traits\Main\Visitant;

trait VisitantPropertyTrait
{
    public $name = '';
    public $photo = '';
    public $cpf = '';
    public $date_of_birth = '';
    public $phone = '';
    public $street = '';
    public $number = '';
    public $complement = '';
    public $barrio = '';
    public $type_of_residence = '';
    public $status = '';
    public $remark = '';
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';
    public $civil_status_id = '';
    public $sex_id = '';
    public $municipality_id = '';
    public $state_id = '';
    public $civil_statuses = [];
    public $sexes = [];
    public $municipalities = [];
    public $states = [];

    public $municipalityEdit = [];

    public function clearFields()
    {
        $this->reset(
            'name','photo','cpf','date_of_birth','street','complement','barrio','type_of_residence','phone','status','remark',
            'civil_status_id','sex_id','municipality_id','state_id'
        );
    }
}
