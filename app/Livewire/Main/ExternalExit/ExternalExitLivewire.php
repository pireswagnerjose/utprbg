<?php

namespace App\Livewire\Main\ExternalExit;

use App\Models\Admin\ExternalOutput\ExitReason;
use App\Models\Admin\ExternalOutput\Requesting;
use App\Models\Admin\Municipality;
use App\Models\Admin\State;
use App\Models\Main\ExternalExit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ExternalExitLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $event_date;
    public $event_time;
    public $departure_date;
    public $departure_time;
    public $arrival_date;
    public $arrival_time;
    public $status;
    public $document;
    public $remark;
    public $state_id;
    public $municipality_id;
    public $requesting_id;
    public $exit_reason_id;
    public $states = [];
    public $municipalities = [];
    public $requestings = [];
    public $exit_reasons = [];

    public $openModalDocumentDelete = false;

    public $statuses = ['MANTIDO', 'CANCELADO'];

    public function mount()
    {
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->states           = State::all();
        $this->requestings      = Requesting::all();
        $this->exit_reasons     = ExitReason::all();
    }
    // Seleciona o município conforme o estado escolhido
    public function selectMunicipality()
    {
        $this->municipalities = Municipality::where('state_id', $this->state_id)->get();
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset(
            'event_date', 'event_time', 'departure_date', 'departure_time',
            'arrival_date', 'arrival_time', 'status', 'document', 'remark', 'state_id',
            'municipality_id', 'requesting_id','exit_reason_id');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalExternalExitCreate = false;
        $this->openModalExternalExitUpdate = false;
        $this->openModalExternalExitDelete = false;
        $this->openModalDocumentDelete = false;
        $this->clearFields();
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalExternalExitCreate = false;
    public function modalExternalExitCreate()
    {
        $this->openModalExternalExitCreate = true;
    }
    // CREATE
    public function externalExitCreate()
    {
        $dataValidated = $this->validate(
            [
                'document' => [
                    'nullable',
                    File::types(['pdf']),
                ],
                'event_date'        =>'required|max:10',
                'event_time'        =>'required|max:10',
                'departure_date'    =>'nullable|max:10',
                'departure_time'    =>'nullable|max:10',
                'arrival_date'      =>'nullable|max:10',
                'arrival_time'      =>'nullable|max:10',
                'status'            =>'nullable|max:100',
                'remark'            =>'nullable',
                'state_id'          =>'required|max:10',
                'municipality_id'   =>'required|max:10',
                'requesting_id'     =>'required|max:10',
                'exit_reason_id'    =>'required|max:10',
                'user_create'       =>'required|max:10',
                'prisoner_id'       =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
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
            $document = date('d-m-Y_H-m-s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/external_exit', $document);
        }
        // grava os dados no banco
        ExternalExit::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalExternalExitUpdate = false;
    public function modalExternalExitUpdate(ExternalExit $external_exit)
    {
        $this->event_date                   =$external_exit->event_date;
        $this->event_time                   =$external_exit->event_time;
        $this->departure_date               =$external_exit->departure_date;
        $this->departure_time               =$external_exit->departure_time;
        $this->arrival_date                 =$external_exit->arrival_date;
        $this->arrival_time                 =$external_exit->arrival_time;
        $this->status                       =$external_exit->status;
        $this->remark                       =$external_exit->remark;
        $this->state_id                     =$external_exit->state_id;
        $this->municipality_id              =$external_exit->municipality_id;
        $this->prison_unit_id               =$external_exit->prison_unit_id;
        $this->requesting_id                =$external_exit->requesting_id;
        $this->exit_reason_id               =$external_exit->exit_reason_id;
        $this->openModalExternalExitUpdate  =$external_exit->id;
    }
    // UPDATE
    public function externalExitUpdate(ExternalExit $external_exit)
    {
        $dataValidated = $this->validate(
            [
                'event_date'        =>'required|max:10',
                'event_time'        =>'required|max:10',
                'departure_date'    =>'nullable|max:10',
                'departure_time'    =>'nullable|max:10',
                'arrival_date'      =>'nullable|max:10',
                'arrival_time'      =>'nullable|max:10',
                'status'            =>'nullable|max:100',
                'remark'            =>'nullable',
                'state_id'          =>'required|max:10',
                'municipality_id'   =>'required|max:10',
                'requesting_id'     =>'required|max:10',
                'exit_reason_id'    =>'required|max:10',
                'user_update'       =>'required|max:10',
                'prisoner_id'       =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
            ]
        );
        // se ouver documento
        if ($this->document) {
            $pdf = $this->validate([
                'document' => [
                        'nullable',
                        File::types(['pdf']),
                    ],
                ]);
            $dataValidated = array_merge($dataValidated, $pdf);
        }
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        if ($this->document) {
            /* responsável por excluir o documento */
            if (!empty($dataValidated->document)) {
                Storage::disk('public')->delete($dataValidated->document);
            }
            /* cria o nome com a extensão */
            $document = date('d-m-Y_H-m-s') . '.' . $this->document->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['document'] = $this->document->storeAs('prisoner/'. $this->prisoner_id .'/documents/external_exit', $document);
        }
        // se as datas forem atualizadas com valores vazios
        if ($dataValidated['departure_date'] == '') {
            $dataValidated['departure_date'] = null;
        }
        if ($dataValidated['arrival_date'] == '') {
            $dataValidated['arrival_date'] = null;
        }
        // grava os dados no banco
        $external_exit->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalExternalExitDelete = false;
    public function modalExternalExitDelete($external_exit_id)
    {
        $this->openModalExternalExitDelete = $external_exit_id;
    }
    // DELETE
    public function externalExitDelete(ExternalExit $external_exit)
    {
        /* responsável por excluir o documento */
        if (!empty($external_exit->document)) {
            Storage::disk('public')->delete($external_exit->document);
        }
        $external_exit->delete();
        $this->closeModal();
    }
    
    public function render()
    {
        return view('livewire.main.external-exit.external-exit-livewire', [
            'external_exits' => ExternalExit::where('prisoner_id', $this->prisoner_id)
                ->orderBy('id','desc')
                ->paginate(6),
        ]);
    }

    /**
     * abre o modal para confirmação da exclusão do documento da saída externa
     * @param mixed $external_exit_id
     * @return void
     */
    public function modalDocumentDelete($external_exit_id)
    {
        $this->openModalDocumentDelete = $external_exit_id;
    }

    /**
     * exclui o documento da saída externa
     * @param \App\Models\Main\ExternalExit $external_exit
     * @return void
     */
    public function documentDelete(ExternalExit $external_exit)
    {
        Storage::disk('public')->delete($external_exit->document);
        $external_exit['document'] = '';
        $external_exit->update($external_exit->toArray());
        $this->closeModal();
    }
}
