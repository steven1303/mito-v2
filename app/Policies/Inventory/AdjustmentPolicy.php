<?php

namespace App\Policies\Inventory;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdjustmentPolicy
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
        // dd($user->roles->permissions_for_access('Adjustment','adjustment-view')->get());
        foreach ($user->roles->permissions_for_access('Adjustment','adjustment-view')->get() as $permission ) {
            if($permission->name == 'adjustment-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Adjustment','adjustment-store')->get() as $permission ) {
            if($permission->name == 'adjustment-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Adjustment','adjustment-update')->get() as $permission ) {
            if($permission->name == 'adjustment-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Adjustment','adjustment-delete')->get() as $permission ) {
            if($permission->name == 'adjustment-delete'){
                return true;
            }
        }
        return false;
    }

    public function request(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Adjustment','adjustment-request')->get() as $permission ) {
            if($permission->name == 'adjustment-request'){
                return true;
            }
        }
        return false;
    }

    public function approve(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Adjustment','adjustment-approve')->get() as $permission ) {
            if($permission->name == 'adjustment-approve'){
                return true;
            }
        }
        return false;
    }

    public function print(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Adjustment','adjustment-print')->get() as $permission ) {
            if($permission->name == 'adjustment-print'){
                return true;
            }
        }
        return false;
    }
}
