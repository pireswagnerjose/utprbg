<?php

namespace App\Livewire\Admin\LegalAssistance\ModalityCare;

use App\Models\Admin\LegalAssistance\ModalityCare;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Modalidade do Atendimento")]
class ModalityCareLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $modality_care = '';

    public function mount()
    {
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
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
    public function closeModal()
    {
        $this->openModalModalityCareUpdate = false;
        $this->openModalModalityCareDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function modalityCareCreate()
    {
        $dataValidated = $this->validate(
            [
                'modality_care' =>'required|max:100|unique:modality_cares,modality_care',
                'user_create'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['modality_care'] = mb_strtoupper ($dataValidated['modality_care'],'utf-8');

        ModalityCare::create($dataValidated);
        $this->reset('modality_care');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalModalityCareUpdate = false;
    public function modalModalityCareUpdate(ModalityCare $modality_care)
    {
        $this->modality_care              = $modality_care->modality_care;
        $this->openModalModalityCareUpdate= $modality_care->id;
    }
    // UPDATE
    public function modalityCareUpdate(ModalityCare $modality_care)
    {
        $dataValidated = $this->validate(
            [
                'modality_care'   =>"required|max:100|unique:modality_cares,modality_care,{$modality_care->id},id",
                'user_update'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['modality_care'] = mb_strtoupper ($dataValidated['modality_care'],'utf-8');

        $modality_care->update($dataValidated);//atualiza os dados no banco
        $this->reset('modality_care');
        $this->openModalModalityCareUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalModalityCareDelete = false;
    public function modalModalityCareDelete($modality_care)
    {
        $this->openModalModalityCareDelete = $modality_care;
    }
    // LEVEL ACCESS DELETE
    public function modalityCareDelete(ModalityCare $modality_care)
    {
        $modality_care->delete();
        $this->openModalModalityCareDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.legal-assistance.modality-care.modality-care-livewire', [
            'modality_cares' => ModalityCare::orderBy('modality_care', 'asc')->where('modality_care', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
