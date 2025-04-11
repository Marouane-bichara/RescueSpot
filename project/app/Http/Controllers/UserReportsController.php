<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReportsController extends Controller
{
    //

    public function indexReports()
    {
        view('user.reports.reports');
    }
}
