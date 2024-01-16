<?php

namespace App\Livewire\Admin\ExternalOutput\Requesting;

use App\Models\Admin\ExternalOutput\Requesting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Requisitante")]
class RequestingLivewire extends Component
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
        $this->reset('requesting', 'userCreate');
        $this->confirmingRequestingUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $requesting;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'requesting'        => $this->requesting,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'requesting'        => 'required|max:100|string|unique:requestings,requesting',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['requesting'] = mb_strtoupper ($dataValidated['requesting'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        Requesting::create($dataValidated);
        $this->reset('requesting');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingRequestingUpdate = false;
    public function modalRequestingUpdate(Requesting $requesting)
    {
        $this->requesting  = $requesting->requesting;
        $this->confirmingRequestingUpdate = $requesting->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateRequesting(Requesting $requesting)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'requesting'    => $this->requesting,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'requesting'    => "required|max:100|string|unique:requestings,requesting,{$requesting->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['requesting'] = mb_strtoupper ($dataValidated['requesting'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $requesting->update($dataValidated);//atualiza os dados no banco
        $this->reset('requesting');
        $this->confirmingRequestingUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingRequestingDeletion = false;
    public function modalRequestingDeletion($requestingID)
    {
        $this->confirmingRequestingDeletion = $requestingID;
    }
    // LEVEL ACCESS DELETE
    public function deleteRequesting(Requesting $requesting)
    {
        $requesting->delete();
        $this->confirmingRequestingDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.external-output.requesting.requesting-livewire', [
            'requestings' => Requesting::orderBy('requesting', 'asc')->where('requesting', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
