<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spbd extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'spbd_no',
        'request',
        'approve',
        'spbd_print',
        'username',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }
}
