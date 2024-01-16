<?php

namespace App\Livewire\Admin\Prison\TypePrison;

use App\Models\Admin\Prison\TypePrison;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipo da Prisão")]
class TypePrisonLivewire extends Component
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
        $this->reset('typePrison', 'userCreate');
        $this->confirmingTypePrisonUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $typePrison;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'type_prison'       => $this->typePrison,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'type_prison'       => 'required|max:100|string|unique:type_prisons,type_prison',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
            [
                'type_prison.unique'=> 'Já exite um item com esse nome',
            ]
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['type_prison'] = mb_strtoupper ($dataValidated['type_prison'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        TypePrison::create($dataValidated);
        $this->reset('typePrison');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingTypePrisonUpdate = false;
    public function modalTypePrisonUpdate(TypePrison $typePrison)
    {
        $this->typePrison  = $typePrison->type_prison;
        $this->confirmingTypePrisonUpdate = $typePrison->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateTypePrison(TypePrison $typePrison)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'type_prison'   => $this->typePrison,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'type_prison'   => "required|max:100|string|unique:type_prisons,type_prison,{$typePrison->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
            [
                'type_prison.unique'=> 'Já exite um item com esse nome',
            ]
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['type_prison'] = mb_strtoupper ($dataValidated['type_prison'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $typePrison->update($dataValidated);//atualiza os dados no banco
        $this->reset('typePrison');
        $this->confirmingTypePrisonUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingTypePrisonDeletion = false;
    public function modalTypePrisonDeletion($typePrisonID)
    {
        $this->confirmingTypePrisonDeletion = $typePrisonID;
    }
    // LEVEL ACCESS DELETE
    public function deleteTypePrison(TypePrison $typePrison)
    {
        $typePrison->delete();
        $this->confirmingTypePrisonDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.prison.type-prison.type-prison-livewire', [
            'typePrisons' => TypePrison::orderBy('type_prison', 'asc')->where('type_prison', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
