<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;
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
            if($type == 'POS'){
                $movement[] = $this->savePoStock($detail, $doc_number, $type,$keterangan, $create_at);
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
            'in_qty' => (float)Str::of($detail->in_qty)->replaceMatches('/[^\d\.]/', '')->value,
            'out_qty' => (float)Str::of($detail->out_qty)->replaceMatches('/[^\d\.]/', '')->value,
            'harga_modal' => (float)Str::of($detail->harga_modal)->replaceMatches('/[^\d\.]/', '')->value,
            'harga_jual' => (float)Str::of($detail->harga_jual)->replaceMatches('/[^\d\.]/', '')->value,
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
            'out_qty' => (float)Str::of($detail->qty)->replaceMatches('/[^\d\.]/', '')->value,
            'harga_modal' => 0,
            'harga_jual' => 0,
            'user' => Auth::user()->name,
            'ket' => $keterangan,
        ];
        return $data;
    }

    function savePoStock($detail, $doc_number, $type,$keterangan, $create_at)
    {
        $data = [
            'stock_master_id' => $detail->stock_master_id,
            'branch_id' => Auth::user()->branch_id,
            'move_date' => $create_at,
            'type' => $type,
            'doc_no' => $doc_number,
            'order_qty' => (float)Str::of($detail->qty)->replaceMatches('/[^\d\.]/', '')->value,
            'sell_qty' => 0,
            'in_qty' => 0,
            'out_qty' => 0,
            'harga_modal' => (float)Str::of($detail->price)->replaceMatches('/[^\d\.]/', '')->value,
            'harga_jual' => 0,
            'user' => Auth::user()->name,
            'ket' => $keterangan,
        ];
        return $data;
    }
}