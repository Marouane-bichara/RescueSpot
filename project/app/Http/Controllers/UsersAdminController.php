<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersAdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.users.users');
    }
}
