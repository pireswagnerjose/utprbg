<?php

namespace App\Livewire\Report\LegalAssistance;

use App\Models\Admin\LegalAssistance\TypeCare;
use App\Models\Main\LegalAssistance;
use Livewire\Component;
use Livewire\WithPagination;

class LegalAssistanceReport extends Component
{
    use WithPagination;
    public $start_date = '';
    public $end_date = '';
    public $status = '';
    public $type_care_id = '';

    public $type_cares = [];

    public  function mount()
    {
        $this->type_cares = TypeCare::all();
    }

    public function search()
    {
        $legal_assistances = LegalAssistance::with('prisoner', 'type_care')->orderBy('date', 'asc')
            ->where('type_care_id', 'like', "%{$this->type_care_id}%")
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $legal_assistances = $legal_assistances->where('date', '>=', $this->start_date);
            $legal_assistances = $legal_assistances->where('date', '<=', $this->end_date);
        }

        $legal_assistances = $legal_assistances->paginate(10);
        
        return $legal_assistances;
    }

    public function render()
    {
        $legal_assistances = $this->search();
        return view('livewire.report.legal-assistance.legal-assistance-report', compact('legal_assistances'));
    }
}
