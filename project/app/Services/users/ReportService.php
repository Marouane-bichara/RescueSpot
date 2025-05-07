<?php

namespace App\Services\users;

use App\Models\User;
use App\Repository\users\ReportsRepository;


class ReportService
{  
    protected $ReportsRepository;
    public function __construct(ReportsRepository $ReportsRepository)
    {
        $this->ReportsRepository = $ReportsRepository;
    }


    public function getUserInfo($userId){
        $user = $this->ReportsRepository->getUserInfo($userId);
        return $user;
    }

 
    public function addReports($credentials){

        $reports = $this->ReportsRepository->addReports($credentials);
        return $reports;
    }
}   