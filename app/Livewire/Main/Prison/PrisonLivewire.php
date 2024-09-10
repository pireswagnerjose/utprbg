<?php

namespace App\Livewire\Main\Prison;

use App\Models\Admin\Prison\OutputType;
use App\Models\Admin\Prison\PrisonOrigin;
use App\Models\Admin\Prison\TypePrison;
use App\Models\Admin\PrisonUnit;
use App\Models\Main\Prison;
use App\Models\Main\PrisonDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class PrisonLivewire extends Component
{
    use WithPagination;
    
    public $entry_date;
    public $exit_date;
    public $sentence = '';
    public $exit_forecast;
    public $sentence_certificate;
    public $remarks = '';
    public $user_create = '';
    public $user_update = '';
    public $prisoner_id;
    public $prison_unit_id;
    public $prison_origin_id;
    public $type_prison_id;
    public $output_type_id;
    public $prisonUnits;
    public $prisonOrigins;
    public $typePrisons;
    public $outputTypes;

    public $prisonAcessories;

    public function mount()
    {
        $this->prisonAcessories = Prison::all();
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prisonUnits      = PrisonUnit::all();
        $this->prisonOrigins    = PrisonOrigin::all();
        $this->typePrisons      = TypePrison::all();
        $this->outputTypes      = OutputType::all();
    }
    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('entry_date', 'exit_date', 'sentence', 'exit_forecast', 'sentence_certificate', 'remarks',
            'prison_unit_id', 'prison_origin_id', 'type_prison_id', 'output_type_id',);
    }

    // CLEAR MODAL
    public function closeModal()
    {
        $this->openModalPrisonCreate = false;
        $this->openModalPrisonUpdate = false;
        $this->openModalPrisonDelete = false;

        $this->openModalPrisonDocument = false;
        $this->openModalPrisonDocumentEdit = false;
        $this->openModalPrisonDocumentDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['sentence'] = mb_strtoupper ($dataValidated['sentence'],'utf-8');
        $dataValidated['remarks'] = mb_strtoupper ($dataValidated['remarks'],'utf-8');
        return $dataValidated;
    }
    
    // MODAL CREATE NEW PRISON
    public $openModalPrisonCreate = false;
    public function modalPrisonCreate()
    {
        // $this->clearFields();
        $this->openModalPrisonCreate = true;
    }
    public function prisonCreate()
    {
        $dataValidated = $this->validate(
            [
                'prison_unit_id'        =>'required|max:10',
                'entry_date'            =>'required|min:10|max:10',
                'exit_date'             =>'nullable|min:10|max:10',
                'sentence'              =>'max:100',
                'exit_forecast'         =>'nullable|min:10|max:10',
                'sentence_certificate'  =>'nullable|min:10|max:10',
                'remarks'               =>'nullable',
                'user_create'           =>'required|max:10',
                'prison_origin_id'      =>'required|max:10',
                'type_prison_id'        =>'required|max:10',
                'output_type_id'        =>'nullable|max:10',
                'prisoner_id'           =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        Prison::create($dataValidated);
        $this->clearFields();
        $this->closeModal();
        $this->resetPage();
    }

    // MODAL UPDATE PRISON
    public $openModalPrisonUpdate = false;
    public $prisonUpdate_id;
    public function modalPrisonUpdate(Prison $prison)
    {
        $this->prisonUpdate_id = $prison->id;
        // seta os valores para serem atualizados
        $this->prison_unit_id       =$prison->prison_unit_id;
        $this->entry_date           =$prison->entry_date;
        $this->exit_date            =$prison->exit_date;
        $this->sentence             =$prison->sentence;
        $this->exit_forecast        =$prison->exit_forecast;
        $this->sentence_certificate =$prison->sentence_certificate;
        $this->remarks              =$prison->remarks;
        $this->user_create          =$prison->user_create;
        $this->prison_origin_id     =$prison->prison_origin_id;
        $this->type_prison_id       =$prison->type_prison_id;
        $this->output_type_id       =$prison->output_type_id;
        $this->prisoner_id          =$prison->prisoner_id;
        // abre o modal
        $this->openModalPrisonUpdate = $prison->id;
    }

    public function prisonUpdate()
    {
        $prison_update = Prison::find($this->prisonUpdate_id);
        $dataValidated = $this->validate(
            [
                'prison_unit_id'        =>'required|max:10',
                'entry_date'            =>'required|min:10|max:10',
                'exit_date'             =>'nullable|min:10|max:10',
                'sentence'              =>'max:100',
                'exit_forecast'         =>'nullable|min:10|max:10',
                'sentence_certificate'  =>'nullable|min:10|max:10',
                'remarks'               =>'nullable',
                'user_update'           =>'required|max:10',
                'prison_origin_id'      =>'required|max:10',
                'type_prison_id'        =>'required|max:10',
                'output_type_id'        =>'nullable|max:10',
            ]
        );
        // corrige o erro quando a data de saída for apagada
        $exit_date = $dataValidated['exit_date'] ?: null;
        $dataValidated['exit_date'] = $exit_date;
        $exit_forecast = $dataValidated['exit_forecast'] ?: null;
        $dataValidated['exit_forecast'] = $exit_forecast;
        $sentence_certificate = $dataValidated['sentence_certificate'] ?: null;
        $dataValidated['sentence_certificate'] = $sentence_certificate;
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // Atualiza os dados no banco
        $prison_update->update($dataValidated);
        $this->clearFields();
        $this->closeModal();
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPrisonDelete = false;
    public function modalPrisonDelete($prison_id)
    {
        $this->openModalPrisonDelete = $prison_id;
    }
    // DELETE
    public function prisonDelete(Prison $prison)
    {
        $prison->delete();
        $this->clearFields();
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.main.prison.prison-livewire', [
            'prisons' => Prison::where('prisoner_id', $this->prisoner_id)->orderBy('entry_date', 'desc')->paginate(10)
        ]);
    }

    // PRISON DOCUMENT
    use WithFileUploads;
    public $document;
    public $title = '';
    public $description = '';
    public $prison_id;
    public $prison;

    // MODAL CREATE
    public $openModalPrisonDocument = false;
    public function modalPrisonDocument($prison_id)
    {
        $this->prison_id = $prison_id;
        $this->openModalPrisonDocument = $prison_id;
    }

    public function prisonDocumentCreate()
    {
        $this->prison_unit_id = Auth::user()->prison_unit_id;
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
    public $openModalPrisonDocumentEdit = false;
    public function modalPrisonDocumentEdit(PrisonDocument $prison_document)
    {
        $this->reset('document', 'title', 'description');
        $this->title = $prison_document->title;
        $this->description = $prison_document->description;
        $this->openModalPrisonDocumentEdit = $prison_document->id;
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
        $this->openModalPrisonDocumentEdit = false;
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
}
