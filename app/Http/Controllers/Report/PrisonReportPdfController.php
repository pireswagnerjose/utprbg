<?php

namespace App\Http\Controllers\Report;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
class PrisonReportPdfController extends Controller
{
    public function search($request)
    {
        $prisoners = Prisoner::orderBy('name', 'asc')->get();
        foreach ($prisoners as $prisoner) {
            $prisons[] = Prison::where('prisoner_id', $prisoner->id)->orderBy('entry_date', 'desc')->first('id');
        }
        $array = implode(",",  $prisons);
        $array = explode(",",  $array);
        $array = preg_replace(array('/"/', '/id:/', '/{/', '/}/'), array('', '', '', ''), $array);

        $data = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
            ->whereIn('prisons.id', $array)
            ->orderBy('prisoners.name','asc');
        // entrada
        if($request->type_search == 'entry'){
            if($request->start_date != null && $request->end_date != null) {
                $data = $data->where('entry_date', '>=', $request->start_date)
                    ->where('entry_date', '<=', $request->end_date);
            }

            // origem da prisão
            if($request->prison_origin_id ) {
                $data = $data->where('prison_origin_id', $request->prison_origin_id);
            }
        }

        // saída
        if($request->type_search == 'exit'){
            if($request->start_date != null && $request->end_date != null) {
                $data = $data->where('exit_date', '>=', $request->start_date)
                    ->where('exit_date', '<=', $request->end_date);
            }

            // tipo da saída
            if($request->output_type_id ) {
                $data = $data->where('output_type_id', $request->output_type_id);
            }
        }
        $data = $data->get();
        return $data;
    }

    public function pdf(Request $request)
    {
        $prisons = $this->search($request);
        $pdf = Pdf::loadView( 'reports.prison.prison-pdf', compact( 'prisons' ) );
        return $pdf->stream('Relatório de Tipos Penais.pdf');
    }
}
