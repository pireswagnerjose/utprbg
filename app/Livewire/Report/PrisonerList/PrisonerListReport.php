<?php

namespace App\Livewire\Report\PrisonerList;

use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Ward;
use App\Models\Main\UnitAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrisonerListReport extends Component
{
    public $status_prisons;
    public $unit_address;
    public $wards;

    public function mount()
    {
        $this->status_prisons = StatusPrison::all();
        $this->wards = Ward::all();
    }
    public function render()
    {
        return view('livewire.report.prisoner-list.prisoner-list-report');
    }
}
