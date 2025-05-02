<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateReportStatus;
use App\Services\shelter\ReportsShelterService;

class ReportShelterController extends Controller
{
    //
    protected $reportsShelterService;
    public function __construct(ReportsShelterService $reportsShelterService)
    {
        $this->reportsShelterService = $reportsShelterService;
    }
    public function index()
    {
        $user = auth()->user();
        $user = User::where('id', $user->id)->first();
        $reports = $this->reportsShelterService->getAllReports();
        return view('shelter.reports.reports' , compact('reports' , 'user'));
    }

    public function reportStatus(ValidateReportStatus $request)
    {
        $reportid = $request->input('report_id');
        $status = $request->input('shelter_status');

        $credentionls = [
            'report_id' => $reportid,
            'shelter_status' => $status
        ];
        $report = $this->reportsShelterService->reportStatus($credentionls);
        if ($report) {
            return redirect()->back()->with('success', 'Report status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update report status.');
        }

    }
}
