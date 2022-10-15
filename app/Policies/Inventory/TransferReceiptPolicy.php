<?php

namespace App\Policies\Inventory;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransferReceiptPolicy
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
        foreach ($user->roles->permissions_for_access('Transfer Receipt','transfer-receipt-view')->get() as $permission ) {
            if($permission->name == 'transfer-receipt-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer Receipt','transfer-receipt-store')->get() as $permission ) {
            if($permission->name == 'transfer-receipt-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer Receipt','transfer-receipt-update')->get() as $permission ) {
            if($permission->name == 'transfer-receipt-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer Receipt','transfer-receipt-delete')->get() as $permission ) {
            if($permission->name == 'transfer-receipt-delete'){
                return true;
            }
        }
        return false;
    }

    public function request(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer Receipt','transfer-receipt-request')->get() as $permission ) {
            if($permission->name == 'transfer-receipt-request'){
                return true;
            }
        }
        return false;
    }

    public function approve(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer Receipt','transfer-receipt-approve')->get() as $permission ) {
            if($permission->name == 'transfer-receipt-approve'){
                return true;
            }
        }
        return false;
    }

    public function print(Admin $user)
    {
        foreach ($user->roles->permissions_for_access('Transfer Receipt','transfer-receipt-print')->get() as $permission ) {
            if($permission->name == 'transfer-receipt-print'){
                return true;
            }
        }
        return false;
    }
}
