<?php

namespace App\Livewire\Admin\LegalAssistance\Lawyers;

use App\Models\Admin\LegalAssistance\Lawyer;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Livewire\Forms\LawyerForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout("layouts.app")]
#[Title("Advogado")]
class LawyersShowLivewire extends Component
{
    use WithFileUploads;
    public LawyerForm $lawyer_form;

    public $lawyer_id;

    // close modal
    public function closeModal()
    {
        $this->openModalDelete = false;
        $this->openModalUpdate = false;
        $this->lawyer_form->clearFields();
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
        $this->redirectRoute('lawyers.index');
    }

    public function render()
    {
        $lawyer = Lawyer::find($this->lawyer_id);
        return view('livewire.admin.legal-assistance.lawyers.lawyers-show-livewire', compact("lawyer"));
    }
}
