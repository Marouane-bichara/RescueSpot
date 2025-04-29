<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Admin\SheltersAdminService;

class SheltersAdminController extends Controller
{
    //

    protected $sheltersAdminService;
    public function __construct(SheltersAdminService $sheltersAdminService)
    {
        $this->sheltersAdminService = $sheltersAdminService;
    }
    public function index()
    {
        $shelters = $this->sheltersAdminService->getShelters();
        return view('admin.shelters.shelters' , compact('shelters'));
    }

    public function active(Request $request)
    {
        $userActive = $this->sheltersAdminService->active($request->user_id);
        if($userActive){
            return redirect()->back()->with('success' , 'User Active');
        }
        return redirect()->back()->with('error' , 'User Not Active');
    }
    public function inactive(Request $request)
    {
        $userActive = $this->sheltersAdminService->inactive($request->user_id);
        if($userActive){
            return redirect()->back()->with('success' , 'User inactive');
        }
        return redirect()->back()->with('error' , 'User Not inactive');
    }
}
