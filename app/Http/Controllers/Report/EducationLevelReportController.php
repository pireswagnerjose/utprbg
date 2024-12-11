<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\Prison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EducationLevelReportController extends Controller
{
    public function search($request)
    {
        $data = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
            ->where('prisoners.status_prison_id', 1)
            ->where('prisoners.prison_unit_id', Auth::user()->prison_unit_id )
            ->where('prisons.exit_date', null)
            ->orderBy('prisoners.name','asc');

        if($request->education_level_id ) {
            $data = $data->whereLike('education_level_id', $request->education_level_id);
        }
    
        if($request->start_date != null && $request->end_date != null) {
            $data = $data->where('entry_date', '>=', $request->start_date)
                ->where('entry_date', '<=', $request->end_date);
        }
        $data = $data->get();
        return $data;
    }

    public function pdf(Request $request)
    {
        $prisons = $this->search($request);
        $pdf = Pdf::loadView( 'reports.education-level.education-level-pdf', compact( 'prisons' ) );
        return $pdf->stream('Relatório de Escolaridade.pdf');
    }
}
