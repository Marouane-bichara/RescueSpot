<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\admin\AdminService;

class AdminController extends Controller
{
    //

    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function indexHome()
    {
        $totalReports = $this->adminService->totalReports();
        $totalAdoptions = $this->adminService->totalAdoptions();
        $totalShelters = $this->adminService->totalShelters();
        $pendingAdoptions = $this->adminService->pendingAdoptions();
        $lastFourAnimals = $this->adminService->getLastFourAnimals();
        $recentAnimalReports = $this->adminService->recentAnimalReportsWithAnimal();
        $recentAdoptionRequestWithAnimal = $this->adminService->recentAdoptionRequestWithAnimal();

        $arrayofInfo = [
            'totalReports' => $totalReports,
            'totalAdoptions' => $totalAdoptions,
            'totalShelters' => $totalShelters,
            'pendingAdoptions' => $pendingAdoptions,
            'lastFourAnimals' => $lastFourAnimals,
            'recentAnimalReports' => $recentAnimalReports,
            'recentAdoptionRequestWithAnimal' => $recentAdoptionRequestWithAnimal
        ];
     
        return view('admin.home', compact('arrayofInfo'));
    }
}
