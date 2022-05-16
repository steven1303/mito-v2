<?php

namespace App\Policies\Tools;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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
        foreach ($user->roles->permissions_for('Admins')->get() as $permission ) {
            if($permission->name == 'admin-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Admins')->get() as $permission ) {
            if($permission->name == 'admin-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Admins')->get() as $permission ) {
            if($permission->name == 'admin-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Admins')->get() as $permission ) {
            if($permission->name == 'admin-delete'){
                return true;
            }
        }
        return false;
    }

    public function profile(Admin $user)
    {
        foreach ($user->roles->permissions_for('Admins')->get() as $permission ) {
            if($permission->name == 'admin-profile'){
                return true;
            }
        }
        return false;
    }

    public function branch(Admin $user)
    {
        foreach ($user->roles->permissions_for('Admins')->get() as $permission ) {
            if($permission->name == 'admin-branch'){
                return true;
            }
        }
        return false;
    }
}
