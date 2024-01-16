<?php

namespace App\Livewire\Admin\Ethnicity;

use App\Models\Admin\Ethnicity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Etnia")]
class EthnicityLivewire extends Component
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
        $this->reset('ethnicity', 'userCreate');
        $this->confirmingEthnicityUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $ethnicity;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'ethnicity'         => $this->ethnicity,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'ethnicity'         => 'required|max:100|string|unique:ethnicities,ethnicity',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['ethnicity'] = mb_strtoupper ($dataValidated['ethnicity'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        Ethnicity::create($dataValidated);
        $this->reset('ethnicity');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingEthnicityUpdate = false;
    public function modalEthnicityUpdate(Ethnicity $ethnicity)
    {
        $this->ethnicity  = $ethnicity->ethnicity;
        $this->confirmingEthnicityUpdate = $ethnicity->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateEthnicity(Ethnicity $ethnicity)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'ethnicity'     => $this->ethnicity,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'ethnicity'     => "required|max:100|string|unique:ethnicities,ethnicity,{$ethnicity->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['ethnicity'] = mb_strtoupper ($dataValidated['ethnicity'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $ethnicity->update($dataValidated);//atualiza os dados no banco
        $this->reset('ethnicity');
        $this->confirmingEthnicityUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingEthnicityDeletion = false;
    public function modalEthnicityDeletion($ethnicityID)
    {
        $this->confirmingEthnicityDeletion = $ethnicityID;
    }
    // LEVEL ACCESS DELETE
    public function deleteEthnicity(Ethnicity $ethnicity)
    {
        $ethnicity->delete();
        $this->confirmingEthnicityDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.ethnicity.ethnicity-livewire', [
            'ethnicities' => Ethnicity::orderBy('ethnicity', 'asc')->where('ethnicity', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
