<?php

namespace App\Livewire\Admin\ExternalOutput\ExitReason;

use App\Models\Admin\ExternalOutput\ExitReason;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Motivo da Saída")]
class ExitReasonLivewire extends Component
{
    use WithPagination;
    
    // CLASS ACESSORIES
    public int $userCreate;
    public int $userUpdate;
    public $userPrisonUnitID;
    public function mount()
    {
        $this->userPrisonUnitID = Auth::user()->prison_unit_id;
        $this->userCreate = Auth::user()->id;
        $this->userUpdate = Auth::user()->id;
    }

    // SEARCH - PESQUISA
    #[Url]
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //ADD NEW - ADICIONAR NOVO 
    public $add_new;
    public function addNew()
    {
        $this->add_new = true;
    }
    public function cancel()
    {
        $this->add_new = false;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('exitReason', 'userCreate');
        $this->confirmingExitReasonUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $exitReason;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'exit_reason'       => $this->exitReason,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'exit_reason'       => 'required|max:100|string|unique:exit_reasons,exit_reason',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['exit_reason'] = mb_strtoupper ($dataValidated['exit_reason'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        ExitReason::create($dataValidated);
        $this->reset('exitReason');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingExitReasonUpdate = false;
    public function modalExitReasonUpdate(ExitReason $exitReason)
    {
        $this->exitReason  = $exitReason->exit_reason;
        $this->confirmingExitReasonUpdate = $exitReason->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateExitReason(ExitReason $exitReason)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'exit_reason'   => $this->exitReason,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'exit_reason'   => "required|max:100|string|unique:exit_reasons,exit_reason,{$exitReason->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['exit_reason'] = mb_strtoupper ($dataValidated['exit_reason'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $exitReason->update($dataValidated);//atualiza os dados no banco
        $this->reset('exitReason');
        $this->confirmingExitReasonUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingExitReasonDeletion = false;
    public function modalExitReasonDeletion($exitReasonID)
    {
        $this->confirmingExitReasonDeletion = $exitReasonID;
    }
    // LEVEL ACCESS DELETE
    public function deleteExitReason(ExitReason $exitReason)
    {
        $exitReason->delete();
        $this->confirmingExitReasonDeletion = false;
    }
    public function render()
    {
        
        return view('livewire.admin.external-output.exit-reason.exit-reason-livewire', [
            'exitReasons' => ExitReason::orderBy('exit_reason', 'asc')->where('exit_reason', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
