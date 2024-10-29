<?php

namespace App\Livewire\Admin\PublicDefender;

use App\Livewire\Admin\PublicDefender\Traits\PublicDefenderPropertiesRulesTrait;
use App\Models\Admin\PublicDefender\PublicDefender;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Defensor Público")]
class PublicDefenderLivewire extends Component
{
    use WithPagination;
    use PublicDefenderPropertiesRulesTrait;//Trait com a validação dos dados

    public $public_defender = '';
    public $contact = '';
    public $user_create = '';
    public $user_update = '';
    public $prison_unit_id = '';
    public $public_defender_id = '';

    public function mount()
    {
        $this->prison_unit_id = Auth::user()->prison_unit_id;
        $this->user_create = Auth::user()->id;
        $this->user_update = Auth::user()->id;
    }

    // SEARCH - PESQUISA
    #[Url]
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //ADD NEW - ADICIONAR NOVO 
    public $add_new = false;
    public function addNew()
    {
        $this->add_new = true;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('public_defender', 'contact');
        $this->openModalPublicDefenderUpdate = false;
        $this->openModalPublicDefenderDelete = false;
    }

    //CANCEL
    public function cancel()
    {
        $this->add_new = false;
        $this->clearFields();
    }

    //STORE
    public function store()
    {
        $data = $this->validate();
        PublicDefender::create($data);
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
        $this->add_new = false;
    }

    // MODAL UPDATE
    public $openModalPublicDefenderUpdate = false;
    public function modaPublicDefenderUpdate(PublicDefender $public_defender)
    {
        $this->public_defender_id = $public_defender->id;
        $this->public_defender  = $public_defender->public_defender;
        $this->contact  = $public_defender->contact;
        $this->openModalPublicDefenderUpdate = $public_defender->id;
    }

    // UPDATE
    public function update(PublicDefender $public_defender)
    {
        $data = $this->validate();
        $public_defender->update($data);
        $this->clearFields();
        $this->openModalPublicDefenderUpdate = false;
        session()->flash('success', 'Atualizado com sucesso.');
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPublicDefenderDelete = false;
    public function modalPublicDefenderDelete($public_defender_id)
    {
        $this->openModalPublicDefenderDelete = $public_defender_id;
    }
    // DELETE
    public function deletePublicDefender(PublicDefender $public_defender)
    {
        $public_defender->delete();
        session()->flash('success', 'Excluído com sucesso.');
        $this->openModalPublicDefenderDelete = false;
        $this->resetPage();
    }

    public function render()
    {
        $public_defenders = PublicDefender::orderBy('public_defender','asc')
            ->where('public_defender', 'like', "%{$this->search}%")
            ->orWhere('contact', 'like', "%{$this->search}%")
            ->paginate(10);
        return view('livewire.admin.public-defender.public-defender-livewire', compact( 'public_defenders' ));
    }
}