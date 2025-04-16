<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SheltersController extends Controller
{
    //

    public function indexHome()
    {

        $shelterid = auth()->user()->id;
        $shelter = User::where('id', $shelterid)->first();
        return view('Shelter.home' , compact('shelter'));
    }
}
