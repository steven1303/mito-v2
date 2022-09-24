<?php

namespace App\Http\Controllers\Admins\Inventory;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ActionButton;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Models\Adjustment;

class AdjustmentController extends SettingAjaxController
{
    use ActionButton;

    public function index()
    {
        if(Auth::user()->can('adjustment.view')){
            $data = [];
            return view('admins.contents.inventory.adjustment.adjustmentList')->with($data);
        }
        return view('admins.components.403');
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('adjustment.view')){
            $data = Adjustment::latest()->get();
            $access =   $this->accessEditDelete( $auth, 'adjustment');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $action = $this->buttonEditDelete($data, $access);
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }
}
