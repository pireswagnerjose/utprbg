<?php

namespace App\Livewire\Admin\LegalAssistance\CriminalCourt;

use App\Models\Admin\LegalAssistance\CriminalCourt;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Vara Criminal")]
class CriminalCourtLivewire extends Component
{
    use WithPagination;
    // CLASS ACESSORIES
    public int $user_create;
    public int $user_update;
    public $prison_unit_id;
    public $criminal_court = '';

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
        $this->openModalCriminalCourtUpdate = false;
        $this->openModalCriminalCourtDelete = false;
    }

    //CREATE NEW - CRIAR NOVO
    public function criminalCourtCreate()
    {
        $dataValidated = $this->validate(
            [
                'criminal_court'=>'required|max:100|unique:pad_locals,pad_local',
                'user_create'   =>'required|max:10',
                'prison_unit_id'=>'required|max:10',
            ]
        );

        // Transforma os caracteres em maiusculos
        $dataValidated['criminal_court'] = mb_strtoupper ($dataValidated['criminal_court'],'utf-8');

        CriminalCourt::create($dataValidated);
        $this->reset('criminal_court');
        session()->flash('success', 'Criado com sucesso.');
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalCriminalCourtUpdate = false;
    public function modalCriminalCourtUpdate(CriminalCourt $criminal_court)
    {
        $this->criminal_court              = $criminal_court->criminal_court;
        $this->openModalCriminalCourtUpdate= $criminal_court->id;
    }
    // UPDATE
    public function criminalCourtUpdate(CriminalCourt $criminal_court)
    {
        $dataValidated = $this->validate(
            [
                'criminal_court' =>"required|max:100|unique:criminal_courts,criminal_court,{$criminal_court->id},id",
                'user_update'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated['criminal_court'] = mb_strtoupper ($dataValidated['criminal_court'],'utf-8');

        $criminal_court->update($dataValidated);//atualiza os dados no banco
        $this->reset('criminal_court');
        $this->openModalCriminalCourtUpdate = false;
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalCriminalCourtDelete = false;
    public function modalCriminalCourtDelete($criminal_court)
    {
        $this->openModalCriminalCourtDelete = $criminal_court;
    }
    // LEVEL ACCESS DELETE
    public function criminalCourtDelete(CriminalCourt $criminal_court)
    {
        $criminal_court->delete();
        $this->openModalCriminalCourtDelete = false;
    }
    
    public function render()
    {
        return view('livewire.admin.legal-assistance.criminal-court.criminal-court-livewire', [
            'criminal_courts' => CriminalCourt::orderBy('criminal_court', 'asc')->where('criminal_court', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
