<?php

namespace App\Livewire\Main\Visit;

use App\Models\Main\IdentificationCard;
use App\Models\Main\Visit\VisitSchedulingDate;
use Livewire\Attributes\Layout;

use Livewire\Component;

#[Layout("layouts.guest")]
class VisitLivewire extends Component
{
    public $code;
    public $cpf;
    public $start_date;
    public $end_date;
    public $date;
    public $visitant_id;
    public $prisoner_id;
    public $identification_card = [];
    public $visit_scheduling_date = [];
    public $visibleForm = true;

    public function mount()
    {
        $this->visit_scheduling_date = VisitSchedulingDate::orderBy('start_date', 'desc')->first();
        $this->date = date("Y-m-d");
        $this->start_date = $this->visit_scheduling_date['start_date'];
        $this->end_date = $this->visit_scheduling_date['end_date'];
    }

    public function visit()
    {
        $this->identification_card = IdentificationCard::with('visitant', 'prisoner')
            ->where('id', $this->code)->get()->first();
        $this->render();
        $this->visibleForm = false;
    }

    public function render()
    {
        return view('livewire.main.visit.visit-livewire');
    }
}
