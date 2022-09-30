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
        'stock_no','branch_id', 'bin', 'name', 'satuan', 'min_soh', 'max_soh', 'harga_modal', 'harga_jual'
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

    }

    public function avg_jual()
    {

    }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }
}
