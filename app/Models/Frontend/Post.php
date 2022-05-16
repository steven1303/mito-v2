<?php

namespace App\Models\Frontend;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle' ,'slug', 'id_admin','status','body','image','meta_description','meta_keyword'
    ];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }

}
