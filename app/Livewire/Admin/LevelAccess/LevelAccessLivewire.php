<?php

namespace App\Livewire\Admin\LevelAccess;

use App\Models\Admin\LevelAccess;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Níve de Acesso ao Sistema")]
class LevelAccessLivewire extends Component
{
    use WithPagination;

    // CLASS ACESSORIES
    public int $userCreate;
    public int $userUpdate;
    public function mount()
    {
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
        $this->reset('levelAccess');
        $this->add_new = true;
    }
    public function cancel()
    {
        $this->add_new = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $levelAccess;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'level_access'  => $this->levelAccess,
                'user_create'   => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'level_access'  => 'max:100|string',
                'user_create'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['level_access'] = mb_strtoupper ($dataValidated['level_access'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        LevelAccess::create($dataValidated);
        $this->reset('levelAccess');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingLevelAccessUpdate = false;
    public function modalLevelAccessUpdate(LevelAccess $levelAccess)
    {
        $this->levelAccess  = $levelAccess->level_access;
        $this->confirmingLevelAccessUpdate = $levelAccess->id;
    }

    // LEVEL ACCESS UPDATE
    public function updateLevelAccess(LevelAccess $levelAccess)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'level_access'  => $this->levelAccess,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'level_access'  => 'max:100|string',
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['level_access'] = mb_strtoupper ($dataValidated['level_access'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $levelAccess->update($dataValidated);//atualiza os dados no banco
        $this->reset('levelAccess');
        $this->confirmingLevelAccessUpdate = false;
    }

    // MODAL DELETE
    public $confirmingLevelAccessDeletion = false;
    public function modalLevelAccessDeletion($levelAccessID)
    {
        $this->confirmingLevelAccessDeletion = $levelAccessID;
    }
    // LEVEL ACCESS DELETE
    public function deleteLevelAccess(LevelAccess $levelAccess)
    {
        $levelAccess->delete();
        $this->confirmingLevelAccessDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.level-access.level-access-livewire', [
            'levelAccesses' => LevelAccess::latest()->where('level_access', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
