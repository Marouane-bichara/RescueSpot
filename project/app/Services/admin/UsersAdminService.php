<?php
namespace App\Services\admin;

use App\Models\User;
use App\Repository\Admin\UsersAdminRepository;


class UsersAdminService
{
    protected $userAdminRepository;

    public function __construct(UsersAdminRepository $userAdminRepository)
    {
        $this->userAdminRepository = $userAdminRepository;
    }

    public function getAllUsers()
    {
        return $this->userAdminRepository->getAllUsers();
    }
}