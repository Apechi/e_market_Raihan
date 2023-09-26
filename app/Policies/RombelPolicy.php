<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rombel;
use Illuminate\Auth\Access\HandlesAuthorization;

class RombelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rombel can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list rombels');
    }

    /**
     * Determine whether the rombel can view the model.
     */
    public function view(User $user, Rombel $model): bool
    {
        return $user->hasPermissionTo('view rombels');
    }

    /**
     * Determine whether the rombel can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create rombels');
    }

    /**
     * Determine whether the rombel can update the model.
     */
    public function update(User $user, Rombel $model): bool
    {
        return $user->hasPermissionTo('update rombels');
    }

    /**
     * Determine whether the rombel can delete the model.
     */
    public function delete(User $user, Rombel $model): bool
    {
        return $user->hasPermissionTo('delete rombels');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete rombels');
    }

    /**
     * Determine whether the rombel can restore the model.
     */
    public function restore(User $user, Rombel $model): bool
    {
        return false;
    }

    /**
     * Determine whether the rombel can permanently delete the model.
     */
    public function forceDelete(User $user, Rombel $model): bool
    {
        return false;
    }
}
