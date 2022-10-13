<?php

namespace App\Models;

use Carbon\Carbon;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function transferDate(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:m A'),
        );
    }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public function transfer_branch_detail()
    {
    	return $this->hasMany('App\Models\TransferBranchDetail','transfer_branch_id');
    }
}
