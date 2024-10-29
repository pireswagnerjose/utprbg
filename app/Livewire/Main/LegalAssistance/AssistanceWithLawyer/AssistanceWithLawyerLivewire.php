<?php

namespace App\Livewire\Main\LegalAssistance\AssistanceWithLawyer;

use App\Livewire\Forms\AssistanceWithLawyerForm;
use App\Models\Admin\LegalAssistance\Lawyer;
use App\Models\Admin\LegalAssistance\ModalityCare;
use App\Models\Main\AssistanceWithLawyer;
use App\Models\Main\AssistanceWithLawyerDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AssistanceWithLawyerLivewire extends Component
{
    use WithFileUploads;
    public AssistanceWithLawyerForm $assistance_with_lawyer_form;
    use WithPagination;

    public $prisoner_id;
    public $lawyers = [];
    public $modality_cares = [];
    public $statuses = ['MANTIDO', 'CANCELADO'];
    public $openModalCreate = false;
    public $openModalUpdate = false;
    public $openModalDelete = false;
    public $openModalRelatedDocumentCreate = false;
    public $openModalRelatedDocumentDelete = false;
    
    public function mount()
    {
        $this->lawyers = Lawyer::all();
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
        $this->assistance_with_lawyer_form->clearFields();
    }
    // modal create
    public function modalCreate()
    {
        $this->assistance_with_lawyer_form->prisoner_id = $this->prisoner_id;
        $this->openModalCreate = true;
    }
    // create
    public function create()
    {
        $this->assistance_with_lawyer_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->assistance_with_lawyer_form->user_create = Auth::user()->id;
        $this->assistance_with_lawyer_form->create();
        $this->closeModal();
    }
    // modal update
    public function modalUpdate(AssistanceWithLawyer $assistance_with_lawyer)
    {
        $this->assistance_with_lawyer_form->setPost($assistance_with_lawyer);
        $this->openModalUpdate = true;
    }
    // update
    public function update()
    {
        $dataValidated = $this->validate();
        $this->assistance_with_lawyer_form->update($dataValidated);
        $this->openModalUpdate = false;
        $this->assistance_with_lawyer_form->clearFields();
        session()->flash('success', 'Atualizado com sucesso.');
        $this->render();
    }
    // modal delete
    public function modalDelete($id)
    {
        $this->openModalDelete = $id;
    }
    // delete
    public function delete(AssistanceWithLawyer $assistance_with_lawyer)
    {
        $this->assistance_with_lawyer_form->delete($assistance_with_lawyer);
        $this->openModalDelete = false;
        $this->assistance_with_lawyer_form->clearFields();
        $this->render();
    }
    // modal related document create
    public function modalRelatedDocumentCreate($pk_a_w_l_id)
    {
        $this->assistance_with_lawyer_form->pk_a_w_l_id = $pk_a_w_l_id;
        $this->assistance_with_lawyer_form->prisoner_id = $this->prisoner_id;
        $this->openModalRelatedDocumentCreate = true;
    }
    // related document create
    public function createRelatedDocumment()
    {
        $this->assistance_with_lawyer_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->assistance_with_lawyer_form->user_create = Auth::user()->id;
        $this->assistance_with_lawyer_form->createDocument();
        $this->closeModal();
    }
    // modal related document delete
    public function modalRelatedDocumentDelete($pk_a_w_l_id)
    {
        $this->openModalRelatedDocumentDelete = $pk_a_w_l_id;
    }
    // related document delete
    public function deleteRelatedDocumment(AssistanceWithLawyerDocument $document)
    {
        $this->assistance_with_lawyer_form->deleteDocument($document);
        $this->openModalRelatedDocumentDelete = false;
        $this->assistance_with_lawyer_form->clearFields();
        session()->flash('success', 'Excluído com sucesso.');
    }
    
    public function render()
    {
        $assistance_with_lawyers = AssistanceWithLawyer::where('prisoner_id', $this->prisoner_id)
            ->with('assistance_with_lawyer_documents')
            ->orderBy('date_of_service', 'desc')
            ->paginate(5);
        return view('livewire.main.legal-assistance.assistance-with-lawyer.assistance-with-lawyer-livewire',
            compact('assistance_with_lawyers')
        );
    }
}
