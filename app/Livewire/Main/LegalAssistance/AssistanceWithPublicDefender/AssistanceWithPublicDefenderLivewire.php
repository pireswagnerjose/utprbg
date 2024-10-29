<?php

namespace App\Livewire\Main\LegalAssistance\AssistanceWithPublicDefender;

use App\Livewire\Forms\AssistanceWithPublicDefenderForm;
use App\Models\Admin\LegalAssistance\ModalityCare;
use App\Models\Admin\PublicDefender\PublicDefender;
use App\Models\Main\AssistanceWithPublicDefender;
use App\Models\Main\AssistanceWithPublicDefenderDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AssistanceWithPublicDefenderLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public AssistanceWithPublicDefenderForm $assistance_with_public_defender_form;
    public $prisoner_id;
    public $public_defenders = [];
    public $modality_cares = [];
    public $statuses = ['MANTIDO', 'CANCELADO'];
    public $openModalCreate = false;
    public $openModalUpdate = false;
    public $openModalDelete = false;
    public $openModalRelatedDocumentCreate = false;
    public $openModalRelatedDocumentDelete = false;

    public function mount()
    {
        $this->public_defenders = PublicDefender::all();
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
        $this->assistance_with_public_defender_form->clearFields();
    }
    // modal create
    public function modalCreate()
    {
        $this->assistance_with_public_defender_form->prisoner_id = $this->prisoner_id;
        $this->openModalCreate = true;
    }
    // create
    public function create()
    {
        $this->assistance_with_public_defender_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->assistance_with_public_defender_form->user_create = Auth::user()->id;
        $this->assistance_with_public_defender_form->create();
        $this->closeModal();
    }
    // modal update
    public function modalUpdate(AssistanceWithPublicDefender $assistance_with_public_defender)
    {
        $this->assistance_with_public_defender_form->setPost($assistance_with_public_defender);
        $this->openModalUpdate = true;
    }
    // update
    public function update()
    {
        $dataValidated = $this->validate();
        $this->assistance_with_public_defender_form->update($dataValidated);
        $this->openModalUpdate = false;
        $this->assistance_with_public_defender_form->clearFields();
        session()->flash('success', 'Atualizado com sucesso.');
        $this->render();
    }
    // modal delete
    public function modalDelete($id)
    {
        $this->openModalDelete = $id;
    }
    // delete
    public function delete(AssistanceWithPublicDefender $assistance_with_public_defender)
    {
        $this->assistance_with_public_defender_form->delete($assistance_with_public_defender);
        $this->openModalDelete = false;
        $this->assistance_with_public_defender_form->clearFields();
        $this->render();
    }
    // modal related document create
    public function modalRelatedDocumentCreate($pk_a_p_d_id)
    {
        $this->assistance_with_public_defender_form->pk_a_p_d_id = $pk_a_p_d_id;
        $this->assistance_with_public_defender_form->prisoner_id = $this->prisoner_id;
        $this->openModalRelatedDocumentCreate = true;
    }
    // related document create
    public function createRelatedDocumment()
    {
        $this->assistance_with_public_defender_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->assistance_with_public_defender_form->user_create = Auth::user()->id;
        $this->assistance_with_public_defender_form->createDocument();
        $this->closeModal();
    }
    // modal related document delete
    public function modalRelatedDocumentDelete($pk_a_w_l_id)
    {
        $this->openModalRelatedDocumentDelete = $pk_a_w_l_id;
    }
    // related document delete
    public function deleteRelatedDocumment(AssistanceWithPublicDefenderDocument $document)
    {
        $this->assistance_with_public_defender_form->deleteDocument($document);
        $this->openModalRelatedDocumentDelete = false;
        $this->assistance_with_public_defender_form->clearFields();
        session()->flash('success', 'Excluído com sucesso.');
    }

    public function render()
    {
        $assistance_with_public_defenders = AssistanceWithPublicDefender::where('prisoner_id', $this->prisoner_id)
        ->with('assistance_with_public_defender_documents')
        ->orderBy('date_of_service', 'desc')
        ->paginate(5);
        return view('livewire.main.legal-assistance.assistance-with-public-defender.assistance-with-public-defender-livewire',
        compact('assistance_with_public_defenders')
        );
    }
}
