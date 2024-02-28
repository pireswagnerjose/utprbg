<?php

namespace App\Livewire\Forms;

use App\Models\Main\Photo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PhotoUpdateForm extends Form
{
    #[Validate('required|max:10')]
    public $prisoner_id;
    // DATA
    #[Validate('required|max:100')]
    public $position;
    #[Validate('required|max:100')]
    public $description = '';
    #[Validate('required|max:10')]
    public $user_update = '';
    #[Validate('required|max:10')]
    public $prison_unit_id = '';
    public $positions = [
        'CABEÇA E PESCOÇO',
        'COSTAS',
        'BRAÇO DIREITO E MÃO DIREITA',
        'BRAÇO ESQUERDO E MÃO ESQUERDA',
        'FRONTAL',
        'PEITO E ABDOME',
        'PERFIL DIREITO',
        'PERFIL ESQUERDO',
        'PERNA DIREITA E PÉ DIREITO',
        'PERNA ESQUERDA E PÉ ESQUERDO',
    ];

    // UPDATE
    public function update($photo_id)
    {
        $photo = Photo::find($photo_id);
        $dataValidated = $this->validate();
        // Converte caracteres em maiúsculo
        $dataValidated['position'] = mb_strtoupper($dataValidated['position'], 'utf-8');
        $dataValidated['description'] = mb_strtoupper($dataValidated['description'], 'utf-8');

        $photo->update($dataValidated);
        $this->reset();
    }
}
