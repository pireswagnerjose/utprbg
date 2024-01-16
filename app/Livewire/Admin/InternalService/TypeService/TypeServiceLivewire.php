<?php

namespace App\Livewire\Admin\InternalService\TypeService;

use App\Models\Admin\InternalService\TypeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipos de Atendimento")]
class TypeServiceLivewire extends Component
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
        $this->reset('typeService', 'userCreate');
        $this->confirmingTypeServiceUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $typeService;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'type_service'      => $this->typeService,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'type_service'      => 'required|max:100|string|unique:type_services,type_service',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['type_service'] = mb_strtoupper ($dataValidated['type_service'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        TypeService::create($dataValidated);
        $this->reset('typeService');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingTypeServiceUpdate = false;
    public function modalTypeServiceUpdate(TypeService $typeService)
    {
        $this->typeService  = $typeService->type_service;
        $this->confirmingTypeServiceUpdate = $typeService->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateTypeService(TypeService $typeService)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'type_service'  => $this->typeService,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'type_service'  => "required|max:100|string|unique:type_services,type_service,{$typeService->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['type_service'] = mb_strtoupper ($dataValidated['type_service'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $typeService->update($dataValidated);//atualiza os dados no banco
        $this->reset('typeService');
        $this->confirmingTypeServiceUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingTypeServiceDeletion = false;
    public function modalTypeServiceDeletion($typeServiceID)
    {
        $this->confirmingTypeServiceDeletion = $typeServiceID;
    }
    // LEVEL ACCESS DELETE
    public function deleteTypeService(TypeService $typeService)
    {
        $typeService->delete();
        $this->confirmingTypeServiceDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.internal-service.type-service.type-service-livewire', [
            'typeServices' => TypeService::orderBy('type_service', 'asc')->where('type_service', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
