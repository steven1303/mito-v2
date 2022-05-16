<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    use Notifiable;

    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

	protected $guard = 'admin';

	protected $fillable = [
        'name', 'username' ,'email', 'password','role_id','branch_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branch()
    {
    	return $this->belongsTo('App\Models\Branch','branch_id');
    }

    public function roles()
    {
        return $this->hasOne('App\Models\Role','id','role_id');
    }
}
