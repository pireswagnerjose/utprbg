<?php

namespace App\Livewire\Main\Pad;

use App\Models\Admin\Pad\PadEventType;
use App\Models\Admin\Pad\PadLocal;
use App\Models\Admin\Pad\PadNatureOfEvent;
use App\Models\Admin\Pad\PadStatus;
use App\Models\Admin\Pad\PadTypeOfOccurrence;
use App\Models\Main\Pad;
use App\Models\Main\PadDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class PadLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;

    public $register_number = '';
    public $opening_date;
    public $opening_time;
    public $completion_date;
    public $remark = '';
    public $pad_event_type_id;
    public $pad_local_id;
    public $pad_nature_of_event_id;
    public $pad_status_id;
    public $pad_type_of_occurrence_id;
    public $pad_event_types = [];
    public $pad_locals = [];
    public $pad_nature_of_events = [];
    public $pad_statuses = [];
    public $pad_type_of_occurrences = [];

    public function mount()
    {
        $this->user_create             = Auth::user()->id;
        $this->user_update             = Auth::user()->id;
        $this->prison_unit_id          = Auth::user()->prison_unit_id;
        $this->pad_event_types         = PadEventType::all();
        $this->pad_locals              = PadLocal::all();
        $this->pad_nature_of_events    = PadNatureOfEvent::all();
        $this->pad_statuses            = PadStatus::all();
        $this->pad_type_of_occurrences = PadTypeOfOccurrence::all();

        // Pad Documents
        $this->pad_doc                    = Pad::find($this->pad_doc_id);
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('register_number', 'opening_date', 'opening_time', 'completion_date', 'remark', 'pad_event_type_id',
                    'pad_local_id', 'pad_nature_of_event_id', 'pad_status_id', 'pad_type_of_occurrence_id');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalPadCreate = false;
        $this->openModalPadUpdate = false;
        $this->openModalPadDelete = false;

        // Pad Document
        $this->openModalPadDocumentCreate = false;
        $this->openModalPadDocumentUpdate = false;
        $this->openModalPadDocumentDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        if(isset($data['register_number'])) { $dataValidated['register_number'] = mb_strtoupper ($dataValidated['register_number'],'utf-8'); }
        if(isset($data['remark'])) { $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8'); }
        if(isset($data['document'])) { $dataValidated['document'] = mb_strtoupper ($dataValidated['document'],'utf-8'); }
        if(isset($data['title'])) { $dataValidated['title'] = mb_strtoupper ($dataValidated['title'],'utf-8'); }
        if(isset($data['description'])) { $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8'); }
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalPadCreate = false;
    public function modalPadCreate()
    {
        $this->clearFields();
        $this->openModalPadCreate = true;
    }
    // CREATE
    public function padCreate()
    {
        $dataValidated = $this->validate(
            [
                'register_number'          =>'required|max:100',
                'opening_date'             =>'required|min:10|max:10',
                'opening_time'             =>'required|min:5|max:5',
                'completion_date'          =>'nullable|min:10|max:10',
                'remark'                   =>'nullable',
                'user_create'              =>'required|max:10',
                'prison_unit_id'           =>'required|max:10',
                'prisoner_id'              =>'required|max:10',
                'pad_event_type_id'        =>'nullable|max:10',
                'pad_local_id'             =>'nullable|max:10',
                'pad_nature_of_event_id'   =>'nullable|max:10',
                'pad_status_id'            =>'nullable|max:10',
                'pad_type_of_occurrence_id'=>'nullable|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        Pad::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalPadUpdate = false;
    public function modalPadUpdate(Pad $pad)
    {
        $this->register_number           = $pad->register_number;
        $this->opening_date              = $pad->opening_date;
        $this->opening_time              = $pad->opening_time;
        $this->completion_date           = $pad->completion_date;
        $this->remark                    = $pad->remark;
        $this->user_create               = $pad->user_create;
        $this->prison_unit_id            = $pad->prison_unit_id;
        $this->prisoner_id               = $pad->prisoner_id;
        $this->pad_event_type_id         = $pad->pad_event_type_id;
        $this->pad_local_id              = $pad->pad_local_id;
        $this->pad_nature_of_event_id    = $pad->pad_nature_of_event_id;
        $this->pad_status_id             = $pad->pad_status_id;
        $this->pad_type_of_occurrence_id = $pad->pad_type_of_occurrence_id;
        $this->openModalPadUpdate        = $pad->id;
    }
    // UPDATE
    public function padUpdate(pad $pad)
    {
        $dataValidated = $this->validate(
            [
                'register_number'          =>'required|max:100',
                'opening_date'             =>'required|min:10|max:10',
                'opening_time'             =>'required|min:5|max:5',
                'completion_date'          =>'nullable|min:10|max:10',
                'remark'                   =>'nullable',
                'user_update'              =>'required|max:10',
                'pad_event_type_id'        =>'nullable|max:10',
                'pad_local_id'             =>'nullable|max:10',
                'pad_nature_of_event_id'   =>'nullable|max:10',
                'pad_status_id'            =>'nullable|max:10',
                'pad_type_of_occurrence_id'=>'nullable|max:10',
            ]
        );
        // corrige o erro quando a data de saída for apagada
        $completion_date = $dataValidated['completion_date'] ?: null;
        $dataValidated['completion_date'] = $completion_date;
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        $pad->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalPadDelete = false;
    public function modalPadDelete($pad_id)
    {
        $this->openModalPadDelete = $pad_id;
    }
    // DELETE
    public function padDelete(Pad $pad)
    {
        $pad->delete();
        $this->closeModal();
        $this->clearFields();
    }

    
    public function render()
    {
        return view('livewire.main.pad.pad-livewire', [
            'pads' => Pad::where('prisoner_id', $this->prisoner_id)->orderBy('opening_date','desc')->paginate(10)
        ]);
    }


    // PAD DOCUMENTS
    public $pad_doc = [];
    public $pad_doc_id;
    public $document;
    public $title = '';
    public $description = '';
    public $pad_id;

    // MODAL CREATE
    public $openModalPadDocumentCreate = false;
    public function modalPadDocumentCreate($pad_id)
    {
        $this->reset('document', 'title', 'description');
        $this->pad_id = $pad_id;
        $this->openModalPadDocumentCreate = true;
    }

    // CREATE
    public function padDocumentCreate()
    {
        $dataValidated = $this->validate(
            [
                'document'      =>'required|mimes:pdf',
                'title'         =>'required|max:100',
                'description'   =>'nullable|max:255',
                'user_create'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
                'pad_id'        =>'required|max:10',
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
            $document = $dataValidated['title'].'_'.date('d-m-Y_H-m-s').'.'.$this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/pad', $document);
        }
        // grava os dados no banco
        PadDocument::create($dataValidated);
        $this->closeModal();
        $this->reset('document', 'title', 'description', 'pad_id');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalPadDocumentUpdate = false;
    public function modalPadDocumentUpdate(PadDocument $pad_document)
    {
        $this->title                      =$pad_document->title;
        $this->description                =$pad_document->description;
        $this->openModalPadDocumentUpdate =$pad_document->id;
    }

    // UPDATE
    public function padDocumentUpdate(PadDocument $pad_document)
    {
        if ($this->document) {
            $dataValidated = $this->validate(
                [
                    'document'      =>'required|mimes:pdf',
                    'title'         =>'required|max:100',
                    'description'   =>'nullable|max:255',
                    'user_update'   =>'required|max:10',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'title'         =>'required|max:100',
                    'description'   =>'nullable|max:255',
                    'user_update'   =>'required|max:10',
                ]
            );
        }
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($pad_document->document)) {
                Storage::disk('public')->delete($pad_document->document);
            }
            /* cria o nome com a extensão */
            $document = $dataValidated['title'].'_'.date('d-m-Y_H-m-s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/pad', $document);
        }   
        // grava os dados no banco
        $pad_document->update($dataValidated);
        $this->closeModal();
        $this->reset('document', 'title', 'description', 'pad_id');
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalPadDocumentDelete = false;
    public function modalPadDocumentDelete($document_id)
    {
        $this->openModalPadDocumentDelete = $document_id;
    }
    // DELETE
    public function padDocumentDelete(PadDocument $pad_document)
    {
        /* responsável por excluir o documento */
        if (!empty($pad_document->document)) {
            Storage::disk('public')->delete($pad_document->document);
        }
        $pad_document->delete();
        $this->closeModal();
        $this->reset('document', 'title', 'description', 'pad_id');
    }
}
