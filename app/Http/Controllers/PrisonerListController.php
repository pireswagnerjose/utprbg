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

        $prisons = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)->get();
        $prison_arr_id = [];
        foreach ($prisons as $prison) {
            $prison_arr_id[] = $prison->prisoner_id;
        }

        $prisoners = Prisoner::where('prisoners.status_prison_id', 1);
        $prisoners = $prisoners->whereIn('prisoners.id', $prison_arr_id)->get();

        $prisons = Prison::orderBy('entry_date', 'desc')->first();

        $prisoner_arr_id = [];
        foreach ($prisoners as $prisoner) {
            $prisoner_arr_id[] = $prisoner->id;
        }
        if ($request->ward_id) {
            $unit_addresses = UnitAddress::whereIn('unit_addresses.prisoner_id', $prisoner_arr_id)->where('ward_id', $request->ward_id);
            $unit_addresses = $unit_addresses->where('unit_addresses.status', 'ATIVO')->get();
        }else{
            $unit_addresses = UnitAddress::whereIn('unit_addresses.prisoner_id', $prisoner_arr_id);
            $unit_addresses = $unit_addresses->where('unit_addresses.status', 'ATIVO')->get();
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
