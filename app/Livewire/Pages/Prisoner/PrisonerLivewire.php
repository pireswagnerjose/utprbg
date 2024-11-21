<?php

namespace App\Livewire\Pages\Prisoner;

use App\Models\Admin\Municipality;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Admin\CivilStatus;
use App\Models\Admin\Country;
use App\Models\Admin\EducationLevel;
use App\Models\Admin\Ethnicity;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Sex;
use App\Models\Admin\SexualOrientation;
use App\Models\Admin\State;
use App\Models\Main\Prisoner;
use App\Services\Main\Prisoner\PrisonerService;
use App\Traits\Main\PrisonerMessageTrait;
use App\Traits\Main\PrisonerPropertyTrait;
use App\Traits\Main\PrisonerRuleTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

#[Layout("layouts.app")]
#[Title("Pesquisar")]
class PrisonerLivewire extends Component
{
    use WithPagination, PrisonerPropertyTrait, PrisonerRuleTrait, PrisonerMessageTrait;
    public $openModal = false;

    public function mount()
    {
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
     * Fecha o modal e reseta os valores dos campos
     * @return void
     */
    public function closeModal()
    {
        $this->openModal = false;
        $this->clearFields();
    }

    /**
     * Quando selecionado o estado, retorna os municípios equivalentes
     * @return void
     */
    public function selectMunicipality()
    {
        $this->municipalities = Municipality::where('state_id', $this->state_id)->get();
    }

    /**
     * Abre o modal para inserção dos dados
     * @return void
     */
    public function modal()
    {
        $this->user_create      = Auth::user()->id;
        $this->prison_unit_id   = Auth::user()->prison_unit_id;
        $this->openModal  = true;
    }

    /**
     * Insere os registros no banco e retorna para a página do preso cadastrado
     * @return void
     */
    public function save()
    {
        $data = $this->validate();
        $data = (new PrisonerService())->convertUppercase($data);
        $prisoner = Prisoner::create($data);
        $this->closeModal();
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $prisoner->id]);
    }
    public function render()
    {
        $prisoners = $this->search();
        return view('livewire.pages.prisoner.prisoner-livewire', compact('prisoners'));
    }

    /**
     * retorna os dados com os respectivos filtros da pesquisa
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(){
        $prisoners = Prisoner::orderBy('name', 'asc');
        $this->name ? $prisoners = $prisoners->whereLike('name', "%{$this->name}%") : null;
        $this->nickname ? $prisoners = $prisoners->whereLike('nickname', "%{$this->nickname}%") : null;
        $this->cpf ? $prisoners = $prisoners->whereLike('cpf', "%{$this->cpf}%") : null;
        $this->rg ? $prisoners = $prisoners->whereLike('rg',"%{$this->rg}%") : null;
        $this->title ? $prisoners = $prisoners->whereLike('title', "%{$this->title}%") : null;
        $this->birth_certificate ? $prisoners = $prisoners->whereLike('birth_certificate', "%{$this->birth_certificate}%") : null;
        $this->sus_card ? $prisoners = $prisoners->whereLike('sus_card',"%{$this->sus_card}%") : null;
        $this->status_prison_id ? $prisoners = $prisoners->whereLike('status_prison_id',"%{$this->status_prison_id}%") : null;
        $this->civil_status_id ? $prisoners = $prisoners->whereLike('civil_status_id',"%{$this->civil_status_id}%") : null;
        $this->ethnicity_id ? $prisoners = $prisoners->whereLike('ethnicity_id',"%{$this->ethnicity_id}%") : null;
        $this->sexual_orientation_id ? $prisoners = $prisoners->whereLike('sexual_orientation_id',"%{$this->sexual_orientation_id}%") : null;
        $this->country_id ? $prisoners = $prisoners->whereLike('country_id',"%{$this->country_id}%") : null;
        $prisoners = $prisoners->paginate(12);
        return $prisoners;
    }
}
