<?php

namespace App\Livewire\Report\PrisonerList;

use App\Models\Admin\Cell;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Ward;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use App\Models\Main\UnitAddress;
use Livewire\Component;

class PrisonerListReport extends Component
{
    public $c_s_photo;
    public $ward_id;
    public $list_type;

    public $status_prisons;
    public $unit_address;
    public $wards;
    public $cells;

    public function mount()
    {
        $this->status_prisons = StatusPrison::all();
        $this->wards = Ward::all();
        $this->cells = Cell::all();
    }
    public function search()
    {
        if ($this->list_type == 'list'){
            if($this->ward_id){
                $data = UnitAddress::select('unit_addresses.*', 'prisoners.*')
                    ->join('prisoners','unit_addresses.prisoner_id','=','prisoners.id')
                    ->where('ward_id', $this->ward_id)
                    ->where('status', 'ATIVO')
                    ->where('prisoners.status_prison_id', 1)
                    ->orderBy('prisoners.name','asc')
                    ->get();
                return $data;
            } else {
                $data = UnitAddress::select('unit_addresses.*', 'prisoners.*')
                    ->join('prisoners','unit_addresses.prisoner_id','=','prisoners.id')
                    ->where('status', 'ATIVO')
                    ->where('prisoners.status_prison_id', 1)
                    ->orderBy('prisoners.name','asc')
                    ->get();
                return $data;
            }
        }
        if ($this->list_type == 'conference'){
            // por ala
            if ($this->ward_id) {
                $data = Cell::where('ward_id', $this->ward_id)
                    ->with('unit_addresses')
                    ->whereHas('unit_addresses', function ($querey){
                        $querey->where('status', 'ATIVO');
                    })->get();
                    return $data;
            }else {
                $data = Cell::with('unit_addresses')
                    ->whereHas('unit_addresses', function ($querey){
                        $querey->where('status', 'ATIVO');
                    })->get();
                return $data;
            }
        }
    }
    public function render()
    {
        $prisons = Prison::select('prisons.*', 'prisoners.*')
                ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
                ->where('prisoners.status_prison_id', 1)
                ->where('prisons.exit_date', NULL)
                ->get();

        $unit_adds = $this->search();
                                        
        return view('livewire.report.prisoner-list.prisoner-list-report', compact('unit_adds', 'prisons'));
    }
}
