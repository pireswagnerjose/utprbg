<?php

namespace App\Livewire\Forms\Main;

use App\Models\Main\IdentificationCard;
use App\Traits\Main\IdentificationCard\IdentificationCardPropertyTrait;
use App\Traits\Main\IdentificationCard\IdentificationCardRuleTrait;
use Livewire\Form;

class IdentificationCardForm extends Form
{
    use IdentificationCardPropertyTrait, IdentificationCardRuleTrait;
    public ?IdentificationCard $identificationCard;

    // Transforma os caracteres em maiusculos
    public function convertUppercase($data)
    {
        $data['type'] = mb_strtoupper ($data['type'],'utf-8');
        $data['status'] = mb_strtoupper ($data['status'],'utf-8');
        $data['remark'] = mb_strtoupper ($data['remark'],'utf-8');
        return $data;
    }

    public function create()
    {
        $data = $this->validate();
        $data = $this->convertUppercase($data);
        $identification_card = IdentificationCard::create($data);
        return  $identification_card;
    }

    public function setPost(IdentificationCard $identificationCard)
    {
        $this->identificationCard   = $identificationCard;
        $this->date_of_creation     = $identificationCard->date_of_creation;
        $this->expiration_date      = $identificationCard->expiration_date;
        $this->type                 = $identificationCard->type;
        $this->status               = $identificationCard->status;
        $this->remark               = $identificationCard->remark;
        $this->visitant_id          = $identificationCard->visitant_id;
        $this->prisoner_id          = $identificationCard->prisoner_id;
        $this->degree_of_kinship_id = $identificationCard->degree_of_kinship_id;
    }

    public function update($data)
    {
        $data = $this->convertUppercase($data);
        $this->identificationCard->update($data);
    }

    public function delete($identificationCard)
    {
        $identificationCard->delete();
        session()->flash('success', 'Excluído com sucesso.');
    }
}
