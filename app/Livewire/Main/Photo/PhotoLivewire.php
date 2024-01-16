<?php

namespace App\Livewire\Main\Photo;

use App\Models\Main\Photo;
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Validation\Rules\File;
use Livewire\Component;

class PhotoLivewire extends Component
{
    use WithFileUploads;
    public $prisoner_id;
    public $prisoner = [];

    // DATA
    public $photo;
    public $position;
    public $description = '';
    public $user_create = '';
    public $user_update= '';
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

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prisoner         = Prisoner::find($this->prisoner_id);
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('photo', 'position', 'description');
    }

    // CLOSE MODALS
    public function closeModal()
    {
        $this->openModalPhotoCreate = false;
        $this->openModalPhotoDelete = false;
        $this->openModalPhotoUpdate = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['position'] = mb_strtoupper ($dataValidated['position'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalPhotoCreate = false;
    public function modalPhotoCreate()
    {
        $this->clearFields();
        $this->openModalPhotoCreate = true;
    }
    // CREATE
    public function photoCreate()
    {
        $dataValidated = $this->validate(
            [
                'photo'         => File::image()->types(['jpeg', 'jpg', 'png']),
                'position'      => 'required|max:255',
                'description'   => 'required|max:255',
                'prison_unit_id'=> 'required|max:10',
                'user_create'   => 'required|max:10',
                'prisoner_id'   => 'required|max:10',
            ]
        );
        if ($this->photo) {
            /* responsável por excluir o diretório e a foto */
            if (!empty($photo)) {
                Storage::disk('public')->delete($photo);
            }
            $photo_name = str_replace("/", "-", $this->prisoner['id']. '_' .$dataValidated['description']);
            $photo_name = str_replace("\"", "", $photo_name);
            $photo_name = str_replace("\'", "", $photo_name);

            /* cria o nome da photo com a extensão */
            $photo_name = $photo_name .'_'. date('d-m-Y_H_m_s') . '.' . $dataValidated['photo']->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('prisoner/'. $this->prisoner['id']. '/gallery', $photo_name);
        }
        // Converte caracteres em maiúsculo
        $dataValidated = $this->convertUppercase($dataValidated);
        Photo::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
    }

    // MODAL UPDATE
    public $openModalPhotoUpdate = false;
    public function modalPhotoUpdate(Photo $photo)
    {
        $this->position             = $photo->position;
        $this->description          = $photo->description;
        $this->openModalPhotoUpdate = $photo->id;
    }

    // UPDATE
    public function photoUpdate(Photo $photo)
    {
        $dataValidated = $this->validate(
            [
                'position'      => 'required|max:255',
                'description'   => 'required|max:255',
                'prison_unit_id'=> 'required|max:10',
                'user_update'   => 'required|max:10',
                'prisoner_id'   => 'required|max:10',
            ]
        );
        // Converte caracteres em maiúsculo
        $dataValidated = $this->convertUppercase($dataValidated);
        // Atualiza os dados no banco
        $photo->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
    }

    // MODAL DELETE
    public $openModalPhotoDelete = false;
    public function modalPhotoDelete(Photo $photo)
    {
        $this->openModalPhotoDelete = $photo->id;
    }
    // DELETE
    public function photoDelete(Photo $photo)
    {
        /* responsável por excluir o arquivo */
        if (!empty($photo->photo)) {
            Storage::disk('public')->delete($photo->photo);
        }
        $photo->delete();
        $this->closeModal();
    }
    
    public function render()
    {
        return view('livewire.main.photo.photo-livewire', [
            'photos' => Photo::where('prisoner_id', $this->prisoner_id)->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
