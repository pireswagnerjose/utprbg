<?php

namespace App\Livewire\Main\IdentificationCard;

use App\Models\Main\IdentificationCard;
use Livewire\Component;

class IdentificationCardShowLivewire extends Component
{
    public $identification_card_id;
    public function render()
    {
        return view('livewire.main.identification-card.identification-card-show-livewire', [
            'identification_card' => IdentificationCard::where('id', $this->identification_card_id)
                ->with('visitant', 'prisoner', 'degree_of_kinship')
                ->first()
        ]);
    }
}
