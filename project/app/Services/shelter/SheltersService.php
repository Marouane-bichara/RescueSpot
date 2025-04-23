<?php 

namespace App\Services\shelter;

use App\Models\Shelter;
use App\Repository\SheltersRepository\SheltersRepository;

class SheltersService
{

    protected $sheltersRepository;
    public function __construct(SheltersRepository $sheltersRepository)
    {
        $this->sheltersRepository = $sheltersRepository;
    }

    public function getallTheAdoptionRequests()
    {
        $alladoptionReq = $this->sheltersRepository->getallTheAdoptionRequests();

        return $alladoptionReq; 
    }

    public function getLatestReports()
    {
        $reports = $this->sheltersRepository->getLatestReports(); 
        return $reports;
    }

    public function sheltAnimalsForAdoption()
    {
        $shelterAnimals = $this->sheltersRepository->sheltAnimalsForAdoption(); 
        return $shelterAnimals;
    }

    public function getallAdoptionsReqPaginations(){
        $adoptionReq = $this->sheltersRepository->getallAdoptionsReqPaginations(); 
        return $adoptionReq;
    }
    public function addAnimal($credentials)
    {
        $animal = $this->sheltersRepository->addAnimal($credentials); 
        return $animal;
    }

    public function getMessages()
    {
        $messages = $this->sheltersRepository->getMessages(); 
        return $messages;
    }

    public function rejectAdoptionRequest($id)
    {
        $adoptionRequest = $this->sheltersRepository->rejectAdoptionRequest($id); 
        return $adoptionRequest;
    }
    public function aproveAdoptionRequest($id)
    {
        $adoptionRequest = $this->sheltersRepository->aproveAdoptionRequest($id); 
        return $adoptionRequest;
    }
    
} 