<?php 

namespace App\Services\Admin;

use App\Repository\Admin\SheltersAdminRepository;

class SheltersAdminService
{
    protected $sheltersAdminRepository;

    public function __construct(SheltersAdminRepository $sheltersAdminRepository)
    {
        $this->sheltersAdminRepository = $sheltersAdminRepository;
    }

    public function getShelters()
    {
        return $this->sheltersAdminRepository->getShelters();
    }
    public function active($id)
    {
        return $this->sheltersAdminRepository->active($id);
    }
    public function inactive($id)
    {
        return $this->sheltersAdminRepository->inactive($id);
    }
}