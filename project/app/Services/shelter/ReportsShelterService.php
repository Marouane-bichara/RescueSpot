<?php
namespace App\Services\shelter;

use App\Repository\SheltersRepository\ReportsShelterRepository;


class ReportsShelterService
{
    
    protected $reportsShelterRepository;
    public function __construct(ReportsShelterRepository $reportsShelterRepository)
    {
        $this->reportsShelterRepository = $reportsShelterRepository;
    }

    public function getAllReports()
    {
        return $this->reportsShelterRepository->getAllReports();
    }

    public function countReports()
    {
        return $this->reportsShelterRepository->countReports();
    }

    public function reportStatus($credentionls)
    {
        return $this->reportsShelterRepository->reportStatus($credentionls);

    }

}