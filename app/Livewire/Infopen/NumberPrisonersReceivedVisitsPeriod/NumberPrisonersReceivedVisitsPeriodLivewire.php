<?php

namespace App\Livewire\Infopen\NumberPrisonersReceivedVisitsPeriod;

use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Models\Main\Visit\VisitScheduling;
use Livewire\Component;
use Livewire\WithPagination;

class NumberPrisonersReceivedVisitsPeriodLivewire extends Component
{
  use WithPagination;

  public $start_date;
  public $end_date;

  public function clearFieldes()
  {
    $this->reset('start_date', 'end_date');
    $this->resetPage();
    $this->redirectRoute('infopen-number-prisoners-received-visits-period', navigate: true);
  }

  public function getPrisoners()
  {
    $visit_schedulings = VisitScheduling::where('status', true);
    if ($this->start_date && $this->end_date) {
      $visit_schedulings = $visit_schedulings->whereBetween('date_visit', [$this->start_date, $this->end_date]);
    }
    $visit_schedulings = $visit_schedulings->get();

    $prisoner_id = $visit_schedulings->pluck('prisoner_id')->toArray();
    return $prisoners = Prisoner::whereIn('id', $prisoner_id)->paginate(12);
  }
  public function render()
  {
    $prisoners = $this->getPrisoners();
    return view('livewire.infopen.number-prisoners-received-visits-period.number-prisoners-received-visits-period-livewire', compact('prisoners'));
  }
}
