<?php

namespace App\Http\Controllers;

use App\Services\admin\UsersAdminService;
use Illuminate\Http\Request;

class UsersAdminController extends Controller
{
    //
    protected $userAdminService;
    public function __construct(UsersAdminService $userAdminService)
    {
        $this->userAdminService = $userAdminService;
    }
    public function index()
    {
        $users = $this->userAdminService->getAllUsers();
        return view('admin.users.users' , compact('users'));
    }
}
