<?php

namespace App\Livewire\Admin\CivilStatus;

use App\Models\Admin\CivilStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Estado Civil")]
class CivilStatusLivewire extends Component
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
        $this->reset('civilStatus', 'userCreate');
        $this->confirmingCivilStatusUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $civilStatus;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'civil_status'      => $this->civilStatus,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'civil_status'      => 'required|max:100|string|unique:civil_statuses,civil_status',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['civil_status'] = mb_strtoupper ($dataValidated['civil_status'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        CivilStatus::create($dataValidated);
        $this->reset('civilStatus');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingCivilStatusUpdate = false;
    public function modalStateUpdate(CivilStatus $civilStatus)
    {
        $this->civilStatus  = $civilStatus->civilS_status;
        $this->confirmingCivilStatusUpdate = $civilStatus->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateCivilStatus(CivilStatus $civilStatus)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'civil_status'  => $this->civilStatus,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'civil_status'  => "required|max:100|string|unique:civil_statuses,civil_status,{$civilStatus->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['civilStatus'] = mb_strtoupper ($dataValidated['civilStatus'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $civilStatus->update($dataValidated);//atualiza os dados no banco
        $this->reset('civilStatus');
        $this->confirmingCivilStatusUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingCivilStatusDeletion = false;
    public function modalCivilStatusDeletion($civilStatusID)
    {
        $this->confirmingCivilStatusDeletion = $civilStatusID;
    }
    // LEVEL ACCESS DELETE
    public function deleteState(CivilStatus $civilStatus)
    {
        $civilStatus->delete();
        $this->confirmingCivilStatusDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.civil-status.civil-status-livewire', [
            'civilStatuses' => CivilStatus::orderBy('civil_status', 'asc')->where('civil_status', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
