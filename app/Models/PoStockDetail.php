<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoStockDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'po_id',
        'spbd_detail_id',
        'stock_master_id',
        'qty',
        'price',
        'disc',
        'keterangan',
        'status',
    ];
    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    protected function price(): Attribute
    {        
        return new Attribute(
            set: fn($value) => (float)Str::of($value)->replaceMatches('/[^\d\.]/', '')->value,
        );
    }

    protected function qty(): Attribute
    {        
        return new Attribute(
            set: fn($value) => (float)Str::of($value)->replaceMatches('/[^\d\.]/', '')->value,
        );
    }
    protected function disc(): Attribute
    {        
        return new Attribute(
            set: fn($value) => (float)Str::of($value)->replaceMatches('/[^\d\.]/', '')->value,
        );
    }
    public function stock_master()
    {
        return $this->belongsTo('App\Models\StockMaster','stock_master_id')->soh();
    }
}