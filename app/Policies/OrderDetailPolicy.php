<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the orderDetail can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list orderdetails');
    }

    /**
     * Determine whether the orderDetail can view the model.
     */
    public function view(User $user, OrderDetail $model): bool
    {
        return $user->hasPermissionTo('view orderdetails');
    }

    /**
     * Determine whether the orderDetail can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create orderdetails');
    }

    /**
     * Determine whether the orderDetail can update the model.
     */
    public function update(User $user, OrderDetail $model): bool
    {
        return $user->hasPermissionTo('update orderdetails');
    }

    /**
     * Determine whether the orderDetail can delete the model.
     */
    public function delete(User $user, OrderDetail $model): bool
    {
        return $user->hasPermissionTo('delete orderdetails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete orderdetails');
    }

    /**
     * Determine whether the orderDetail can restore the model.
     */
    public function restore(User $user, OrderDetail $model): bool
    {
        return false;
    }

    /**
     * Determine whether the orderDetail can permanently delete the model.
     */
    public function forceDelete(User $user, OrderDetail $model): bool
    {
        return false;
    }
}
