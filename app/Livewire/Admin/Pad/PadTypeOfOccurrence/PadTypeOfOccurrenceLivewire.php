<?php

namespace App\Livewire\Admin\Pad\PadTypeOfOccurrence;

use App\Models\Admin\Pad\PadTypeOfOccurrence;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipo de Ocorrência")]
class PadTypeOfOccurrenceLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $pad_type_of_occurrence = '';

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
        $this->openModalPadTypeOfOccurrenceUpdate = false;
        $this->openModalPadTypeOfOccurrenceDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function padTypeOfOccurrenceCreate()
    {
        $dataValidated = $this->validate(
            [
                'pad_type_of_occurrence'=>'required|max:100|unique:pad_type_of_occurrences,pad_type_of_occurrence',
                'user_create'           =>'required|max:10',
                'prison_unit_id'        =>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['pad_type_of_occurrence'] = mb_strtoupper ($dataValidated['pad_type_of_occurrence'],'utf-8');

        PadTypeOfOccurrence::create($dataValidated);
        $this->reset('pad_type_of_occurrence');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalPadTypeOfOccurrenceUpdate = false;
    public function modalPadTypeOfOccurrenceUpdate(PadTypeOfOccurrence $pad_type_of_occurrence)
    {
        $this->pad_type_of_occurrence            = $pad_type_of_occurrence->pad_type_of_occurrence;
        $this->openModalPadTypeOfOccurrenceUpdate=$pad_type_of_occurrence->id;
    }
    // UPDATE
    public function padTypeOfOccurrenceUpdate(PadTypeOfOccurrence $pad_type_of_occurrence)
    {
        $dataValidated = $this->validate(
            [
                'pad_type_of_occurrence'=>"required|max:100|unique:pad_type_of_occurrences,pad_type_of_occurrence,{$pad_type_of_occurrence->id},id",
                'user_update'           =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['pad_type_of_occurrence'] = mb_strtoupper ($dataValidated['pad_type_of_occurrence'],'utf-8');

        $pad_type_of_occurrence->update($dataValidated);//atualiza os dados no banco
        $this->reset('pad_type_of_occurrence');
        $this->openModalPadTypeOfOccurrenceUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPadTypeOfOccurrenceDelete = false;
    public function modalPadTypeOfOccurrenceDelete($pad_type_of_occurrence)
    {
        $this->openModalPadTypeOfOccurrenceDelete = $pad_type_of_occurrence;
    }
    // LEVEL ACCESS DELETE
    public function padTypeOfOccurrenceDelete(PadTypeOfOccurrence $pad_type_of_occurrence)
    {
        $pad_type_of_occurrence->delete();
        $this->openModalPadTypeOfOccurrenceDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.pad.pad-type-of-occurrence.pad-type-of-occurrence-livewire', [
            'pad_type_of_occurrences' => PadTypeOfOccurrence::orderBy('pad_type_of_occurrence', 'asc')->where('pad_type_of_occurrence', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
