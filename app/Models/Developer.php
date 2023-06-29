<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'founded_at',
        'description',
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function makeDeveloper(User $user)
    {
        $this->users()->attach($user);
    }

    public function removeDeveloper(User $user)
    {
        $this->users()->detach($user);
    }

    public function isDeveloperOf(Game $game): bool
    {
        return $this->games->contains($game);
    }
}
