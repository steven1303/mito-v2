<?php

namespace App\Policies\Inventory;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransferBranchPolicy
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
        foreach ($user->roles->permissions_for_access('Transfer','transfer-view')->get() as $permission ) {
            if($permission->name == 'transfer-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer','transfer-store')->get() as $permission ) {
            if($permission->name == 'transfer-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer','transfer-update')->get() as $permission ) {
            if($permission->name == 'transfer-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer','transfer-delete')->get() as $permission ) {
            if($permission->name == 'transfer-delete'){
                return true;
            }
        }
        return false;
    }

    public function request(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer','transfer-request')->get() as $permission ) {
            if($permission->name == 'transfer-request'){
                return true;
            }
        }
        return false;
    }

    public function approve(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer','transfer-approve')->get() as $permission ) {
            if($permission->name == 'transfer-approve'){
                return true;
            }
        }
        return false;
    }

    public function print(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer','transfer-print')->get() as $permission ) {
            if($permission->name == 'transfer-print'){
                return true;
            }
        }
        return false;
    }
}
