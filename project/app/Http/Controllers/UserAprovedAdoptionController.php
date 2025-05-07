<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\users\UserAprovedAdoptionService;

class UserAprovedAdoptionController extends Controller
{
    protected $userAprovedAdoptionService;

    public function __construct(UserAprovedAdoptionService $userAprovedAdoptionService)
    {
        $this->userAprovedAdoptionService = $userAprovedAdoptionService;
    }

    public function index()
    {
        $adoptionDetails = $this->userAprovedAdoptionService->getAllAdoptionRequestAproved();
        $userinfo = auth()->user();
        return view('user.aprovedrequest.aprovedrequest', compact('adoptionDetails' , 'userinfo'));
    }
}
