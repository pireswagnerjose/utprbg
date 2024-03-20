<?php

namespace App\Http\Controllers;

use App\Models\Admin\Ward;
use App\Models\Main\Prisoner;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
class PrisonerListController extends Controller
{
    public function pdf(Request $request)
    {
        $prisoners = Prisoner::where('status_prison_id', $request->status_prison_id)->get();

        $ward = Ward::where('id', $request->ward_id)->first();

        $pdf = Pdf::loadView(
            'reports.prisoner-list.prisoner-list',
            compact(
                'prisoners', 'ward'
            )
        );
        return $pdf->stream('Lista de Presos'.'.pdf');
    }
}
