<?php

namespace App\Livewire\Main\Process;

use App\Models\Admin\Process\PenalType;
use App\Models\Main\PenalTypeProcess;
use App\Models\Main\Process;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class ProcessPenalTypeLivewire extends Component
{
    use WithPagination;

    #[Reactive]
    public $process_id;
    public $prisoner_id;
    public $user_create = '';
    public $user_update = '';
    public $prison_unit_id = '';
    public $process;

    // SEARCH - PESQUISA
    public $search;

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->process          = Process::find($this->process_id);
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function closeModal()
    {
        $this->openModalProcessPenealTypeDelete = false;
    }

    //ADD NEW - ADICIONAR NOVO 
    public $add_new = false;
    public function addNew()
    {
        $this->add_new = true;
    }
    public function cancel()
    {
        $this->add_new = false;
        $this->reset('search');
    }

    // CREATE

    public function processPenealTypeCreate(PenalType $penal_type)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'user_create'       => $this->user_create,
                'process_id'        => $this->process_id,
                'penal_type_id'     => $penal_type->id,
                'prisoner_id'       => $this->prisoner_id,
                'prison_unit_id'    => $this->prison_unit_id,
            ],
            // Validation rules to apply...
            [
                'user_create'       =>'required|max:10',
                'process_id'        =>'required|max:10',
                'penal_type_id'     =>'required|max:10',
                'prisoner_id'       =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
            ],
        )->validate();
        PenalTypeProcess::create($dataValidated);
        $this->add_new = false;
        $this->resetPage();
        $this->reset('search');
    }

    // MODAL DELETE
    public $openModalProcessPenealTypeDelete = false;
    public function modalProcessPenealTypeDelete($penal_type_process_id)
    {
        $this->openModalProcessPenealTypeDelete = $penal_type_process_id;
    }
    public function processPenalTypeDelete($penal_type_process_id)
    {
        $penal_type_process = PenalTypeProcess::findOrFail($penal_type_process_id);
        $penal_type_process->delete();
    
        $this->closeModal();
    }
    
    public $penal_type_processes;
    public function render()
    {
        $this->penal_type_processes = PenalTypeProcess::where('process_id', $this->process_id)->get();
        return view('livewire.main.process.process-penal-type-livewire', [
            'penal_types' => PenalType::orderBy('created_at', 'asc')
                ->where('law', 'like', "%{$this->search}%")
                ->orWhere('article', 'like', "%{$this->search}%")
                ->orWhere('paragraph', 'like', "%{$this->search}%")
                ->orWhere('item', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%")
                ->paginate(5)
        ]);
    }
}
