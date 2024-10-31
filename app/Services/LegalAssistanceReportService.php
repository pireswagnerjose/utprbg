<?php

namespace App\Services;

use App\Models\Main\AssistanceWithLawyer;
use App\Models\Main\AssistanceWithPublicDefender;
use App\Models\Main\HearingWithPoliceOfficer;
use App\Models\Main\RestorativeJustice;
use App\Models\Main\VideoconferenceHearing;

class LegalAssistanceReportService
{
   public function search_assistance_with_lawyer($start_date, $end_date, $status)
   {
       $assistance_with_lawyers = AssistanceWithLawyer::with('prisoner', 'lawyer', 'modality_care')->orderBy('date_of_service', 'asc')
           ->where('status', 'like', "%{$status}%");

       if($start_date != '' && $end_date != ''){
           $assistance_with_lawyers = $assistance_with_lawyers->where('date_of_service', '>=', $start_date);
           $assistance_with_lawyers = $assistance_with_lawyers->where('date_of_service', '<=', $end_date);
       }
       $assistance_with_lawyers = $assistance_with_lawyers->paginate(5);
       return $assistance_with_lawyers;
   }

   public function search_assistance_with_public_defender($start_date, $end_date, $status)
    {
        $assistance_with_public_defenders = AssistanceWithPublicDefender::with('prisoner', 'public_defender', 'modality_care')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$status}%");

        if($start_date != '' && $end_date != ''){
            $assistance_with_public_defenders = $assistance_with_public_defenders->where('date_of_service', '>=', $start_date);
            $assistance_with_public_defenders = $assistance_with_public_defenders->where('date_of_service', '<=', $end_date);
        }
        $assistance_with_public_defenders = $assistance_with_public_defenders->paginate(5);
        return $assistance_with_public_defenders;
    }

    public function search_hearing_with_police_officer($start_date, $end_date, $status)
    {
        $hearing_with_police_officers = HearingWithPoliceOfficer::with('prisoner', 'modality_care')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$status}%");

        if($start_date != '' && $end_date != ''){
            $hearing_with_police_officers = $hearing_with_police_officers->where('date_of_service', '>=', $start_date);
            $hearing_with_police_officers = $hearing_with_police_officers->where('date_of_service', '<=', $end_date);
        }
        $hearing_with_police_officers = $hearing_with_police_officers->paginate(5);
        return $hearing_with_police_officers;
    }

    public function search_restorative_justice($start_date, $end_date, $status)
    {
        $restorative_justices = RestorativeJustice::with('prisoner', 'modality_care')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$status}%");

        if($start_date != '' && $end_date != ''){
            $restorative_justices = $restorative_justices->where('date_of_service', '>=', $start_date);
            $restorative_justices = $restorative_justices->where('date_of_service', '<=', $end_date);
        }
        $restorative_justices = $restorative_justices->paginate(5);
        return $restorative_justices;
    }

    public function search_videoconference_hearing($start_date, $end_date, $status)
    {
        $videoconference_hearings = VideoconferenceHearing::with('prisoner')->orderBy('date_of_service', 'asc')
            ->where('status', 'like', "%{$status}%");

        if($start_date != '' && $end_date != ''){
            $videoconference_hearings = $videoconference_hearings->where('date_of_service', '>=', $start_date);
            $videoconference_hearings = $videoconference_hearings->where('date_of_service', '<=', $end_date);
        }
        $videoconference_hearings = $videoconference_hearings->paginate(5);
        return $videoconference_hearings;
    }
}