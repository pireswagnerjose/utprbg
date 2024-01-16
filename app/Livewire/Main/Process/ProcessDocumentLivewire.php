<?php

namespace App\Livewire\Main\Process;

use App\Models\Main\Process;
use App\Models\Main\ProcessDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProcessDocumentLivewire extends Component
{
    use WithFileUploads;
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
                'document' => [
                    'required',
                    File::types(['pdf']),
                ],
                'title'             => 'required|max:255',
                'description'       => 'max:255',
                'user_create'       => 'max:10',
                'prison_unit_id'    => 'max:10',
                'process_id'        => 'max:10',
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
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/process', $document);
        }
        $dataValidated['document'] = mb_strtoupper ($dataValidated['document'],'utf-8');
        $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');

        ProcessDocument::create($dataValidated);
        $this->openModalProcessDocument = false;
        $this->reset('document', 'title', 'description');
    }

    // MODAL UPDATE
    public $openModalProcessDocumentEdit = false;
    public function modalProcessDocumentEdit(ProcessDocument $process_document)
    {
        $this->title = $process_document->title;
        $this->description = $process_document->description;
        $this->openModalProcessDocumentEdit = $process_document->id;
    }
    public function processDocumentUpdate(ProcessDocument $process_document)
    {
        if ($this->document) {
            $dataValidated = $this->validate(
                [
                    'document'      => [ File::types(['pdf']) ],
                    'title'         => 'required|max:255',
                    'description'   => 'max:255',
                    'user_update'   => 'max:10',
                    'process_id'    => 'max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'title'         => 'required|max:255',
                    'description'   => 'max:255',
                    'user_update'   => 'max:10',
                    'process_id'    => 'max:10',
                ]
            );
        }
        if (!empty($dataValidated['document'])) {
            $document_name = str_replace("/", "-", $dataValidated['title']);
            /* responsável por excluir o documento */
            if (!empty($this->document)) {
                Storage::disk('public')->delete($process_document->document);
            }
            /* cria o nome com a extensão */
            $document = $document_name . ' - ' . date('d-m-Y') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/process', $document);
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
