<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','ppn'
    ];

    protected $appends = ['tax_percent'];

    protected function taxPercent(): Attribute
    {
        
        return new Attribute(
            get: fn() => ($this->ppn * 100 ). " %",
        );
    }
}
