<?php

namespace App\Http\Controllers;

use App\Models\Main\Prison;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class VcamController extends Controller
{
    public function pdf(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $prisons = Prison::orderBy('entry_date', 'asc');

        //exclui dos presos que sairam antes do mes especificado
        $prisons_saida_antes = Prison::where('exit_date', '<=', $start_date)->get();
        foreach ($prisons_saida_antes as $saida_antes) {
            $saida_antes_id[] = $saida_antes->id;
        }
        $prisons = $prisons->whereNotIn('id', $saida_antes_id);

        //exclui dos presos que entraram depois do mes especificado
        $prisons_entrada_depois = Prison::where('entry_date', '>=', $end_date)->get();
        foreach ($prisons_entrada_depois as $entrada_depois) {
            $entrada_depois_id[] = $entrada_depois->id;
        }
        if (!empty($entrada_depois_id)) {
            $prisons = $prisons->whereNotIn('id', $entrada_depois_id);
        }
                            
        $prisons = $prisons->get();

        $pdf = Pdf::loadView(
            'reports.vcam.vcam',
            compact(
                'prisons', 'start_date', 'end_date'
            )
        );
        return $pdf->stream('Lista de Presos'.'.pdf');

        //return view('reports.vcam.vcam', ['prisons' => $prisons]);
    }
}
