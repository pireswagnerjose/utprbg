<?php

namespace App\Livewire\Admin\Prison\PrisonOrigin;

use App\Models\Admin\Prison\PrisonOrigin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Origem da Prisão")]
class PrisonOriginLivewire extends Component
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
        $this->reset('prisonOrigin', 'userCreate');
        $this->confirmingPrisonOriginUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $prisonOrigin;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'prison_origin'     => $this->prisonOrigin,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'prison_origin'     => "required|max:100|string|unique:prison_origins,prison_origin",
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['prison_origin'] = mb_strtoupper ($dataValidated['prison_origin'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        PrisonOrigin::create($dataValidated);
        $this->reset('prisonOrigin');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingPrisonOriginUpdate = false;
    public function modalPrisonOriginUpdate(PrisonOrigin $prisonOrigin)
    {
        $this->prisonOrigin  = $prisonOrigin->prison_origin;
        $this->confirmingPrisonOriginUpdate = $prisonOrigin->id;
    }

    // LEVEL ACCESS UPDATE
    public function updatePrisonOrigin(PrisonOrigin $prisonOrigin)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'prison_origin' => $this->prisonOrigin,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'prison_origin' => "required|max:100|string|unique:prison_origins,prison_origin,{$prisonOrigin->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['prison_origin'] = mb_strtoupper ($dataValidated['prison_origin'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $prisonOrigin->update($dataValidated);//atualiza os dados no banco
        $this->reset('prisonOrigin');
        $this->confirmingPrisonOriginUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingPrisonOriginDeletion = false;
    public function modalPrisonOriginDeletion($prisonOriginID)
    {
        $this->confirmingPrisonOriginDeletion = $prisonOriginID;
    }
    // LEVEL ACCESS DELETE
    public function deletePrisonOrigin(PrisonOrigin $prisonOrigin)
    {
        $prisonOrigin->delete();
        $this->confirmingPrisonOriginDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.prison.prison-origin.prison-origin-livewire', [
            'prisonOrigins' => PrisonOrigin::orderBy('prison_origin', 'asc')->where('prison_origin', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
