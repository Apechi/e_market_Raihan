<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Purchase;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the purchase can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list purchases');
    }

    /**
     * Determine whether the purchase can view the model.
     */
    public function view(User $user, Purchase $model): bool
    {
        return $user->hasPermissionTo('view purchases');
    }

    /**
     * Determine whether the purchase can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create purchases');
    }

    /**
     * Determine whether the purchase can update the model.
     */
    public function update(User $user, Purchase $model): bool
    {
        return $user->hasPermissionTo('update purchases');
    }

    /**
     * Determine whether the purchase can delete the model.
     */
    public function delete(User $user, Purchase $model): bool
    {
        return $user->hasPermissionTo('delete purchases');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete purchases');
    }

    /**
     * Determine whether the purchase can restore the model.
     */
    public function restore(User $user, Purchase $model): bool
    {
        return false;
    }

    /**
     * Determine whether the purchase can permanently delete the model.
     */
    public function forceDelete(User $user, Purchase $model): bool
    {
        return false;
    }
}
