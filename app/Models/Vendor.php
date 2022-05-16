<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'tax_id',
    ];

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public function tax()
    {
    	return $this->belongsTo('App\Models\Tax','tax_id');
    }
}
