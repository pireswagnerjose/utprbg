<?php

namespace App\Livewire\Main\Visitant;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\Municipality;
use App\Models\Admin\Sex;
use App\Models\Admin\State;
use App\Models\Main\Visitant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class VisitantCreateLivewire extends Component
{
    use WithFileUploads;

    public $name = '';

    #[Validate('required|mimes:jpeg,jpg,png')] 
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

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset(
            'name','photo','cpf','date_of_birth','street','complement','barrio','type_of_residence','phone','status','remark',
            'civil_status_id','sex_id','municipality_id','state_id'
        );
    }

    public function cancel()
    {
        redirect('dashboard');
    }

    //CREATE
    public function create()
    {
        $dataValidated = $this->validate(
            [
                'name'              =>'required|max:100',
                'photo'             =>'required|mimes:jpeg,jpg,png',
                'date_of_birth'     =>'required',
                'cpf'               =>'required|min:14|max:14|unique:visitants',
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
        $dataValidated = $this->convertUppercase($dataValidated);// Transforma os caracteres em maiusculos 
        $dataValidated['name'] = trim($dataValidated['name']);//Remove espaço em branco no começo do nome 
        $visitant = Visitant::create($dataValidated);// Cadastra os dados no banco
        
        // Cadastra a foto do visitante
        if ($visitant) {
            $visitant_name = trim($visitant->name);//Limpa os espaços vazios no início do nome
            $visitant_name = str_replace("/", "-", $this->name);//substitui a barra por traço no nome
            $photo = $visitant->id . ' - ' . $visitant_name . '.' . $dataValidated['photo']->getClientOriginalExtension();/* cria o nome da photo com a extensão */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('visitant/' . 'id - ' . $visitant->id, $photo);/* faz o upload e retorna o endereco do arquivo */
            $visitant->update($dataValidated);//Atualiza o endereço da foto no banco
        } 
        $this->clearFields();// Limpa os campos
        $this->redirectRoute('visitant.show', ['visitant_id' => $visitant->id]);// Redireciona para a página do visitante cadastrado
    }

    public function render()
    {
        return view('livewire.main.visitant.visitant-create-livewire');
    }
}
