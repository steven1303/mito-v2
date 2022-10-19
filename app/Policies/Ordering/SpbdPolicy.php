<?php

namespace App\Policies\Ordering;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpbdPolicy
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
        foreach ($user->roles->permissions_for_access('SPBD','spbd-view')->get() as $permission ) {
            if($permission->name == 'spbd-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('SPBD','spbd-store')->get() as $permission ) {
            if($permission->name == 'spbd-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('SPBD','spbd-update')->get() as $permission ) {
            if($permission->name == 'spbd-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('SPBD','spbd-delete')->get() as $permission ) {
            if($permission->name == 'spbd-delete'){
                return true;
            }
        }
        return false;
    }

    public function request(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('SPBD','spbd-request')->get() as $permission ) {
            if($permission->name == 'spbd-request'){
                return true;
            }
        }
        return false;
    }

    public function verify(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('SPBD','spbd-verify')->get() as $permission ) {
            if($permission->name == 'spbd-verify'){
                return true;
            }
        }
        return false;
    }

    public function approve(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('SPBD','spbd-approve')->get() as $permission ) {
            if($permission->name == 'spbd-approve'){
                return true;
            }
        }
        return false;
    }

    public function print(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('SPBD','spbd-print')->get() as $permission ) {
            if($permission->name == 'spbd-print'){
                return true;
            }
        }
        return false;
    }
}
