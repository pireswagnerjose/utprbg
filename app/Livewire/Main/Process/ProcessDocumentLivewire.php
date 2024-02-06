<?php

namespace App\Livewire\Main\Process;

use App\Models\Main\Process;
use App\Models\Main\ProcessDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Reactive;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProcessDocumentLivewire extends Component
{
    use WithFileUploads;

    #[Reactive]
    public $process_id;
    public $prisoner_id;
    public $document;
    public $title = '';
    public $description = '';
    public $user_create = '';
    public $user_update = '';
    public $prison_unit_id = '';
    public $process;

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function closeModal()
    {
        $this->openModalProcessDocument = false;
        $this->openModalProcessDocumentEdit = false;
        $this->openModalProcessDocumentDelete = false;
    }

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->process          = Process::find($this->process_id);
    }

    // MODAL CREATE
    public $openModalProcessDocument = false;
    public function modalProcessDocument()
    {
        $this->openModalProcessDocument = true;
    }
    public function processDocumentCreate()
    {
        $dataValidated = $this->validate(
            [
                'document'      => 'required|mimetypes:application/pdf|max:10000',
                'title'         => 'required|max:100',
                'description'   => 'nullable|max:100',
                'user_create'   => 'required|max:10',
                'prison_unit_id'=> 'required|max:10',
                'process_id'    => 'required|max:10',
            ]
        );
        $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');

        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated['document'])) {
                Storage::disk('public')->delete($dataValidated['document']);
            }
            /* cria o nome com a extensão */
            $document = 'id-'.$this->prisoner_id . '_date-' . date('d-m-Y_H_m_s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/process_documents', $document);
        }
        ProcessDocument::create($dataValidated);
        $this->openModalProcessDocument = false;
        $this->reset('document', 'title', 'description');
    }

    // MODAL UPDATE
    public $openModalProcessDocumentEdit = false;
    public function modalProcessDocumentEdit(ProcessDocument $process_document)
    {
        $this->reset('document', 'title', 'description');
        $this->title = $process_document->title;
        $this->description = $process_document->description;
        $this->openModalProcessDocumentEdit = $process_document->id;
    }
    public function processDocumentUpdate(ProcessDocument $process_document)
    {
        if ($this->document) {
            $dataValidated = $this->validate(
                [
                    'document'   => 'required|mimetypes:application/pdf|max:10000',
                    'title'      => 'required|max:100',
                    'description'=> 'nullable|max:100',
                    'user_update'=> 'required|max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'title'      => 'required|max:100',
                    'description'=> 'nullable|max:100',
                    'user_update'=> 'required|max:10',
                ]
            );
        }
        $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');
        if (!empty($dataValidated['document'])) {
            /* responsável por excluir o documento */
            if (!empty($this->document)) {
                Storage::disk('public')->delete($process_document->document);
            }
            /* cria o nome com a extensão */
            $document = 'id-'.$this->prisoner_id . '_date-' . date('d-m-Y_H_m_s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/process_documents', $document);
        }
        $process_document->update($dataValidated);
        $this->openModalProcessDocumentEdit = false;
        $this->reset('document', 'title', 'description');
    }

    // MODAL DELETE
    public $openModalProcessDocumentDelete = false;
    public function modalProcessDocumentDelete($process_document_id)
    {
        $this->openModalProcessDocumentDelete = $process_document_id;
    }
    public function processDocumentDelete(ProcessDocument $process_document)
    {
        /* responsável por excluir o documento */
        if (!empty($process_document->document)) {
            Storage::disk('public')->delete($process_document->document);
        }
        $process_document->delete();
        $this->openModalProcessDocumentDelete = false;
    }

    public function render()
    {
        return view('livewire.main.process.process-document-livewire', [
            'process_documents' => ProcessDocument::where('process_id', $this->process_id)->orderBy('created_at','desc')->paginate(10),
        ]);
    }
}
