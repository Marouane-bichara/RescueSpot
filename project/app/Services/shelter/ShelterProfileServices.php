<?php

namespace App\Services\shelter;

use App\Repository\SheltersRepository\ShelterProfileRepository;

class ShelterProfileServices
{
    protected $shelterProfileRepository;

     public function __construct(ShelterProfileRepository $shelterProfileRepository){
        $this->shelterProfileRepository = $shelterProfileRepository;
     }

   public function statisticShelter(){
        return $this->shelterProfileRepository->statisticShelter();
    }

    public function shelterAnimals(){
        return $this->shelterProfileRepository->shelterAnimals();
    }
}