<?php

namespace App\Livewire\Main\Prisoner;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\Country;
use App\Models\Admin\EducationLevel;
use App\Models\Admin\Ethnicity;
use App\Models\Admin\Municipality;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Sex;
use App\Models\Admin\SexualOrientation;
use App\Models\Admin\State;
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Cadastrar Preso")]
class PrisonerCreateLivewire extends Component
{   
    use WithPagination;
    
    public $name = '';
    public $nickname = '';
    public $date_birth;
    public $cpf = '';
    public $rg = '';
    public $title = '';
    public $birth_certificate = '';
    public $reservist = '';
    public $sus_card = '';
    public $rji = '';
    public $mother = '';
    public $father = '';
    public $profession = '';
    public $user_create = '';
    public $user_update= '';
    public $prison_unit_id = '';
    public $educationLevelID;
    public $sexual_orientation_id = '';
    public $ethnicity_id = '';
    public $education_level_id = '';
    public $civil_status_id = '';
    public $sex_id = '';
    public $municipality_id = '';
    public $state_id = '';
    public $country_id = '';
    public $status_prison_id = '';
    public $remarks = '';
    public $status_prisons = [];
    public $education_levels = [];
    public $civil_statuses = [];
    public $sexes = [];
    public $sexual_orientations = [];
    public $ethnicities = [];
    public $municipalities = [];
    public $states = [];
    public $countries = [];
    
    public function mount()
    {   
        $this->prison_unit_id       = Auth::user()->prison_unit_id;
        $this->user_create          = Auth::user()->id;
        $this->user_update          = Auth::user()->id;
        $this->status_prisons       = StatusPrison::all();
        $this->education_levels     = EducationLevel::all();
        $this->civil_statuses       = CivilStatus::all();
        $this->sexes                = Sex::all();
        $this->sexual_orientations  = SexualOrientation::all();
        $this->ethnicities          = Ethnicity::all();
        $this->states               = State::all();
        $this->countries            = Country::all();
    }
    public function selectMunicipality()
    {
        $this->municipalities = Municipality::where('state_id', $this->state_id)->get();
    }
    public function cancel()
    {
        redirect('dashboard');
    }

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset(
            'name','nickname','date_birth','cpf','rg','title','birth_certificate','reservist','sus_card','rji',
            'mother','father','profession','sexual_orientation_id','ethnicity_id','education_level_id', 'remarks',
            'civil_status_id','sex_id','municipality_id'
        );
    }

    public function create(PrisonerAccessory $prisonerAccessory)
    {
        $dataValidated = $this->validate(
            [
                'name'                  =>'required|max:100',
                'nickname'              =>'nullable|max:100',
                'date_birth'            =>'required|min:10|max:10',
                'cpf'                   =>'nullable|min:14|max:14|unique:prisoners',
                'rg'                    =>'nullable|max:50|unique:prisoners',
                'title'                 =>'nullable|min:14|max:14|unique:prisoners',
                'birth_certificate'     =>'nullable|max:60|unique:prisoners',
                'reservist'             =>'nullable|max:60|unique:prisoners',
                'sus_card'              =>'nullable|min:19|max:19|unique:prisoners',
                'rji'                   =>'nullable|min:12|max:12|unique:prisoners',
                'profession'            =>'nullable|max:100',
                'status_prison_id'      =>'required|max:100',
                'mother'                =>'nullable|max:100',
                'father'                =>'nullable|max:100',
                'education_level_id'    =>'required|max:20',
                'civil_status_id'       =>'required|max:20',
                'sex_id'                =>'required|max:20',
                'sexual_orientation_id' =>'required|max:20',
                'ethnicity_id'          =>'required|max:20',
                'municipality_id'       =>'required|max:20',
                'country_id'            =>'required|max:20',
                'state_id'              =>'required|max:20',
                'prison_unit_id'        =>'required|max:10',
                'user_create'           =>'nullable|max:10',
                'remarks'               =>'nullable',
            ]
        );
        // converte data para o padrão americano
        $dataValidated = $prisonerAccessory->convertDate($dataValidated);
        // Transforma os caracteres em maiusculos
        $dataValidated = $prisonerAccessory->convertUppercase($dataValidated);
        //Remove espaço em branco no começo do nome
        $dataValidated['name'] = trim($dataValidated['name']);
        // Cadastra os dados no banco
        Prisoner::create($dataValidated);
        // Limpa os campos
        $this->clearFields();
        session()->flash('success', 'Criado com sucesso.');
        $prisoner_id = Prisoner::orderBy('created_at', 'desc')->first()->id;
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $prisoner_id]);
    }

    public function render()
    {
        return view('livewire.main.prisoner.prisoner-create-livewire');
    }
}
