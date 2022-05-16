<?php

namespace App\Policies\Tools;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(Admin $user)
    {
        foreach ($user->roles->permissions_for('Roles')->get() as $permission ) {
            if($permission->name == 'role-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Roles')->get() as $permission ) {
            if($permission->name == 'role-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Roles')->get() as $permission ) {
            if($permission->name == 'role-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Roles')->get() as $permission ) {
            if($permission->name == 'role-delete'){
                return true;
            }
        }
        return false;
    }

    public function rolePermission(Admin $user)
    {
        foreach ($user->roles->permissions_for('Roles')->get() as $permission ) {
            if($permission->name == 'role-permission'){
                return true;
            }
        }
        return false;
    }
}
