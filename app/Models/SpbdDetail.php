<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpbdDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id', 
        'spbd_id', 
        'name', 
        'stock_master_id', 
        'qty', 
        'keterangan', 
        'status', 
    ];
    

    public function stock_master()
    {
        return $this->belongsTo('App\Models\StockMaster','stock_master_id')->soh();
    }

    public function Spbd()
    {
        return $this->belongsTo('App\Models\Spbd','spbd_id');
    }
}
