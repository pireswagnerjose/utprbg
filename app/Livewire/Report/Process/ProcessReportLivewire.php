<?php

namespace App\Livewire\Report\Process;

use App\Models\Admin\Process\OriginProcess;
use App\Models\Admin\Process\ProcessRegime;
use App\Models\Main\Process;
use Livewire\Component;
use Livewire\WithPagination;

class ProcessReportLivewire extends Component
{
    use WithPagination;

    public $origin_process_id;
    public $process_regime_id;

    public $origin_processes;
    public $process_regimes;

    public function mount()
    {
        $this->origin_processes = OriginProcess::all();
        $this->process_regimes = ProcessRegime::all();
    }

    public function clearFieldes()
    {
        $this->reset('origin_process_id', 'process_regime_id');
        $this->resetPage();
        $this->redirectRoute('infopen.processes', navigate: true);
    }

    public function search()
    {
        $data = Process::select('processes.*', 'prisoners.*')
            ->join('prisoners','processes.prisoner_id','=','prisoners.id')
            ->orderBy('prisoners.name','asc');

        // origem do processo
        if($this->origin_process_id ) {
            $data = $data->where('origin_process_id', $this->origin_process_id);
        }

        // regime do processo
        if($this->process_regime_id ) {
            $data = $data->where('process_regime_id', $this->process_regime_id);
        }
        
        $data = $data->paginate(10);
        return $data;
    }

    public function render()
    {
        $processes = $this->search();
        return view('livewire.report.process.process-report-livewire', compact('processes'));
    }
}
