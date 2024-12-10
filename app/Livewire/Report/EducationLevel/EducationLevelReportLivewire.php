<?php

namespace App\Livewire\Report\EducationLevel;

use App\Models\Admin\EducationLevel;
use App\Models\Main\Prison;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EducationLevelReportLivewire extends Component
{
    use WithPagination;

    public $start_date;
    public $end_date;
    public $education_level_id;
    public $education_levels;
    public function mount()
    {
        $this->education_levels = EducationLevel::all();
    }

    public function clearFieldes()
    {
        $this->reset('education_level_id', 'start_date', 'end_date');
        $this->resetPage();
        $this->redirectRoute('infopen-education-level', navigate: true);
    }

    public function search()
    {
        $data = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
            ->where('prisoners.status_prison_id', 1)
            ->where('prisoners.prison_unit_id', Auth::user()->prison_unit_id )
            ->where('prisons.exit_date', null)
            ->orderBy('prisoners.name','asc');

        if($this->education_level_id ) {
            $data = $data->whereLike('education_level_id', $this->education_level_id);
        }
    
        if($this->start_date != null && $this->end_date != null) {
            $data = $data->where('entry_date', '>=', $this->start_date)
                ->where('entry_date', '<=', $this->end_date);
        }
        $data = $data->paginate(10);
        return $data;
    }
    public function render()
    {
        $prisons = $this->search();
        return view('livewire.report.education-level.education-level-report-livewire', compact('prisons'));
    }
}
