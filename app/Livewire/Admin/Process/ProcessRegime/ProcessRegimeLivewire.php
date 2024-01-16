<?php

namespace App\Livewire\Admin\Process\ProcessRegime;

use App\Models\Admin\Process\ProcessRegime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Regime do Processo")]
class ProcessRegimeLivewire extends Component
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
        $this->reset('processRegime', 'userCreate');
        $this->confirmingProcessRegimeUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $processRegime;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'process_regime'    => $this->processRegime,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'process_regime'    => 'required|max:100|string|unique:process_regimes,process_regime',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['process_regime'] = mb_strtoupper ($dataValidated['process_regime'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        ProcessRegime::create($dataValidated);
        $this->reset('processRegime');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingProcessRegimeUpdate = false;
    public function modalProcessRegimeUpdate(ProcessRegime $processRegime)
    {
        $this->processRegime  = $processRegime->process_regime;
        $this->confirmingProcessRegimeUpdate = $processRegime->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateProcessRegime(ProcessRegime $processRegime)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'process_regime'    => $this->processRegime,
                'user_update'       => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'process_regime'    => "required|max:100|string|unique:process_regimes,process_regime,{$processRegime->id},id",//unico (usa o id da table pra validadar)
                'user_update'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['process_regime'] = mb_strtoupper ($dataValidated['process_regime'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $processRegime->update($dataValidated);//atualiza os dados no banco
        $this->reset('processRegime');
        $this->confirmingProcessRegimeUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingProcessRegimeDeletion = false;
    public function modalProcessRegimeDeletion($processRegimeID)
    {
        $this->confirmingProcessRegimeDeletion = $processRegimeID;
    }
    // LEVEL ACCESS DELETE
    public function deleteProcessRegime(ProcessRegime $processRegime)
    {
        $processRegime->delete();
        $this->confirmingProcessRegimeDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.process.process-regime.process-regime-livewire', [
            'processRegimes' => ProcessRegime::orderBy('process_regime', 'asc')->where('process_regime', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
