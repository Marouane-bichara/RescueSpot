<?php

namespace App\Repository\users;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Reports;
use Illuminate\Support\Facades\Auth;

class ReportsRepository
{


    public function getUserInfo($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return null; 
        }
        return $user;
    }

    public function addReports($credentials)
    {
        $user = $user = auth()->user();

        
        $addreport = Reports::create([
            'reporter_id' => $user->id,
            'photo' => $credentials->file('photo')->store('photos', 'public'),
            'location' => $credentials->input('location'),
            'reportDate' => $credentials->input('reportDate'),
            'description' => $credentials->input('description'),
            'status' => $credentials->input('status'),
        ]);
        return $addreport;
    }
}