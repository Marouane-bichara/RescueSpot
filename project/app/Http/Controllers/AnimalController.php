<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\shelter\SheltersService;
use App\Http\Requests\AddAnimalValidation;

class AnimalController extends Controller
{
    //
    protected $sheltersService;


    public function __construct(SheltersService $sheltersService){
        $this->sheltersService = $sheltersService;
    }

    public function index()
    {
        $user = auth()->user();
        $userinfo = User::find($user->id);
        $animals = $this->sheltersService->getallAnimalsOfShelter();

        return view('shelter.animals.animals' , compact('userinfo', 'animals'));
    }

    public function addAnimal(AddAnimalValidation $request)
    {

        $credentials = $request->validated();
        $animal = $this->sheltersService->addAnimal($credentials); 
        if($animal){
            return redirect()->route('shelter.HomeShelter')->with('success', 'Animal added successfully');;
        }else{
            return redirect()->route('shelter.HomeShelter')->with('error', 'Animal not added');;
        }
    }
}
