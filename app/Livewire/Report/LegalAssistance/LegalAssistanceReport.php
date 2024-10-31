<?php

namespace App\Livewire\Report\LegalAssistance;

use App\Services\LegalAssistanceReportService;
use Livewire\Component;
use Livewire\WithPagination;

class LegalAssistanceReport extends Component
{
    use WithPagination;
    public $start_date = '';
    public $end_date = '';
    public $status = '';

    public function render()
    {
        $assistance_with_lawyers = (new LegalAssistanceReportService())
            ->search_assistance_with_lawyer($this->start_date, $this->end_date, $this->status);

        $assistance_with_public_defenders = (new LegalAssistanceReportService())
            ->search_assistance_with_public_defender($this->start_date, $this->end_date, $this->status);

        $hearing_with_police_officers = (new LegalAssistanceReportService())
            ->search_hearing_with_police_officer($this->start_date, $this->end_date, $this->status);

        $restorative_justices = (new LegalAssistanceReportService())
            ->search_restorative_justice($this->start_date, $this->end_date, $this->status);

        $videoconference_hearings = (new LegalAssistanceReportService())
            ->search_videoconference_hearing($this->start_date, $this->end_date, $this->status);

        return view('livewire.report.legal-assistance.legal-assistance-report', compact(
            'assistance_with_lawyers', 'assistance_with_public_defenders', 'hearing_with_police_officers',
            'restorative_justices', 'videoconference_hearings'
        ));
    }
}
