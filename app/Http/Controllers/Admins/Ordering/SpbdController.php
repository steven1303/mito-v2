<?php

namespace App\Http\Controllers\Admins\Ordering;

use App\Models\Spbd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;

class SpbdController extends SettingAjaxController
{
    use DocNumber;    
    use StockMasterMovement;

    public function index()
    {
        if(Auth::user()->can('spbd.view')){
            $data = [];
            return view('admins.contents.ordering.spbd.spbdList')->with($data);
        }
        return view('admins.components.403');
    }

    public function transfer_branch_form($id)
    {
        if(Auth::user()->can('spbd.store')){
            $spbd = Spbd::findOrFail($id);
            $data = [
                'spbd' => $spbd,
            ];
            return view('admins.contents.ordering.spbd.spbdForm')->with($data);
        }
        return view('admins.components.403');
    }
}
