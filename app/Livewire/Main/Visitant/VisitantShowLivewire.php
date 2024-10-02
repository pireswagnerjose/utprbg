<?php

namespace App\Livewire\Main\Visitant;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Main\Visitant;
use Livewire\Component;

class VisitantShowLivewire extends Component
{
    public $visitant_id;

    use WithFileUploads;

    public $name = '';
    public $photo = '';
    public $cpf = '';
    public $address = '';
    public $phone = '';
    public $status = '';
    public $remark = '';
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';

    public function mount()
    {   
        $this->prison_unit_id       = Auth::user()->prison_unit_id;
        $this->user_create          = Auth::user()->id;
        $this->user_update          = Auth::user()->id;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['name'] = mb_strtoupper ($dataValidated['name'],'utf-8');
        $dataValidated['address'] = mb_strtoupper ($dataValidated['address'],'utf-8');
        $dataValidated['status'] = mb_strtoupper ($dataValidated['status'],'utf-8');
        $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
        return $dataValidated;
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->openModalVisitantEdit = false;
        $this->openModalVisitantDelete = false;
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset(
            'name','photo','cpf','address','phone','status','remark'
        );
    }

    // MODAL UPDATE
    public $openModalVisitantEdit = false;
    public function modalVisitantEdit(Visitant $visitant)
    {
        $this->clearFields();
        $this->name = $visitant->name;
        //$this->photo = $visitant->photo;
        $this->cpf = $visitant->cpf;
        $this->address = $visitant->address;
        $this->phone = $visitant->phone;
        $this->status = $visitant->status;
        $this->prison_unit_id = $visitant->prison_unit_id;
        $this->user_create = $visitant->user_create;
        $this->user_update = $visitant->user_update;
        $this->remark = $visitant->remark;
        $this->openModalVisitantEdit = $visitant->id;
    }

    //UPDATE
    public function visitantUpdate(Visitant $visitant)
    {
        if ($this->photo) {
            $dataValidated = $this->validate(
                [
                    'name'              =>'required|max:100',
                    'photo'             =>'nullable|mimes:jpeg,jpg,png',
                    'cpf'               =>"required|min:14|max:14|unique:visitants,cpf,{$this->visitant_id},id",
                    'address'           =>'required|max:255',
                    'phone'             =>'required|min:15|max:15',
                    'status'            =>'required|max:10',
                    'prison_unit_id'    =>'required|max:10',
                    'user_create'       =>'required|max:10',
                    'user_update'       =>'required|max:10',
                    'remark'            =>'nullable',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'name'              =>'required|max:100',
                    'cpf'               =>"required|min:14|max:14|unique:visitants,cpf,{$this->visitant_id},id",
                    'address'           =>'required|max:255',
                    'phone'             =>'required|min:15|max:15',
                    'status'            =>'required|max:10',
                    'prison_unit_id'    =>'required|max:10',
                    'user_create'       =>'required|max:10',
                    'user_update'       =>'required|max:10',
                    'remark'            =>'nullable',
                ]
            );
        }

        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);

        if (!empty($dataValidated['photo'])) {
            /* responsável por excluir o documento */
            if (!empty($this->photo)) {
                Storage::disk('public')->delete($visitant->photo);
            }
            $visitant_name = trim($this->name);
            $visitant_name = str_replace("/", "-", $this->name);
            /* cria o nome da photo com a extensão */
            $photo = $visitant_name . ' - ' . date('d-m-Y_H_m_s') . '.' . $dataValidated['photo']->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('visitant/' . $photo);
        }
        $visitant->update($dataValidated);
        $this->openModalVisitantEdit = false;
        $this->clearFields();
    }

    public $openModalVisitantDelete = false;
    public function modalVisitantDelete($visitant_id)
    {
        $this->openModalVisitantDelete = $visitant_id;
    }
    //DELETE
    public function visitantDelete(Visitant $visitant)
    {
        /* responsável por excluir o documento */
        if (!empty($visitant->photo)) {
            Storage::disk('public')->delete($visitant->photo);
        }
        $visitant->delete();
        $this->openModalVisitantDelete = false;
        $this->redirectRoute('visitant.index');
    }

    public function render()
    {
        return view('livewire.main.visitant.visitant-show-livewire', [
            'visitant' => Visitant::where('id', $this->visitant_id)->first()
        ]);
    }
}
