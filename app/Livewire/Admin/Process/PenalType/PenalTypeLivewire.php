<?php

namespace App\Livewire\Admin\Process\PenalType;

use App\Models\Admin\Process\PenalType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipo Penal")]
class PenalTypeLivewire extends Component
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
        $this->reset('law', 'article', 'paragraph', 'item', 'description');
        $this->confirmingPenalTypeUpdate = false;
    }

    //CREATE NEW - CRIAR NOVO
    public $law;
    public $article;
    public $paragraph;
    public $item;
    public $description;
    public function create()
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'law'               => $this->law,
                'article'           => $this->article,
                'paragraph'         => $this->paragraph,
                'item'              => $this->item,
                'description'       => $this->description,
                'prison_unit_id'    => $this->userPrisonUnitID,
                'user_create'       => $this->userCreate,
            ],
            // Validation rules to apply...
            [
                'law'               => 'required|max:60',        
                'article'           => 'max:60',    
                'paragraph'         => 'max:60',  
                'item'              => 'max:60',       
                'description'       => '',
                'prison_unit_id'    => 'required|max:10',
                'user_create'       => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['law'] = mb_strtoupper ($dataValidated['law'],'utf-8');
        $dataValidated['article'] = mb_strtoupper ($dataValidated['article'],'utf-8');
        $dataValidated['paragraph'] = mb_strtoupper ($dataValidated['paragraph'],'utf-8');
        $dataValidated['item'] = mb_strtoupper ($dataValidated['item'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');
        $dataValidated['user_create'] = mb_strtoupper ($dataValidated['user_create'],'utf-8');

        PenalType::create($dataValidated);
        $this->reset('law', 'article', 'paragraph', 'item', 'description');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $confirmingPenalTypeUpdate = false;
    public function modalPenalTypeUpdate(PenalType $penalType)
    {
        $this->law                          = $penalType->law;
        $this->article                      = $penalType->article;
        $this->paragraph                    = $penalType->paragraph;
        $this->item                         = $penalType->item;
        $this->description                  = $penalType->description;
        $this->confirmingPenalTypeUpdate    = $penalType->id;
    }

    // LEVEL ACCESS UPDATE
    public function updatePenalType(PenalType $penalType)
    {
        $dataValidated = Validator::make(
            // Data to validate...
            [
                'law'           => $this->law,
                'article'       => $this->article,
                'paragraph'     => $this->paragraph,
                'item'          => $this->item,
                'description'   => $this->description,
                'user_update'   => $this->userUpdate,
            ],
            // Validation rules to apply...
            [
                'law'           => 'required|max:60',        
                'article'       => 'max:60',    
                'paragraph'     => 'max:60',  
                'item'          => 'max:60',       
                'description'   => '',
                'user_update'   => 'max:10',
            ],
        )->validate();

        // Transforma os caracteres em maiusculos
        $dataValidated['law'] = mb_strtoupper ($dataValidated['law'],'utf-8');
        $dataValidated['article'] = mb_strtoupper ($dataValidated['article'],'utf-8');
        $dataValidated['paragraph'] = mb_strtoupper ($dataValidated['paragraph'],'utf-8');
        $dataValidated['item'] = mb_strtoupper ($dataValidated['item'],'utf-8');
        $dataValidated['description'] = mb_strtoupper ($dataValidated['description'],'utf-8');
        $dataValidated['user_update'] = mb_strtoupper ($dataValidated['user_update'],'utf-8');

        $penalType->update($dataValidated);//atualiza os dados no banco
        $this->reset('law', 'article', 'paragraph', 'item', 'description');
        $this->confirmingPenalTypeUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $confirmingPenalTypeDeletion = false;
    public function modalPenalTypeDeletion($penalTypeID)
    {
        $this->confirmingPenalTypeDeletion = $penalTypeID;
    }
    // LEVEL ACCESS DELETE
    public function deletePenalType(PenalType $penalType)
    {
        $penalType->delete();
        $this->confirmingPenalTypeDeletion = false;
    }
    public function render()
    {
        return view('livewire.admin.process.penal-type.penal-type-livewire', [
            'penalTypes' => PenalType::orderBy('created_at', 'asc')
                ->where('law', 'like', "%{$this->search}%")
                ->orWhere('article', 'like', "%{$this->search}%")
                ->orWhere('paragraph', 'like', "%{$this->search}%")
                ->orWhere('item', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%")
                ->paginate(10)
        ]);
    }
}
