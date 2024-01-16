<?php

namespace App\Livewire\Admin\Pad\PadLocal;

use App\Models\Admin\Pad\PadLocal;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Local da Ocorrência")]
class PadLocalLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $pad_local = '';

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
        $this->openModalPadLocalUpdate = false;
        $this->openModalPadLocalDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function padLocalCreate()
    {
        $dataValidated = $this->validate(
            [
                'pad_local'         =>'required|max:100|unique:pad_locals,pad_local',
                'user_create'       =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['pad_local'] = mb_strtoupper ($dataValidated['pad_local'],'utf-8');

        PadLocal::create($dataValidated);
        $this->reset('pad_local');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalPadLocalUpdate = false;
    public function modalPadLocalUpdate(PadLocal $pad_local)
    {
        $this->pad_local                = $pad_local->pad_local;
        $this->openModalPadLocalUpdate  = $pad_local->id;
    }

    // UPDATE
    public function padLocalUpdate(PadLocal $pad_local)
    {
        $dataValidated = $this->validate(
            [
                'pad_local'     =>"required|max:100|unique:pad_locals,pad_local,{$pad_local->id},id",
                'user_update'   =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['pad_local'] = mb_strtoupper ($dataValidated['pad_local'],'utf-8');

        $pad_local->update($dataValidated);//atualiza os dados no banco
        $this->reset('pad_local');
        $this->openModalPadLocalUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPadLocalDelete = false;
    public function modalPadLocalDelete($pad_local)
    {
        $this->openModalPadLocalDelete = $pad_local;
    }
    // LEVEL ACCESS DELETE
    public function padLocalDelete(PadLocal $pad_local)
    {
        $pad_local->delete();
        $this->openModalPadLocalDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.pad.pad-local.pad-local-livewire', [
            'pad_locals' => PadLocal::orderBy('pad_local', 'asc')->where('pad_local', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
