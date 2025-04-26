<?php

namespace App\Services\admin;

use App\Repository\Admin\AdminRepository;



class AdminService{

    protected $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }


    public function totalReports()
    {
        return $this->adminRepository->totalReports();
    }

    public function totalAdoptions()
    {
        return $this->adminRepository->totalAdoptions();
    }

    public function totalShelters()
    {
        return $this->adminRepository->totalShelters();
    }

    public function pendingAdoptions()
    {
        return $this->adminRepository->pendingAdoptions();
    }

    public function getLastFourAnimals()
    {
        return $this->adminRepository->getLastFourAnimals();
    }

    public function recentAnimalReportsWithAnimal()
    {
        return $this->adminRepository->recentAnimalReportsWithAnimal();
    }

    public function recentAdoptionRequestWithAnimal()
    {
        return $this->adminRepository->recentAdoptionRequestWithAnimal();
    }
}