<?php

namespace App\Livewire\Forms\Main;

use App\Models\Main\Prisoner;

use App\Services\Main\Prisoner\PrisonerService;
use App\Traits\Main\PrisonerMessageTrait;
use App\Traits\Main\PrisonerPropertyTrait;
use App\Traits\Main\PrisonerRuleTrait;

use Livewire\Form;

class PrisonerForm extends Form
{
    public ?Prisoner $prisoner;
    use PrisonerRuleTrait;
    use PrisonerMessageTrait;
    use PrisonerPropertyTrait;

    // set post
    public function setPost($prisoner)
    {
        $this->prisoner              = $prisoner;
        $this->name                  = $prisoner->name;
        $this->nickname              = $prisoner->nickname;
        $this->date_birth            = $prisoner->date_birth;
        $this->cpf                   = $prisoner->cpf;
        $this->rg                    = $prisoner->rg;
        $this->title                 = $prisoner->title;
        $this->birth_certificate     = $prisoner->birth_certificate;
        $this->reservist             = $prisoner->reservist;
        $this->sus_card              = $prisoner->sus_card;
        $this->rji                   = $prisoner->rji;
        $this->profession            = $prisoner->profession;
        $this->status_prison_id      = $prisoner->status_prison_id;
        $this->mother                = $prisoner->mother;
        $this->father                = $prisoner->father;
        $this->education_level_id    = $prisoner->education_level_id;
        $this->civil_status_id       = $prisoner->civil_status_id;
        $this->sex_id                = $prisoner->sex_id;
        $this->sexual_orientation_id = $prisoner->sexual_orientation_id;
        $this->ethnicity_id          = $prisoner->ethnicity_id;
        $this->municipality_id       = $prisoner->municipality_id;
        $this->country_id            = $prisoner->country_id;
        $this->state_id              = $prisoner->state_id;
        $this->prison_unit_id        = $prisoner->prison_unit_id;
        $this->user_update           = $prisoner->user_update;
        $this->remarks               = $prisoner->remarks;
    }

    public function create()
    {
        $data = $this->validate();
        $data = (new PrisonerService())->convertUppercase($data);
        return Prisoner::create($data);
    }

    public function update($data)
    {
        $data = (new PrisonerService())->convertUppercase($data);
        //Remove espaço em branco no começo do nome
        $data['name'] = trim($data['name']);
        $this->prisoner->update($data);
    }

    public function delete($prisoner)
    {
        $prisoner->delete();
        session()->flash('success', 'Excluído com sucesso.');
    }

    public function prisoner_search()
    {
        $prisoners = Prisoner::orderBy('name', 'asc')
            ->where('name', 'like', "%{$this->name}%")
            ->where('nickname', 'like', "%{$this->nickname}%")
            ->Where('cpf', 'like', "%{$this->cpf}%")
            // ->Where('rg', 'like', "%{$this->rg}%")
            // ->where('title', 'like', "%{$this->title}%")
            // ->where('birth_certificate', 'like', "%{$this->birth_certificate}%")
            ->where('sus_card', 'like', "%{$this->sus_card}%")
            ->where('status_prison_id', 'like', "%{$this->status_prison_id}%")
            ->where('civil_status_id', 'like', "%{$this->civil_status_id}%")
            ->where('ethnicity_id', 'like', "%{$this->ethnicity_id}%")
            ->where('sexual_orientation_id', 'like', "%{$this->sexual_orientation_id}%")
            ->where('country_id', 'like', "%{$this->country_id}%")
            ->paginate(12);
            return $prisoners;
    }
}
