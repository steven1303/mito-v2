<?php

namespace App\Models;

use Carbon\Carbon;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function approve(): Attribute
    {
        return new Attribute(
            get: fn ($value) => (!$value) ? '00-00-0000 00:00' : Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:m A'),
        );
    }

    public function spbd_detail()
    {
    	return $this->hasMany('App\Models\SpbdDetail','spbd_id');
    }
}
