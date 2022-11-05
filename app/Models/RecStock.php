<?php

namespace App\Models;

use Carbon\Carbon;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'rec_no',
        'vendor_id',
        'po_stock_id',
        'rec_inv_ven',
        'approved',
        'ppn',
        'status',
        'username',
        'print',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function scopePoStockDetail($query)
    {
        $query->addSelect(['po_no' => PoStock::whereColumn('rec_stocks.po_stock_id','id' )
            ->selectRaw('po_no as po_no')
        ]);
    }

    public function approved(): Attribute
    {
        return new Attribute(
            get: fn ($value) => (!$value) ? '00-00-0000 00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:m A'),
        );
    }

    public function vendor()
    {
    	return $this->belongsTo('App\Models\Vendor','vendor_id');
    }

    public function po_stock()
    {
    	return $this->belongsTo('App\Models\PoStock','po_stock_id');
    }

    public function rec_stock_detail()
    {
    	return $this->hasMany('App\Models\RecStockDetail','rec_id');
    }
}
