<?php

namespace App\Livewire\Admin\State;

use App\Models\Admin\State;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Estado")]
class StateLivewire extends Component
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
        $this->reset('state', 'userCreate');
        $this->confirmingStateUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $state;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'state'             => $this->state,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'state'             => 'required|max:100|string|unique:states,state',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['state'] = mb_strtoupper ($dataValidated['state'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        State::create($dataValidated);
        $this->reset('state');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingStateUpdate = false;
    public function modalStateUpdate(State $state)
    {
        $this->state  = $state->state;
        $this->confirmingStateUpdate = $state->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateState(State $state)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'state'         => $this->state,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'state'         => "required|max:100|string|unique:states,state,{$state->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['state'] = mb_strtoupper ($dataValidated['state'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $state->update($dataValidated);//atualiza os dados no banco
        $this->reset('state');
        $this->confirmingStateUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingStateDeletion = false;
    public function modalStateDeletion($stateID)
    {
        $this->confirmingStateDeletion = $stateID;
    }
    // DELETE
    public function deleteState(State $state)
    {
        $state->delete();
        $this->confirmingStateDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.state.state-livewire', [
            'states' => State::orderBy('state', 'asc')->where('state', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
