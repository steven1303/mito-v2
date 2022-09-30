<?php

namespace App\Http\Controllers\Admins\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Admins\SettingAjaxController;

class StockMovementController extends SettingAjaxController
{
    public function index($id)
    {
        if(Auth::user()->can('stock.master.movement')){
            $stock_master = StockMaster::where([
                ['id', '=', $id],
                ['id_branch', '=', Auth::user()->id_branch]
            ])->first();

            $avg_jual = $stock_master->stock_movement()->where([
                ['sell_qty','>', 0],
                ['status','=', 0]
            ])->count();
            $avg_modal =  $stock_master->stock_movement()->where([
                ['order_qty','>', 0],
                ['status','=', 0]
            ])->count();
            if($avg_modal > 0){
                $avg_modal = $stock_master->stock_movement()->where([['order_qty','>', 0],['status','=', 0]])->sum('harga_modal') / $stock_master->stock_movement()->where([['order_qty','>', 0],['status','=', 0]])->count();
            }
            if($avg_jual > 0){
                $avg_jual = $stock_master->stock_movement()->where([['sell_qty','>', 0],['status','=', 0]])->sum('harga_jual')  / $stock_master->stock_movement()->where([['sell_qty','>', 0],['status','=', 0]])->count();
            }
            $data = [
                'stock_detail' => $stock_master,
                'avg_modal' => $avg_modal,
                'avg_jual' => $avg_jual,
            ];
            return view('admins.contents.inventory.stockMovement')->with($data);
        }
        return view('admin.components.403');
    }
}
