<?php

namespace App\Http\Controllers\Admins\Inventory;

use App\Models\StockMaster;
use Illuminate\Http\Request;
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
}
