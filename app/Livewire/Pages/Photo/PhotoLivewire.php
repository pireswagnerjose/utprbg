<?php

namespace App\Livewire\Pages\Photo;

use App\Models\Main\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PhotoLivewire extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;
    
    #[Title('Polícia Penal - Fotos')]

    public $photo_collection = null;

    #[Validate('required|max:10')]
    public $prisoner_id;
    public $photo;
    #[Validate('required|max:100')]
    public $position;
    #[Validate('required|max:100')]
    public $description;
    #[Validate('required|max:100')]
    public $user_create;
    #[Validate('required|max:10')]
    public $user_update;
    #[Validate('required|max:10')]
    public $prison_unit_id;
    public $openModal = false;
    public $image_key;//corrigir erro de upload de imagem
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
        $this->user_create = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->user_update = Auth::user()->id;
    }

    public function clearFields()
    {
        $this->reset( 'photo','position','description', 'photo_collection');
    }
    public function closeModal()
    {
        $this->openModal = false;
        $this->clearFields();
    }

    public function modal(Photo $photo_collection)
    {
        # Para edição
        if ($photo_collection->id) {
            $this->photo_collection = $photo_collection;
            $this->position = $photo_collection->position;
            $this->description = $photo_collection->description;
            $this->prison_unit_id = Auth::user()->prison_unit_id;
            $this->user_update = Auth::user()->id;
            if ($this->photo) {
                $this->photo = $photo_collection->photo;
            }
            $this->openModal = $photo_collection->id;
        }else{
            $this->openModal = true;
        }
    }

    public function save()
    {
        $this->image_key = rand();
        
        # Valida os campos title e content
        $this->validate();

        # Valida a imagem
        $rules = [
            'photo' => $this->photo_collection && $this->photo_collection->photo ? 'nullable|image|mimes:jpeg,jpg,png|max:2048' : 'required|image|mimes:jpeg,jpg,png|max:2048'
        ];
        $messages = [
            'photo.required' => 'O Campo Foto é obrigatório',
            'photo.image' => 'O Campo Foto deve ser uma imagem válida',
            'photo.mimes' => 'O Campo Foto aceita somente as extenções: jpeg, jpg, ou png',
            'photo.max' => 'O Campo Foto deve ter no máximo 2MB',
        ];
        $this->validate($rules,$messages);
        
        # Faz o upload da Photo e retorna o path
        $image_path = null;
        if ($this->photo) {
            # Delete Photo
            if (isset($this->photo_collection->photo)){
                Storage::delete($this->photo_collection->photo);
            };
            # Create a new neme Photo
            $image_name = 'id-'.$this->prisoner_id.'_'.time().'.'.$this->photo->extension();
            $image_path = $this->photo->storeAs('prisoner/' . $this->prisoner_id . '/gallery', $image_name);
        }

        # Create e Update
        if ($this->photo_collection) {
            # Update Funcionality
            $this->photo_collection->position = $this->position;
            $this->photo_collection->description = $this->description;
            $this->photo_collection->user_update = $this->user_update;
            $this->photo_collection->prison_unit_id = $this->prison_unit_id;
            if ($image_path) {
                $this->photo_collection->photo = $image_path;
            }
            $updatePhoto = $this->photo_collection->save();
            if ($updatePhoto) {
                session()->flash('success', 'A Foto foi atualizada com sucesso!');
            }
            else{
                session()->flash('error', 'Não foi possível editar a Foto, por favor tente novamente.');
            }
        }else {
            # Create Funcionality
            $photo = Photo::create([
                'position' => $this->position,
                'description' => $this->description,
                'photo' => $image_path,
                'prisoner_id' => $this->prisoner_id,
                'user_create' => $this->user_create,
                'prison_unit_id' => $this->prison_unit_id,
            ]);
            if ($photo) {
                session()->flash('success', 'A Foto foi cadastrada com sucesso!');
            }
            else{
                session()->flash('error', 'Não foi possível cadastrar a Foto, por favor tente novamente.');
            }
        }
        $this->closeModal();
    }

    public function delete(Photo $photo)
    {
        if ($photo) {
            # Delete photo
            if (Storage::exists($photo->photo)){
                Storage::delete($photo->photo);
            };
            # Delete Data
            $deleteResponse = $photo->delete();
            if ($deleteResponse) {
                session()->flash('success', 'A Foto excluído com sucesso!');
            } else{
                session()->flash('error', 'erro ao excluir a Foto! tente novamente.');
            }
        } else{
            session()->flash('error', 'Foto inesistente.');
        }
    }
    public function render()
    {
        $photos = Photo::where('prisoner_id', $this->prisoner_id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('livewire.pages.photo.photo-livewire', compact('photos'));
    }
}
