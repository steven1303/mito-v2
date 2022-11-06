<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Spbd;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'po_no',
        'spbd_id',
        'vendor_id',
        'approve',
        'status',
        'ppn',
        'username',
        'request',
        'po_print',
    ];
    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function approve(): Attribute
    {
        return new Attribute(
            get: fn ($value) => (!$value) ? '00-00-0000 00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:m A'),
        );
    }

    public function scopeSpbdDetail($query)
    {
        $query->addSelect(['spbd_no' => Spbd::whereColumn('po_stocks.spbd_id','id' )
            ->selectRaw('spbd_no as spbd_no')
        ]);
    }

    public function scopeItemDetail($query)
    {
        $query->addSelect(['total_ppn' => PoStockDetail::whereColumn('po_stocks.id','po_id' )
            ->selectRaw('TRIM(IFNULL(sum((qty * price) - disc),0))+0 as total_ppn')
        ]);
    }

    public function spbd()
    {
    	return $this->belongsTo('App\Models\Spbd','spbd_id');
    }

    public function vendor()
    {
    	return $this->belongsTo('App\Models\Vendor','vendor_id');
    }

    public function po_stock_detail()
    {
    	return $this->hasMany('App\Models\PoStockDetail','po_id');
    }
}
