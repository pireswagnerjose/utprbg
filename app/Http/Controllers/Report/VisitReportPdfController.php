<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\Visit\VisitScheduling;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VisitReportPdfController extends Controller
{
    public function search($request)
    {
        $data = VisitScheduling::with('prisoner', 'visitant')
            ->orderBy('date_visit', 'desc');

        if($request->type ) {
            $data = $data->whereLike('type', $request->type);
        }
    
        if($request->start_date != null && $request->end_date != null) {
            $data = $data->where('date_visit', '>=', $request->start_date)
                ->where('date_visit', '<=', $request->end_date);
        }

        $data = $data->get();
        return $data;
    }

    public function pdf(Request $request)
    {
        $visit_schedulings = $this->search($request);
        $pdf = Pdf::loadView( 'reports.visit.visit-pdf', compact( 'visit_schedulings' ) );
        return $pdf->stream('Relatório de Visitas.pdf');
    }
}
