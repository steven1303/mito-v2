<?php

namespace App\Models;

use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'email',
        'address1',
        'address2',
        'city',
        'phone',
        'pic',
        'telp',
        'npwp',
        'tax',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }
}
