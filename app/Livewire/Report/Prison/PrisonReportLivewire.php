<?php

namespace App\Livewire\Report\Prison;

use App\Models\Admin\Prison\OutputType;
use App\Models\Admin\Prison\PrisonOrigin;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use Livewire\Component;
use Livewire\WithPagination;

class PrisonReportLivewire extends Component
{
    use WithPagination;

    public $start_date;
    public $end_date;
    public $prison_origin_id;
    public $output_type_id;

    public $prison_origins;
    public $output_types;
    public $type_search;    

    public function mount ()
    {
        $this->prison_origins = PrisonOrigin::all();
        $this->output_types = OutputType::all();
    }

    public function clearFieldes()
    {
        $this->reset('prison_origin_id', 'output_type_id', 'type_search', 'start_date', 'end_date');
        $this->resetPage();
        $this->redirectRoute('infopen.prisons', navigate: true);
    }

    public function search()
    {
        $prisoners = Prisoner::orderBy('name', 'asc')->get();
        foreach ($prisoners as $prisoner) {
            $prisons[] = Prison::where('prisoner_id', $prisoner->id)->orderBy('entry_date', 'desc')->first('id');
        }
        $array = implode(",",  $prisons);
        $array = explode(",",  $array);
        $array = preg_replace(array('/"/', '/id:/', '/{/', '/}/'), array('', '', '', ''), $array);

        $data = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
            ->whereIn('prisons.id', $array)
            ->orderBy('prisoners.name','asc');
        

        // entrada
        if($this->start_date != null && $this->end_date != null) {
            $data = $data->where('entry_date', '>=', $this->start_date)
                ->where('entry_date', '<=', $this->end_date);
        }

        // origem da prisão
        if($this->prison_origin_id ) {
            $data = $data->where('prison_origin_id', $this->prison_origin_id);
        }

        // tipo da saída
        if($this->output_type_id ) {
            $data = $data->where('output_type_id', $this->output_type_id);
        }

        
        $data = $data->paginate(10);
        return $data;
    }

    public function render()
    {
        $prisons = $this->search();
        return view('livewire.report.prison.prison-report-livewire', compact('prisons'));
    }
}
