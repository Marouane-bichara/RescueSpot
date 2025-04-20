<?php
namespace App\Repository\SheltersRepository;

use App\Models\Animal;
use App\Models\Report;
use Illuminate\Http\Request;


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

   public function profileDeleteAnimal($id){

            $animal = Animal::find($id);
            if ($animal) {
                   $animal->delete();
                   return true;
            } 
            return false;
   }

    public function updateAnimal($id, $data){
            $animal = Animal::find($id);
            if ($animal) {
                $animal->update($data);
                return true;
            } 
            return false;
            }

     public function updateUser($user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function updateShelter($shelter, Request $request)
    {
        if ($shelter) {
            $shelter->update([
                'website' => $request->input('website'),
                'description' => $request->input('bio'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'shelterName' => $request->input('name'),
            ]);  
        }
        return $shelter;
    }
}

