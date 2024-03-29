<?php

namespace App\Policies;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DeveloperPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Developer $developer): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('developers.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Developer $developer): bool
    {
        if ($user->hasPermissionTo('developers.edit'))
            return true;

        if ($user->hasPermissionTo('own_developers.edit') && $developer->users->contains($user))
            return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Developer $developer): bool
    {
        return $user->hasPermissionTo('developers.destroy');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Developer $developer): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Developer $developer): bool
    {
        //
    }
}
