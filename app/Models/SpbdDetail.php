<?php

namespace App\Models;

use App\Models\PoStockDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    
    public function scopePoStockDetail($query)
    {
        $query->addSelect(['po_qty' => PoStockDetail::whereColumn('spbd_detail_id', 'spbd_details.id')
            ->selectRaw('TRIM(IFNULL(sum(qty),0))+0 as po_qty')
        ]);
    }

    public function stock_master()
    {
        return $this->belongsTo('App\Models\StockMaster','stock_master_id')->soh();
    }

    public function Spbd()
    {
        return $this->belongsTo('App\Models\Spbd','spbd_id');
    }

    public function po_detail()
    {
    	return $this->hasMany('App\Models\PoStockDetail','spbd_detail_id');
    }
}
