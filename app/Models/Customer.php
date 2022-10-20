<?php

namespace App\Models;

use Carbon\Carbon;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'address1',
        'address2',
        'email',
        'city',
        'pic',
        'telp',
        'phone',
        'npwp',
        'tax',
        'ktp',
        'bod',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new BranchScope);
    }


    public function bod(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y'),
            set: fn ($value) => Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
        );
    }

    // public function bod1(): Attribute
    // {
    //     return new Attribute(
    //         get: fn($value) => Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
    //         set: fn($value) => Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y'),
    //     );
    // }

    // protected function bod1(): Attribute
    // {
        
    //     return new Attribute(
    //         get: fn() => $this->status($this->tax_id),
    //     );
    // }

    // public function status($id)
    // {
    // 	if($id == 1){
    //         return 'ok';
    //     }
    //     return 'tidak';
    // }

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }
}
