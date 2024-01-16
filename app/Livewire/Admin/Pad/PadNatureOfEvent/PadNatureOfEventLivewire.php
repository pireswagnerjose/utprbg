<?php

namespace App\Livewire\Admin\Pad\PadNatureOfEvent;

use App\Models\Admin\Pad\PadNatureOfEvent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Natureza da Ocorrência")]
class PadNatureOfEventLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $pad_nature_of_event = '';

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
        $this->openModalPadNatureOfEventUpdate = false;
        $this->openModalPadNatureOfEventDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function padNatureOfEventCreate()
    {
        $dataValidated = $this->validate(
            [
                'pad_nature_of_event'   =>'required|max:100|unique:pad_locals,pad_local',
                'user_create'           =>'required|max:10',
                'prison_unit_id'        =>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['pad_nature_of_event'] = mb_strtoupper ($dataValidated['pad_nature_of_event'],'utf-8');

        PadNatureOfEvent::create($dataValidated);
        $this->reset('pad_nature_of_event');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalPadNatureOfEventUpdate = false;
    public function modalPadNatureOfEventUpdate(PadNatureOfEvent $pad_nature_of_event)
    {
        $this->pad_nature_of_event              = $pad_nature_of_event->pad_nature_of_event;
        $this->openModalPadNatureOfEventUpdate  = $pad_nature_of_event->id;
    }
    // UPDATE
    public function padNatureOfEventUpdate(PadNatureOfEvent $pad_nature_of_event)
    {
        $dataValidated = $this->validate(
            [
                'pad_nature_of_event'   =>"required|max:100|unique:pad_nature_of_events,pad_nature_of_event,{$pad_nature_of_event->id},id",
                'user_update'           =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['pad_nature_of_event'] = mb_strtoupper ($dataValidated['pad_nature_of_event'],'utf-8');

        $pad_nature_of_event->update($dataValidated);//atualiza os dados no banco
        $this->reset('pad_nature_of_event');
        $this->openModalPadNatureOfEventUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPadNatureOfEventDelete = false;
    public function modalPadNatureOfEventDelete($pad_nature_of_event)
    {
        $this->openModalPadNatureOfEventDelete = $pad_nature_of_event;
    }
    // LEVEL ACCESS DELETE
    public function padNatureOfEventDelete(PadNatureOfEvent $pad_nature_of_event)
    {
        $pad_nature_of_event->delete();
        $this->openModalPadNatureOfEventDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.pad.pad-nature-of-event.pad-nature-of-event-livewire', [
            'pad_nature_of_events' => PadNatureOfEvent::orderBy('pad_nature_of_event', 'asc')->where('pad_nature_of_event', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
