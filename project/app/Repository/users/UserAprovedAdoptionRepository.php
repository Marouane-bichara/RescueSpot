<?php

namespace App\Repository\users;

use App\Models\Adoption;
use Illuminate\Support\Facades\Auth;

class UserAprovedAdoptionRepository
{

public function getAllAdoptionRequestAproved()
{
    $user = Auth::user();

    $adoptions = Adoption::with(['animal.shelters', 'adopter'])
        ->where('adopterId', $user->id)  
        ->where('status', 'approved')  
        ->get();
    
    return $adoptions->map(function($adoption) {
        return [
            'status' => $adoption->status,  
            'animal_name' => $adoption->animal->name,
            'animal_image' => $adoption->animal->photoAnimal,
            'shelter_id' => $adoption->animal->shelter_id,
            'shelter_image' => $adoption->animal->shelters->first()->photo ?? null, 
            'shelter_address' => $adoption->animal->shelters->first()->address ?? 'No address available', 
        ];
    });
}

}
