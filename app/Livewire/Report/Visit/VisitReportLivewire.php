<?php

namespace App\Livewire\Report\Visit;

use App\Models\Main\Visit\VisitScheduling;
use Livewire\Component;
use Livewire\WithPagination;

class VisitReportLivewire extends Component
{
    use WithPagination;
    public $start_date;
    public $end_date;
    public $type;
    public $visit_types = ['SOCIAL','ÍNTIMA'];

    public function clearFieldes()
    {
        $this->reset('type', 'start_date', 'end_date');
        $this->resetPage();
        $this->redirectRoute('visit-report.index', navigate: true);
    }

    public function search()
    {
        $data = VisitScheduling::with('prisoner', 'visitant');

        if($this->type ) {
            $data = $data->whereLike('type', $this->type);
        }
    
        if($this->start_date != null && $this->end_date != null) {
            $data = $data->where('date_visit', '>=', $this->start_date)
                ->where('date_visit', '<=', $this->end_date);
        }

        $data = $data->paginate(10);
        return $data;
    }

    public function render()
    {
        $visit_schedulings = $this->search();
        return view('livewire.report.visit.visit-report-livewire', compact('visit_schedulings'));
    }
}
