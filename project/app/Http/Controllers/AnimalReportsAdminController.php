<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateDeleteReport;
use App\Services\admin\AnimalReportsAdminService;

class AnimalReportsAdminController extends Controller
{
    //

    protected $animalReportsAdminService;
    public function __construct(AnimalReportsAdminService $animalReportsAdminService)
    {
        $this->animalReportsAdminService = $animalReportsAdminService;
    }
    public function index()
    {
        $animalReports = $this->animalReportsAdminService->getAnimalReports();
        $animalReportsCount = $this->animalReportsAdminService->countAnimalReports();
        $arrayofAnimalReports = ["animalReports" => $animalReports , "animalReportsCount" => $animalReportsCount];
        return view('admin.AnimalReport.AnimalReport' , compact('arrayofAnimalReports'));
    }

    public function deleteReport(ValidateDeleteReport $request)
    {
        $animalReportId = $request->input('report_id');

        $animalReport = $this->animalReportsAdminService->getAnimalReportById($animalReportId);
        if ($animalReport) {
            $this->animalReportsAdminService->deleteReport($animalReportId);
            return redirect()->back()->with('success', 'Animal report deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Animal report not found.');
        }
    }

}
