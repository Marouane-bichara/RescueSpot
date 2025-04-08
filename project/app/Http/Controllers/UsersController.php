<?php

namespace App\Http\Controllers;

use App\Models\Animals;
use App\Models\Reports;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //

    public function index()
    {
        $reports = Reports::latest()->paginate(10);  // Paginate reports, 10 per page
        $readyAnimals = Animals::where('status', 'ready')->paginate(6);
            
        return view('user.home', compact('reports', 'readyAnimals'));
    }
}
