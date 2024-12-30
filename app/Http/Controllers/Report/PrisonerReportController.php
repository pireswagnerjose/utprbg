<?php


namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\Prisoner;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PrisonerReportController extends Controller
{
    public function search($request)
    {
        $data = Prisoner::orderBy('name', 'asc')
            ->where('status_prison_id', 1);
        if($request->sexual_orientation_id ) {
            $data = $data->whereLike('sexual_orientation_id', $request->sexual_orientation_id);
        }
        if($request->ethnicity_id ) {
            $data = $data->whereLike('ethnicity_id', $request->ethnicity_id);
        }
        if($request->education_level_id ) {
            $data = $data->whereLike('education_level_id', $request->education_level_id);
        }
        if($request->civil_status_id ) {
            $data = $data->whereLike('civil_status_id', $request->civil_status_id);
        }
        if( $request->value_start && $request->value_end ) {
            global $value_start, $value_end;
            $value_start = $request->value_start;
            $value_end = $request->value_end;

            $presos = $data->get();
            foreach ($presos as $preso) { $birty[] = [Carbon::parse($preso['date_birth'])->age, $preso['id']]; }
            $array_ini = array_filter($birty, function ($b) {
                global $value_start;
                return $b[0] >= $value_start;
            });
            $array_fim = array_filter($array_ini, function ($b) {
                global $value_end;
                return $b[0] <= $value_end;
            });
            foreach ($array_fim as $key) { $arr_id[] = $key[1]; }
            $data = $data->whereIn('id', $arr_id);
        }
        if($request->cpf ) {
            if($request->cpf == 'sim'){ $data = $data->where('cpf', '!=', ''); }
            if($request->cpf == 'nao'){ $data = $data->where('cpf', ''); }
        }
        if($request->rg ) {
            if($request->rg == 'sim'){ $data = $data->where('rg', '!=', ''); }
            if($request->rg == 'nao'){ $data = $data->where('rg', ''); }
        }
        if($request->title ) {
            if($request->title == 'sim'){ $data = $data->where('title', '!=', ''); }
            if($request->title == 'nao'){ $data = $data->where('title', ''); }
        }
        if($request->birth_certificate ) {
            if($request->birth_certificate == 'sim'){ $data = $data->where('birth_certificate', '!=', ''); }
            if($request->birth_certificate == 'nao'){ $data = $data->where('birth_certificate', ''); }
        }
        if($request->reservist ) {
            if($request->reservist == 'sim'){ $data = $data->where('reservist', '!=', ''); }
            if($request->reservist == 'nao'){ $data = $data->where('reservist', ''); }
        }
        if($request->sus_card ) {
            if($request->sus_card == 'sim'){ $data = $data->where('sus_card', '!=', ''); }
            if($request->sus_card == 'nao'){ $data = $data->where('sus_card', ''); }
        }
        
        $data = $data->get();
        return $data;
    }
    public function pdf(Request $request)
    {
        $prisoners = $this->search($request);
        $pdf = Pdf::loadView( 'reports.prisoner.prisoner-report-infopen', compact( 'prisoners' ) );
        return $pdf->stream('Relatório Social dos Presos.pdf');
    }
    
}
