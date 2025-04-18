<?php
namespace App\Repository\SheltersRepository;

use App\Models\Animal;
use App\Models\Report;


class ShelterProfileRepository
{
   public function statisticShelter(){
         $shelter = auth()->user()->shelter;
         $totalAnimals = Animal::where('shelter_id', $shelter->id)->count();
         $totalAdopted = Animal::where('shelter_id', $shelter->id)->where('status', 'adopted')->count();
         $totalReports = Report::all()->count();

         return compact('shelter', 'totalAnimals', 'totalAdopted', 'totalReports');
   }

   public function shelterAnimals(){
            $shelter = auth()->user()->shelter;
            $animals = Animal::where('shelter_id', $shelter->id)->get();
            return $animals;
   } 
}

