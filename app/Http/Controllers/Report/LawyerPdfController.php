<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Admin\LegalAssistance\Lawyer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LawyerPdfController extends Controller
{
    public function pdf(Request $request)
    {
        $lawyer = Lawyer::find($request->lawyer_id);

        $pdf = Pdf::loadView('reports.lawyer.lawyer-pdf', compact('lawyer'));
        return $pdf->stream($lawyer->lawyer . '.pdf');
    }
}
