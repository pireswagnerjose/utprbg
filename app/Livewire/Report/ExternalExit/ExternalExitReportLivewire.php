<?php

namespace App\Livewire\Report\ExternalExit;

use App\Models\Admin\ExternalOutput\Requesting;
use App\Models\Main\ExternalExit;
use Livewire\Component;
use Livewire\WithPagination;

class ExternalExitReportLivewire extends Component
{
    use WithPagination;
    public $start_date = '';
    public $end_date = '';
    public $status = '';
    public $requesting_id = '';

    public $requestings = [];

    public  function mount()
    {
        $this->requestings = Requesting::all();
    }

    public function search()
    {
        $external_exits = ExternalExit::with('prisoner', 'requesting', 'municipality', 'state')->orderBy('event_date', 'asc')
            ->where('requesting_id', 'like', "%{$this->requesting_id}%")
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $external_exits = $external_exits->where('event_date', '>=', $this->start_date);
            $external_exits = $external_exits->where('event_date', '<=', $this->end_date);
        }

        $external_exits = $external_exits->paginate(10);
        
        return $external_exits;
    }

    public function render()
    {
        $external_exits = $this->search();
        return view('livewire.report.external-exit.external-exit-report-livewire', compact('external_exits'));
    }
}
