<?php

namespace App\Livewire\Main\Visitant;

use App\Models\Main\Visitant;
use Livewire\Component;

class VisitantShowLivewire extends Component
{
    public $visitant_id;
    public function render()
    {
        return view('livewire.main.visitant.visitant-show-livewire', [
            'visitant' => Visitant::where('id', $this->visitant_id)->first()
        ]);
    }
}
