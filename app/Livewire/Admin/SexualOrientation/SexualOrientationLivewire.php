<?php

namespace App\Livewire\Admin\SexualOrientation;

use App\Models\Admin\SexualOrientation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Orientação Sexual")]
class SexualOrientationLivewire extends Component
{
    use WithPagination;
    
    // CLASS ACESSORIES
    public int $userCreate;
    public int $userUpdate;
    public $userPrisonUnitID;
    public function mount()
    {
        $this->userPrisonUnitID = Auth::user()->prison_unit_id;
        $this->userCreate = Auth::user()->id;
        $this->userUpdate = Auth::user()->id;
    }

    // SEARCH - PESQUISA
    #[Url]
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //ADD NEW - ADICIONAR NOVO 
    public $add_new;
    public function addNew()
    {
        $this->add_new = true;
    }
    public function cancel()
    {
        $this->add_new = false;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('sexualOrientation', 'userCreate');
        $this->confirmingSexualOrientationUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $sexualOrientation;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'sexual_orientation'    => $this->sexualOrientation,
                'prison_unit_id'        => $this->userPrisonUnitID,
                'user_create'           => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'sexual_orientation'    => 'required|max:100|string|unique:sexual_orientations,sexual_orientation',
                'prison_unit_id'        => 'required|max:10',
                'user_create'           => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['sexual_orientation'] = mb_strtoupper ($dataValidated['sexual_orientation'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        SexualOrientation::create($dataValidated);
        $this->reset('sexualOrientation');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingSexualOrientationUpdate = false;
    public function modalSexualOrientationUpdate(SexualOrientation $sexualOrientation)
    {
        $this->sexualOrientation  = $sexualOrientation->sexual_orientation;
        $this->confirmingSexualOrientationUpdate = $sexualOrientation->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateSexualOrientation(SexualOrientation $sexualOrientation)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'sexual_orientation'    => $this->sexualOrientation,
                'user_update'           => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'sexual_orientation'    => "required|max:100|string|unique:sexual_orientations,sexual_orientation,{$sexualOrientation->id},id",//unico (usa o id da table pra validadar)
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['sexual_orientation'] = mb_strtoupper ($dataValidated['sexual_orientation'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $sexualOrientation->update($dataValidated);//atualiza os dados no banco
        $this->reset('sexualOrientation');
        $this->confirmingSexualOrientationUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingSexualOrientationDeletion = false;
    public function modalSexualOrientationDeletion($sexualOrientationID)
    {
        $this->confirmingSexualOrientationDeletion = $sexualOrientationID;
    }
    // LEVEL ACCESS DELETE
    public function deleteSexualOrientation(SexualOrientation $sexualOrientation)
    {
        $sexualOrientation->delete();
        $this->confirmingSexualOrientationDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.sexual-orientation.sexual-orientation-livewire', [
            'sexualOrientations' => SexualOrientation::orderBy('sexual_orientation', 'asc')->where('sexual_orientation', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
