<?php

namespace App\Models;

use Carbon\Carbon;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'adj_no',
        'status',
        'username',
        'adj_open',
        'adj_print',
    ];

    protected $appends = [
        'created_format',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }

    public function createdFormat(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at->format('d/m/Y H:m'),
        );
    }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public function adj_detail()
    {
    	return $this->hasMany('App\Models\AdjustmentDetail','adj_id');
    }
}
