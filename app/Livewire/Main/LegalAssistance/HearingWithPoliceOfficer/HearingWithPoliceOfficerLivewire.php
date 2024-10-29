<?php

namespace App\Livewire\Main\LegalAssistance\HearingWithPoliceOfficer;

use App\Livewire\Forms\HearingWithPoliceOfficerForm;
use App\Models\Admin\LegalAssistance\ModalityCare;
use App\Models\Main\HearingWithPoliceOfficer;
use App\Models\Main\HearingWithPoliceOfficerDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class HearingWithPoliceOfficerLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public HearingWithPoliceOfficerForm $hearing_with_police_officer_form;
    public $prisoner_id;
    public $modality_cares = [];
    public $statuses = ['MANTIDO', 'CANCELADO'];
    public $openModalCreate = false;
    public $openModalUpdate = false;
    public $openModalDelete = false;
    public $openModalRelatedDocumentCreate = false;
    public $openModalRelatedDocumentDelete = false;

    public function mount()
    {
        $this->modality_cares = ModalityCare::all();
    }
    // close modal
    public function closeModal()
    {
        $this->openModalCreate = false;
        $this->openModalUpdate = false;
        $this->openModalDelete = false;
        $this->openModalRelatedDocumentCreate = false;
        $this->openModalRelatedDocumentDelete = false;
        $this->hearing_with_police_officer_form->clearFields();
    }
    // modal create
    public function modalCreate()
    {
        $this->hearing_with_police_officer_form->prisoner_id = $this->prisoner_id;
        $this->openModalCreate = true;
    }
    // create
    public function create()
    {
        $this->hearing_with_police_officer_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->hearing_with_police_officer_form->user_create = Auth::user()->id;
        $this->hearing_with_police_officer_form->create();
        $this->closeModal();
    }
    // modal update
    public function modalUpdate(HearingWithPoliceOfficer $hearing_with_police_officer)
    {
        $this->hearing_with_police_officer_form->setPost($hearing_with_police_officer);
        $this->openModalUpdate = true;
    }
    // update
    public function update()
    {
        $dataValidated = $this->validate();
        $this->hearing_with_police_officer_form->update($dataValidated);
        $this->openModalUpdate = false;
        $this->hearing_with_police_officer_form->clearFields();
        session()->flash('success', 'Atualizado com sucesso.');
        $this->render();
    }
    // modal delete
    public function modalDelete($id)
    {
        $this->openModalDelete = $id;
    }
    // delete
    public function delete(HearingWithPoliceOfficer $hearing_with_police_officer)
    {
        $this->hearing_with_police_officer_form->delete($hearing_with_police_officer);
        $this->openModalDelete = false;
        $this->hearing_with_police_officer_form->clearFields();
        $this->render();
    }
    // modal related document create
    public function modalRelatedDocumentCreate($pk_h_p_o_id)
    {
        $this->hearing_with_police_officer_form->pk_h_p_o_id = $pk_h_p_o_id;
        $this->hearing_with_police_officer_form->prisoner_id = $this->prisoner_id;
        $this->openModalRelatedDocumentCreate = true;
    }
    // related document create
    public function createRelatedDocumment()
    {
        $this->hearing_with_police_officer_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->hearing_with_police_officer_form->user_create = Auth::user()->id;
        $this->hearing_with_police_officer_form->createDocument();
        $this->closeModal();
    }
    // modal related document delete
    public function modalRelatedDocumentDelete($pk_h_p_o_id)
    {
        $this->openModalRelatedDocumentDelete = $pk_h_p_o_id;
    }
    // related document delete
    public function deleteRelatedDocumment(HearingWithPoliceOfficerDocument $document)
    {
        $this->hearing_with_police_officer_form->deleteDocument($document);
        $this->openModalRelatedDocumentDelete = false;
        $this->hearing_with_police_officer_form->clearFields();
        session()->flash('success', 'Excluído com sucesso.');
    }
    public function render()
    {
        $hearing_with_police_officers = HearingWithPoliceOfficer::where('prisoner_id', $this->prisoner_id)
        ->with('hearing_with_police_officer_documents')
        ->orderBy('date_of_service', 'desc')
        ->paginate(5);
        return view('livewire.main.legal-assistance.hearing-with-police-officer.hearing-with-police-officer-livewire',
        compact('hearing_with_police_officers')
        );
    }
}
