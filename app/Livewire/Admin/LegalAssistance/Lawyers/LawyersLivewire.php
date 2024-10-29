<?php

namespace App\Livewire\Admin\LegalAssistance\Lawyers;

use App\Livewire\Forms\LawyerForm;
use App\Models\Admin\LegalAssistance\Lawyer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout("layouts.app")]
#[Title("Advogado")]
class LawyersLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    public LawyerForm $lawyer_form;

    public function mount()
    {
        $this->lawyer_form->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->lawyer_form->user_create      = Auth::user()->id;
    }
    // search
    #[Url]
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    // add new
    public $add_new;
    public function addNew()
    {
        $this->add_new = true;
        $this->lawyer_form->clearFields();
    }
    // close modal
    public function closeModal()
    {
        $this->add_new = false;
        $this->openModalDelete = false;
        $this->openModalUpdate = false;
        $this->lawyer_form->clearFields();
    }
    // crete
    public function create()
    {
        $this->lawyer_form->store();
        $this->lawyer_form->clearFields();
        session()->flash('success', 'Criado com sucesso.');
        $this->add_new = false;
    }
    // modal update
    public $openModalUpdate = false;
    public function modalUpdate(Lawyer $lawyer)
    {
        $this->lawyer_form->setPost($lawyer);
        $this->openModalUpdate = true;
    }
    // update
    public function update()
    {
        $dataValidated = $this->validate();
        $this->lawyer_form->update($dataValidated);
        $this->openModalUpdate = false;
        $this->lawyer_form->clearFields();
        session()->flash('success', 'Atualizado com sucesso.');
    }
    // modal delete
    public $openModalDelete = false;
    public function modalDelete($lawyer)
    {
        $this->openModalDelete = $lawyer;
    }
    // delete
    public function delete(Lawyer $lawyer)
    {
        $this->lawyer_form->delete($lawyer);
        $this->openModalDelete = false;
        $this->lawyer_form->clearFields();
        session()->flash('success', 'Excluído com sucesso.');
    }
    public function render()
    {
        return view('livewire.admin.legal-assistance.lawyers.lawyers-livewire', [
            'lawyers' => Lawyer::orderBy('lawyer', 'asc')->where('lawyer', 'like', "%{$this->search}%")->paginate(10)
        ]);
    }
}
