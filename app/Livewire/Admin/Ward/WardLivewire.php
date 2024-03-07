<?php

namespace App\Livewire\Admin\Ward;

use App\Models\Admin\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Ala - Pavilhão")]
class WardLivewire extends Component
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
        $this->reset('ward');
        $this->confirmingWardUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $ward;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'ward'              => $this->ward,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'ward'              => 'required|max:100|string|unique:wards,ward',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['ward'] = mb_strtoupper ($dataValidated['ward'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        Ward::create($dataValidated);
        $this->reset('ward');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingWardUpdate = false;
    public function modalWardUpdate(Ward $ward)
    {
        $this->ward  = $ward->ward;
        $this->confirmingWardUpdate = $ward->id;
    }

    // UPDATE
    public function updateWard(Ward $ward)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'ward'          => $this->ward,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'ward'          => "required|max:100|string|unique:wards,ward,{$ward->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['ward'] = mb_strtoupper ($dataValidated['ward'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $ward->update($dataValidated);//atualiza os dados no banco
        $this->reset('ward');
        $this->confirmingWardUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingWardDeletion = false;
    public function modalWardDeletion($wardID)
    {
        $this->confirmingWardDeletion = $wardID;
    }
    
    // DELETE
    public function deleteWard(Ward $ward)
    {
        $ward->delete();
        $this->confirmingWardDeletion = false;
    }

    public function render()
    {
        return view('livewire.admin.ward.ward-livewire', [
            'wards' => Ward::orderBy('ward', 'asc')
                    ->where('prison_unit_id', $this->userPrisonUnitID)
                    ->where('ward', 'like', "%{$this->search}%")
                    ->paginate(10)
        ]);
    }
}
