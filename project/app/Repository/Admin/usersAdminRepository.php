<?php

namespace App\Repository\Admin;

use App\Models\User;


class usersAdminRepository{
    public function getAllUsers()
    {
        $users = User::all();
        return $users;
    }
}