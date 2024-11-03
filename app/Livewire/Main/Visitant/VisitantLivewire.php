<?php

namespace App\Livewire\Main\Visitant;

use App\Livewire\Forms\Main\VisitantForm;
use App\Models\Admin\CivilStatus;
use App\Models\Admin\Municipality;
use App\Models\Admin\Sex;
use App\Models\Admin\State;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout("layouts.app")]
#[Title("Pesquisar Visitante")]
class VisitantLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    public VisitantForm $visitantForm;

    public $openModalCreate = false;

    public function mount()
    {   
        $this->visitantForm->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->visitantForm->user_create      = Auth::user()->id;
        $this->visitantForm->user_update      = Auth::user()->id;
        $this->visitantForm->civil_statuses   = CivilStatus::all();
        $this->visitantForm->sexes            = Sex::all();
        $this->visitantForm->states           = State::all();
    }

    public function closeModal()
    {
        $this->openModalCreate = false;
        $this->visitantForm->clearFields();
    }

    public function cancel()
    {
        $this->visitantForm->clearFields();
        redirect('dashboard');
    }

    // Seleciona o município conforme o estado escolhido
    public function selectMunicipality()
    {
        $this->visitantForm->municipalities = Municipality::where('state_id', $this->visitantForm->state_id)->get();
    }

    public function modalCreate()
    {
        $this->openModalCreate = true;
    }

    public function create()
    {
        $visitant = $this->visitantForm->create();
        $this->closeModal();
        $this->redirectRoute('visitant.show', ['visitant_id' => $visitant->id]);
    }

    public function render()
    {
        $visitants = $this->visitantForm->search();

        return view('livewire.main.visitant.visitant-livewire', compact('visitants'));
    }
}
