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
        'transfer_receipt_no',
        'from_branch',
        'transfer_receipt_date',
        'status',
        'username',
        'transfer_request',
        'transfer_print',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function scopeTransferBranch($query)
    {
        // $query->addSelect(['transfer_no' => TransferBranch::withoutGlobalScopes()->whereColumn('transfer_id', 'transfer_branches.id')
        //     ->selectRaw('transfer_no as transfer_no')
        // ]);

        $query->addSelect([
            'transfer_no' => TransferBranch::withoutGlobalScopes()->whereColumn('transfer_id', 'transfer_branches.id')
                ->selectRaw('transfer_no as transfer_no'),
            'transfer_date' => TransferBranch::withoutGlobalScopes()->whereColumn('transfer_id', 'transfer_branches.id')
                ->selectRaw('transfer_date as transfer_date'),
        ]);

        $query->addSelect(['from_branch' => Branch::whereColumn('from_branch', 'branches.id')
            ->selectRaw('name as from_branch')
        ]);
    }

    public function from()
    {
    	return $this->belongsTo('App\Models\Branch','from_branch');
    }
}
