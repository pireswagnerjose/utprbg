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
use App\Models\Main\UnitAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\WithPagination;


#[Title("Exibir Preso")]
class PrisonerShowLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $prisoner_id;

    // DATA
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
    public $user_update = '';
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

    public $prisonerMul; //id do preso a ser exibido na view

    public $municipalityEdit = []; //quando for editar o município

    public function mount()
    {
        $this->prisonerMul = Prisoner::find($this->prisoner_id);
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

    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset(
            'name',
            'nickname',
            'date_birth',
            'cpf',
            'rg',
            'title',
            'birth_certificate',
            'reservist',
            'sus_card',
            'rji',
            'mother',
            'father',
            'profession',
            'sexual_orientation_id',
            'ethnicity_id',
            'education_level_id',
            'civil_status_id',
            'sex_id',
            'municipality_id',
            'remarks'
        );
    }

    // CLOSE MODALS
    public function closeModal()
    {
        $this->openModalPrisonerUpdate = false;
        $this->openModalProfilePhoto = false;
        $this->openModalPrisonerDelete = false;
        $this->openModalProfilePhoto = false;
        $this->dispatch('prisoner::prisonerShowLivewire::refresh');
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }

    public function selectMunicipality()
    {
        $this->municipalities = Municipality::where('state_id', $this->state_id)->get();
    }

    // MODAL UPDATE
    public $openModalPrisonerUpdate = false;
    public function modalPrisonerUpdate(Prisoner $prisoner)
    {
        $this->municipalityEdit     = Municipality::find($prisoner->municipality_id);
        $this->name                  = $prisoner->name;
        $this->nickname              = $prisoner->nickname;
        $this->date_birth            = \Carbon\Carbon::parse($prisoner->date_birth)->format('d/m/Y'); //converte data para o padrão pt-br
        $this->cpf                   = $prisoner->cpf;
        $this->rg                    = $prisoner->rg;
        $this->title                 = $prisoner->title;
        $this->birth_certificate     = $prisoner->birth_certificate;
        $this->reservist             = $prisoner->reservist;
        $this->sus_card              = $prisoner->sus_card;
        $this->rji                   = $prisoner->rji;
        $this->profession            = $prisoner->profession;
        $this->status_prison_id      = $prisoner->status_prison_id;
        $this->mother                = $prisoner->mother;
        $this->father                = $prisoner->father;
        $this->education_level_id    = $prisoner->education_level_id;
        $this->civil_status_id       = $prisoner->civil_status_id;
        $this->sex_id                = $prisoner->sex_id;
        $this->sexual_orientation_id = $prisoner->sexual_orientation_id;
        $this->ethnicity_id          = $prisoner->ethnicity_id;
        $this->municipality_id       = $prisoner->municipality_id;
        $this->country_id            = $prisoner->country_id;
        $this->state_id              = $prisoner->state_id;
        $this->prison_unit_id        = $prisoner->prison_unit_id;
        $this->user_update           = $prisoner->user_update;
        $this->remarks               = $prisoner->remarks;

        $this->openModalPrisonerUpdate  = $prisoner->id;
    }
    public function prisonerUpdate(Prisoner $prisoner, PrisonerAccessory $prisonerAccessory)
    {
        $dataValidated = $this->validate(
            [
                'name'                  => 'required|max:100',
                'nickname'              => 'nullable|max:100',
                'date_birth'            => 'required|min:10|max:10',
                'cpf'                   => ['nullable', 'min:14', 'max:14'],
                'rg'                    => "nullable|max:50",
                'title'                 => "nullable|min:14|max:14|unique:prisoners,title,{$this->prisoner_id},id",
                'birth_certificate'     => "nullable|max:60|unique:prisoners,birth_certificate,{$this->prisoner_id},id",
                'reservist'             => "nullable|max:60|unique:prisoners,reservist,{$this->prisoner_id},id",
                'sus_card'              => "nullable|min:19|max:19|unique:prisoners,sus_card,{$this->prisoner_id},id",
                'rji'                   => "nullable|min:12|max:12",
                'profession'            => 'nullable|max:100',
                'status_prison_id'      => 'required|max:100',
                'mother'                => 'nullable|max:100',
                'father'                => 'nullable|max:100',
                'education_level_id'    => 'required|max:20',
                'civil_status_id'       => 'required|max:20',
                'sex_id'                => 'required|max:20',
                'sexual_orientation_id' => 'required|max:20',
                'ethnicity_id'          => 'required|max:20',
                'municipality_id'       => 'required|max:20',
                'country_id'            => 'required|max:20',
                'state_id'              => 'required|max:20',
                'prison_unit_id'        => 'required|max:10',
                'user_update'           => 'nullable|max:10',
                'remarks'               => 'nullable',
            ]
        );
        // converte data para o padrão americano
        $dataValidated = $prisonerAccessory->convertDate($dataValidated);
        // Transforma os caracteres em maiusculos
        $dataValidated = $prisonerAccessory->convertUppercase($dataValidated);
        //Remove espaço em branco no começo do nome
        $dataValidated['name'] = trim($dataValidated['name']);
        // Atualiza os dados no banco
        $prisoner->update($dataValidated);
        $this->clearFields();
        $this->closeModal();
        session()->flash('success', 'Criado com sucesso.');
    }

    // MODAL DELETE
    public $openModalPrisonerDelete = false;
    public $prisoner_name;
    public function modalPrisonerDelete($prisonerID)
    {
        $this->prisoner_name = Prisoner::where('id', $prisonerID)->first()->name;
        $this->openModalPrisonerDelete = $prisonerID;
    }
    // DELETE
    public function prisonerDelete(Prisoner $prisoner)
    {
        $prisoner->delete();
        $this->openModalPrisonerDelete = false;
        $this->redirect(PrisonerLivewire::class);
        //$this->redirectRoute('prisoners.search');
    }

    // MODAL PHOTO PROFILE - MODAL DA FOTO DO PERFIL
    public $openModalProfilePhoto = false;
    public function modalPrisonerProfilePhoto(Prisoner $prisoner)
    {
        $this->openModalProfilePhoto = $prisoner->id;
    }
    public $photo;
    public function profilePhoto(Prisoner $prisoner)
    {
        $dataValidated = $this->validate(
            [
                'photo' => 'mimes:jpeg,jpg,png',
            ]
        );
        if ($this->photo) {
            $prisoner_name = trim($prisoner['name']);
            $prisoner_name = str_replace("/", "-", $prisoner['name']);
            /* responsável por excluir o diretório e a foto */
            if (!empty($prisoner->photo)) {
                Storage::disk('public')->delete($prisoner->photo);
            }
            /* cria o nome da photo com a extensão */
            $photo = $prisoner_name . '.' . $dataValidated['photo']->getClientOriginalExtension();
            /* faz o upload e retorna o endereco do arquivo */
            $dataValidated['photo'] = $dataValidated['photo']->storeAs('prisoner/' . $prisoner['id'], $photo);
        }
        $prisoner->update($dataValidated);
        $this->openModalProfilePhoto = false;
        $this->reset('photo');
        $this->dispatch('prisoner::prisonerShowLivewire::refresh');
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }

    public function render()
    {
        return view('livewire.main.prisoner.prisoner-show-livewire', [
            'prisoner' => Prisoner::where('id', $this->prisoner_id)->first(),
            'unitAddress' => UnitAddress::where('prisoner_id', 'like', "%{$this->prisoner_id}%")
                            ->orWhere("status","=", "ATIVO")->first()
        ]);
    }

    // MODAL REPORT
    public $openModalReport = false;
    public function modalReport($prisoner_id)
    {
        $this->openModalReport = true;
    }
    public function closeModalReport()
    {
        $this->openModalReport = false;
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }
}
