<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\Prisoner;
use App\Models\Main\Visit\VisitScheduling;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VisitReportPdfController extends Controller
{
    public function search($request)
    {
        $data = VisitScheduling::select('visit_schedulings.*', 'prisoners.*')
                    ->join('prisoners','visit_schedulings.prisoner_id','=','prisoners.id')
                    ->where('prisoners.status_prison_id', 1)
                    ->orderBy('date_visit', 'desc');

        if($request->type ) {
            $data = $data->whereLike('type', $request->type);
        }

        if($request->prisoner_id ) {
            $data = $data->where('prisoner_id', $request->prisoner_id);
        }
    
        if($request->start_date != null && $request->end_date != null) {
            $data = $data->whereDate('date_visit', '>=', $request->start_date)
                ->whereDate('date_visit', '<=', $request->end_date);
        }
        return $data;
    }

    public function index(Request $request)
    {
        $prisoners = Prisoner::all();
        $visit_types = ['SOCIAL','ÍNTIMA'];
        $type = $request->type;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $visit_schedulings = $this->search($request);
        $visit_schedulings = $visit_schedulings->paginate(12);
        return view('livewire.report.visit.visit-report-livewire', 
        compact('visit_schedulings', 'visit_types', 'type', 'start_date', 'end_date', 'prisoners'));
    }

    public function pdf(Request $request)
    {
        $visit_schedulings = $this->search($request);
        $visit_schedulings = $visit_schedulings->get();
        $pdf = Pdf::loadView( 'reports.visit.visit-pdf', compact( 'visit_schedulings' ) );
        return $pdf->stream('Relatório de Visitas.pdf');
    }

    public function destroy($id)
    {
        /* recupera pelo id */
        if (!$visit_scheduling = VisitScheduling::find($id)) {
            /* se não recuperar retorna para a página de listagem */
            return redirect()->route('visit-report.index');
        };

        /* deleta o registro */
        if ($visit_scheduling->delete()) {
            /* retorna para a página exibir*/
            return redirect()->route('visit-report.index')->with('sucesso', 'Apagado com sucesso');
        }
    }
}
