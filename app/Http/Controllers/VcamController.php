<?php

namespace App\Http\Controllers;

use App\Models\Main\Prison;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VcamController extends Controller
{
    public function csv(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $prisons = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)->orderBy('entry_date', 'asc');

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

        //Criar o arquivo temporário
        $csv = tempnam(sys_get_temp_dir(), 'csv_' . Str::ulid());
        // Abir o arquivo na forma de escrita
        $csv_open = fopen($csv, 'w');
        //Criar o cabeçalho do excel 
        $title = [
            'id',
            'nome',
            'dt. entrada',
            mb_convert_encoding('dt. saída', 'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding('qt. diárias', 'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding('vr. diária', 'ISO-8859-1', 'UTF-8'),
            'vr. total'
        ];
        //Escrever o cabeçalho no arquivo
        fputcsv($csv_open, $title, ';');

        // Ler os registros recuperados do banco de dados
        foreach ($prisons as $id => $prison) {
            // CÁLCULO DOS DIAS -----------------------
            // retorna o a data de entrada do preso na unidade
            $data_entry = \Carbon\Carbon::parse($prison->entry_date);

            // retorna a data de saída do preso da unidade
            if (!empty($prison->exit_date)) {
               $exit_date = \Carbon\Carbon::parse($prison->exit_date);
            }
            
            // retorna o primeiro dia do mês para cálculo
            $first_day = \Carbon\Carbon::parse($start_date);

            // retorna o último dia do mês para cálculo = 30 ou 31
            $last_day = \Carbon\Carbon::parse($end_date);
            
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
            // ---------------------

            // CÁLCULO DAS DIÁRIAS -----------------------
            $value_month = str_replace(",", ".", $request->value_month);//substitui a vírgula pelo ponto.
            $value_thirty_days = $value_month / 30; //$d1 = 5543.98 / 30;
            $value_thirty_one_days = $value_month / 31; //$d2 = 5543.98 / 31;
            $valor30 = $value_thirty_days * $days; //$d1  * $days;
            $valor31 = $value_thirty_one_days * $days; //$d2 * $days;

            // valor da diária
            if ($days == 31)
                $valor_diaria =  number_format($value_thirty_one_days, 2, ',', '.');
            else
                $valor_diaria = number_format($value_thirty_days, 2, ',', '.');

            // valor total das diárias
            if ($days == 31)
                $valor_total =  number_format($valor31, 2, ',', '.');
            else
                $valor_total = number_format($valor30, 2, ',', '.');
            // ---------------------
            // converte a data de entrada e saída para o padrão pt-br
            $entry_date_formated = '';
            if (!empty($prison->entry_date)) {
                $entry_date_formated = \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y');
            }
            $exit_date_formated = '';
            if (!empty($prison->exit_date)) {
                $exit_date_formated = \Carbon\Carbon::parse($prison->exit_date)->format('d/m/Y');
            }
            // Criar Array com os dados da linha do excel
            $prisonArr = [
                'id'        => $id + 1,
                'name'      => mb_convert_encoding($prison->prisoner->name, 'ISO-8859-1', 'UTF-8'),
                'dt_entry'  => $entry_date_formated,
                'dt_exit'   => $exit_date_formated,
                'qt_days'   => $days,
                'vr_day'    => $valor_diaria,
                'vr_full'   => $valor_total,
            ];
            //Escrever o conteúdo no arquivo
            fputcsv($csv_open, $prisonArr, ';');
        }
        // Fecha o arquivo
        fclose($csv_open);
        //Realiza o download do arquivo
        return response()->download($csv, 'VCAM' . Str::ulid() . '.csv');
    }
}
