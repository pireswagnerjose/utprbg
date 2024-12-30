<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\Process;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProcessReportPdfController extends Controller
{
    public function search($request)
    {
        $data = Process::select('processes.*', 'prisoners.*')
            ->join('prisoners','processes.prisoner_id','=','prisoners.id')
            ->orderBy('prisoners.name','asc');

        // origem do processo
        if($request->origin_process_id ) {
            $data = $data->where('origin_process_id', $request->origin_process_id);
        }

        // regime do processo
        if($request->process_regime_id ) {
            $data = $data->where('process_regime_id', $request->process_regime_id);
        }
        
        $data = $data->get();
        return $data;
    }
    
    public function pdf(Request $request)
    {
        $processes = $this->search($request);
        $pdf = Pdf::loadView( 'reports.process.process-pdf', compact( 'processes' ) );
        return $pdf->stream('Relatório de Processos.pdf');
    }
}
