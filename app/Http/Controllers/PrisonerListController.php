<?php

namespace App\Http\Controllers;

use App\Livewire\Main\Prisoner\PrisonerShowLivewire;
use App\Models\Admin\Cell;
use App\Models\Admin\PrisonUnit;
use App\Models\Admin\Ward;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use App\Models\Main\UnitAddress;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PrisonerListController extends Controller
{
    public function pdf(Request $request)
    {
        $c_s_photo  = $request->c_s_photo;
        $prisons = Prison::get();

        // retorna a listagem geral de presos
        if ($request->list_type == 'list') {
            $unit_addresses = UnitAddress::where('status', 'ATIVO')->orderBy('cell_id', 'asc')
                                        ->with('prisoner', 'cell')
                                        ->whereHas('prisoner', function ($querey){
                                            $querey->where('status_prison_id', 1);
                                        });
            if ($request->ward_id) {
                $unit_addresses = $unit_addresses->where('ward_id', $request->ward_id);
            }
            $unit_addresses = $unit_addresses->get();
            $pdf = Pdf::loadView('reports.prisoner-list.prisoner-list',
                compact(
                    'unit_addresses', 'c_s_photo', 'prisons'
                )
            );
            return $pdf->stream('Lista de Presos'.'.pdf');
        }

        // retorna os presos divididos por cela
        if ($request->list_type == 'conference') {
            $ward_id = $request->ward_id;
            $cells = Cell::where('ward_id', $request->ward_id)
                        ->with('unit_addresses')
                        ->whereHas('unit_addresses', function ($querey){
                                $querey->where('status', 'ATIVO');
                        });

            $cells = $cells->get();
            $pdf = Pdf::loadView('reports.prisoner-list.prisoner-conference',
                compact(
                    'cells', 'c_s_photo', 'prisons'
                )
            );
            return $pdf->stream('Lista de Presos'.'.pdf');
        }
    }
}
