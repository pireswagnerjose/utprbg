<?php

namespace App\Livewire\Main\Prison;

use App\Models\Main\Prison;
use App\Models\Main\PrisonDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Validation\Rules\File;

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
    public function modalPrisonDocument(Prison $prison)
    {
        $this->openModalPrisonDocument = $prison->id;
    }

    public function prisonDocumentCreate()
    {
        $dataValidated = $this->validate(
            [
                'document' => [
                    'required',
                    File::types(['pdf']),
                ],
                'title'             => 'required|max:255',
                'description'       => 'max:255',
                'user_create'       => 'max:10',
                'prison_unit_id'    => 'max:10',
                'prison_id'         => 'max:10',
            ]
        );

        if ($this->document) {
            $document_name = str_replace("/", "-", $dataValidated['title']);

            /* responsável por excluir o documento */
            if (!empty($dataValidated->document)) {
                Storage::disk('public')->delete($dataValidated->document);
            }
            /* cria o nome com a extensão */
            $document = $document_name . ' - ' . date('d-m-Y') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/prison', $document);
        }
        $dataValidated['document'] = mb_strtoupper ($dataValidated['document'],'utf-8');
        $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');

        PrisonDocument::create($dataValidated);
        $this->openModalPrisonDocument = false;
        $this->reset('document', 'title', 'description');
    }

    // MODAL UPDATE
    public $openmodalPrisonDocumentEdit = false;
    public function modalPrisonDocumentEdit(PrisonDocument $prison_document)
    {
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
                    'document'      => [ File::types(['pdf']) ],
                    'title'         => 'required|max:255',
                    'description'   => 'max:255',
                    'user_update'   => 'max:10',
                    'prison_id'     => 'max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'title'         => 'required|max:255',
                    'description'   => 'max:255',
                    'user_update'   => 'max:10',
                    'prison_id'     => 'max:10',
                ]
            );
        }

        if (!empty($dataValidated['document'])) {
            $document_name = str_replace("/", "-", $dataValidated['title']);

            /* responsável por excluir o documento */
            if (!empty($this->document)) {
                Storage::disk('public')->delete($prison_document->document);
            }
            /* cria o nome com a extensão */
            $document = $document_name . ' - ' . date('d-m-Y') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/prison', $document);
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
    
    public function render()
    {
        return view('livewire.main.prison.prison-document-livewire');
    }
}
