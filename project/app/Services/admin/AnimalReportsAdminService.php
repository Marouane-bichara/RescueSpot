<?php

namespace App\Services\admin;

use App\Repository\Admin\AnimalReportsAdminRepository;


class AnimalReportsAdminService
{
    protected $animalReportsAdminRepository;
     public function __construct(AnimalReportsAdminRepository $animalReportsAdminRepository){
        $this->animalReportsAdminRepository = $animalReportsAdminRepository;
     }
    public function getAnimalReports()
    {
        return $this->animalReportsAdminRepository->getAnimalReports();
    }
    public function countAnimalReports()
    {
        return $this->animalReportsAdminRepository->countAnimalReports();
    }
    public function getAnimalReportById($id)
    {
        return $this->animalReportsAdminRepository->getAnimalReportById($id);
    }

    public function deleteReport($id)
    {
        return $this->animalReportsAdminRepository->deleteReport($id);
    }
}
