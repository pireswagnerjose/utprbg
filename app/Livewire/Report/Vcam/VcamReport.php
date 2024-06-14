<?php

namespace App\Livewire\Report\Vcam;

use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VcamReport extends Component
{
    public function render()
    {
        return view('livewire.report.vcam.vcam-report');
    }
}
