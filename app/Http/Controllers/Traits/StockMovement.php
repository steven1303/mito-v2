<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;

trait Stock_Movement {

    public function addStockMovement($data)
    {
        foreach ($data as $detail ) {
            $data = [
                'id_stock_master' => $detail->id_stock_master,
                'id_branch' => $detail->id_branch,
                'move_date' => $detail->adj->created_at,
                // 'bin' => "-",
                'type' => 'ADJ',
                'doc_no' => $detail->adj->adj_no,
                'order_qty' => 0,
                'sell_qty' => 0,
                'in_qty' => $detail->in_qty,
                'out_qty' => $detail->out_qty,
                'harga_modal' => $detail->harga_modal,
                'harga_jual' => $detail->harga_jual,
                'user' => Auth::user()->name,
                'ket' => 'Adjustment Approved at ('.Carbon::now().')',
            ];
            $movement = StockMovement::create($data);
        }
    }
}