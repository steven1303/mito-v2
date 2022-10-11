<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;

trait StockMasterMovement {

    public function addSAdjustmentMovement($data, $doc_number, $type, $keterangan, $create_at)
    {
        $movement = collect([]);
        foreach ($data as $detail ) {
            if($type == 'ADJ'){
                $movement->push($this->saveAjustment($detail, $doc_number, $type,$keterangan, $create_at));
            }            
            
        }
        StockMovement::insert($movement);
    }

    function saveAjustment($detail, $doc_number, $type,$keterangan, $create_at)
    {
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
        return $data;
    }
}