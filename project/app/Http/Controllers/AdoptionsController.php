<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\users\AdoptionsService;
use App\Http\Requests\AdoptionValidation;

class AdoptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $adoptionService;
    public function __construct(AdoptionsService $adoptionService)
    {
        $this->adoptionService = $adoptionService;
    }
    public function index()
    {
        // 

        $user = auth()->user();

        $userinfo = User::where('id', $user->id)->first();
        $animals = $this->adoptionService->getAllAdoptions();

        return view('user.adoptions.adoptions', compact('animals' , 'userinfo'));   
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
    public function store(AdoptionValidation $request)
    {
        //

        $adoptionOrFail = $this->adoptionService->storeAdoption($request->all());
        if($adoptionOrFail)
        {
            return redirect()->back()->with('success', 'Adoption created successfully');

        }

        if($adoptionOrFail == false)
        {
            return redirect()->back()->with('error', 'Adoption already exists');
        }
        return redirect()->back()->with('error', 'Failed to create adoption');
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
    }
}
