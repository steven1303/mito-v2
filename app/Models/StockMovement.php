<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_master_id',
        'branch_id',
        'move_date',
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
        'status'
    ];

    protected $appends = [
        'status_desc',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function statusDesc(): Attribute
    {
        return new Attribute(
            get: fn () => ($this->status == 0) ? 'Accept' : 'Reject',
        );
    }

    protected function orderQty(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => $value - 0
        );
    }

    protected function sellQty(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => $value - 0
        );
    }

    protected function inQty(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => $value - 0
        );
    }

    protected function outQty(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => $value - 0
        );
    }

    protected function hargaModal(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => $value - 0
        );
    }

    protected function hargaJual(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => $value - 0
        );
    }

    public function stock_master()
    {
    	return $this->belongsTo('App\Models\StockMaster','stock_master_id');
    }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }
}
