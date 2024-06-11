<?php

namespace App\Http\Controllers;

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
        //$prisoners = Prisoner::where('status_prison_id', $request->status_prison_id);
        $prisoner_id    = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)->get('prisoner_id');
        $prisons = Prison::orderBy('entry_date', 'desc')->first();
        
        if ($request->ward_id) {
            $unit_addresses = UnitAddress::where('status', 'ATIVO')->where('ward_id', $request->ward_id)->get();
        }else{
            $unit_addresses = UnitAddress::where('status', 'ATIVO')->get();
        }
        $ward = Ward::where('id', $request->ward_id)->first('ward');
        //$prisoners->whereIn('prisoners.id', $prisoner_id);
        //$prisoners = $prisoners->get();

        $pdf = Pdf::loadView(
            'reports.prisoner-list.prisoner-list',
            compact(
                'unit_addresses', 'c_s_photo', 'prisons', 'ward'
            )
        );
        return $pdf->stream('Lista de Presos'.'.pdf');
    }
}
