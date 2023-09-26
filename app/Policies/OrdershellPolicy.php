<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ordershell;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrdershellPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ordershell can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list ordershells');
    }

    /**
     * Determine whether the ordershell can view the model.
     */
    public function view(User $user, Ordershell $model): bool
    {
        return $user->hasPermissionTo('view ordershells');
    }

    /**
     * Determine whether the ordershell can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create ordershells');
    }

    /**
     * Determine whether the ordershell can update the model.
     */
    public function update(User $user, Ordershell $model): bool
    {
        return $user->hasPermissionTo('update ordershells');
    }

    /**
     * Determine whether the ordershell can delete the model.
     */
    public function delete(User $user, Ordershell $model): bool
    {
        return $user->hasPermissionTo('delete ordershells');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete ordershells');
    }

    /**
     * Determine whether the ordershell can restore the model.
     */
    public function restore(User $user, Ordershell $model): bool
    {
        return false;
    }

    /**
     * Determine whether the ordershell can permanently delete the model.
     */
    public function forceDelete(User $user, Ordershell $model): bool
    {
        return false;
    }
}
