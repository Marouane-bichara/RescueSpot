<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Services\shelter\ShelterProfileServices;

class ShelterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $shelterProfileServices;

    public function __construct(ShelterProfileServices $shelterProfileServices)
    {
        $this->shelterProfileServices = $shelterProfileServices;
    }

    public function index()
    { 
        //
        $userID = auth()->user()->id;
        $user = User::where('id', $userID)->first();
        $statisticShelter = $this->shelterProfileServices->statisticShelter();
        $animals = $this->shelterProfileServices->shelterAnimals();
        return view('shelter.profile.profile' , compact('user' , 'statisticShelter' , 'animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $animal = Animal::findOrFail($id);

        $this->authorize('update', $animal);
        $updateAnimal = $this->shelterProfileServices->updateAnimal($id, $request->all());
        if ($updateAnimal) {
            return redirect()->back()->with('success', 'Animal updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Animal not found!');
        }
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $animal = Animal::findOrFail($id);

        $this->authorize('delete', $animal);
        $deleteanimal = $this->shelterProfileServices->profileDeleteAnimal($id);
        if ($deleteanimal) {
            return redirect()->back()->with('success', 'Animal deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Animal not found!');
        }
    }
}
