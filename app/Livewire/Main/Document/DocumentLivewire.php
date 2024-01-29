<?php

namespace App\Livewire\Main\Document;

use App\Models\Main\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class DocumentLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $document;
    public $name = '';
    public $description = '';

    public function mount()
    {
        $this->user_create    = Auth::user()->id;
        $this->user_update    = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('document', 'name', 'description');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalDocumentCreate = false;
        $this->openModalDocumentUpdate = false;
        $this->openModalDocumentDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        if(isset($data['document'])) { $dataValidated['document'] = mb_strtoupper ($dataValidated['document'],'utf-8'); }
        $dataValidated['name'] = mb_strtoupper ($dataValidated['name'],'utf-8');
        if(isset($data['description'])) { $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8'); }
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalDocumentCreate = false;
    public function modalDocumentCreate()
    {
        $this->clearFields();
        $this->openModalDocumentCreate = true;
    }
    // CREATE
    public function documentCreate()
    {
        $dataValidated = $this->validate(
            [
                'document'      =>'required|mimes:jpeg,jpg,png,pdf',
                'name'          =>'required|max:100',
                'description'   =>'nullable|max:255',
                'user_create'   =>'required|max:10',
                'prisoner_id'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated->document)) {
                Storage::disk('public')->delete($dataValidated->document);
            }
            /* cria o nome com a extensão */
            $document = 'id-'.$this->prisoner_id.'_'.'date-'.date('d-m-Y_H_m_s').'.'.$this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents', $document);
        }
        // grava os dados no banco
        Document::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalDocumentUpdate = false;
    public function modalDocumentUpdate(Document $document)
    {
        $this->name                        =$document->name;
        $this->description                 =$document->description;
        $this->openModalDocumentUpdate =$document->id;
    }
    // UPDATE
    public function documentUpdate(Document $document_update)
    {
        if ($this->document) {
            $dataValidated = $this->validate(
                [
                    'document'      =>'required|mimes:jpeg,jpg,png,pdf',
                    'name'          =>'required|max:100',
                    'description'   =>'nullable|max:255',
                    'user_update'   =>'required|max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'name'          =>'required|max:100',
                    'description'   =>'nullable|max:255',
                    'user_update'   =>'required|max:10',
                ]
            );
        }
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated->document)) {
                Storage::disk('public')->delete($dataValidated->document);
            }
            /* cria o nome com a extensão */
            $document = 'id-'.$this->prisoner_id.'_'.'date-'.date('d-m-Y_H_m_s').'.'.$this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents', $document);
        }   
        // grava os dados no banco
        $document_update->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalDocumentDelete = false;
    public function modalDocumentDelete($document_id)
    {
        $this->openModalDocumentDelete = $document_id;
    }
    // DELETE
    public function documentDelete(Document $document_delete)
    {
        /* responsável por excluir o documento */
        if (!empty($document_delete->document)) {
            Storage::disk('public')->delete($document_delete->document);
        }
        $document_delete->delete();
        $this->closeModal();
        $this->clearFields();
    }
    
    public function render()
    {
        return view('livewire.main.document.document-livewire', [
            'documents' => Document::where('prisoner_id', $this->prisoner_id)->orderBy('id','desc')->paginate(10),
        ]);
    }
}
