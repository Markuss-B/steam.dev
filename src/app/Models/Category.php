<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function create(User $user, string $name): self
    {
        $category = new self([
            'name' => $name,
        ]);

        $category->user()->associate($user);
        $category->save();

        return $category;
    }

    // rename category
    public function rename(string $name): void
    {
        $this->name = $name;
        $this->save();
    }

    // add game
    public function addGame(Game $game): void
    {
        // check if user has game
        if (!$this->user->ownsGame($game)) {
            return;
        }

        // check if category has game
        if ($this->hasGame($game)) {
            return;
        }
        
        $this->games()->attach($game->id);
    }

    public function hasGame(Game $game): bool
    {
        return $this->games()->contains($game);
    }

    // remove game
    public function removeGame(Game $game): void
    {
        $this->games()->detach($game->id);
    }


}
