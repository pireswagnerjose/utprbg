<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Main\IdentificationCard;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class IdentificationCardPdfController extends Controller
{
    public function pdf($identification_card_id)
    {
        $identification_card = IdentificationCard::find($identification_card_id);
        $pdf = Pdf::loadView( 'reports.identification-card.identification-card-pdf', compact( 'identification_card' ) );
        return $pdf->stream('Cartão de Identificação.pdf');
    }
}
