<?php

namespace App\Livewire\Forms;

use App\Models\Admin\LegalAssistance\Lawyer;
use App\Services\Lawyer\LawyerService;
use App\Traits\LawyerTrait;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class LawyerForm extends Form
{
    public ?Lawyer $lawyer_model;
    use LawyerTrait;

    //properties
    public $photo;
    public $lawyer;
    public $register;
    public $contact;
    public $remark;

    public int $user_create;
    public int $user_update;
    public $prison_unit_id;

    // limpar campos
    public function clearFields()
    {
        $this->reset('photo', 'lawyer', 'register', 'contact', 'remark');
    }

    public function setPost($lawyer)
    {
        $this->lawyer_model = $lawyer;
        $this->photo = $lawyer->photo;
        $this->lawyer = $lawyer->lawyer;
        $this->register = $lawyer->register;
        $this->contact = $lawyer->contact;
        $this->remark = $lawyer->remark;
        $this->user_update = Auth::user()->id;
        $this->prison_unit_id = Auth::user()->prison_unit_id;
    }

    public function store()
    {
        $dataValidated = $this->validate();
        $dataValidated = (new LawyerService())->photoCreate($dataValidated);
        $dataValidated = (new LawyerService())->convertUppercase($dataValidated);
        Lawyer::create($dataValidated);
    }
 
    public function update($dataValidated)
    {
        $dataValidated = (new LawyerService())->photoCreate($dataValidated);
        $dataValidated = (new LawyerService())->convertUppercase($dataValidated);
        $this->lawyer_model->update($dataValidated);
    }

    public function delete($lawyer)
    {
        /* responsável por excluir o arquivo */
        if (!empty($lawyer->photo)) {
            Storage::disk('public')->deleteDirectory('lawyer/register - '.$lawyer['register']);
        }
        $lawyer->delete();
    }
}
