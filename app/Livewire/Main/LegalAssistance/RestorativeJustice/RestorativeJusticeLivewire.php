<?php

namespace App\Livewire\Main\LegalAssistance\RestorativeJustice;

use App\Livewire\Forms\RestorativeJusticeForm;
use App\Models\Admin\LegalAssistance\ModalityCare;
use App\Models\Main\RestorativeJustice;
use App\Models\Main\RestorativeJusticeDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RestorativeJusticeLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public RestorativeJusticeForm $restorative_justice_form;
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
        $this->restorative_justice_form->clearFields();
    }
    // modal create
    public function modalCreate()
    {
        $this->restorative_justice_form->prisoner_id = $this->prisoner_id;
        $this->openModalCreate = true;
    }
    // create
    public function create()
    {
        $this->restorative_justice_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->restorative_justice_form->user_create = Auth::user()->id;
        $this->restorative_justice_form->create();
        $this->closeModal();
    }
    // modal update
    public function modalUpdate(RestorativeJustice $restorative_justice)
    {
        $this->restorative_justice_form->setPost($restorative_justice);
        $this->openModalUpdate = true;
    }
    // update
    public function update()
    {
        $dataValidated = $this->validate();
        $this->restorative_justice_form->update($dataValidated);
        $this->openModalUpdate = false;
        $this->restorative_justice_form->clearFields();
        session()->flash('success', 'Atualizado com sucesso.');
        $this->render();
    }
    // modal delete
    public function modalDelete($id)
    {
        $this->openModalDelete = $id;
    }
    // delete
    public function delete(RestorativeJustice $restorative_justice)
    {
        $this->restorative_justice_form->delete($restorative_justice);
        $this->openModalDelete = false;
        $this->restorative_justice_form->clearFields();
        $this->render();
    }
    // modal related document create
    public function modalRelatedDocumentCreate($restorative_justice_id)
    {
        $this->restorative_justice_form->restorative_justice_id = $restorative_justice_id;
        $this->restorative_justice_form->prisoner_id = $this->prisoner_id;
        $this->openModalRelatedDocumentCreate = true;
    }
    // related document create
    public function createRelatedDocumment()
    {
        $this->restorative_justice_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->restorative_justice_form->user_create = Auth::user()->id;
        $this->restorative_justice_form->createDocument();
        $this->closeModal();
    }
    // modal related document delete
    public function modalRelatedDocumentDelete($restorative_justice_id)
    {
        $this->openModalRelatedDocumentDelete = $restorative_justice_id;
    }
    // related document delete
    public function deleteRelatedDocumment(RestorativeJusticeDocument $document)
    {
        $this->restorative_justices_form->deleteDocument($document);
        $this->openModalRelatedDocumentDelete = false;
        $this->restorative_justices_form->clearFields();
        session()->flash('success', 'Excluído com sucesso.');
    }
    public function render()
    {
        $restorative_justices = RestorativeJustice::where('prisoner_id', $this->prisoner_id)
        ->with('restorative_justice_documents')
        ->orderBy('date_of_service', 'desc')
        ->paginate(5);
        return view('livewire.main.legal-assistance.restorative-justice.restorative-justice-livewire',
        compact('restorative_justices')
        );
    }
}
