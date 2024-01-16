<?php

namespace App\Livewire\Admin\Sex;

use App\Models\Admin\Sex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Sexo")]
class SexLivewire extends Component
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
        $this->reset('sex', 'userCreate');
        $this->confirmingSexUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $sex;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'sex'               => $this->sex,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'sex'               => 'required|max:100|string|unique:sexes,sex',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['sex'] = mb_strtoupper ($dataValidated['sex'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        Sex::create($dataValidated);
        $this->reset('sex');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingSexUpdate = false;
    public function modalSexUpdate(Sex $sex)
    {
        $this->sex  = $sex->sex;
        $this->confirmingSexUpdate = $sex->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateSex(Sex $sex)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'sex'           => $this->sex,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'sex'           => "required|max:100|string|unique:sexes,sex,{$sex->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['sex'] = mb_strtoupper ($dataValidated['sex'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $sex->update($dataValidated);//atualiza os dados no banco
        $this->reset('sex');
        $this->confirmingSexUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingSexDeletion = false;
    public function modalSexDeletion($sexID)
    {
        $this->confirmingSexDeletion = $sexID;
    }
    // LEVEL ACCESS DELETE
    public function deleteSex(Sex $sex)
    {
        $sex->delete();
        $this->confirmingSexDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.sex.sex-livewire', [
            'sexes' => Sex::orderBy('sex', 'asc')->where('sex', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
