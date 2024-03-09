<?php

namespace App\Policies;

use App\Models\Developer;
use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GamePolicy
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
    public function view(User $user, Game $game): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo('games.create'))
            return true;

        if ($user->hasPermissionTo('own_games.create'))
            return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Game $game): bool
    {
        return $user->hasRole('admin') ||
            $user->hasPermissionTo('games.edit') ||
            ($user->hasPermissionTo('own_games.edit') && $user->isDeveloperOf($game));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Game $game): bool
    {
        return $user->hasRole('admin') ||
            $user->hasPermissionTo('games.destroy') ||
            ($user->hasPermissionTo('own_games.destroy') && $user->isDeveloperOf($game));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Game $game): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Game $game): bool
    {
        //
        return false;
    }
}
