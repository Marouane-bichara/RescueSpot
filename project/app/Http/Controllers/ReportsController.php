<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\users\ReportService;
use App\Http\Requests\ReportValidationUser;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */








     protected $reportService;
     public function __construct(ReportService $reportService)
     {
         $this->reportService = $reportService;
     }


      
    public function index()
    {
        //

        $user = auth()->user();
        $userId = $user->id;
        $userInfo = $this->reportService->getUserInfo($userId);
        return view('user.reports.reports' , compact('userInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportValidationUser $request)
    {
        //
        $reportServiceR = $this->reportService->addReports($request);
        if ($reportServiceR) {
            return redirect()->route('user.UserReports.index')->with('success', 'Report added successfully');
        } else {
            return redirect()->route('user.UserReports.index')->with('error', 'Failed to add report');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
