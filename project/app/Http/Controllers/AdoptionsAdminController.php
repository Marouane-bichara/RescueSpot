<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\admin\AdoptionsService;

class AdoptionsAdminController extends Controller
{
    //
    protected $adoptionService;

    public function __construct(AdoptionsService $adoptionService)
    {
        $this->adoptionService = $adoptionService;
    }


    public function index()
    {
        $adoptions = $this->adoptionService->getAdoptions();
        return view('admin.adoptions.adoptions' , compact('adoptions'));
    }
}
