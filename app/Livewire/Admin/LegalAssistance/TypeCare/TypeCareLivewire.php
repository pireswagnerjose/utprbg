<?php

namespace App\Livewire\Admin\LegalAssistance\TypeCare;

use App\Models\Admin\LegalAssistance\TypeCare;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipo do Atendimento")]
class TypeCareLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $type_care = '';

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
        $this->openModalTypeCareUpdate = false;
        $this->openModalTypeCareDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function typeCareCreate()
    {
        $dataValidated = $this->validate(
            [
                'type_care'     =>'required|max:100|unique:type_cares,type_care',
                'user_create'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['type_care'] = mb_strtoupper ($dataValidated['type_care'],'utf-8');

        TypeCare::create($dataValidated);
        $this->reset('type_care');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalTypeCareUpdate = false;
    public function modalTypeCareUpdate(TypeCare $type_care)
    {
        $this->type_care              = $type_care->type_care;
        $this->openModalTypeCareUpdate= $type_care->id;
    }
    // UPDATE
    public function typeCareUpdate(TypeCare $type_care)
    {
        $dataValidated = $this->validate(
            [
                'type_care'   =>"required|max:100|unique:type_cares,type_care,{$type_care->id},id",
                'user_update'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['type_care'] = mb_strtoupper ($dataValidated['type_care'],'utf-8');

        $type_care->update($dataValidated);//atualiza os dados no banco
        $this->reset('type_care');
        $this->openModalTypeCareUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalTypeCareDelete = false;
    public function modalTypeCareDelete($type_care)
    {
        $this->openModalTypeCareDelete = $type_care;
    }
    // LEVEL ACCESS DELETE
    public function typeCareDelete(TypeCare $type_care)
    {
        $type_care->delete();
        $this->openModalTypeCareDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.legal-assistance.type-care.type-care-livewire', [
            'type_cares' => TypeCare::orderBy('type_care', 'asc')->where('type_care', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
