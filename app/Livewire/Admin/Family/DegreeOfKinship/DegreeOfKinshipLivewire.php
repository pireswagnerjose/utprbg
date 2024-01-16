<?php

namespace App\Livewire\Admin\Family\DegreeOfKinship;

use App\Models\Admin\Family\DegreeOfKinship;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Grau de Parentesco")]
class DegreeOfKinshipLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $degree_of_kinship = '';

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
        $this->openModalDegreeOfKinshipUpdate = false;
        $this->openModalDegreeOfKinshipDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function degreeOfKinshipCreate()
    {
        $dataValidated = $this->validate(
            [
                'degree_of_kinship'=>'required|max:100|unique:pad_locals,pad_local',
                'user_create'      =>'required|max:10',
                'prison_unit_id'   =>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['degree_of_kinship'] = mb_strtoupper ($dataValidated['degree_of_kinship'],'utf-8');

        DegreeOfKinship::create($dataValidated);
        $this->reset('degree_of_kinship');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalDegreeOfKinshipUpdate = false;
    public function modalDegreeOfKinshipUpdate(DegreeOfKinship $degree_of_kinship)
    {
        $this->degree_of_kinship             = $degree_of_kinship->degree_of_kinship;
        $this->openModalDegreeOfKinshipUpdate= $degree_of_kinship->id;
    }
    // UPDATE
    public function degreeOfKinshipUpdate(DegreeOfKinship $degree_of_kinship)
    {
        $dataValidated = $this->validate(
            [
                'degree_of_kinship' =>"required|max:100|unique:degrees_of_kinship,degree_of_kinship,{$degree_of_kinship->id},id",
                'user_update'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['degree_of_kinship'] = mb_strtoupper ($dataValidated['degree_of_kinship'],'utf-8');

        $degree_of_kinship->update($dataValidated);//atualiza os dados no banco
        $this->reset('degree_of_kinship');
        $this->openModalDegreeOfKinshipUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalDegreeOfKinshipDelete = false;
    public function modalDegreeOfKinshipDelete($degree_of_kinship)
    {
        $this->openModalDegreeOfKinshipDelete = $degree_of_kinship;
    }
    // LEVEL ACCESS DELETE
    public function degreeOfKinshipDelete(DegreeOfKinship $degree_of_kinship)
    {
        $degree_of_kinship->delete();
        $this->openModalDegreeOfKinshipDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.family.degree-of-kinship.degree-of-kinship-livewire', [
            'degrees_of_kinship' => DegreeOfKinship::orderBy('degree_of_kinship', 'asc')->where('degree_of_kinship', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
