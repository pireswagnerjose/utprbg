<?php

namespace App\Livewire\Report\LegalAssistance;

use App\Models\Main\AssistanceWithLawyer;
use App\Models\Main\AssistanceWithPublicDefender;
use App\Models\Main\HearingWithPoliceOfficer;
use App\Models\Main\RestorativeJustice;
use App\Models\Main\VideoconferenceHearing;
use Livewire\Component;
use Livewire\WithPagination;

class LegalAssistanceReport extends Component
{
    use WithPagination;
    public $start_date = '';
    public $end_date = '';
    public $status = '';

    public function search_assistance_with_lawyer()
    {
        $assistance_with_lawyers = AssistanceWithLawyer::with('prisoner', 'lawyer', 'modality_care')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $assistance_with_lawyers = $assistance_with_lawyers->where('date_of_service', '>=', $this->start_date);
            $assistance_with_lawyers = $assistance_with_lawyers->where('date_of_service', '<=', $this->end_date);
        }
        $assistance_with_lawyers = $assistance_with_lawyers->paginate(5);
        return $assistance_with_lawyers;
    }

    public function search_assistance_with_public_defender()
    {
        $assistance_with_public_defenders = AssistanceWithPublicDefender::with('prisoner', 'public_defender', 'modality_care')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $assistance_with_public_defenders = $assistance_with_public_defenders->where('date_of_service', '>=', $this->start_date);
            $assistance_with_public_defenders = $assistance_with_public_defenders->where('date_of_service', '<=', $this->end_date);
        }
        $assistance_with_public_defenders = $assistance_with_public_defenders->paginate(5);
        return $assistance_with_public_defenders;
    }

    public function search_hearing_with_police_officer()
    {
        $hearing_with_police_officers = HearingWithPoliceOfficer::with('prisoner', 'modality_care')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $hearing_with_police_officers = $hearing_with_police_officers->where('date_of_service', '>=', $this->start_date);
            $hearing_with_police_officers = $hearing_with_police_officers->where('date_of_service', '<=', $this->end_date);
        }
        $hearing_with_police_officers = $hearing_with_police_officers->paginate(5);
        return $hearing_with_police_officers;
    }

    public function search_restorative_justice()
    {
        $restorative_justices = RestorativeJustice::with('prisoner', 'modality_care')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $restorative_justices = $restorative_justices->where('date_of_service', '>=', $this->start_date);
            $restorative_justices = $restorative_justices->where('date_of_service', '<=', $this->end_date);
        }
        $restorative_justices = $restorative_justices->paginate(5);
        return $restorative_justices;
    }

    public function search_videoconference_hearing()
    {
        $videoconference_hearings = VideoconferenceHearing::with('prisoner')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$this->status}%");

        if($this->start_date != '' && $this->end_date != ''){
            $videoconference_hearings = $videoconference_hearings->where('date_of_service', '>=', $this->start_date);
            $videoconference_hearings = $videoconference_hearings->where('date_of_service', '<=', $this->end_date);
        }
        $videoconference_hearings = $videoconference_hearings->paginate(5);
        return $videoconference_hearings;
    }

    public function render()
    {
        $assistance_with_lawyers = $this->search_assistance_with_lawyer();
        $assistance_with_public_defenders = $this->search_assistance_with_public_defender();
        $hearing_with_police_officers = $this->search_hearing_with_police_officer();
        $restorative_justices = $this->search_restorative_justice();
        $videoconference_hearings = $this->search_videoconference_hearing();

        return view('livewire.report.legal-assistance.legal-assistance-report', compact(
            'assistance_with_lawyers', 'assistance_with_public_defenders', 'hearing_with_police_officers',
            'restorative_justices', 'videoconference_hearings'
        ));
    }
}
