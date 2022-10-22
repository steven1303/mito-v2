<?php

namespace App\Policies\Ordering;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReceiptPolicy
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
        foreach ($user->roles->permissions_for_access('Receipt','receipt-view')->get() as $permission ) {
            if($permission->name == 'receipt-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-store')->get() as $permission ) {
            if($permission->name == 'receipt-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-update')->get() as $permission ) {
            if($permission->name == 'receipt-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-delete')->get() as $permission ) {
            if($permission->name == 'receipt-delete'){
                return true;
            }
        }
        return false;
    }

    public function request(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-request')->get() as $permission ) {
            if($permission->name == 'receipt-request'){
                return true;
            }
        }
        return false;
    }

    public function verify1(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-verify1')->get() as $permission ) {
            if($permission->name == 'receipt-verify1'){
                return true;
            }
        }
        return false;
    }

    public function verify2(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-verify2')->get() as $permission ) {
            if($permission->name == 'receipt-verify2'){
                return true;
            }
        }
        return false;
    }

    public function approve(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-approve')->get() as $permission ) {
            if($permission->name == 'receipt-approve'){
                return true;
            }
        }
        return false;
    }

    public function print(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Receipt','receipt-print')->get() as $permission ) {
            if($permission->name == 'receipt-print'){
                return true;
            }
        }
        return false;
    }
}
