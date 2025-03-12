<?php

namespace App\Livewire\Report\PrisonerList;

use App\Models\Admin\Cell;
use App\Models\Admin\Prison\StatusPrison;
use App\Models\Admin\Ward;
use App\Models\Main\Prison;
use App\Models\Main\UnitAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PrisonerListReport extends Component
{
    use WithPagination;
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
        $this->wards = Ward::where('prison_unit_id', Auth::user()->prison_unit_id)->get();
    }
    public function search()
    {
        if ($this->list_type == 'list') {
            if ($this->ward_id) {
                $data = UnitAddress::select('unit_addresses.*', 'prisoners.*')
                    ->join('prisoners', 'unit_addresses.prisoner_id', '=', 'prisoners.id')
                    ->where('ward_id', $this->ward_id)
                    ->where('status', 'ATIVO')
                    ->where('prisoners.status_prison_id', 1)
                    ->orderBy('prisoners.name', 'asc')
                    ->paginate(50);
                return $data;
            } else {
                $data = UnitAddress::select('unit_addresses.*', 'prisoners.*')
                    ->join('prisoners', 'unit_addresses.prisoner_id', '=', 'prisoners.id')
                    ->where('status', 'ATIVO')
                    ->where('prisoners.status_prison_id', 1)
                    ->orderBy('prisoners.name', 'asc')
                    ->paginate(50);
                return $data;
            }
        }
        if ($this->list_type == 'conference') {
            // por ala
            if ($this->ward_id) {
                $cells = Cell::where('ward_id', $this->ward_id)
                    ->orderBy('cell', 'asc')
                    ->where('prison_unit_id', Auth::user()->prison_unit_id)
                    ->get();

                foreach ($cells as $key => $cell) {
                    $data[$key] = $cell;
                    $data[$key]['unit_addresses'] = UnitAddress::where('cell_id', $cell->id)
                        ->where('status', 'ATIVO')
                        ->where('prison_unit_id', Auth::user()->prison_unit_id)
                        ->whereRelation('prisoner', 'status_prison_id', 1)
                        ->get();
                }
                return $data;

            } else {
                $cells = Cell::orderBy('cell', 'asc')
                    ->where('prison_unit_id', Auth::user()->prison_unit_id)
                    ->get();

                foreach ($cells as $key => $cell) {
                    $data[$key] = $cell;
                    $data[$key]['unit_addresses'] = UnitAddress::where('cell_id', $cell->id)
                        ->where('status', 'ATIVO')
                        ->where('prison_unit_id', Auth::user()->prison_unit_id)
                        ->whereRelation('prisoner', 'status_prison_id', 1)
                        ->get();
                }
                return $data;
            }
        }
    }
    public function render()
    {
        $prisons = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners', 'prisons.prisoner_id', '=', 'prisoners.id')
            ->where('prisoners.status_prison_id', 1)
            ->where('prisons.exit_date', NULL)
            ->get();

        $unit_adds = $this->search();

        return view('livewire.report.prisoner-list.prisoner-list-report', compact('unit_adds', 'prisons'));
    }
}