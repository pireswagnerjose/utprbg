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
        $data = VisitScheduling::select(
            'visit_schedulings.*',
            'visit_schedulings.id as visit_scheduling_id',
            'visit_schedulings.created_at as visit_scheduling_created_at',
            'prisoners.*',
            'prisoners.created_at as prisoner_created_at',
            'prisoners.id as prisoner_join_id'
        )
            ->join('prisoners', 'visit_schedulings.prisoner_id', '=', 'prisoners.id')
            ->orderBy('date_visit', direction: 'desc');

        if ($request->type) {
            $data = $data->whereLike('type', $request->type);
        }

        if ($request->status) {
            $data = $data->whereLike('status', $request->status === "MANTIDA" ? true : false);
        }

        if ($request->start_date != null && $request->end_date != null) {
            $data = $data->whereDate('date_visit', '>=', $request->start_date)
                ->whereDate('date_visit', '<=', $request->end_date);
        }
        return $data;
    }

    public function index(Request $request)
    {
        $prisoners = Prisoner::all();
        $visit_types = ['SOCIAL', 'ÍNTIMA'];
        $type = $request->type;
        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $visit_schedulings = $this->search($request);
        $visit_schedulings = $visit_schedulings->paginate(12);
        return view(
            'livewire.report.visit.visit-report-livewire',
            compact('visit_schedulings', 'visit_types', 'type', "status", 'start_date', 'end_date', 'prisoners')
        );
    }

    public function pdf(Request $request)
    {
        $visit_schedulings = $this->search($request);
        $visit_schedulings = $visit_schedulings->get();

        $pdf = Pdf::loadView('reports.visit.visit-pdf', compact('visit_schedulings'));
        return $pdf->stream('Relatório de Visitas.pdf');
    }

    public function destroy($id)
    {
        /* recupera pelo id */
        if (!$visit_scheduling = VisitScheduling::find($id)) {
            /* se não recuperar retorna para a página de listagem */
            return redirect()->route('visit-report.index');
        }
        ;

        /* deleta o registro */
        if ($visit_scheduling->delete()) {
            /* retorna para a página exibir*/
            return redirect()->route('visit-report.index')->with('sucesso', 'Apagado com sucesso');
        }
    }
}
