<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdjustmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'adj_id',
        'stock_master_id',
        'in_qty',
        'out_qty',
        'harga_modal',
        'harga_jual',
        'keterangan',
    ];

    protected function inQty(): Attribute
    {        
        return new Attribute(
            set: fn($value) => floatval(preg_replace('/[^\d\.]/', '', $value)),
        );
    }

    protected function outQty(): Attribute
    {        
        return new Attribute(
            set: fn($value) => floatval(preg_replace('/[^\d\.]/', '', $value)),
        );
    }

    protected function hargaModal(): Attribute
    {        
        return new Attribute(
            set: fn($value) => floatval(preg_replace('/[^\d\.]/', '', $value)),
        );
    }

    protected function hargaJual(): Attribute
    {        
        return new Attribute(
            set: fn($value) => floatval(preg_replace('/[^\d\.]/', '', $value)),
        );
    }

    public function stock_master()
    {
        return $this->belongsTo('App\Models\StockMaster','stock_master_id')->soh();
    }

    public function adj()
    {
        return $this->belongsTo('App\Models\Adjustment','adj_id');
    }
}
