<?php

namespace App\Livewire\Main\Prisoner;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\Country;
use App\Models\Admin\Ethnicity;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\SexualOrientation;
use App\Models\Main\Prisoner;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Pesquisar")]
class PrisonerLivewire extends Component
{
    use WithPagination;
    public $name;
    public $nickname;
    public $cpf;
    public $rg;
    public $title;
    public $birth_certificate;
    public $sus_card;
    public $status_prison_id;
    public $civil_status_id;
    public $ethnicity_id;
    public $sexual_orientation_id;
    public $country_id;
    public $status_prisons = [];
    public $civil_statuses = [];
    public $ethnicities = [];
    public $sexual_orientations = [];
    public $countries = [];

    public function mount()
    {
        $this->status_prisons       = StatusPrison::all();
        $this->civil_statuses       = CivilStatus::all();
        $this->ethnicities          = Ethnicity::all();
        $this->sexual_orientations  = SexualOrientation::all();
        $this->countries            = Country::all();
    }
    public function render()
    {
        return view('livewire.main.prisoner.prisoner-livewire', [
            'prisoners' => Prisoner::orderBy('name', 'asc')
                ->where('name', 'like', "%{$this->name}%")
                ->where('nickname', 'like', "%{$this->nickname}%")
                ->where('cpf', 'like', "%{$this->cpf}%")
                ->where('rg', 'like', "%{$this->rg}%")
                ->where('title', 'like', "%{$this->title}%")
                ->where('birth_certificate', 'like', "%{$this->birth_certificate}%")
                ->where('sus_card', 'like', "%{$this->sus_card}%")
                ->where('status_prison_id', 'like', "%{$this->status_prison_id}%")
                ->where('civil_status_id', 'like', "%{$this->civil_status_id}%")
                ->where('ethnicity_id', 'like', "%{$this->ethnicity_id}%")
                ->where('sexual_orientation_id', 'like', "%{$this->sexual_orientation_id}%")
                ->where('country_id', 'like', "%{$this->country_id}%")
                ->paginate(9)
        ]);
    }
}
