<?php

namespace App\Livewire\Admin\Prison\StatusPrison;

use App\Models\Admin\Prison\StatusPrison;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Status da Prisão")]
class StatusPrisonLivewire extends Component
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
        $this->reset('statusPrison', 'userCreate');
        $this->confirmingStatusPrisonUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $statusPrison;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'status_prison'     => $this->statusPrison,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'status_prison'     => 'required|max:100|string|unique:status_prisons,status_prison',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['status_prison'] = mb_strtoupper ($dataValidated['status_prison'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        StatusPrison::create($dataValidated);
        $this->reset('statusPrison');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingStatusPrisonUpdate = false;
    public function modalStatusPrisonUpdate(StatusPrison $statusPrison)
    {
        $this->statusPrison  = $statusPrison->status_prison;
        $this->confirmingStatusPrisonUpdate = $statusPrison->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateStatusPrison(StatusPrison $statusPrison)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'status_prison' => $this->statusPrison,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'status_prison' => "required|max:100|string|unique:status_prisons,status_prison,{$statusPrison->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['status_prison'] = mb_strtoupper ($dataValidated['status_prison'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $statusPrison->update($dataValidated);//atualiza os dados no banco
        $this->reset('statusPrison');
        $this->confirmingStatusPrisonUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingStatusPrisonDeletion = false;
    public function modalStatusPrisonDeletion($statusPrisonID)
    {
        $this->confirmingStatusPrisonDeletion = $statusPrisonID;
    }
    // LEVEL ACCESS DELETE
    public function deleteStatusPrison(StatusPrison $statusPrison)
    {
        $statusPrison->delete();
        $this->confirmingStatusPrisonDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.prison.status-prison.status-prison-livewire', [
            'statusPrisons' => StatusPrison::orderBy('status_prison', 'asc')->where('status_prison', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
