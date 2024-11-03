<?php

namespace App\Traits\Main;

trait PrisonerPropertyTrait
{
    public $name;
    public $nickname;
    public $date_birth;
    public $cpf;
    public $rg;
    public $title;
    public $birth_certificate;
    public $reservist;
    public $sus_card;
    public $rji;
    public $mother;
    public $father;
    public $profession;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $sexual_orientation_id;
    public $ethnicity_id;
    public $education_level_id;
    public $civil_status_id;
    public $sex_id;
    public $municipality_id;
    public $state_id;
    public $country_id;
    public $status_prison_id;
    public $remarks;
    public $status_prisons = [];
    public $education_levels = [];
    public $civil_statuses = [];
    public $sexes = [];
    public $sexual_orientations = [];
    public $ethnicities = [];
    public $municipalities = [];
    public $states = [];
    public $countries = [];
    // clear fields
    public function clearFields()
    {
        $this->reset(
            'name','nickname','date_birth','cpf','rg','title','birth_certificate','reservist','sus_card',
            'rji','mother','father','profession','sexual_orientation_id','ethnicity_id','education_level_id',
            'civil_status_id','sex_id','municipality_id','remarks'
        );
    }
}
