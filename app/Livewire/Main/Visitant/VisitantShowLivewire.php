<?php

namespace App\Livewire\Main\Visitant;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\Municipality;
use App\Models\Admin\Sex;
use App\Models\Admin\State;
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
    public $date_of_birth = '';
    public $phone = '';
    public $street = '';
    public $number = '';
    public $complement = '';
    public $barrio = '';
    public $type_of_residence = '';
    public $status = '';
    public $remark = '';
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';
    public $civil_status_id = '';
    public $sex_id = '';
    public $municipality_id = '';
    public $state_id = '';
    public $civil_statuses = [];
    public $sexes = [];
    public $municipalities = [];
    public $states = [];

    public $municipalityEdit = [];

    public function mount()
    {   
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->civil_statuses   = CivilStatus::all();
        $this->sexes            = Sex::all();
        $this->states           = State::all();
    }

    // Seleciona o município conforme o estado escolhido
    public function selectMunicipality()
    {
        $this->municipalities = Municipality::where('state_id', $this->state_id)->get();
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['name'] = mb_strtoupper ($dataValidated['name'],'utf-8');
        $dataValidated['street'] = mb_strtoupper ($dataValidated['street'],'utf-8');
        $dataValidated['complement'] = mb_strtoupper ($dataValidated['complement'],'utf-8');
        $dataValidated['barrio'] = mb_strtoupper ($dataValidated['barrio'],'utf-8');
        $dataValidated['type_of_residence'] = mb_strtoupper ($dataValidated['type_of_residence'],'utf-8');
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
            'name','photo','cpf','date_of_birth','street','complement','barrio','type_of_residence','phone','status','remark',
            'civil_status_id','sex_id','municipality_id','state_id'
        );
    }

    // MODAL UPDATE
    public $openModalVisitantEdit = false;
    public function modalVisitantEdit(Visitant $visitant)
    {
        $this->clearFields();
        $this->name = $visitant->name;
        $this->date_of_birth = $visitant->date_of_birth;
        $this->cpf = $visitant->cpf;
        $this->phone = $visitant->phone;
        $this->street = $visitant->street;
        $this->number = $visitant->number;
        $this->complement = $visitant->complement;
        $this->barrio = $visitant->barrio;
        $this->type_of_residence = $visitant->type_of_residence;
        $this->status = $visitant->status;
        $this->prison_unit_id = $visitant->prison_unit_id;
        $this->user_update = $visitant->user_update;
        $this->remark = $visitant->remark;
        $this->civil_status_id = $visitant->civil_status_id;
        $this->sex_id = $visitant->sex_id;
        $this->municipality_id = $visitant->municipality_id;
        $this->state_id = $visitant->state_id;
        $this->openModalVisitantEdit = $visitant->id;
    }

    //UPDATE
    public function visitantUpdate(Visitant $visitant)
    {
        if ($this->photo) {
            $dataValidated = $this->validate(
                [
                    'name'              =>'required|max:100',
                    'photo'             =>'required|mimes:jpeg,jpg,png',
                    'date_of_birth'     =>'required',
                    'cpf'               =>"required|min:14|max:14|unique:visitants,cpf,{$this->visitant_id},id",
                    'phone'             =>'required|min:15|max:15',
                    'street'            =>'required|max:255',
                    'number'            =>'nullable|max:50',
                    'complement'        =>'nullable|max:255',
                    'barrio'            =>'nullable|max:255',
                    'type_of_residence' =>'required|max:255',
                    'status'            =>'required|max:10',
                    'prison_unit_id'    =>'required|max:10',
                    'civil_status_id'   =>'required|max:10',
                    'sex_id'            =>'required|max:10',
                    'municipality_id'   =>'required|max:10',
                    'state_id'          =>'required|max:10',
                    'user_create'       =>'required|max:10',
                    'remark'            =>'nullable',
                ]
            );
        } else {
            $dataValidated = $this->validate(
                [
                    'name'              =>'required|max:100',
                    'date_of_birth'     =>'required',
                    'cpf'               =>"required|min:14|max:14|unique:visitants,cpf,{$this->visitant_id},id",
                    'phone'             =>'required|min:15|max:15',
                    'street'            =>'required|max:255',
                    'number'            =>'nullable|max:50',
                    'complement'        =>'nullable|max:255',
                    'barrio'            =>'nullable|max:255',
                    'type_of_residence' =>'required|max:255',
                    'status'            =>'required|max:10',
                    'prison_unit_id'    =>'required|max:10',
                    'civil_status_id'   =>'required|max:10',
                    'sex_id'            =>'required|max:10',
                    'municipality_id'   =>'required|max:10',
                    'state_id'          =>'required|max:10',
                    'user_create'       =>'required|max:10',
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
            $photo = $visitant->id . ' - ' . $visitant_name . '.' . $dataValidated['photo']->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('visitant/' . 'id - ' . $visitant->id, $photo);
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
        $visitant_delete = explode('/', $visitant->photo);//pega o endereço do diretório a ser excluído
        $diretory_delete = $visitant_delete[0]. '/' .$visitant_delete[1];//recupera o diretório a ser excluído
        
        /* responsável por excluir o documento */
        if (!empty($visitant->photo)) {
            Storage::disk('public')->deleteDirectory($diretory_delete);
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
