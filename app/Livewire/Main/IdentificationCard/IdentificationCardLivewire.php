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
        $this->identificationCardForm->prison_unit_id = Auth::user()->prison_unit_id;
        $this->identificationCardForm->user_create = Auth::user()->id;
        $this->identificationCardForm->user_update = Auth::user()->id;
        $this->identificationCardForm->prisoners = Prisoner::orderBy('name', 'asc')->get();
        $this->identificationCardForm->visitants = Visitant::orderBy('name', 'asc')->get();
        $this->identificationCardForm->degree_of_kinships = DegreeOfKinship::all();
    }
    public function render()
    {
        $visitants_id_arr = [];
        if ($this->identificationCardForm->visitant_name != '') {
            $visitants = Visitant::where('name', 'like', "%{$this->identificationCardForm->visitant_name}%")
                ->orderBy('name', 'asc')->get('id');
            foreach ($visitants as $visitant) {
                $visitants_id_arr[] = $visitant->id;
            }
        }

        $prisoner_id_arr = [];
        if ($this->identificationCardForm->prisoner_name != '') {
            $prisoners = Prisoner::where('name', 'like', "%{$this->identificationCardForm->prisoner_name}%")
                ->orderBy('name', 'asc')->get('id');
            foreach ($prisoners as $prisoner) {
                $prisoner_id_arr[] = $prisoner->id;
            }
        }

        $identification_cards = IdentificationCard::orderBy('created_at', 'asc')
            ->with('visitant', 'prisoner');
        if (isset($visitants)) {
            $identification_cards = $identification_cards->whereIn('visitant_id', $visitants_id_arr);
        }
        if (isset($prisoners)) {
            $identification_cards = $identification_cards->whereIn('prisoner_id', $prisoner_id_arr);
        }

        $identification_cards = $identification_cards->paginate(9);

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
