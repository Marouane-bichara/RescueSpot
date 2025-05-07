<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use App\Models\Report;
use App\Models\Message;
use App\Models\Adoption;
use App\Models\Follower;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //

    public function indexHome()
    {
        $reports = Report::latest()->paginate(6);  // Paginate reports, 10 per page
        $readyAnimals = Animal::where('status', 'ready')->paginate(6);

        $user = auth()->user();

        $reportsUser = Report::where('reporter_id', $user->id)->get();
        $userinfo = User::where('id', $user->id)->first();


            

        return view('user.home', compact('reports', 'readyAnimals' , 'reportsUser'  , 'userinfo'));
    }




}
