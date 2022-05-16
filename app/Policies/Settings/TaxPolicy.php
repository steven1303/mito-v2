<?php

namespace App\Policies\Settings;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxPolicy
{
    use HandlesAuthorization;

    protected $tax_akses;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function view(Admin $user)
    {
        foreach ($user->roles->permissions_for('Tax')->get() as $permission ) {
            if($permission->name == 'tax-view'){
                return true;
            }
        }
        return false;
    }

    public function store(Admin $user)
    {
        foreach ($user->roles->permissions_for('Tax')->get() as $permission ) {
            if($permission->name == 'tax-store'){
                return true;
            }
        }
        return false;
    }

    public function update(Admin $user)
    {
        foreach ($user->roles->permissions_for('Tax')->get() as $permission ) {
            if($permission->name == 'tax-update'){
                return true;
            }
        }
        return false;
    }

    public function delete(Admin $user)
    {
        foreach ($user->roles->permissions_for('Tax')->get() as $permission ) {
            if($permission->name == 'tax-delete'){
                return true;
            }
        }
        return false;
    }
}
