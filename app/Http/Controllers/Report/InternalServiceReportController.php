<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\InternalService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InternalServiceReportController extends Controller
{
    public function pdf(Request $request)
    {
        $internal_services = InternalService::with('prisoner', 'type_service')->orderBy('date', 'asc')
            ->where('type_service_id', 'like', "%{$request->type_service_id}%")
            ->where('status', 'like', "%{$request->status}%");

        if($request->start_date != '' && $request->end_date != ''){
            $internal_services = $internal_services->where('date', '>=', $request->start_date);
            $internal_services = $internal_services->where('date', '<=', $request->end_date);
        }

        $internal_services = $internal_services->get();

        $pdf = Pdf::loadView( 'reports.internal-service.internal-service-report',
         compact( 'internal_services' ) );
        return $pdf->stream('Atendimentos Internos.pdf');
    }
}
