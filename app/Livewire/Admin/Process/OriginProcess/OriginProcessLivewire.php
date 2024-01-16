<?php

namespace App\Livewire\Admin\Process\OriginProcess;

use App\Models\Admin\Process\OriginProcess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Origem do Processo")]
class OriginProcessLivewire extends Component
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
        $this->reset('originProcess');
        $this->confirmingOriginProcessUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $originProcess;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'origin_process'    => $this->originProcess,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'origin_process'    => 'required|max:100|string|unique:origin_processes,origin_process',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['origin_process'] = mb_strtoupper ($dataValidated['origin_process'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        OriginProcess::create($dataValidated);
        $this->reset('originProcess');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingOriginProcessUpdate = false;
    public function modalOriginProcessUpdate(OriginProcess $originProcess)
    {
        $this->originProcess  = $originProcess->origin_process;
        $this->confirmingOriginProcessUpdate = $originProcess->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateOriginProcess(OriginProcess $originProcess)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'origin_process'    => $this->originProcess,
                'user_update'       => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'origin_process'    => "required|max:100|string|unique:origin_processes,origin_process,{$originProcess->id},id",//unico (usa o id da table pra validadar)
                'user_update'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['origin_process'] = mb_strtoupper ($dataValidated['origin_process'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $originProcess->update($dataValidated);//atualiza os dados no banco
        $this->reset('originProcess');
        $this->confirmingOriginProcessUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingOriginProcessDeletion = false;
    public function modalOriginProcessDeletion($originProcessID)
    {
        $this->confirmingOriginProcessDeletion = $originProcessID;
    }
    // LEVEL ACCESS DELETE
    public function deleteOriginProcess(OriginProcess $originProcess)
    {
        $originProcess->delete();
        $this->confirmingOriginProcessDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.process.origin-process.origin-process-livewire', [
            'originProcesses' => OriginProcess::orderBy('origin_process', 'asc')->where('origin_process', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
