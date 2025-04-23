<?php 

namespace App\Services\users;

use App\Repositories\users\UserAprovedAdoptionRepository;



class UserAprovedAdoptionService
{
    
    protected $userAprovedAdoptionRepository;

    public function __construct(UserAprovedAdoptionRepository $userAprovedAdoptionRepository)
    {
        $this->userAprovedAdoptionRepository = $userAprovedAdoptionRepository;
    }

    
}