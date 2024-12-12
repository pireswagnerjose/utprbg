<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\Prison;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TypePrisonPdfController extends Controller
{
    public function getPrison($request)
    {
        $data = Prison::select('prisons.*', 'prisoners.*')
            ->join('prisoners','prisons.prisoner_id','=','prisoners.id')
            ->where('prisoners.status_prison_id', 1)
            ->where('prisoners.prison_unit_id', Auth::user()->prison_unit_id )
            ->where('prisons.exit_date', null)
            ->orderBy('prisoners.name','asc');

        if($request->type_prison_id ) {
            $data = $data->whereLike('type_prison_id', $request->type_prison_id);
        }
    
        if($request->operator != 'between'){
            if($request->start_date != null) {
                $data = $data->where('entry_date', "$request->operator", $request->start_date);
            }
        }else{
            if($request->start_date != null && $request->end_date != null) {
                $data = $data->where('entry_date', '>=', $request->start_date)
                    ->where('entry_date', '<=', $request->end_date);
            }
        }
        $data = $data->get();
        return $data;
    }

    public function pdf(Request $request)
    {
        $prisons = $this->getPrison($request);
        $pdf = Pdf::loadView( 'reports.type-prison.type-prison-pdf', compact( 'prisons' ) );
        return $pdf->stream('Relatório de Tipos Penais.pdf');
    }

    public function csv(Request $request)
    {
        $prisons = $this->getPrison($request);
        //Criar o arquivo temporário
        $csv = tempnam(sys_get_temp_dir(), 'csv_' . Str::ulid());
        // Abir o arquivo na forma de escrita
        $csv_open = fopen($csv, 'w');
        //Criar o cabeçalho do excel 
        $title = [
            'id',
            'nome',
            'cela',
            'dt. entrada',
            'dt. saida',
        ];
        //Escrever o cabeçalho no arquivo
        fputcsv($csv_open, $title, ';');
        // Criar Array com os dados da linha do excel
        foreach ($prisons as $key => $prison) {
            foreach ( $prison->prisoner->unit_address as $unit_address){
                if ($unit_address->status == "ATIVO"){
                    $cell = $unit_address->cell->cell;
                }
            }
            $prisonArr = [
                'id'          => $key + 1,
                'name'        => mb_convert_encoding($prison->prisoner->name, 'ISO-8859-1', 'UTF-8'),
                'cell'        => $cell,
                'entry_date'  => $prison->entry_date,
                'exit_date'   => $prison->exit_date,
            ];
            //Escrever o conteúdo no arquivo
            fputcsv($csv_open, $prisonArr, ';');
        }
        // Fecha o arquivo
        fclose($csv_open);
        //Realiza o download do arquivo
        return response()->download($csv, 'Presos por tipo de prisao.csv');
    }
}
