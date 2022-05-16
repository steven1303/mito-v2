<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Admins\SettingsController;

class DashboardController extends SettingsController
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admins.app');
    }

    public function dashboard(Request $request)
    {
        return view('admins.contents.dashboard');
    }
}
