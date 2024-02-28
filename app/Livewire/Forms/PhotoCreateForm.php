<?php

namespace App\Livewire\Forms;

use App\Models\Main\Photo;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PhotoCreateForm extends Form
{
    #[Validate('required|max:10')]
    public $prisoner_id;
    // DATA
    #[Validate('required|mimes:jpeg,jpg,png')]
    public $photo;
    #[Validate('required|max:100')]
    public $position;
    #[Validate('required|max:100')]
    public $description = '';
    #[Validate('required|max:10')]
    public $user_create = '';
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

    // CREATE
    public function save()
    {
        $dataValidated = $this->validate();
        // Converte caracteres em maiúsculo
        $dataValidated['position'] = mb_strtoupper($dataValidated['position'], 'utf-8');
        $dataValidated['description'] = mb_strtoupper($dataValidated['description'], 'utf-8');

        if ($this->photo) {
            /* responsável por excluir o diretório e a foto */
            if (!empty($photo)) {
                Storage::disk('public')->delete($photo);
            }
            /* cria o nome da photo com a extensão */
            $photo_name = 'id-' . $this->prisoner_id . '_' . 'date-' . date('d-m-Y_H_m_s') . '.' . $dataValidated['photo']->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('prisoner/' . $this->prisoner_id . '/gallery', $photo_name);
            $photo_name = '';
        }
        Photo::create($dataValidated);
        $this->reset('photo', 'position', 'description');
    }
}
