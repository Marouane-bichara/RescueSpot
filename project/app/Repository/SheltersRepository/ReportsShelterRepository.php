<?php

namespace App\Repository\SheltersRepository;

use App\Models\Report;
use App\Models\Shelter;

class ReportsShelterRepository
{
    public function getAllReports()
    {
        $user = auth()->user();
        $shelter = Shelter::where('user_id', $user->id)->first();


        $reports = Report::where('shelter_status', '!=', 'resolved')->get();
        
        return $reports;
    }

    public function countReports()
    {
        $reports = Report::where('shelter_status' , 'pending')->count();
        return $reports;
    }

    public function reportStatus($credentionls)
    {
        $report = Report::find($credentionls['report_id']);
        if ($report) {
            $report->shelter_status = $credentionls['shelter_status'];
            $report->save();
            return true;
        }
        return false;
    }   
}