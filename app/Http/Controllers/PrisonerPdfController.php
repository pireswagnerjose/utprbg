<?php

namespace App\Http\Controllers;


use App\Models\Main\Prisoner;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class PrisonerPdfController extends Controller
{
    public function pdf(Request $request, $prisoner_id)
    {
        $prisoner = Prisoner::with('prisons', 'processes', 'photos', 'addresses', 'internal_services', 'external_exits',
                'families', 'assistance_with_lawyers', 'assistance_with_public_defenders', 'restorative_justices', 
                'hearing_with_police_officers', 'videoconference_hearings')
                ->find($prisoner_id);

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
            compact('prisoner',
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
