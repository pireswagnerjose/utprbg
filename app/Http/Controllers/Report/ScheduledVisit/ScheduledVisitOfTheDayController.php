<?php

namespace App\Http\Controllers\Report\ScheduledVisit;

use App\Http\Controllers\Controller;
use App\Models\Main\Prisoner;
use App\Models\Main\Visit\VisitScheduling;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ScheduledVisitOfTheDayController extends Controller
{
    public function index(Request $request)
    {
        $prisoners = Prisoner::all();
        $visit_types = ['SOCIAL', 'ÍNTIMA'];
        $type = $request->type;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $visit_schedulings = $this->search($request);
        $visit_schedulings = $visit_schedulings->paginate(12);
        return view(
            'reports.scheduled-visit.index',
            compact('visit_schedulings', 'visit_types', 'type', 'start_date', 'end_date', 'prisoners')
        );
    }

    public function search($request)
    {
        $data = VisitScheduling::select(
            'visit_schedulings.*',
            'visit_schedulings.id as visit_scheduling_id',
            'visit_schedulings.created_at as visit_scheduling_created_at',
            'prisoners.*',
            'prisoners.name as prisoner_name',
            'prisoners.created_at as prisoner_created_at',
            'prisoners.id as prisoner_join_id'
        )
            ->join('prisoners', 'visit_schedulings.prisoner_id', '=', 'prisoners.id')
            ->orderBy('prisoner_name', direction: 'asc');

        if ($request->type) {
            $data = $data->whereLike('type', $request->type);
        }

        if ($request->start_date != null && $request->end_date != null) {
            $data = $data->whereDate('date_visit', '>=', $request->start_date)
                ->whereDate('date_visit', '<=', $request->end_date);
        }
        return $data;
    }

    public function pdf(Request $request)
    {
        $visit_schedulings = $this->search($request);
        $visit_schedulings = $visit_schedulings->get();
        $pdf = Pdf::loadView('reports.scheduled-visit.pdf', compact('visit_schedulings'));
        return $pdf->stream('Relatório de Visitas do Dia.pdf');
    }
}
