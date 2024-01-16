<?php

namespace App\Livewire\Admin\PrisonUnit;

use App\Models\Admin\PrisonUnit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Layout("layouts.app")]
#[Title("Unidade Prisional")]
class PrisonUnitLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $userCreate;
    public int $userUpdate;
    public function mount()
    {
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

    //CREATE NEW - CRIAR NOVO
    public $prisonUnit;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'prison_unit'  => $this->prisonUnit,
                'user_create'   => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'prison_unit'  => 'max:100|string',
                'user_create'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['prison_unit'] = mb_strtoupper ($dataValidated['prison_unit'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        PrisonUnit::create($dataValidated);
        $this->reset('prisonUnit', 'userCreate');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingPrisonUnitUpdate = false;
    public function modalPrisonUnitUpdate(PrisonUnit $prisonUnit)
    {
        $this->prisonUnit  = $prisonUnit->prison_unit;
        $this->confirmingPrisonUnitUpdate = $prisonUnit->id;
    }

    // LEVEL ACCESS UPDATE
    public function updatePrisonUnit(PrisonUnit $prisonUnit)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'prison_unit'   => $this->prisonUnit,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'prison_unit'  => 'max:100|string',
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['prison_unit'] = mb_strtoupper ($dataValidated['prison_unit'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $prisonUnit->update($dataValidated);//atualiza os dados no banco
        $this->reset('prisonUnit', 'userCreate');
        $this->confirmingPrisonUnitUpdate = false;
    }

    // MODAL DELETE
    public $confirmingPrisonUnitDeletion = false;
    public function modalPrisonUnitDeletion($prisonUnitID)
    {
        $this->confirmingPrisonUnitDeletion = $prisonUnitID;
    }
    // LEVEL ACCESS DELETE
    public function deletePrisonUnit(PrisonUnit $prisonUnit)
    {
        $prisonUnit->delete();
        $this->confirmingPrisonUnitDeletion = false;
    }

    public function render()
    {
        return view('livewire.admin.prison-unit.prison-unit-livewire', [
            'prisonUnits' => PrisonUnit::latest()->where('prison_unit', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
