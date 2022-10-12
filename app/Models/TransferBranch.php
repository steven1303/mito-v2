<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'transfer_no',
        'to_branch',
        'transfer_date',
        'username',
        'transfer_request',
        'transfer_print',
        'status'
    ];

    public function transferDate(): Attribute
    {
        return new Attribute(
            get: fn () => $this->transfer_date->format('d/m/Y H:m'),
        );
    }
}
