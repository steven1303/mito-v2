<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
    ];

    public function permissions()
    {
    	return $this->belongsToMany('App\Models\Permission','permission_role','role_id', 'permission_id');
    }

    public function permissions_for($for)
    {
    	return $this->belongsToMany('App\Models\Permission','permission_role','role_id', 'permission_id')->where('for',$for);
    }

    public function permissions_for_access($for, $access)
    {
    	return $this->belongsToMany('App\Models\Permission','permission_role','role_id', 'permission_id')->where([
            ['for',$for],
            ['name', $access]
        ]);
    }

}
