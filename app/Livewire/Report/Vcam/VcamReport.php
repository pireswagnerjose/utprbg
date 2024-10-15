<?php

namespace App\Livewire\Report\Vcam;

use App\Models\Main\Prison;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VcamReport extends Component
{
    use WithPagination;
    public $start_date = '';
    public $end_date = '';


    public function search()
    {
        if (empty($this->start_date)) {
            $prisons = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)->orderBy('entry_date', 'asc');
        } else {
            $prisons = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)->orderBy('entry_date', 'asc');

            //exclui dos presos que sairam antes do mes especificado
            $prisons_saida_antes_id = Prison::where('exit_date', '<', $this->start_date)->get('id');
            $prisons = $prisons->whereNotIn('id', $prisons_saida_antes_id);

            //exclui dos presos que entraram depois do mes especificado
            $prisons_entrada_depois_id = Prison::where('entry_date', '>', $this->end_date)->get('id');
            $prisons = $prisons->whereNotIn('id', $prisons_entrada_depois_id);
        }

        $prisons = $prisons->paginate(10);
        return $prisons;
    }

    public function render()
    {
        $prisons = $this->search();
        return view('livewire.report.vcam.vcam-report', compact('prisons'));
    }
}
