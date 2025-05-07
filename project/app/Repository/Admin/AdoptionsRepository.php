<?php

namespace App\Repository\Admin;

use App\Models\Adoption;


class AdoptionsRepository
{
    public function getAdoptions()
    {
    
        $adoptions = Adoption::with('animal' , 'adopter')
        ->get();
        if ($adoptions->isEmpty()) {
            return null; 
        }
        return $adoptions;
    }

    public function countAdoptions()
    {
        $adoptions = Adoption::where('status', 'approved')->count();
        return $adoptions;
    }
}