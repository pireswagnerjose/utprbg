<?php

namespace App\Livewire\Report\Prison;

use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Prison\TypePrison;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PrisonReportLivewire extends Component
{
    use WithPagination;
    public $operator;
    public $date_type;
    public $type_prison_id;
    public $status_prison_id;
    public $start_date;
    public $end_date;
    public $type_prisons;
    public $status_prisons;
    public  function mount()
    {
        $this->status_prisons = StatusPrison::all();
    }

    public function selectOperator()
    {
        $this->type_prisons = TypePrison::all();
    }

    public function getPrison()
    {
        $data = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
            ->where('exit_date', '=', null)
            ->orderBy('name','asc');

        if($this->status_prison_id ) {
            $data = $data->whereLike('status_prison_id', $this->status_prison_id);
        }
        if($this->type_prison_id ) {
            $data = $data->whereLike('type_prison_id', $this->type_prison_id);
        }
        if($this->date_type == 'date_entry'){
            if($this->operator != 'between'){
                if($this->start_date != null) {
                    $data = $data->where('entry_date', "$this->operator", $this->start_date);
                }
            }else{
                if($this->start_date != null && $this->end_date != null) {
                    $data = $data->where('entry_date', '>=', $this->start_date)
                        ->orWhere('exit_date', '<=', $this->end_date);
                }
            }
        }
        $data = $data->paginate(10);
        return $data;
    }

    public function render()
    {
        $prisons = $this->getPrison();
        return view('livewire.report.prison.prison-report-livewire', compact('prisons'));
    }
}
