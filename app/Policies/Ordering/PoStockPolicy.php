<?php

namespace App\Policies\Ordering;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoStockPolicy
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
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-view')->get() as $permission ) {
            if($permission->name == 'po-stock-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-store')->get() as $permission ) {
            if($permission->name == 'po-stock-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-update')->get() as $permission ) {
            if($permission->name == 'po-stock-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-delete')->get() as $permission ) {
            if($permission->name == 'po-stock-delete'){
                return true;
            }
        }
        return false;
    }

    public function request(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-request')->get() as $permission ) {
            if($permission->name == 'po-stock-request'){
                return true;
            }
        }
        return false;
    }

    public function verify1(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-verify1')->get() as $permission ) {
            if($permission->name == 'po-stock-verify1'){
                return true;
            }
        }
        return false;
    }

    public function verify2(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-verify2')->get() as $permission ) {
            if($permission->name == 'po-stock-verify2'){
                return true;
            }
        }
        return false;
    }

    public function approve(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-approve')->get() as $permission ) {
            if($permission->name == 'po-stock-approve'){
                return true;
            }
        }
        return false;
    }

    public function print(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('PoStock','po-stock-print')->get() as $permission ) {
            if($permission->name == 'po-stock-print'){
                return true;
            }
        }
        return false;
    }
}
