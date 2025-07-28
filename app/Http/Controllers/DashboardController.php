<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function kader()
    {
        return view('dashboard.kader');
    }

    public function orangtua()
    {
        return view('dashboard.orangtua');
    }
}
