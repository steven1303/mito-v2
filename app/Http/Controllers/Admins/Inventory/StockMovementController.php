<?php

namespace App\Http\Controllers\Admins\Inventory;

use App\Models\StockMaster;
use Illuminate\Http\Request;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admins\SettingAjaxController;

class StockMovementController extends SettingAjaxController
{
    public function index($id)
    {
        if(Auth::user()->can('stock.master.movement')){
            $stock_master = StockMaster::where([
                ['id', '=', $id]
            ])->first();
            $data = [
                'stock_detail' => $stock_master,
            ];
            return view('admins.contents.inventory.stockMovement')->with($data);
        }
        return view('admin.components.403');
    }

    public function record($id){
        if(Auth::user()->can('stock.master.movement')){
            $data = StockMovement::where([
                ['stock_master_id', '=', $id],
            ])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $action = "";
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Stock Movement Access Denied', 'stat' => 'Error']);
    }
}
