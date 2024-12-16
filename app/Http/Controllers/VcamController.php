<?php

namespace App\Http\Controllers;

use App\Models\Main\Prison;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VcamController extends Controller
{
    public function getVcam($request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $prisons = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)->orderBy('entry_date', 'asc');
        
        //exclui dos presos que sairam antes do mes especificado
        $prisons_saida_antes_id = Prison::where('exit_date', '<', $start_date)->get('id');
        $prisons = $prisons->whereNotIn('id', $prisons_saida_antes_id);

        //exclui dos presos que entraram depois do mes especificado
        $prisons_entrada_depois_id = Prison::where('entry_date', '>', $end_date)->get('id');
        $prisons = $prisons->whereNotIn('id', $prisons_entrada_depois_id);

        $data = $prisons->get();
        return $data;
    }
    public function pdf(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $prisons = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)->orderBy('entry_date', 'asc');
        
        //exclui dos presos que sairam antes do mes especificado
        $prisons_saida_antes_id = Prison::where('exit_date', '<', $start_date)->get('id');
        $prisons = $prisons->whereNotIn('id', $prisons_saida_antes_id);

        //exclui dos presos que entraram depois do mes especificado
        $prisons_entrada_depois_id = Prison::where('entry_date', '>', $end_date)->get('id');
        $prisons = $prisons->whereNotIn('id', $prisons_entrada_depois_id);

        $prisons = $prisons->get();

        $pdf = Pdf::loadView( 'reports.vcam.vcam-pdf',
        compact( 'prisons', 'start_date', 'end_date' ) )->setPaper('A4', 'landscape');
        return $pdf->stream('VCAM.pdf');

    }
    public function csv(Request $request)
    {
        $prisons_vcam = $this->getVcam($request);

        //Criar o arquivo temporário
        $csv = tempnam(sys_get_temp_dir(), 'csv_' . Str::ulid());
        // Abir o arquivo na forma de escrita
        $csv_open = fopen($csv, 'w');
        //Criar o cabeçalho do excel 
        $title = [
            'id',
            'nome',
            'dt. entrada',
            'dt. saida',
            'nr. dias'
        ];
        //Escrever o cabeçalho no arquivo
        fputcsv($csv_open, $title, ';');

        // Ler os registros recuperados do banco de dados
        foreach ($prisons_vcam as $id => $prison) {
            // CÁLCULO DOS DIAS -----------------------
            // retorna o a data de entrada do preso na unidade
            
            $data_entry = \Carbon\Carbon::parse($prison->entry_date);

            // retorna a data de saída do preso da unidade
            $exit_date = '';
            if (!empty($prison->exit_date)) {
               $exit_date = \Carbon\Carbon::parse($prison->exit_date);
            }

            // retorna o primeiro dia do mês para cálculo
            $first_day = \Carbon\Carbon::parse($request->start_date);
      
            // retorna o último dia do mês para cálculo = 30 ou 31
            $last_day = \Carbon\Carbon::parse($request->end_date);

            if (!empty($prison->exit_date)) {
                if ($first_day->diffInDays($exit_date) < $first_day->diffInDays($last_day)) {
                    $days = $first_day->diffInDays($exit_date) + 1;
                } elseif ($data_entry->diffInDays($last_day) < $first_day->diffInDays($last_day)) {
                    $days = $data_entry->diffInDays($last_day) + 1;
                } else {
                    $days = $first_day->diffInDays($last_day) + 1;
                }
            } else {
                if ($data_entry->diffInDays($last_day) < $first_day->diffInDays($last_day)) {
                    $days = $data_entry->diffInDays($last_day) + 1;
                } else {
                    $days = $first_day->diffInDays($last_day) + 1;
                }
            }

            
            // Criar Array com os dados da linha do excel
            $prisonArr = [
                'id'        => $id + 1,
                'name'      => mb_convert_encoding($prison->prisoner->name, 'ISO-8859-1', 'UTF-8'),
                'dt_entry'  => $data_entry,
                'dt_exit'   => $exit_date,
                'days'      => $days
            ];
            //Escrever o conteúdo no arquivo
            fputcsv($csv_open, $prisonArr, ';');
        }
        // Fecha o arquivo
        fclose($csv_open);
        //Realiza o download do arquivo
        return response()->download($csv, 'VCAM.csv');
    }
}
