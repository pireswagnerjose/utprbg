<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Services\LegalAssistanceReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LegalAssistanceReportController extends Controller
{
    
    public function pdf(Request $request)
    {

        $assistance_with_lawyers = (new LegalAssistanceReportService())
            ->search_assistance_with_lawyer($request->start_date, $request->end_date, $request->status);
        $assistance_with_lawyers = $assistance_with_lawyers->get();

        $assistance_with_public_defenders = (new LegalAssistanceReportService())
            ->search_assistance_with_public_defender($request->start_date, $request->end_date, $request->status);
        $assistance_with_public_defenders = $assistance_with_public_defenders->get();

        $hearing_with_police_officers = (new LegalAssistanceReportService())
            ->search_hearing_with_police_officer($request->start_date, $request->end_date, $request->status);
        $hearing_with_police_officers = $hearing_with_police_officers->get();

        $restorative_justices = (new LegalAssistanceReportService())
            ->search_restorative_justice($request->start_date, $request->end_date, $request->status);
        $restorative_justices = $restorative_justices->get();

        $videoconference_hearings = (new LegalAssistanceReportService())
            ->search_videoconference_hearing($request->start_date, $request->end_date, $request->status);
        $videoconference_hearings = $videoconference_hearings->get();


        $pdf = Pdf::loadView( 'reports.legal-assistance.legal-assistance-report',
         compact( 'assistance_with_lawyers', 'assistance_with_public_defenders', 'hearing_with_police_officers',
                'restorative_justices', 'videoconference_hearings')
        );

        return $pdf->stream('Atendimentos Jurídicos.pdf');
    }
}
