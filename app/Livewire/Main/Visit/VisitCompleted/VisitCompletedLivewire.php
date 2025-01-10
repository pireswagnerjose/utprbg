<?php

namespace App\Livewire\Main\Visit\VisitCompleted;

use App\Models\Main\Visit\VisitScheduling;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.guest")]
class VisitCompletedLivewire extends Component
{
    public $visit_completed_id;
    public function render()
    {
        $visit_completed = VisitScheduling::where('id', $this->visit_completed_id)->get()->first();
        return view('livewire.main.visit.visit-completed.visit-completed-livewire',
        compact('visit_completed')
        );
    }
}
