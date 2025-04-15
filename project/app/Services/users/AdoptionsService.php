<?php 

namespace App\Services\users;

use App\Repository\users\AdoptionsRepository;



class AdoptionsService
{
    protected $adoptionRepository;
    public function __construct(AdoptionsRepository $adoptionRepository)
    {
        $this->adoptionRepository = $adoptionRepository;
    }



    public function getAllAdoptions()
    {
        $animals = $this->adoptionRepository->getAllAnimals();
        return $animals;
    }


    // public function createAdoption($createAdoption)
    // {
    //     return $this->adoptionRepository->createAdoption($createAdoption);
    // }

    public function storeAdoption($credanimals)
    {
        return $this->adoptionRepository->storeAdoption($credanimals);
    }
}