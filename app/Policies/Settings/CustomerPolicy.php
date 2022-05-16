<?php

namespace App\Policies\Settings;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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
        foreach ($user->roles->permissions_for('Customer')->get() as $permission ) {
            if($permission->name == 'customer-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Customer')->get() as $permission ) {
            if($permission->name == 'customer-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Customer')->get() as $permission ) {
            if($permission->name == 'customer-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Customer')->get() as $permission ) {
            if($permission->name == 'customer-delete'){
                return true;
            }
        }
        return false;
    }

    public function info(Admin $user)
    {
        foreach ($user->roles->permissions_for('Customer')->get() as $permission ) {
            if($permission->name == 'customer-info'){
                return true;
            }
        }
        return false;
    }
}
