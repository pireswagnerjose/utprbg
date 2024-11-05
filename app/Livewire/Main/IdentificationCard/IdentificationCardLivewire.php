<?php

namespace App\Livewire\Main\IdentificationCard;

use App\Livewire\Forms\Main\IdentificationCardForm;
use App\Models\Admin\Family\DegreeOfKinship;
use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Models\Main\Visitant;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class IdentificationCardLivewire extends Component
{
    use WithFileUploads;
    public IdentificationCardForm $identificationCardForm;
    public $openModalCreate = false;

    public function mount()
    {
        $this->identificationCardForm->prison_unit_id       = Auth::user()->prison_unit_id;
        $this->identificationCardForm->user_create          = Auth::user()->id;
        $this->identificationCardForm->user_update          = Auth::user()->id;
        $this->identificationCardForm->prisoners            = Prisoner::all();
        $this->identificationCardForm->visitants            = Visitant::all();
        $this->identificationCardForm->degree_of_kinships   = DegreeOfKinship::all();
    }
    public function render()
    {
        $identification_cards = IdentificationCard::orderBy('created_at', 'asc')
        ->with('visitant', 'prisoner')
        ->where('visitant_id', 'like', "%{$this->identificationCardForm->visitant_id}%")
        ->where('prisoner_id', 'like', "%{$this->identificationCardForm->prisoner_id}%")
        ->paginate(9);

        return view('livewire.main.identification-card.identification-card-livewire', compact('identification_cards'));
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalCreate = false;
        $this->identificationCardForm->clearFields();
    }

    // MODAL CREATE
    public function modalCreate()
    {
        $this->openModalCreate = true;
    }

    // CREATE
    public function create()
    {
        $identification_card = $this->identificationCardForm->create();
        $this->closeModal();
        $this->redirectRoute('identification-card.show', ['identification_card_id' => $identification_card->id]);
    }
}
