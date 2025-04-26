<?php 

namespace App\Repository\Admin;

use App\Models\Animal;
use App\Models\Report;
use App\Models\Shelter;
use App\Models\Adoption;


class AdminRepository{


    public function totalReports()
    {
        $totalReports = Report::count();
        return $totalReports;
    }

    public function totalAdoptions()
    {
        $totalAdoptions = Adoption::where('status', 'adopted')->count();
        return $totalAdoptions;
    }

    public function totalShelters()
    {
        $totalShelters = Shelter::count();
        return $totalShelters;
    }

    public function pendingAdoptions()
    {
        $pendingAdoptions = Adoption::where('status', 'pending')->count();
        return $pendingAdoptions;
    }

    public function getLastFourAnimals()
    {
        $lastFourAnimals = Animal::orderBy('created_at', 'desc')->take(4)->get();
        return $lastFourAnimals;
    }

    public function recentAnimalReportsWithAnimal()
    {
        // just reports without animals
        $recentAnimalReports = Report::orderBy('created_at', 'desc')->take(4)->get();
        return $recentAnimalReports;
    }

    public function recentAdoptionRequestWithAnimal()
    {
        $recentAdoptionRequestWithAnimal = Adoption::with('animal')->where('status', 'pending')->orderBy('created_at', 'desc')->take(4)->get();
        return $recentAdoptionRequestWithAnimal;
    }


}