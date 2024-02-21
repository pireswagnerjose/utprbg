<?php

namespace App\Http\Controllers;

use App\Models\Main\Address;
use App\Models\Main\ExternalExit;
use App\Models\Main\Family;
use App\Models\Main\InternalService;
use App\Models\Main\LegalAssistance;
use App\Models\Main\Photo;
use App\Models\Main\Prison;
use App\Models\Main\Prisoner;
use App\Models\Main\Process;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class PrisonerPdfController extends Controller
{
    public function pdf(Request $request, $prisoner_id)
    {
        $prisoner          = Prisoner::find($prisoner_id);
        $prisons           = Prison::where('prisoner_id', $prisoner_id)->get();
        $processes         = Process::where('prisoner_id', $prisoner_id)->get();
        $photos            = Photo::where('prisoner_id', $prisoner_id)->get();
        $addresses         = Address::where('prisoner_id', $prisoner_id)->get();
        $internal_services = InternalService::where('prisoner_id', $prisoner_id)->get();
        $legal_assistances = LegalAssistance::where('prisoner_id', $prisoner_id)->get();
        $external_exits    = ExternalExit::where('prisoner_id', $prisoner_id)->get();
        $families          = Family::where('prisoner_id', $prisoner_id)->get();

        // Itens que irão aparecer no RELATÓRIO
        $prisonsPDF           = $request->prisons;
        $processesPDF         = $request->processes;
        $photosPDF            = $request->photos;
        $addressesPDF         = $request->addresses;
        $internal_servicesPDF = $request->internal_services;
        $legal_assistancesPDF = $request->legal_assistances;
        $external_exitsPDF    = $request->external_exits;
        $familiesPDF          = $request->families;

        $pdf = Pdf::loadView(
            'reports.prisoner.prisoner-report',
            compact(
                'prisoner',
                'prisons',
                'processes',
                'photos',
                'addresses',
                'internal_services',
                'legal_assistances',
                'external_exits',
                'families',
                'prisonsPDF',
                'processesPDF',
                'photosPDF',
                'addressesPDF',
                'internal_servicesPDF',
                'legal_assistancesPDF',
                'external_exitsPDF',
                'familiesPDF',
            )
        );
        return $pdf->stream($prisoner->name.'.pdf');
    }
}
