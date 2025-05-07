<?php

namespace App\Repository\Admin;

use App\Models\Report;



class AnimalReportsAdminRepository
{
    public function getAnimalReports()
    {
         $animalReports = Report::all();
            return $animalReports;
    }

    public function countAnimalReports()
    {
        return Report::count();
    }

    public function getAnimalReportById($id)
    {
        return Report::find($id);
    }

    public function deleteReport($id)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            return true;
        }
        return false;
    }
}