<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shelter;
use Illuminate\Http\Request;
use App\Services\shelter\SheltersService;

class SheltersController extends Controller
{
    //

    protected $sheltersService;


    public function __construct(SheltersService $sheltersService ){
        $this->sheltersService = $sheltersService;
    }

    public function indexHome()
    {
        $user = auth()->user();
        $user = User::where('id', $user->id)->first();
        $adoptionRequests = $this->sheltersService->getallTheAdoptionRequests();
        $messages = null;
        $allthereports = $this->sheltersService->getLatestReports(); 
        $allAnimalsReadyForAdoption = $this->sheltersService->sheltAnimalsForAdoption();
        $shelterid = auth()->user()->id;
        $shelter = User::where('id', $shelterid)->first();
        return view('Shelter.home' , compact('shelter' , 'adoptionRequests' , 'allthereports' , 'allAnimalsReadyForAdoption'  , 'messages' , 'user'));
    }
}
