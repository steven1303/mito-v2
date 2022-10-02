<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;

trait StockMasterMovement {

    public function addStockMovement($data, $doc_number, $type,$keterangan, $create_at)
    {
        foreach ($data as $detail ) {
            $data = [
                'stock_master_id' => $detail->stock_master_id,
                'branch_id' => Auth::user()->branch_id,
                'move_date' => $create_at,
                'type' => $type,
                'doc_no' => $doc_number,
                'order_qty' => 0,
                'sell_qty' => 0,
                'in_qty' => $detail->in_qty,
                'out_qty' => $detail->out_qty,
                'harga_modal' => $detail->harga_modal,
                'harga_jual' => $detail->harga_jual,
                'user' => Auth::user()->name,
                'ket' => $keterangan.'at ('.Carbon::now().')',
            ];
            StockMovement::create($data);
        }
    }
}