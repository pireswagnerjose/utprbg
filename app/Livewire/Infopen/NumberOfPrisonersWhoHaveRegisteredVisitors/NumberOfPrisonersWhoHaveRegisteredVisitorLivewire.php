<?php

namespace App\Livewire\Infopen\NumberOfPrisonersWhoHaveRegisteredVisitors;

use App\Models\Main\IdentificationCard;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use Livewire\Component;
use Livewire\WithPagination;

class NumberOfPrisonersWhoHaveRegisteredVisitorLivewire extends Component
{
  use WithPagination;
  public $date;

  public function clearFields()
  {
    $this->reset('date');
    $this->resetPage();
    $this->redirectRoute('infopen-number-of-prisoners-who-have-registered-visitor', navigate: true);
  }

  public function getPrisoners()
  {
    $identification_cards = IdentificationCard::orderBy('date_of_creation', 'asc');

    if ($this->date) {
      $prisons = Prison::where('exit_date', ">=", $this->date)->orWhere('exit_date', null)
        ->where('entry_date', "<=", $this->date)->get();
      $prisons_id = $prisons->pluck('prisoner_id')->toArray();
      $identification_cards = $identification_cards->whereIn('prisoner_id', $prisons_id);
    }

    $identification_cards = $identification_cards->get();
    $prisoner_id = $identification_cards->pluck('prisoner_id')->toArray();
    return $prisoners = Prisoner::whereIn('id', $prisoner_id)->paginate(12);
  }
  public function render()
  {
    $prisoners = $this->getPrisoners();
    return view('livewire.infopen.number-of-prisoners-who-have-registered-visitors.number-of-prisoners-who-have-registered-visitor-livewire', compact('prisoners'));
  }
}
