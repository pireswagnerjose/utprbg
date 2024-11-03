<?php

namespace App\Livewire\Main\Prisoner;

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
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\WithPagination;


#[Title("Exibir Preso")]
class PrisonerShowLivewire extends Component
{
    public PrisonerForm $prisonerForm;

    use WithFileUploads;
    use WithPagination;
    public $prisoner_id;
    public $openModalUpdate = false;
    public $openModalDelete = false;

    public $prisonerMul; //id do preso a ser exibido na view
    public $municipalityEdit = []; //quando for editar o município

    public function mount()
    {
        $this->prisonerMul                        = Prisoner::find($this->prisoner_id);
        $this->prisonerForm->status_prisons       = StatusPrison::all();
        $this->prisonerForm->education_levels     = EducationLevel::all();
        $this->prisonerForm->civil_statuses       = CivilStatus::all();
        $this->prisonerForm->sexes                = Sex::all();
        $this->prisonerForm->sexual_orientations  = SexualOrientation::all();
        $this->prisonerForm->ethnicities          = Ethnicity::all();
        $this->prisonerForm->states               = State::all();
        $this->prisonerForm->countries            = Country::all();
    }

    // CLOSE MODALS
    public function closeModal()
    {
        $this->openModalUpdate = false;
        $this->openModalProfilePhoto = false;
        $this->openModalDelete = false;
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }

    public function selectMunicipality()
    {
        $this->prisonerForm->municipalities = Municipality::where('state_id', $this->prisonerForm->state_id)->get();
    }

    // MODAL UPDATE
    public function modalUpdate(Prisoner $prisoner)
    {
        $this->municipalityEdit = Municipality::find($prisoner->municipality_id);
        $this->prisonerForm->setPost($prisoner);
        $this->openModalUpdate  = $prisoner->id;
    }
    public function update()
    {
        $data = $this->validate();
        $this->prisonerForm->update($data);
        $this->closeModal();
        session()->flash('success', 'Atualizado com sucesso.');
    }

    // MODAL DELETE
    public function modalDelete($id)
    {
        $this->openModalDelete = $id;
    }
    // DELETE
    public function delete(Prisoner $prisoner)
    {
        $prisoner->delete();
        $this->openModalDelete = false;
        $this->redirectRoute('prisoners.search');
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
            'prisoner' => Prisoner::where('id', $this->prisoner_id)
                ->with('status_prison', 'education_level', 'civil_status', 'sex', 'sexual_orientation',
                    'ethnicity', 'country', 'municipality', 'state')
                ->first()
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
