<?php

namespace App\Livewire\Pages\Prisoner;

use App\Livewire\Forms\Main\PrisonerForm;
use App\Models\Admin\CivilStatus;
use App\Models\Admin\Country;
use App\Models\Admin\EducationLevel;
use App\Models\Admin\Ethnicity;
use App\Models\Admin\Municipality;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Sex;
use App\Models\Admin\SexualOrientation;
use App\Models\Admin\State;
use App\Models\Main\IdentificationCard;
use App\Models\Main\Prisoner;
use App\Services\Main\Prisoner\PrisonerService;
use App\Traits\Main\PrisonerMessageTrait;
use App\Traits\Main\PrisonerPropertyTrait;
use App\Traits\Main\PrisonerRuleTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title("Exibir Preso")]
class PrisonerShowLivewire extends Component
{
    use WithPagination, WithFileUploads, PrisonerPropertyTrait, PrisonerRuleTrait, PrisonerMessageTrait;
    public $prisoner_id;
    public $openModal = false;
    public $openModalProfilePhoto = false;
    public $openModalReport = false;

    public $prisonerMul; //id do preso a ser exibido na view
    public $municipalityEdit = []; //quando for editar o município

    public function mount()
    {
        $this->prisonerMul          = Prisoner::find($this->prisoner_id);
        $this->status_prisons       = StatusPrison::all();
        $this->education_levels     = EducationLevel::all();
        $this->civil_statuses       = CivilStatus::all();
        $this->sexes                = Sex::all();
        $this->sexual_orientations  = SexualOrientation::all();
        $this->ethnicities          = Ethnicity::all();
        $this->states               = State::all();
        $this->countries            = Country::all();
    }

    /**
     * Fecha os modais
     * @return void
     */
    public function closeModal()
    {
        $this->openModal = false;
        $this->openModalProfilePhoto = false;
        $this->clearFields();
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }

    /**
     * Retorna os Municípios conforme o estado selecionado
     * @return void
     */
    public function selectMunicipality()
    {
        $this->municipalities = Municipality::where('state_id', $this->state_id)->get();
    }

    /**
     * Abre o modal para a edição dos dados do preso
     * @param \App\Models\Main\Prisoner $prisoner
     * @return void
     */
    public function modal(Prisoner $prisoner)
    {
        $this->municipalityEdit      = Municipality::find($prisoner->municipality_id);

        $this->prisoner              = $prisoner;
        $this->name                  = $prisoner->name;
        $this->nickname              = $prisoner->nickname;
        $this->date_birth            = $prisoner->date_birth;
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
        $this->prison_unit_id        = Auth::user()->prison_unit_id;
        $this->user_update           = Auth::user()->id;
        $this->remarks               = $prisoner->remarks;
        
        $this->openModal             = $prisoner->id;
    }

    /**
     * Atualiza os dados do preso
     * @return void
     */
    public function save()
    {
        $data = $this->validate();
        $data = (new PrisonerService())->convertUppercase($data);
        $data['name'] = trim($data['name']);
        $prisoner = $this->prisoner->update($data);
        $this->closeModal();
        if ($prisoner) {
            session()->flash('success', 'Os dados do Preso foi atualizado com sucesso!');
        }
        else{
            session()->flash('error', 'Não foi possível atualizar os dados do Preso, por favor tente novamente.');
        }
    }

    /**
     * Exclui o preso
     * @param \App\Models\Main\Prisoner $prisoner
     * @return void
     */
    public function delete(Prisoner $prisoner)
    {
        $prisoner->delete();
        session()->flash('success', 'Excluído com sucesso.');
        $this->redirectRoute('prisoners.search');
    }

    /**
     * Abre o modal para inserção da foto do perfil
     * @param \App\Models\Main\Prisoner $prisoner
     * @return void
     */
    public function modalProfilePhoto(Prisoner $prisoner)
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
            $prisoner_name = trim($prisoner->name);
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
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }
    
    /**
     * Abre o modal para selecionar os itens do relatório
     * @param mixed $prisoner_id
     * @return void
     */
    public function modalReport($prisoner_id)
    {
        $this->openModalReport = true;
    }

    /**
     * fecha o modal de relatórios
     * @return void
     */
    public function closeModalReport()
    {
        $this->openModalReport = false;
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }

    public function render()
    {
        $identification_cards = IdentificationCard::where('prisoner_id', $this->prisoner_id)->get();
        $prisoner_show = Prisoner::where('id', $this->prisoner_id)
        ->with('status_prison', 'education_level', 'civil_status', 'sex', 'sexual_orientation',
        'ethnicity', 'country', 'municipality', 'state')
        ->first();
        return view('livewire.pages.prisoner.prisoner-show-livewire', compact('prisoner_show', 'identification_cards'));
    }
}
