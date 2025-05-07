<?php

namespace App\Repository\Admin;

use App\Models\Shelter;
use App\Models\User;

class SheltersAdminRepository
{
   public function getShelters()
   {
    $shelters = Shelter::with('user')->get();
    return $shelters;
    }

    public function active($id)
    {
        $user = User::find($id);
        if($user){
            $user->status = "active";
            $user->save();
            return true;
        }
        return false;
    }

    public function inactive($id)
    {
        $user = User::find($id);
        if($user){
            $user->status = "inactive";
            $user->save();
            return true;
        }
        return false;
    }
}