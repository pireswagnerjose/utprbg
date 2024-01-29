<?php

namespace App\Livewire\Main\Prison;

use App\Models\Main\Prison;
use App\Models\Main\PrisonDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Component;

class PrisonDocumentLivewire extends Component
{
    use WithFileUploads;
    public $prison_id;
    public $prisoner_id;
    public $document;
    public $title = '';
    public $description = '';
    public $user_create = '';
    public $user_update = '';
    public $prison_unit_id = '';
    public $prison;

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->openModalPrisonDocument = false;
        $this->openmodalPrisonDocumentEdit = false;
        $this->openModalPrisonDocumentDelete = false;
    }

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prison           = Prison::find($this->prison_id);
    }

    // MODAL CREATE
    public $openModalPrisonDocument = false;
    public function modalPrisonDocument($prison_id)
    {
        $this->openModalPrisonDocument = $prison_id;
    }

    public function prisonDocumentCreate()
    {
        $dataValidated = $this->validate(
            [
                'document'      => 'required|mimetypes:application/pdf|max:10000',
                'title'         => 'required|max:100',
                'description'   => 'max:100',
                'user_create'   => 'max:10',
                'prison_unit_id'=> 'max:10',
                'prison_id'     => 'max:10',
            ]
        );
        $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');

        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated->document)) {
                Storage::disk('public')->delete($dataValidated->document);
            }
            /* cria o nome com a extensão */
            $document = 'id-'.$this->prisoner_id . '_date-' . date('d-m-Y_H_m_s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/prison_documents', $document);
        }
        PrisonDocument::create($dataValidated);
        $this->openModalPrisonDocument = false;
        $this->reset('document', 'title', 'description');
    }

    // MODAL UPDATE
    public $openmodalPrisonDocumentEdit = false;
    public function modalPrisonDocumentEdit(PrisonDocument $prison_document)
    {
        $this->reset('document', 'title', 'description');
        $this->title = $prison_document->title;
        $this->description = $prison_document->description;
        $this->openmodalPrisonDocumentEdit = $prison_document->id;
    }

    // UPDATE
    public function documentUpdate(PrisonDocument $prison_document)
    {
        if ($this->document) {
            $dataValidated = $this->validate(
                [
                    'document'      => 'nullable|mimetypes:application/pdf|max:10000',
                    'title'         => 'nullable|max:100',
                    'description'   => 'nullable|max:100',
                    'user_update'   => 'nullable|max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'title'         => 'nullable|max:100',
                    'description'   => 'nullable|max:255',
                    'user_update'   => 'nullable|max:10',
                ]
            );
        }
        $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');

        if (!empty($dataValidated['document'])) {
            /* responsável por excluir o documento */
            if (!empty($this->document)) {
                Storage::disk('public')->delete($prison_document->document);
            }
            /* cria o nome com a extensão */
            $document = 'id-'.$this->prisoner_id . '_date-' . date('d-m-Y_H_m_s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/prison_documents', $document);
        }
        $prison_document->update($dataValidated);
        $this->openmodalPrisonDocumentEdit = false;
        $this->reset('document', 'title', 'description');
    }

    // MODAL DELETE
    public $openModalPrisonDocumentDelete = false;
    public function modalPrisonDocumentDelete($prison_document_id)
    {
        $this->openModalPrisonDocumentDelete = $prison_document_id;
    }
    public function prisonDocumentDelete(PrisonDocument $prison_document)
    {
        /* responsável por excluir o documento */
        if (!empty($prison_document->document)) {
            Storage::disk('public')->delete($prison_document->document);
        }
        $prison_document->delete();
        $this->openModalPrisonDocumentDelete = false;
    }
    
    // public function render()
    // {
    //     return view('livewire.main.prison.prison-document-livewire');
    // }
}
