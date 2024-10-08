<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\Visitant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VisitantReportController extends Controller
{
    public function report(Request $request)
    {
        $visitant          = Visitant::find($request->visitant_id);
        $pdf = Pdf::loadView( 'reports.visitant.visitant-report', compact( 'visitant' )
        );
        return $pdf->stream($visitant->name.'.pdf');
    }
}
