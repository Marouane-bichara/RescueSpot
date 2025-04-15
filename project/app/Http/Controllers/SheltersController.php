<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SheltersController extends Controller
{
    //

    public function indexHome()
    {
        return view('Shelter.home');
    }
}
