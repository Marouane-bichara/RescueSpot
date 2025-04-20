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

    public function profileDeleteAnimal($id){
        return $this->shelterProfileRepository->profileDeleteAnimal($id);
    }

    public function updateAnimal($id, $data){
        return $this->shelterProfileRepository->updateAnimal($id, $data);
    }

    public function editShelterProfileI($request, $validatedData){
        if ($request->hasFile('profilePhoto')) {
            $validatedData['profilePhoto'] = $request->file('profilePhoto')->store('profile_photos', 'public');
        }

        if ($request->hasFile('backgroundProfile')) {
            $validatedData['backgroundProfile'] = $request->file('backgroundProfile')->store('backgrounds', 'public');
        }    


        $user = auth()->user();

        $this->shelterProfileRepository->updateUser($user, $validatedData);
        $this->shelterProfileRepository->updateShelter($user->shelter, $request);

        return true; 
    } 
}