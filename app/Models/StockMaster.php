<?php

namespace App\Models;

use App\Scopes\BranchScope;
use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_no',
        'branch_id', 
        'bin', 
        'name', 
        'satuan', 
        'min_soh', 
        'max_soh', 
        'harga_modal', 
        'harga_jual'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function scopeIncludeData($query)
    {            
        $query->addSelect([
            'avg_modal' => StockMovement::whereColumn('stock_master_id', 'stock_masters.id')
            ->where([['harga_modal','>', 0],['status','=', 0]])
            ->selectRaw('TRIM(IFNULL(sum(harga_modal),0))+0 as avg_modal')
        ]);

        $query->addSelect([
            'avg_jual' => StockMovement::whereColumn('stock_master_id', 'stock_masters.id')
            ->where([['harga_jual','>', 0],['status','=', 0]])
            ->selectRaw('TRIM(IFNULL(sum(harga_jual),0))+0 as avg_jual')
        ]);

        $query->addSelect([
            'total_order_qty' => StockMovement::whereColumn('stock_master_id', 'stock_masters.id')
            ->where([['order_qty','>', 0],['status','=', 0]])
            ->selectRaw('TRIM(IFNULL(sum(order_qty),0))+0 as total_order_qty')
        ]);

        $query->addSelect([
            'total_sell_qty' => StockMovement::whereColumn('stock_master_id', 'stock_masters.id')
            ->where([['sell_qty','>', 0],['status','=', 0]])
            ->selectRaw('TRIM(IFNULL(sum(sell_qty),0))+0 as total_sell_qty')
        ]);

        $query->addSelect([
            'total_in_qty' => StockMovement::whereColumn('stock_master_id', 'stock_masters.id')
            ->where([['in_qty','>', 0],['status','=', 0]])
            ->selectRaw('TRIM(IFNULL(sum(in_qty),0))+0 as total_in_qty')
        ]);

        $query->addSelect([
            'total_out_qty' => StockMovement::whereColumn('stock_master_id', 'stock_masters.id')
            ->where([['out_qty','>', 0],['status','=', 0]])
            ->selectRaw('TRIM(IFNULL(sum(out_qty),0))+0 as total_out_qty')
        ]);
    }

    public function scopeSoh($query)
    {
        $query->addSelect(['soh' => StockMovement::whereColumn('stock_master_id', 'stock_masters.id')
            ->selectRaw('TRIM(IFNULL(sum(in_qty - out_qty),0))+0 as soh')
        ]);
    }

    protected function minSoh(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => (float)$value - 0
        );
    }

    protected function maxSoh(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
            get: fn($value) => (float)$value - 0
        );
    }

    public function stock_movement()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id');
    }

}
