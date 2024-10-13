<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\LegalAssistance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LegalAssistanceReportController extends Controller
{
    public function pdf(Request $request)
    {
        $legal_assistances = LegalAssistance::with('prisoner', 'type_care')->orderBy('date', 'asc')
            ->where('type_care_id', 'like', "%{$request->type_care_id}%")
            ->where('status', 'like', "%{$request->status}%");

        if($request->start_date != '' && $request->end_date != ''){
            $legal_assistances = $legal_assistances->where('date', '>=', $request->start_date);
            $legal_assistances = $legal_assistances->where('date', '<=', $request->end_date);
        }

        $legal_assistances = $legal_assistances->get();

        $pdf = Pdf::loadView( 'reports.legal-assistance.legal-assistance-report',
         compact( 'legal_assistances' ) );
        return $pdf->stream('Atendimentos Jurídicos.pdf');
    }
}
