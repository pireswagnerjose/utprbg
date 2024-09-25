<?php

namespace App\Livewire\Main\Visitant;

use App\Models\Main\Visitant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class VisitantCreateLivewire extends Component
{
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

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset(
            'name','photo','cpf','address','phone','status','remark'
        );
    }

    public function create()
    {
        $dataValidated = $this->validate(
            [
                'name'              =>'required|max:100',
                'photo'             =>'required|mimes:jpeg,jpg,png',
                'cpf'               =>'required|min:14|max:14|unique:visitants',
                'address'           =>'required|max:255',
                'phone'             =>'required|min:15|max:15',
                'status'            =>'required|max:10',
                'prison_unit_id'    =>'required|max:10',
                'user_create'       =>'required|max:10',
                'user_update'       =>'required|max:10',
                'remark'            =>'nullable',
            ]
        );

        if ($this->photo) {
            $visitant_name = trim($this->name);
            $visitant_name = str_replace("/", "-", $this->name);
            /* cria o nome da photo com a extensão */
            $photo = $visitant_name . ' - ' . date('d-m-Y_H_m_s') . '.' . $dataValidated['photo']->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('visitant/' . $photo);
        }

        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        //Remove espaço em branco no começo do nome
        $dataValidated['name'] = trim($dataValidated['name']);
        // Cadastra os dados no banco
        Visitant::create($dataValidated);
        // Limpa os campos
        $this->clearFields();
        $visitant_id = Visitant::orderBy('created_at', 'desc')->first()->id;
        $this->redirectRoute('visitant.show', ['visitant_id' => $visitant_id]);
    }

    public function render()
    {
        return view('livewire.main.visitant.visitant-create-livewire');
    }
}
