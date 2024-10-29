<?php

namespace App\Livewire\Main\LegalAssistance;

use Livewire\Component;

class LegalAssistanceLivewire extends Component
{
    public $prisoner_id;

    public function render()
    {
        return view('livewire.main.legal-assistance.legal-assistance-livewire');
    }
}
