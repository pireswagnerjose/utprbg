<?php

namespace App\Livewire\Admin\EducationLevel;

use App\Models\Admin\EducationLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Escolaridade")]
class EducationLevelLivewire extends Component
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
        $this->reset('educationLevel', 'userCreate');
        $this->confirmingEducationLevelUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $educationLevel;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'education_level'   => $this->educationLevel,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'education_level'    => 'required|max:100|string|unique:education_levels,education_level',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['education_level'] = mb_strtoupper ($dataValidated['education_level'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        EducationLevel::create($dataValidated);
        $this->reset('educationLevel');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingEducationLevelUpdate = false;
    public function modalEducationLevelUpdate(EducationLevel $educationLevel)
    {
        $this->educationLevel  = $educationLevel->education_level;
        $this->confirmingEducationLevelUpdate = $educationLevel->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateEducationLevel(EducationLevel $educationLevel)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'education_level'   => $this->educationLevel,
                'user_update'       => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'education_level'   => "required|max:100|string|unique:education_levels,education_level,{$educationLevel->id},id",//unico (usa o id da table pra validadar)
                'user_update'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['education_level'] = mb_strtoupper ($dataValidated['education_level'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $educationLevel->update($dataValidated);//atualiza os dados no banco
        $this->reset('educationLevel');
        $this->confirmingEducationLevelUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingEducationLevelDeletion = false;
    public function modalEducationLevelDeletion($stateID)
    {
        $this->confirmingEducationLevelDeletion = $stateID;
    }
    // LEVEL ACCESS DELETE
    public function deleteEducationLevel(EducationLevel $educationLevel)
    {
        $educationLevel->delete();
        $this->confirmingEducationLevelDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.education-level.education-level-livewire', [
            'educationLevels' => EducationLevel::orderBy('education_level', 'asc')->where('education_level', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
