<?php 

namespace App\Repository\users;

use App\Models\User;
use App\Models\Animal;
use App\Models\Adoption;



class AdoptionsRepository
{

    


    public function getAllAnimals()
    {

        $animals = Animal::with('shelters')->where('status', 'ready')->get();
  
        return $animals;
    }


    public function storeAdoption($credanimals)
    {
        $user = auth()->user();
        $adopterId = $user->id;


        $getadoption = Adoption::where('animalId', $credanimals['animalId'])
            ->where('adopterId', $adopterId)
            ->first();

            if ($getadoption) {
                return false;
            }

        $auption = Adoption::create([
            'requestDate' => now(),
            'animalId' => $credanimals['animalId'],
            'adopterId' => $adopterId,
            'status' => 'pending',
        ]);

        return $auption;
        
    }


}