<?php

namespace App\Livewire\Admin\Municipality;

use App\Models\Admin\Municipality;
use App\Models\Admin\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Município")]
class MunicipalityLivewire extends Component
{
    use WithPagination;
    
    // CLASS ACESSORIES
    public int $userCreate;
    public int $userUpdate;
    public $userPrisonUnitID;
    public $states;
    public function mount()
    {
        $this->userPrisonUnitID = Auth::user()->prison_unit_id;
        $this->userCreate = Auth::user()->id;
        $this->userUpdate = Auth::user()->id;
        $this->states = State::all();
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
        $this->reset('municipality', 'userCreate');
        $this->confirmingMunicipalityUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $municipality;
    public $stateID;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'municipality'      => $this->municipality,
                'state_id'          => $this->stateID,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'municipality'      => 'required|max:100|string|unique:municipalities,municipality',
                'state_id'          => 'required|max:10',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['municipality'] = mb_strtoupper ($dataValidated['municipality'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        Municipality::create($dataValidated);
        $this->reset('municipality', 'stateID');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingMunicipalityUpdate = false;
    public function modalMunicipalityUpdate(Municipality $municipality)
    {
        $this->municipality  = $municipality->municipality;
        $this->confirmingMunicipalityUpdate = $municipality->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateMunicipality(Municipality $municipality)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'municipality'  => $this->municipality,
                'state_id'      => $this->stateID,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'municipality'  => "required|max:100|string|unique:municipalities,municipality,{$municipality->id},id",//unico (usa o id da table pra validadar)
                'state_id'      => 'required|max:10',
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['municipality'] = mb_strtoupper ($dataValidated['municipality'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $municipality->update($dataValidated);//atualiza os dados no banco
        $this->reset('municipality', 'stateID');
        $this->confirmingMunicipalityUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingMunicipalityDeletion = false;
    public function modalMunicipalityDeletion($municipalityID)
    {
        $this->confirmingMunicipalityDeletion = $municipalityID;
    }
    // LEVEL ACCESS DELETE
    public function deleteMunicipality(Municipality $municipality)
    {
        $municipality->delete();
        $this->confirmingMunicipalityDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.municipality.municipality-livewire', [
            'municipalities' => Municipality::orderBy('municipality', 'asc')->where('municipality', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
