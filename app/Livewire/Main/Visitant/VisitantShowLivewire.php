<?php

namespace App\Livewire\Main\Visitant;

use App\Livewire\Forms\Main\VisitantForm;
use App\Models\Admin\CivilStatus;
use App\Models\Admin\Municipality;
use App\Models\Admin\Sex;
use App\Models\Admin\State;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;

use App\Models\Main\Visitant;

use Livewire\Component;
use Livewire\WithPagination;

class VisitantShowLivewire extends Component
{
    public VisitantForm $visitantForm;
    use WithFileUploads;
    use WithPagination;

    public $visitant_id;
    public $openModalUpdate = false;
    public $openModalDelete = false;

    public $prisonerMul; //id do preso a ser exibido na view
    public $municipalityEdit = []; //quando for editar o município

    public function mount()
    {   
        $this->prisonerMul                    = Visitant::find($this->visitant_id);
        $this->visitantForm->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->visitantForm->user_create      = Auth::user()->id;
        $this->visitantForm->user_update      = Auth::user()->id;
        $this->visitantForm->civil_statuses   = CivilStatus::all();
        $this->visitantForm->sexes            = Sex::all();
        $this->visitantForm->states           = State::all();
    }

    // Seleciona o município conforme o estado escolhido
    public function selectMunicipality()
    {
        $this->visitantForm->municipalities = Municipality::where('state_id', $this->visitantForm->state_id)->get();
    }

    /**
     * Summary of closeModal
     * @return void
     */
    public function closeModal()
    {
        $this->openModalUpdate = false;
        $this->openModalDelete = false;
        $this->visitantForm->clearFields();
    }

    /**
     * Summary of modalUpdate
     * @param \App\Models\Main\Visitant $visitant
     * @return void
     */
    public function modalUpdate(Visitant $visitant)
    {
        $this->municipalityEdit = Municipality::find($visitant->municipality_id);
        $this->visitantForm->setPost($visitant);
        $this->openModalUpdate  = $visitant->id;
    }

    /**
     * Summary of update
     * @return void
     */
    public function update()
    {
        $data = $this->validate();
        $this->visitantForm->update($data);
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
     * @param \App\Models\Main\Visitant $visitant
     * @return void
     */
    public function delete(Visitant $visitant)
    {
        $this->visitantForm->delete($visitant);
        $this->openModalDelete = false;
        $this->redirectRoute('visitant.index');
    }

    public function render()
    {
        return view('livewire.main.visitant.visitant-show-livewire', [
            'visitant' => Visitant::where('id', $this->visitant_id)
                ->with('civil_status', 'sex', 'municipality', 'state', 'identification_cards')
                ->first()
        ]);
    }
}
