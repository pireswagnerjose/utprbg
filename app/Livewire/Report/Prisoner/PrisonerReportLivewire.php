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

    public $faixa_etaria;
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
        'faixa_etaria');
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
        if( $this->faixa_etaria ) {
            if ($this->faixa_etaria == '18-25') {
                $presos = $data->get();
                foreach ($presos as $preso) { $birty[] = [Carbon::parse($preso['date_birth'])->age, $preso['id']]; }
                $array_fim = array_filter($birty, function ($b) { return $b[0] <= 25; });
                foreach ($array_fim as $key) { $arr_id[] = $key[1]; }
                $data = $data->whereIn('id', $arr_id);
            }
            if ($this->faixa_etaria == '26-30') {
                $presos = $data->get();
                foreach ($presos as $preso) { $birty[] = [Carbon::parse($preso['date_birth'])->age, $preso['id']]; }
                $array_ini = array_filter($birty, function ($b) { return $b[0] >= 26; });
                $array_fim = array_filter($array_ini, function ($b) { return $b[0] <= 30; });
                foreach ($array_fim as $key) { $arr_id[] = $key[1]; }
                $data = $data->whereIn('id', $arr_id);
            }
            if ($this->faixa_etaria == '31-40') {
                $presos = $data->get();
                foreach ($presos as $preso) { $birty[] = [Carbon::parse($preso['date_birth'])->age, $preso['id']]; }
                $array_ini = array_filter($birty, function ($b) { return $b[0] >= 31; });
                $array_fim = array_filter($array_ini, function ($b) { return $b[0] <= 40; });
                foreach ($array_fim as $key) { $arr_id[] = $key[1]; }
                $data = $data->whereIn('id', $arr_id);
            }
            if ($this->faixa_etaria == '41MAIS') {
                $presos = $data->get();
                foreach ($presos as $preso) { $birty[] = [Carbon::parse($preso['date_birth'])->age, $preso['id']]; }
                $array_fim = array_filter($birty, function ($b) { return $b[0] >= 41; });
                foreach ($array_fim as $key) { $arr_id[] = $key[1]; }
                $data = $data->whereIn('id', $arr_id);
            }
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
