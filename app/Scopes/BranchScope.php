<?php
 
namespace App\Scopes;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
 
class BranchScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     * Used on Model Customer, vendor, Admin, StockMaster, StockMovement
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('branch_id','=', Auth::user()->branch_id);
    }
}