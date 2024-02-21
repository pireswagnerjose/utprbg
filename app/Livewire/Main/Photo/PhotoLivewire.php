<?php

namespace App\Livewire\Main\Photo;

use App\Livewire\Forms\PhotoCreateForm;
use App\Livewire\Forms\PhotoUpdateForm;
use App\Models\Main\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Component;
use Livewire\WithPagination;

class PhotoLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $image_key;
    
    public PhotoCreateForm $photo_create_form;
    public PhotoUpdateForm $photo_update_form;
    public $prisoner_id;
    
    // MODAL CREATE
    public $openModalCreate = false;
    public function modalPhotoCreate()
    {
        $this->openModalCreate = true;
    }
    // CREATE
    public function photoCreate()
    {
        $this->photo_create_form->user_create = Auth::user()->id;
        $this->photo_create_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->photo_create_form->prisoner_id = $this->prisoner_id;
        $this->photo_create_form->save();
        $this->openModalCreate = false;
        $this->image_key = rand();
    }

    // MODAL UPDATE
    public $openModalUpdate = false;
    public function modalPhotoUpdate(Photo $photo)
    {
        $this->photo_update_form->user_update = Auth::user()->id;
        $this->photo_update_form->prison_unit_id = Auth::user()->prison_unit_id;
        $this->photo_update_form->prisoner_id = $this->prisoner_id;
        $this->photo_update_form->position             = $photo->position;
        $this->photo_update_form->description          = $photo->description;
        $this->openModalUpdate = $photo->id;
    }

    // UPDATE
    public function photoUpdate($photo_id)
    {
        $this->photo_update_form->update($photo_id);
        $this->image_key = rand();
        $this->openModalUpdate = false;
    }

    // MODAL DELETE
    public $openModalDelete = false;
    public function modalPhotoDelete(Photo $photo)
    {
        $this->openModalDelete = $photo->id;
    }
    // DELETE
    public function photoDelete(Photo $photo)
    {
        /* responsável por excluir o arquivo */
        if (!empty($photo->photo)) {
            Storage::disk('public')->delete($photo->photo);
        }
        $photo->delete();
        $this->openModalDelete = false;
    }
    
    public function render()
    {
        return view('livewire.main.photo.photo-livewire', [
            'photos' => Photo::where('prisoner_id', $this->prisoner_id)->orderBy('created_at', 'desc')->paginate(20)
        ]);
    }
}
