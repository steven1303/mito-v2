<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('ajax.route');
    }
}
