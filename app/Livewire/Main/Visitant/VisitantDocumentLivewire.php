<?php

namespace App\Livewire\Main\Visitant;

use App\Models\Main\Visitant;
use App\Models\Main\VisitantDocument;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;

class VisitantDocumentLivewire extends Component
{
    use WithFileUploads;

    public $visitant_id;
    public $document;
    public $title = '';
    public $description = '';
    public $remark = '';
    public $visitant;
    public $prison_unit_id = '';
    public $user_create = '';
    public $user_update = '';

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->visitant         = Visitant::find($this->visitant_id);
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalVisitantDocumentCreate = false;
        $this->openModalVisitantDocumentEdit = false;
        $this->openModalVisitantDocumentDelete = false;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function  clearFields()
    {
        $this->reset('document','title','description','remark');
    }

    // SET UPPERCASE - TRANSFORMA EM MAÚSCULO
    public function convertUppercase($dataValidated)
    {
        $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalVisitantDocumentCreate = false;
    public function modalVisitantDocumentCreate()
    {
        $this->openModalVisitantDocumentCreate = true;
    }

    // CREATE
    public function visitantDocumentCreate()
    {
        $dataValidated = $this->validate(
            [
                'document'      => 'required|mimetypes:application/pdf|max:10000',
                'title'         => 'required|max:100',
                'description'   => 'nullable|max:255',
                'remark'        => 'nullable',
                'user_create'   => 'required|max:10',
                'prison_unit_id'=> 'required|max:10',
                'visitant_id'   => 'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);

        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated['document'])) {
                Storage::disk('public')->delete($dataValidated['document']);
            }
            /* cria o nome com a extensão */
            $document = 'id-'.$this->visitant_id . '_date-' . date('d-m-Y_H_m_s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('visitant/' . 'id - ' . $this->visitant_id . '/visitant_documents', $document);
        }
        VisitantDocument::create($dataValidated);
        $this->openModalVisitantDocumentCreate = false;
        $this->clearFields();// Limpa os campos
    }

    // MODAL UPDATE
    public $openModalVisitantDocumentEdit = false;
    public function modalVisitantDocumentEdit(VisitantDocument $visitant_document)
    {
        $this->clearFields();
        $this->title = $visitant_document->title;
        $this->description = $visitant_document->description;
        $this->remark = $visitant_document->remark;
        $this->openModalVisitantDocumentEdit = $visitant_document->id;
    }

    // UPDATE
    public function visitantDocumentUpdate(VisitantDocument $visitant_document)
    {
        if ($this->document) {
            $dataValidated = $this->validate(
                [
                    'document'      => 'required|mimetypes:application/pdf|max:10000',
                    'title'         => 'required|max:100',
                    'description'   => 'nullable|max:255',
                    'remark'        => 'nullable',
                    'user_update'   => 'required|max:10',
                    'prison_unit_id'=> 'required|max:10',
                    'visitant_id'   => 'required|max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'title'         => 'required|max:100',
                    'description'   => 'nullable|max:255',
                    'remark'        => 'nullable',
                    'user_update'   => 'required|max:10',
                    'prison_unit_id'=> 'required|max:10',
                    'visitant_id'   => 'required|max:10',
                ]
            );
        }
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);

        if (!empty($dataValidated['document'])) {
            /* responsável por excluir o documento */
            if (!empty($this->document)) {
                Storage::disk('public')->delete($visitant_document->document);
            }
            /* cria o nome com a extensão */
            $document = 'id - ' . $this->visitant_id . '_date-' . date('d-m-Y_H_m_s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('visitant/' . 'id - ' . $this->visitant_id . '/visitant_documents', $document);
        }
        $visitant_document->update($dataValidated);
        $this->openModalVisitantDocumentEdit = false;
        $this->clearFields();
    }

    // MODAL DELETE
    public $openModalVisitantDocumentDelete = false;
    public function modalVisitantDocumentDelete($visitant_document_id)
    {
        $this->openModalVisitantDocumentDelete = $visitant_document_id;
    }

    // DELETE
    public function visitantDocumentDelete(VisitantDocument $visitant_document)
    {
        /* responsável por excluir o documento */
        if (!empty($visitant_document->document)) {
            Storage::disk('public')->delete($visitant_document->document);
        }
        $visitant_document->delete();
        $this->openModalVisitantDocumentDelete = false;
    }

    public function render()
    {
        return view('livewire.main.visitant.visitant-document-livewire', [
            'visitant_documents' => VisitantDocument::where('visitant_id', $this->visitant_id)
                ->orderBy('created_at','desc')
                ->paginate(10),
        ]);
    }
}
