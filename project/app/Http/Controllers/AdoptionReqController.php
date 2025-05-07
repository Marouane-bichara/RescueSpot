<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\shelter\SheltersService;
use App\Http\Requests\ValidateRejectAdoptionReq;

class AdoptionReqController extends Controller
{
    //
    
    protected $sheltersService;


    public function __construct(SheltersService $sheltersService ){
        $this->sheltersService = $sheltersService;
    }
 
    public function index()
    {
        $adoptionRequests = $this->sheltersService->getallAdoptionsReqPaginations();
        $user = auth()->user();

        return view('shelter.adoptionreq.adoptionreq', compact('adoptionRequests' , 'user'));
    }


    public function rejectAdoptionRequest(ValidateRejectAdoptionReq $request)
    {
        $id = $request->input('adoption_request_id');
        $adoptionRequest = $this->sheltersService->rejectAdoptionRequest($id);
        return redirect()->back()->with('success', 'Adoption request rejected successfully.');
    } 
    public function aproveAdoptionRequest(Request $request)
    {

        $id = $request->input('adoption_request_id');
        $adoptionRequest = $this->sheltersService->aproveAdoptionRequest($id);
        return redirect()->back()->with('success', 'Adoption request rejected successfully.');
    }
}
