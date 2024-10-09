<?php

namespace App\Livewire\Main\Process;

use App\Models\Admin\Process\OriginProcess;
use App\Models\Admin\Process\ProcessRegime;
use App\Models\Main\Process;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;


class ProcessLivewire extends Component
{
    use WithPagination;

    #[Reactive]
    public $prisoner_id;

    // DATA
    public $date_arrest;
    public $date_exit;
    public $judicial_district_origin = '';
    public $eproc = '';
    public $seeu = '';
    public $pje = '';
    public $apf = '';
    public $remark = '';
    public $user_create = '';
    public $user_update = '';
    public $prison_unit_id = '';
    public $origin_process_id;
    public $process_regime_id;
    public $origin_processes;
    public $process_regimes;

    public function mount()
    {
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->origin_processes = OriginProcess::all();
        $this->process_regimes  = ProcessRegime::all();
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalProcessCreate = false;
        $this->openModalProcessUpdate = false;
        $this->openModalProcessDelete = false;
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('date_arrest','date_exit','judicial_district_origin','eproc','seeu','pje','apf','remark','origin_process_id','process_regime_id');
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['judicial_district_origin'] = mb_strtoupper ($dataValidated['judicial_district_origin'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE NEW
    public $openModalProcessCreate = false;
    public function modalProcessCreate()
    {
        $this->clearFields();
        $this->openModalProcessCreate = true;
    }

    public function processCreate()
    {
        $dataValidated = $this->validate(
            [
                'date_arrest'               =>'nullable|min:10|max:10',
                'date_exit'                 =>'nullable|min:10|max:10',
                'judicial_district_origin'  =>'max:255',
                'eproc'                     =>'nullable|min:24|max:24',
                'seeu'                      =>'nullable|min:25|max:25',
                'pje'                       =>'nullable|min:24|max:24',
                'apf'                       =>'nullable|min:25|max:25',
                'remark'                    =>'',
                'origin_process_id'         =>'required|max:10',
                'process_regime_id'         =>'required|max:10',
                'user_create'               =>'max:10',
                'prison_unit_id'            =>'required|max:10',
                'prisoner_id'               =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // Grava os dados no banco
        Process::create($dataValidated);
        $this->openModalProcessCreate = false;
        $this->clearFields();
    }

    // MODAL UPDATE
    public $openModalProcessUpdate = false;
    public $processUpdate_id;
    public function modalProcessUpdate(Process $process)
    {
        $this->processUpdate_id = $process->id;
        // seta os valores para serem atualizados
        $this->date_arrest              = $process->date_arrest; 
        $this->date_exit                = $process->date_exit;
        $this->judicial_district_origin = $process->judicial_district_origin;
        $this->eproc                    = $process->eproc;
        $this->seeu                     = $process->seeu;
        $this->pje                      = $process->pje;
        $this->apf                      = $process->apf;
        $this->remark                   = $process->remark;
        $this->origin_process_id        = $process->origin_process_id;
        $this->process_regime_id        = $process->process_regime_id;
        $this->openModalProcessUpdate      = true;
    }
    
    // UPDATE
    public function processUpdate()
    {
        $process_update = process::find($this->processUpdate_id);
        $dataValidated = $this->validate(
            [
                'date_arrest'               =>'nullable|min:10|max:10',
                'date_exit'                 =>'nullable|min:10|max:10',
                'judicial_district_origin'  =>'max:255',
                'eproc'                     =>'nullable|min:24|max:24',
                'seeu'                      =>'nullable|min:25|max:25',
                'pje'                       =>'nullable|min:24|max:24',
                'apf'                       =>'nullable|min:25|max:25',
                'remark'                    =>'nullable|',
                'origin_process_id'         =>'required|max:10',
                'process_regime_id'         =>'required|max:10',
                'user_update'               =>'max:10',
            ]
        );
        // corrige o erro quando a data de saída for apagada
        $date_exit = $dataValidated['date_exit'] ?: null;
        $dataValidated['date_exit'] = $date_exit;
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // Atualiza os dados no banco
        $process_update->update($dataValidated);
        $this->clearFields();
        $this->closeModal();
    }

    // MODAL DELETE
    public $openModalProcessDelete = false;
    public function modalProcessDelete($process_id)
    {
        $this->openModalProcessDelete = $process_id;
    }

    // DELETE
    public function processDelete(Process $process)
    {
        $process->delete();
        $this->clearFields();
        $this->closeModal();
    }
    
    // ATUALIZA A PÁGINA
    #[On('process::ProcessLivewire::refresh')]
    public function render()
    {
        return view('livewire.main.process.process-livewire', [
            'processes' => Process::where('prisoner_id', $this->prisoner_id)
                ->with('origin_process',  'process_regime')
                ->orderBy('date_arrest', 'desc')
                ->paginate(10)
        ]);
    }
}
