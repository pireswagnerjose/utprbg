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

    public function pdf(Request $request)
    {
        $external_exits = ExternalExit::with('prisoner', 'requesting', 'municipality', 'state')->orderBy('event_date', 'asc')
            ->where('requesting_id', 'like', "%{$request->requesting_id}%")
            ->where('status', 'like', "%{$request->status}%");

        if($request->start_date != '' && $request->end_date != ''){
            $external_exits = $external_exits->where('event_date', '>=', $request->start_date);
            $external_exits = $external_exits->where('event_date', '<=', $request->end_date);
        }

        $external_exits = $external_exits->get();

        $pdf = Pdf::loadView( 'reports.external-exit.external-exit-pdf',
        compact( 'external_exits' ) );
        return $pdf->stream('Atendimentos Internos.pdf');
    }
}
