<?php

namespace App\Services\admin;

use App\Repository\Admin\AdoptionsRepository;

class AdoptionsService{


    protected $adoptionRepository;
    public function __construct(AdoptionsRepository $adoptionRepository)
    {
        $this->adoptionRepository = $adoptionRepository;
    }
    public function getAdoptions()
    {
        $adoptions = $this->adoptionRepository->getAdoptions();
        return $adoptions;
    }
    public function countAdoptions()
    {
        $adoptions = $this->adoptionRepository->countAdoptions();
        return $adoptions;
    }
}