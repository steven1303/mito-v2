<?php

namespace App\Models;

use App\Scopes\BranchScope;
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

    protected function minSoh(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
        );
    }

    protected function maxSoh(): Attribute
    {        
        return new Attribute(
            set: fn($value) => str_replace(",", "", $value),
        );
    }

    public function stock_movement()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id');
    }

    public function avg_modal()
    {
        // stock_movement()
        return $this->hasMany('App\Models\StockMovement','stock_master_id')->where([['harga_modal','>', 0],['status','=', 0]]);
    }

    public function avg_jual()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id')->where([['harga_jual','>', 0],['status','=', 0]]);
    }

    public function total_order_qty()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id')->where([['order_qty','>', 0],['status','=', 0]]);
    }

    public function total_sell_qty()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id')->where([['sell_qty','>', 0],['status','=', 0]]);
    }

    public function total_in_qty()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id')->where([['in_qty','>', 0],['status','=', 0]]);
    }

    public function total_out_qty()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id')->where([['out_qty','>', 0],['status','=', 0]]);
    }

}
