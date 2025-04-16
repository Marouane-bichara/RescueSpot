<?php

namespace App\Repository\users;

use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileRepository
{
    
    public function updateProfileInfo($credentials)
    {
        $user = auth()->user();

        if (isset($credentials['profilePhoto']) && $credentials['profilePhoto']) {
            if ($user->profilePhoto && \Storage::exists($user->profilePhoto)) {
                \Storage::delete($user->profilePhoto);
            }
    
            $profilePath = $credentials['profilePhoto']->store('profile_photos', 'public');
            $credentials['profilePhoto'] = $profilePath;
        } else {
            unset($credentials['profilePhoto']); 
        }
    

        if (isset($credentials['backgroundProfile']) && $credentials['backgroundProfile']) {
            if ($user->backgroundPhoto && \Storage::exists($user->backgroundPhoto)) {
                \Storage::delete($user->backgroundPhoto);
            }
    
            $backgroundPath = $credentials['backgroundProfile']->store('background_photos', 'public');
            $credentials['backgroundProfile'] = $backgroundPath;
        } else {
            unset($credentials['backgroundProfile']); 
        }
    

        unset($credentials['email']);
    
    
        $user->update($credentials);
    
        return $user;
    }
}