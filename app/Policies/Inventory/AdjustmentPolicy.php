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
        foreach ($user->roles->permissions_for('Adjustment')->get() as $permission ) {
            if($permission->name == 'adjustment-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Adjustment')->get() as $permission ) {
            if($permission->name == 'adjustment-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Adjustment')->get() as $permission ) {
            if($permission->name == 'adjustment-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Adjustment')->get() as $permission ) {
            if($permission->name == 'adjustment-delete'){
                return true;
            }
        }
        return false;
    }
}
