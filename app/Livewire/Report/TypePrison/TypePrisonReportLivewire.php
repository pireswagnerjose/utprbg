<?php

namespace App\Livewire\Report\TypePrison;

use Livewire\Component;
use App\Models\Admin\Prison\TypePrison;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use Livewire\WithPagination;

class TypePrisonReportLivewire extends Component
{
    use WithPagination;
    public $operator;
    public $type_prison_id;
    public $start_date;
    public $end_date;
    public $type_prisons;

    public function mount()
    {
        $this->type_prisons = TypePrison::all();
    }

    public function selectOperator()
    {

    }

    public function clearFieldes()
    {
        $this->reset('operator', 'type_prison_id', 'start_date', 'end_date');
        $this->resetPage();
        $this->redirectRoute('infopen.type-prisons', navigate: true);
    }

    public function getPrison()
    {
        $prisoners = Prisoner::where('status_prison_id', 1)->get();
        foreach ($prisoners as $prisoner) {
            $prisons[] = Prison::where('prisoner_id', $prisoner->id)->orderBy('entry_date', 'desc')->first('id');
        }
        $array = implode(",", $prisons);
        $array = explode(",", $array);
        $array = preg_replace(array('/"/', '/id:/', '/{/', '/}/'), array('', '', '', ''), $array);

        $data = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners', 'prisons.prisoner_id', '=', 'prisoners.id')
            ->whereIn('prisons.id', $array)
            ->orderBy('prisoners.name', 'asc');

        if ($this->type_prison_id) {
            $data = $data->whereLike('type_prison_id', $this->type_prison_id);
        }

        if ($this->operator != 'between') {
            if ($this->start_date != null) {
                $data = $data->where('entry_date', "$this->operator", $this->start_date);
            }
        } else {
            if ($this->start_date != null && $this->end_date != null) {
                $data = $data->where('entry_date', '>=', $this->start_date)
                    ->where('entry_date', '<=', $this->end_date);
            }
        }

        $data = $data->paginate(10);
        return $data;
    }
    public function render()
    {
        $prisons = $this->getPrison();
        return view('livewire.report.type-prison.type-prison-report-livewire', compact('prisons'));
    }
}
