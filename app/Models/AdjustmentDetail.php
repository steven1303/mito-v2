<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'adj_id',
        'stock_master_id',
        'in_qty',
        'out_qty',
        'harga_modal',
        'harga_jual',
        'keterangan',
    ];

    public function stock_master()
    {
        return $this->belongsTo('App\Models\StockMaster','stock_master_id');
    }

    public function adj()
    {
        return $this->belongsTo('App\Models\Adjustment','adj_id');
    }
}
