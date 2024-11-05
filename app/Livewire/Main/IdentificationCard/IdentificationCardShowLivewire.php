<?php

namespace App\Livewire\Main\IdentificationCard;

use App\Livewire\Forms\Main\IdentificationCardForm;
use App\Models\Admin\Family\DegreeOfKinship;
use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Models\Main\Visitant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IdentificationCardShowLivewire extends Component
{
    public IdentificationCardForm $identificationCardForm;
    public $identification_card_id;
    public $openModalUpdate = false;
    public $openModalDelete = false;

    public function mount()
    {
        $this->identificationCardForm->prison_unit_id       = Auth::user()->prison_unit_id;
        $this->identificationCardForm->user_create          = Auth::user()->id;
        $this->identificationCardForm->user_update          = Auth::user()->id;
        $this->identificationCardForm->prisoners            = Prisoner::all();
        $this->identificationCardForm->visitants            = Visitant::all();
        $this->identificationCardForm->degree_of_kinships   = DegreeOfKinship::all();
    }

    /**
     * Summary of closeModal
     * @return void
     */
    public function closeModal()
    {
        $this->openModalUpdate = false;
        $this->openModalDelete = false;
        $this->identificationCardForm->clearFields();
    }

    /**
     * Summary of modalUpdate
     * @param \App\Models\Main\IdentificationCard $identificationCard
     * @return void
     */
    public function modalUpdate(IdentificationCard $identificationCard)
    {
        $this->identificationCardForm->setPost($identificationCard);
        $this->openModalUpdate  = $identificationCard->id;
    }

    /**
     * Summary of update
     * @return void
     */
    public function update()
    {
        $data = $this->validate();
        $this->identificationCardForm->update($data);
        $this->closeModal();
        session()->flash('success', 'Atualizado com sucesso.');
    }

    /**
     * Summary of modalDelete
     * @param mixed $visitant_id
     * @return void
     */
    public function modalDelete($visitant_id)
    {
        $this->openModalDelete = $visitant_id;
    }
    
    /**
     * Summary of delete
     * @param \App\Models\Main\IdentificationCard $identificationCard
     * @return void
     */
    public function delete(IdentificationCard $identificationCard)
    {
        $this->identificationCardForm->delete($identificationCard);
        $this->openModalDelete = false;
        $this->redirectRoute('identification-card.index');
    }

    public function render()
    {
        return view('livewire.main.identification-card.identification-card-show-livewire', [
            'identification_card' => IdentificationCard::where('id', $this->identification_card_id)
                ->with('visitant', 'prisoner', 'degree_of_kinship')
                ->first()
        ]);
    }
}
