<?php

namespace App\Livewire\Main\Prison;

use App\Models\Admin\Prison\OutputType;
use App\Models\Admin\Prison\PrisonOrigin;
use App\Models\Admin\Prison\TypePrison;
use App\Models\Admin\PrisonUnit;
use App\Models\Main\Prison;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PrisonLivewire extends Component
{
    use WithPagination;
    
    public $entry_date;
    public $exit_date;
    public $sentence = '';
    public $exit_forecast;
    public $sentence_certificate;
    public $remarks = '';
    public $user_create = '';
    public $user_update = '';
    public $prisoner_id;
    public $prison_unit_id;
    public $prison_origin_id;
    public $type_prison_id;
    public $output_type_id;
    public $prisonUnits;
    public $prisonOrigins;
    public $typePrisons;
    public $outputTypes;

    public $prisonAcessories;

    public function mount()
    {
        $this->prisonAcessories = Prison::all();
        $this->user_create      = Auth::user()->id;
        $this->user_update      = Auth::user()->id;
        $this->prisonUnits      = PrisonUnit::all();
        $this->prisonOrigins    = PrisonOrigin::all();
        $this->typePrisons      = TypePrison::all();
        $this->outputTypes      = OutputType::all();
    }
    // CLEAR FIELDS - LIMPAR CAMPOS
    public function clearFields()
    {
        $this->reset('entry_date', 'exit_date', 'sentence', 'exit_forecast', 'sentence_certificate', 'remarks',
            'prison_unit_id', 'prison_origin_id', 'type_prison_id', 'output_type_id',);
    }

    // CLEAR MODAL
    public function closeModal()
    {
        $this->openModalPrisonCreate = false;
        $this->openModalPrisonUpdate = false;
        $this->openModalPrisonDelete = false;
        $this->redirectRoute('prisoners.show', ['prisoner_id' => $this->prisoner_id]);
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['sentence'] = mb_strtoupper ($dataValidated['sentence'],'utf-8');
        $dataValidated['remarks'] = mb_strtoupper ($dataValidated['remarks'],'utf-8');
        return $dataValidated;
    }
    
    // MODAL CREATE NEW PRISON
    public $openModalPrisonCreate = false;
    public function modalPrisonCreate()
    {
        // $this->clearFields();
        $this->openModalPrisonCreate = true;
    }
    public function prisonCreate()
    {
        $dataValidated = $this->validate(
            [
                'prison_unit_id'        =>'required|max:10',
                'entry_date'            =>'required|min:10|max:10',
                'exit_date'             =>'nullable|min:10|max:10',
                'sentence'              =>'max:100',
                'exit_forecast'         =>'nullable|min:10|max:10',
                'sentence_certificate'  =>'nullable|min:10|max:10',
                'remarks'               =>'nullable',
                'user_create'           =>'required|max:10',
                'prison_origin_id'      =>'required|max:10',
                'type_prison_id'        =>'required|max:10',
                'output_type_id'        =>'nullable|max:10',
                'prisoner_id'           =>'required|max:10',
            ]
        );
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // grava os dados no banco
        Prison::create($dataValidated);
        $this->clearFields();
        $this->closeModal();
        $this->resetPage();
    }

    // MODAL UPDATE PRISON
    public $openModalPrisonUpdate = false;
    public $prisonUpdate_id;
    public function modalPrisonUpdate(Prison $prison)
    {
        $this->prisonUpdate_id = $prison->id;
        // seta os valores para serem atualizados
        $this->prison_unit_id       =$prison->prison_unit_id;
        $this->entry_date           =$prison->entry_date;
        $this->exit_date            =$prison->exit_date;
        $this->sentence             =$prison->sentence;
        $this->exit_forecast        =$prison->exit_forecast;
        $this->sentence_certificate =$prison->sentence_certificate;
        $this->remarks              =$prison->remarks;
        $this->user_create          =$prison->user_create;
        $this->prison_origin_id     =$prison->prison_origin_id;
        $this->type_prison_id       =$prison->type_prison_id;
        $this->output_type_id       =$prison->output_type_id;
        $this->prisoner_id          =$prison->prisoner_id;
        // abre o modal
        $this->openModalPrisonUpdate = $prison->id;
    }

    public function prisonUpdate()
    {
        $prison_update = Prison::find($this->prisonUpdate_id);
        $dataValidated = $this->validate(
            [
                'prison_unit_id'        =>'required|max:10',
                'entry_date'            =>'required|min:10|max:10',
                'exit_date'             =>'nullable|min:10|max:10',
                'sentence'              =>'max:100',
                'exit_forecast'         =>'nullable|min:10|max:10',
                'sentence_certificate'  =>'nullable|min:10|max:10',
                'remarks'               =>'nullable',
                'user_update'           =>'required|max:10',
                'prison_origin_id'      =>'required|max:10',
                'type_prison_id'        =>'required|max:10',
                'output_type_id'        =>'nullable|max:10',
            ]
        );
        // corrige o erro quando a data de saída for apagada
        $exit_date = $dataValidated['exit_date'] ?: null;
        $dataValidated['exit_date'] = $exit_date;
        $exit_forecast = $dataValidated['exit_forecast'] ?: null;
        $dataValidated['exit_forecast'] = $exit_forecast;
        $sentence_certificate = $dataValidated['sentence_certificate'] ?: null;
        $dataValidated['sentence_certificate'] = $sentence_certificate;
        // Transforma os caracteres em maiusculos
        $dataValidated = $this->convertUppercase($dataValidated);
        // Atualiza os dados no banco
        $prison_update->update($dataValidated);
        $this->clearFields();
        $this->closeModal();
        $this->resetPage();
    }

    // MODAL DELETE
    public $openModalPrisonDelete = false;
    public function modalPrisonDelete($prison_id)
    {
        $this->openModalPrisonDelete = $prison_id;
    }
    // DELETE
    public function prisonDelete(Prison $prison)
    {
        $prison->delete();
        $this->clearFields();
        $this->closeModal();
    }

    // ATUALIZA A PÁGINA
    #[On('prison::prisonLivewire::refresh')]
    public function render()
    {
        return view('livewire.main.prison.prison-livewire', [
            'prisons' => Prison::where('prisoner_id', $this->prisoner_id)->orderBy('entry_date', 'desc')->paginate(10)
        ]);
    }
}
