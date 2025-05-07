<?php 

namespace App\Services\users;

use App\Repository\users\UserAprovedAdoptionRepository;

class UserAprovedAdoptionService
{
    protected $userAprovedAdoptionRepository;

    public function __construct(UserAprovedAdoptionRepository $userAprovedAdoptionRepository)
    {
        $this->userAprovedAdoptionRepository = $userAprovedAdoptionRepository;
    }

    public function getAllAdoptionRequestAproved()
    {
        // Get the approved adoption requests from the repository
        return $this->userAprovedAdoptionRepository->getAllAdoptionRequestAproved();
    }
}
