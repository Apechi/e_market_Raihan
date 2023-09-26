<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PurchaseDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchaseDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the purchaseDetail can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list purchasedetails');
    }

    /**
     * Determine whether the purchaseDetail can view the model.
     */
    public function view(User $user, PurchaseDetail $model): bool
    {
        return $user->hasPermissionTo('view purchasedetails');
    }

    /**
     * Determine whether the purchaseDetail can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create purchasedetails');
    }

    /**
     * Determine whether the purchaseDetail can update the model.
     */
    public function update(User $user, PurchaseDetail $model): bool
    {
        return $user->hasPermissionTo('update purchasedetails');
    }

    /**
     * Determine whether the purchaseDetail can delete the model.
     */
    public function delete(User $user, PurchaseDetail $model): bool
    {
        return $user->hasPermissionTo('delete purchasedetails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete purchasedetails');
    }

    /**
     * Determine whether the purchaseDetail can restore the model.
     */
    public function restore(User $user, PurchaseDetail $model): bool
    {
        return false;
    }

    /**
     * Determine whether the purchaseDetail can permanently delete the model.
     */
    public function forceDelete(User $user, PurchaseDetail $model): bool
    {
        return false;
    }
}
