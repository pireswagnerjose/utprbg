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
        $visitant = Visitant::find($request->visitant_id);
        $pdf = Pdf::loadView( 'reports.visitant.visitant-report', compact( 'visitant' )
        );
        return $pdf->stream($visitant->name.'.pdf');
    }

    public function pdf(Request $request)
    {
        $visitants = Visitant::orderBy('name', 'asc')
            ->with('sex', 'civil_status', 'municipality', 'state')
            ->where('name', 'like', "%{$request->name}%")
            ->where('date_of_birth', 'like', "%{$request->date_of_birth}%")
            ->where('cpf', 'like', "%{$request->cpf}%")
            ->where('phone', 'like', "%{$request->phone}%")
            ->where('status', 'like', "%{$request->status}%")
            ->where('sex_id', 'like', "%{$request->sex_id}%")
            ->get();
        $pdf = Pdf::loadView( 'reports.visitant.visitants-list-report', compact( 'visitants' )
        );
        return $pdf->stream('lista de visitantes.pdf');
    }


}
