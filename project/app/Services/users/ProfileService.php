<?php

namespace App\Services\users;

use App\Models\User;
use App\Repository\users\ProfileRepository;


class ProfileService
{

        
    protected $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }


    public function updateProfileInfo($credentials){

        $user = $this->profileRepository->updateProfileInfo($credentials);
        return $user;
    }
}   