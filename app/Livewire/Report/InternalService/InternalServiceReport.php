<?php

namespace App\Livewire\Report\InternalService;

use App\Models\Admin\InternalService\TypeService;
use App\Models\Main\InternalService;
use Livewire\Component;
use Livewire\WithPagination;

class InternalServiceReport extends Component
{
    use WithPagination;
    public $start_date = '';
    public $end_date = '';
    public $status = '';
    public $type_service_id = '';

    public $type_services = [];

    public  function mount()
    {
        $this->type_services = TypeService::all();
    }

    public function search()
    {
        $internal_services = InternalService::with('prisoner', 'type_service')->orderBy('date', 'asc')
            ->where('type_service_id', 'like', "%{$this->type_service_id}%")
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $internal_services = $internal_services->where('date', '>=', $this->start_date);
            $internal_services = $internal_services->where('date', '<=', $this->end_date);
        }

        $internal_services = $internal_services->paginate(10);
        
        return $internal_services;
    }

    public function render()
    {
        $internal_services = $this->search();
        return view('livewire.report.internal-service.internal-service-report', compact('internal_services'));
    }
}
