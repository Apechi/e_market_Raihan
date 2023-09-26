<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TransactionType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transactionType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list transactiontypes');
    }

    /**
     * Determine whether the transactionType can view the model.
     */
    public function view(User $user, TransactionType $model): bool
    {
        return $user->hasPermissionTo('view transactiontypes');
    }

    /**
     * Determine whether the transactionType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create transactiontypes');
    }

    /**
     * Determine whether the transactionType can update the model.
     */
    public function update(User $user, TransactionType $model): bool
    {
        return $user->hasPermissionTo('update transactiontypes');
    }

    /**
     * Determine whether the transactionType can delete the model.
     */
    public function delete(User $user, TransactionType $model): bool
    {
        return $user->hasPermissionTo('delete transactiontypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete transactiontypes');
    }

    /**
     * Determine whether the transactionType can restore the model.
     */
    public function restore(User $user, TransactionType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the transactionType can permanently delete the model.
     */
    public function forceDelete(User $user, TransactionType $model): bool
    {
        return false;
    }
}
