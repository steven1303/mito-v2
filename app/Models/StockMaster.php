<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_no','branch_id', 'bin', 'name', 'satuan', 'min_soh', 'max_soh', 'harga_modal', 'harga_jual'
    ];
}
