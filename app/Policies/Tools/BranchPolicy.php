<?php

namespace App\Policies\Tools;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
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
        foreach ($user->roles->permissions_for('Branch')->get() as $permission ) {
            if($permission->name == 'branch-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Branch')->get() as $permission ) {
            if($permission->name == 'branch-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Branch')->get() as $permission ) {
            if($permission->name == 'branch-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Branch')->get() as $permission ) {
            if($permission->name == 'branch-delete'){
                return true;
            }
        }
        return false;
    }
    
}
