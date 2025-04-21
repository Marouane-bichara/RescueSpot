<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\shelter\SheltersService;

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


    public function rejectAdoptionRequest($id)
    {
        $adoptionRequest = $this->sheltersService->rejectAdoptionRequest($id);
        return redirect()->back()->with('success', 'Adoption request rejected successfully.');
    }
}
