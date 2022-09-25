<?php

namespace App\Models;

use Carbon\Carbon;
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

    // protected $casts = [
    //     'created_format' => 'string',
    // ];

    public function createdFormatTime(): Attribute
    {
        return new Attribute(
            get: fn () => Carbon::createFromFormat('Y-m-d', $this->created_at)->format('d/m/Y'),
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
