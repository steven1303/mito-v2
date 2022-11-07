<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecStockDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'rec_id',
        'po_detail_id',
        'stock_master_id',
        'receive',
        'price',
        'disc',
        'keterangan',
        'status',
    ];
    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    protected function receive(): Attribute
    {        
        return new Attribute(
            set: fn($value) => (float)Str::of($value)->replaceMatches('/[^\d\.]/', '')->value,
        );
    }

    protected function price(): Attribute
    {        
        return new Attribute(
            set: fn($value) => (float)Str::of($value)->replaceMatches('/[^\d\.]/', '')->value,
            get: fn($value) => "Rp ". number_format($value ,2,'.',',') ,
        );
    }
    protected function disc(): Attribute
    {        
        return new Attribute(
            set: fn($value) => (float)Str::of($value)->replaceMatches('/[^\d\.]/', '')->value,
            get: fn($value) => "Rp ". number_format($value ,2,'.',',') ,
        );
    }

    public function stock_master()
    {
        return $this->belongsTo('App\Models\StockMaster','stock_master_id')->soh();
    }

    public function po_stock_detail()
    {
        return $this->belongsTo('App\Models\PoStockDetail','po_detail_id');
    }
}
