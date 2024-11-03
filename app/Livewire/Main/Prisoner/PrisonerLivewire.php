<?php

namespace App\Livewire\Main\Prisoner;

use App\Livewire\Forms\Main\PrisonerForm;
use App\Models\Admin\Municipality;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\Country;
use App\Models\Admin\EducationLevel;
use App\Models\Admin\Ethnicity;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Sex;
use App\Models\Admin\SexualOrientation;
use App\Models\Admin\State;
use Illuminate\Support\Facades\Auth;

#[Layout("layouts.app")]
#[Title("Pesquisar")]
class PrisonerLivewire extends Component
{
    public PrisonerForm $prisonerForm;
    use WithPagination;

    public $openModalCreate = false;

    public function mount()
    {
        $this->prisonerForm->prison_unit_id       = Auth::user()->prison_unit_id;
        $this->prisonerForm->user_create          = Auth::user()->id;
        $this->prisonerForm->user_update          = Auth::user()->id;
        $this->prisonerForm->status_prisons       = StatusPrison::all();
        $this->prisonerForm->education_levels     = EducationLevel::all();
        $this->prisonerForm->civil_statuses       = CivilStatus::all();
        $this->prisonerForm->sexes                = Sex::all();
        $this->prisonerForm->sexual_orientations  = SexualOrientation::all();
        $this->prisonerForm->ethnicities          = Ethnicity::all();
        $this->prisonerForm->states               = State::all();
        $this->prisonerForm->countries            = Country::all();
    }

    public function closeModal()
    {
        $this->openModalCreate = false;
        $this->prisonerForm->clearFields();
    }
    public function selectMunicipality()
    {
        $this->prisonerForm->municipalities = Municipality::where('state_id', $this->prisonerForm->state_id)->get();
    }
    public function modalCreate()
    {
        $this->openModalCreate = true;
    }
    public function create()
    {
        $prisoner = $this->prisonerForm->create();
        $this->closeModal();
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $prisoner->id]);
    }

    public function render()
    {
        $prisoners = $this->prisonerForm->prisoner_search();
        return view('livewire.main.prisoner.prisoner-livewire', compact( 'prisoners' ));
    }
}
