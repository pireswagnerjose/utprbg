<?php

namespace App\Livewire\Admin\Pad\PadEventType;

use App\Models\Admin\Pad\PadEventType;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Tipos de Evento")]
class PadEventTypeLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $pad_event_type = '';

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
        $this->openModalPadEventTypeUpdate = false;
        $this->openModalPadEventTypeDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function create()
    {
        $dataValidated = $this->validate(
            [
                'pad_event_type'    =>'required|max:100|unique:pad_event_types,pad_event_type',
                'user_create'       =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['pad_event_type'] = mb_strtoupper ($dataValidated['pad_event_type'],'utf-8');

        PadEventType::create($dataValidated);
        $this->reset('pad_event_type');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalPadEventTypeUpdate = false;
    public function modalPadEventTypeUpdate(PadEventType $pad_event_type)
    {
        $this->pad_event_type               = $pad_event_type->pad_event_type;
        $this->openModalPadEventTypeUpdate  = $pad_event_type->id;
    }

    // UPDATE
    public function padEventTypeUpdate(PadEventType $pad_event_type)
    {
        $dataValidated = $this->validate(
            [
                'pad_event_type'    =>"required|max:100|unique:pad_event_types,pad_event_type,{$pad_event_type->id},id",
                'user_update'       =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['pad_event_type'] = mb_strtoupper ($dataValidated['pad_event_type'],'utf-8');

        $pad_event_type->update($dataValidated);//atualiza os dados no banco
        $this->reset('pad_event_type');
        $this->openModalPadEventTypeUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPadEventTypeDelete = false;
    public function modalPadEventTypeDelete($pad_event_type)
    {
        $this->openModalPadEventTypeDelete = $pad_event_type;
    }
    // LEVEL ACCESS DELETE
    public function padEventTypeDelete(PadEventType $pad_event_type)
    {
        $pad_event_type->delete();
        $this->openModalPadEventTypeDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.pad.pad-event-type.pad-event-type-livewire', [
            'pad_event_types' => PadEventType::orderBy('pad_event_type', 'asc')->where('pad_event_type', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
