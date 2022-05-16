<?php

namespace App\Policies\Tools;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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
        foreach ($user->roles->permissions_for('Permissions')->get() as $permission ) {
            if($permission->name == 'permission-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Permissions')->get() as $permission ) {
            if($permission->name == 'permission-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Permissions')->get() as $permission ) {
            if($permission->name == 'permission-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Permissions')->get() as $permission ) {
            if($permission->name == 'permission-delete'){
                return true;
            }
        }
        return false;
    }
}
