<?php

namespace App\Livewire\Admin\Prison\OutputType;

use App\Models\Admin\Prison\OutputType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipo de Saída")]
class OutputTypeLivewire extends Component
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
        $this->reset('outputType', 'userCreate');
        $this->confirmingOutputTypeUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $outputType;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'output_type'       => $this->outputType,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'output_type'       => 'required|max:100|string|unique:output_types,output_type',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['output_type'] = mb_strtoupper ($dataValidated['output_type'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        OutputType::create($dataValidated);
        $this->reset('outputType');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingOutputTypeUpdate = false;
    public function modalOutputTypeUpdate(OutputType $outputType)
    {
        $this->outputType  = $outputType->output_type;
        $this->confirmingOutputTypeUpdate = $outputType->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateOutputType(OutputType $outputType)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'output_type'   => $this->outputType,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'output_type'   => "required|max:100|string|unique:output_types,output_type,{$outputType->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['output_type'] = mb_strtoupper ($dataValidated['output_type'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $outputType->update($dataValidated);//atualiza os dados no banco
        $this->reset('outputType');
        $this->confirmingOutputTypeUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingOutputTypeDeletion = false;
    public function modalOutputTypeDeletion($outputTypeID)
    {
        $this->confirmingOutputTypeDeletion = $outputTypeID;
    }
    // LEVEL ACCESS DELETE
    public function deleteOutputType(OutputType $outputType)
    {
        $outputType->delete();
        $this->confirmingOutputTypeDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.prison.output-type.output-type-livewire', [
            'outputTypes' => OutputType::orderBy('output_type', 'asc')->where('output_type', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
