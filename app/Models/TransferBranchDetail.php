<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferBranchDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'transfer_branch_id',
        'stock_master_id',
        'qty',
        'price',
        'keterangan',
    ];

    public function stock_master()
    {
        return $this->belongsTo('App\Models\StockMaster','stock_master_id')->soh();
    }

    public function transferBranch()
    {
        return $this->belongsTo('App\Models\TransferBranch','transfer_branch_id');
    }
}
