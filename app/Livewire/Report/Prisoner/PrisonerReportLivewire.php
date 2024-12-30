<?php

namespace App\Livewire\Report\Prisoner;

use App\Models\Admin\CivilStatus;
use App\Models\Admin\EducationLevel;
use App\Models\Admin\Ethnicity;
use App\Models\Admin\SexualOrientation;
use App\Models\Main\Prisoner;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PrisonerReportLivewire extends Component
{
    use WithPagination;

    public $value_start;
    public $value_end;
    public $cpf;
    public $rg;
    public $title;
    public $birth_certificate;
    public $reservist;
    public $sus_card;
    public $sexual_orientation_id;
    public $ethnicity_id;
    public $education_level_id;
    public $civil_status_id;

    public $sexual_orientations;
    public $ethnicities;
    public $education_levels;
    public $civil_statuses;

    public $values = ['18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30',
    '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46',
    '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62',
    '63', '64', '65', '66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78',
    '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94',
    '95', '96', '97', '98', '99', '100' ];

    public function mount()
    {
        $this->sexual_orientations = SexualOrientation::all();
        $this->ethnicities = Ethnicity::all();
        $this->education_levels = EducationLevel::all();
        $this->civil_statuses = CivilStatus::all();
    }

    public function clearFieldes()
    {
        $this->reset('cpf', 'rg', 'title', 'birth_certificate', 'reservist',
        'sus_card', 'sexual_orientation_id', 'ethnicity_id', 'education_level_id', 'civil_status_id',
        'value_start', 'value_end');
        $this->resetPage();
        $this->redirectRoute('infopen-prisoner', navigate: true);
    }

    public function search()
    {
        $data = Prisoner::orderBy('name', 'asc')
            ->where('status_prison_id', 1);
        if($this->sexual_orientation_id ) {
            $data = $data->whereLike('sexual_orientation_id', $this->sexual_orientation_id);
        }
        if($this->ethnicity_id ) {
            $data = $data->whereLike('ethnicity_id', $this->ethnicity_id);
        }
        if($this->education_level_id ) {
            $data = $data->whereLike('education_level_id', $this->education_level_id);
        }
        if($this->civil_status_id ) {
            $data = $data->whereLike('civil_status_id', $this->civil_status_id);
        }
        if( $this->value_start && $this->value_end ) {            
            $presos = $data->get();
            foreach ($presos as $preso) { $birty[] = [Carbon::parse($preso['date_birth'])->age, $preso['id']]; }
            $array_ini = array_filter($birty, function ($b) { return $b[0] >= $this->value_start; });
            $array_fim = array_filter($array_ini, function ($b) { return $b[0] <= $this->value_end; });
            foreach ($array_fim as $key) { $arr_id[] = $key[1]; }
            $data = $data->whereIn('id', $arr_id);
        }
        if($this->cpf ) {
            if($this->cpf == 'sim'){ $data = $data->where('cpf', '!=', ''); }
            if($this->cpf == 'nao'){ $data = $data->where('cpf', ''); }
        }
        if($this->rg ) {
            if($this->rg == 'sim'){ $data = $data->where('rg', '!=', ''); }
            if($this->rg == 'nao'){ $data = $data->where('rg', ''); }
        }
        if($this->title ) {
            if($this->title == 'sim'){ $data = $data->where('title', '!=', ''); }
            if($this->title == 'nao'){ $data = $data->where('title', ''); }
        }
        if($this->birth_certificate ) {
            if($this->birth_certificate == 'sim'){ $data = $data->where('birth_certificate', '!=', ''); }
            if($this->birth_certificate == 'nao'){ $data = $data->where('birth_certificate', ''); }
        }
        if($this->reservist ) {
            if($this->reservist == 'sim'){ $data = $data->where('reservist', '!=', ''); }
            if($this->reservist == 'nao'){ $data = $data->where('reservist', ''); }
        }
        if($this->sus_card ) {
            if($this->sus_card == 'sim'){ $data = $data->where('sus_card', '!=', ''); }
            if($this->sus_card == 'nao'){ $data = $data->where('sus_card', ''); }
        }
        
        $data = $data->paginate(10);
        return $data;
    }

    public function render()
    {
        $prisoners = $this->search();
        return view('livewire.report.prisoner.prisoner-report-livewire', compact('prisoners'));
    }
}
