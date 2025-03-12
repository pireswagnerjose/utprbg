<?php

namespace App\Http\Controllers;

use App\Models\Admin\Cell;
use App\Models\Main\Prison;
use App\Models\Main\UnitAddress;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PrisonerListController extends Controller
{
    public function pdf(Request $request)
    {
        $c_s_photo = $request->c_s_photo;
        $prisons = Prison::where('prison_unit_id', Auth::user()->prison_unit_id)
            ->where('exit_date', NULL)->get();

        // retorna os presos ativos
        foreach ($prisons as $prison) {
            $prisoner_id_arr[] = $prison->prisoner_id;
        }

        $unit_addresses = UnitAddress::with('cell')
            ->where('prison_unit_id', Auth::user()->prison_unit_id)
            ->whereIn('prisoner_id', $prisoner_id_arr)
            ->get();

        // retorna a listagem geral de presos
        if ($request->list_type == 'list') {
            // por ala
            if ($request->ward_id) {
                $unit_adds = UnitAddress::with('cell', 'prisoner')
                    ->join('prisoners', 'prisoners.id', '=', 'unit_addresses.prisoner_id')
                    ->where('ward_id', $request->ward_id)
                    ->where('status', 'ATIVO')
                    ->whereIn('prisoner_id', $prisoner_id_arr)
                    ->orderBy('prisoners.name')
                    ->get();
            } else {
                // todas as alas
                $unit_adds = UnitAddress::with('cell', 'prisoner')
                    ->join('prisoners', 'prisoners.id', '=', 'unit_addresses.prisoner_id')
                    ->where('status', 'ATIVO')
                    ->whereIn('prisoner_id', $prisoner_id_arr)
                    ->orderBy('prisoners.name')
                    ->get();
            }

            $pdf = Pdf::loadView(
                'reports.prisoner-list.prisoner-list',
                compact(
                    'unit_adds',
                    'c_s_photo',
                    'prisons'
                )
            );
            return $pdf->stream('Lista de Presos' . '.pdf');
        }

        // retorna os presos divididos por cela
        if ($request->list_type == 'conference') {
            // por ala
            if ($request->ward_id) {
                $cells = Cell::where('ward_id', $request->ward_id)
                    ->orderBy('cell', 'asc')
                    ->where('prison_unit_id', Auth::user()->prison_unit_id)
                    ->get();

                foreach ($cells as $key => $cell) {
                    $data[$key] = $cell;
                    $data[$key]['unit_addresses'] = UnitAddress::where('cell_id', $cell->id)
                        ->where('status', 'ATIVO')
                        ->where('prison_unit_id', Auth::user()->prison_unit_id)
                        ->whereRelation('prisoner', 'status_prison_id', 1)
                        ->get();
                }
            } else {
                $cells = Cell::orderBy('cell', 'asc')
                    ->where('prison_unit_id', Auth::user()->prison_unit_id)
                    ->get();

                foreach ($cells as $key => $cell) {
                    $data[$key] = $cell;
                    $data[$key]['unit_addresses'] = UnitAddress::where('cell_id', $cell->id)
                        ->where('status', 'ATIVO')
                        ->where('prison_unit_id', Auth::user()->prison_unit_id)
                        ->whereRelation('prisoner', 'status_prison_id', 1)
                        ->get();
                }
            }

            $cells = $data;

            $pdf = Pdf::loadView(
                'reports.prisoner-list.prisoner-conference',
                compact(
                    'cells',
                    'unit_addresses',
                    'c_s_photo',
                    'prisons'
                )
            );
            return $pdf->stream('Lista de Presos' . '.pdf');
        }
    }
}
