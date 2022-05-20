<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
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

    public function stock_movement()
    {
        return $this->hasMany('App\Models\StockMovement','stock_master_id');
    }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }
}
