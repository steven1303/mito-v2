<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;

trait StockMasterMovement {

    public function addMovement($data, $doc_number, $type, $keterangan, $create_at)
    {
        $movement = [];
        foreach ($data as $detail ) {
            if($type == 'ADJ'){
                $movement[] = $this->saveAdjustment($detail, $doc_number, $type,$keterangan, $create_at);
            }   
            if($type == 'TB'){
                $movement[] = $this->saveTransferBranch($detail, $doc_number, $type,$keterangan, $create_at);
            }            
        }
        // dd($movement);
        StockMovement::insert($movement);
    }

    function saveAdjustment($detail, $doc_number, $type,$keterangan, $create_at)
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

    function saveTransferBranch($detail, $doc_number, $type,$keterangan, $create_at)
    {
        $data = [
            'stock_master_id' => $detail->stock_master_id,
            'branch_id' => Auth::user()->branch_id,
            'move_date' => $create_at,
            'type' => $type,
            'doc_no' => $doc_number,
            'order_qty' => 0,
            'sell_qty' => 0,
            'in_qty' => 0,
            'out_qty' => $detail->qty,
            'harga_modal' => 0,
            'harga_jual' => 0,
            'user' => Auth::user()->name,
            'ket' => $keterangan.'at ('.Carbon::now().')',
        ];
        return $data;
    }
}