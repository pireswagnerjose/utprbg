<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\ExternalExit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExternalExitReportController extends Controller
{
    public function report(Request $request)
    {
        $external_exit = ExternalExit::with('prisoner', 'state', 'municipality', 'prison_unit', 'requesting', 'exit_reason')
            ->find($request->external_exit_id);
        $pdf = Pdf::loadView( 'reports.external-exit.external-exit-report', compact( 'external_exit' )
        );
        return $pdf->stream($external_exit->prisoner->name.'.pdf');
    }
}
