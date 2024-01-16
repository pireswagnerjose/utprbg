<?php

namespace App\Livewire\Main\Family;

use App\Models\Admin\Family\DegreeOfKinship;
use App\Models\Main\Family;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class FamilyLivewire extends Component
{
    use WithPagination;
    public $prisoner_id;
    public $user_create;
    public $user_update;
    public $prison_unit_id;
    public $name = '';
    public $contact = '';
    public $status;
    public $remark = '';
    public $degree_of_kinship_id = '';
    public $degree_of_kinships = [];

    public $statuses = ['ATIVO', 'INATIVO'];

    public function mount()
    {
        $this->user_create        =Auth::user()->id;
        $this->user_update        =Auth::user()->id;
        $this->prison_unit_id     =Auth::user()->prison_unit_id;
        $this->degree_of_kinships =DegreeOfKinship::all();
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('name', 'contact', 'status', 'remark', 'degree_of_kinship_id');
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalFamilyCreate = false;
        $this->openModalFamilyUpdate = false;
        $this->openModalFamilyDelete = false;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['name'] = mb_strtoupper ($dataValidated['name'],'utf-8');
        $dataValidated['contact'] = mb_strtoupper ($dataValidated['contact'],'utf-8');
        $dataValidated['status'] = mb_strtoupper ($dataValidated['status'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // MODAL CREATE
    public $openModalFamilyCreate = false;
    public function modalFamilyCreate()
    {
        $this->openModalFamilyCreate = true;
    }
    // CREATE
    public function familyCreate()
    {
        $dataValidated = $this->validate(
            [
                'name'                =>'required|max:100',
                'contact'             =>'nullable|max:100',
                'status'              =>'required|max:20',
                'remark'              =>'nullable',
                'user_create'         =>'required|max:10',
                'prison_unit_id'      =>'required|max:10',
                'prisoner_id'         =>'required|max:10',
                'degree_of_kinship_id'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        Family::create($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL UPDATE
    public $openModalFamilyUpdate = false;
    public function modalFamilyUpdate(Family $family)
    {
        $this->name                 =$family->name;
        $this->contact              =$family->contact;
        $this->status               =$family->status;
        $this->remark               =$family->remark;
        $this->user_create          =$family->user_create;
        $this->prison_unit_id       =$family->prison_unit_id;
        $this->prisoner_id          =$family->prisoner_id;
        $this->degree_of_kinship_id =$family->degree_of_kinship_id;
        $this->openModalFamilyUpdate = $family->id;
    }
    // UPDATE
    public function familyUpdate(Family $family)
    {
        $dataValidated = $this->validate(
            [
                'name'                =>'required|max:100',
                'contact'             =>'nullable|max:100',
                'status'              =>'required|max:20',
                'remark'              =>'nullable',
                'user_update'         =>'required|max:10',
                'degree_of_kinship_id'=>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        $family->update($dataValidated);
        $this->closeModal();
        $this->clearFields();
        $this->resetPage();
    }

    // MODAL DELETE 
    public $openModalFamilyDelete = false;
    public function modalFamilyDelete($family_id)
    {
        $this->openModalFamilyDelete = $family_id;
    }
    // DELETE
    public function familyDelete(Family $family)
    {
        $family->delete();
        $this->closeModal();
        $this->clearFields();
    }

    public function render()
    {
        return view('livewire.main.family.family-livewire', [
            'families' => Family::where('prisoner_id', $this->prisoner_id)->orderBy('name','asc')->paginate(10),
        ]);
    }
}
