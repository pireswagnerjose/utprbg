<?php

namespace App\Livewire\Admin\Pad\PadStatus;

use App\Models\Admin\Pad\PadStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Status da Ocorrência")]
class PadStatusLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $pad_status = '';

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
        $this->openModalPadStatusUpdate = false;
        $this->openModalPadStatusDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function padStatusCreate()
    {
        $dataValidated = $this->validate(
            [
                'pad_status'    =>'required|max:100|unique:pad_locals,pad_local',
                'user_create'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['pad_status'] = mb_strtoupper ($dataValidated['pad_status'],'utf-8');

        PadStatus::create($dataValidated);
        $this->reset('pad_status');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalPadStatusUpdate = false;
    public function modalPadStatusUpdate(PadStatus $pad_status)
    {
        $this->pad_status              = $pad_status->pad_status;
        $this->openModalPadStatusUpdate= $pad_status->id;
    }
    // UPDATE
    public function padStatusUpdate(PadStatus $pad_status)
    {
        $dataValidated = $this->validate(
            [
                'pad_status' =>"required|max:100|unique:pad_statuses,pad_status,{$pad_status->id},id",
                'user_update'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['pad_status'] = mb_strtoupper ($dataValidated['pad_status'],'utf-8');

        $pad_status->update($dataValidated);//atualiza os dados no banco
        $this->reset('pad_status');
        $this->openModalPadStatusUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPadStatusDelete = false;
    public function modalPadStatusDelete($pad_status)
    {
        $this->openModalPadStatusDelete = $pad_status;
    }
    // LEVEL ACCESS DELETE
    public function padStatusDelete(PadStatus $pad_status)
    {
        $pad_status->delete();
        $this->openModalPadStatusDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.pad.pad-status.pad-status-livewire', [
            'pad_statuses' => PadStatus::orderBy('pad_status', 'asc')->where('pad_status', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
