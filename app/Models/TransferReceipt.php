<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransferReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'transfer_id',
        'from_branch',
        'transfer_receipt_date',
        'username',
        'transfer_request',
        'transfer_print',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }
}
