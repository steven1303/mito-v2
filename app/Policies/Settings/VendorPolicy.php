<?php

namespace App\Policies\Settings;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(Admin $user)
    {
        foreach ($user->roles->permissions_for('Vendor')->get() as $permission ) {
            if($permission->name == 'vendor-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Vendor')->get() as $permission ) {
            if($permission->name == 'vendor-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Vendor')->get() as $permission ) {
            if($permission->name == 'vendor-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Vendor')->get() as $permission ) {
            if($permission->name == 'vendor-delete'){
                return true;
            }
        }
        return false;
    }

    public function info(Admin $user)
    {
        foreach ($user->roles->permissions_for('Vendor')->get() as $permission ) {
            if($permission->name == 'vendor-info'){
                return true;
            }
        }
        return false;
    }
}
