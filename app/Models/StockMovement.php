<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_master_id',
        'branch_id',
        'move_date',
        // 'bin',
        'type',
        'doc_no',
        'order_qty',
        'sell_qty',
        'in_qty',
        'out_qty',
        'harga_modal',
        'harga_jual',
        'user',
        'ket',
    ];

    public function stock_master()
    {
    	return $this->belongsTo('App\Models\StockMaster','stock_master_id');
    }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }
}
