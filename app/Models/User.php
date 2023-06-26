<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function developers()
    {
        return $this->belongsToMany(Developer::class);
    }

    public function isDeveloperOf(Game $game): bool
    {
        return $game->developers->intersect($this->developers)->isNotEmpty();
    }
    
    // Games
    public function games()
    {
        return $this->belongsToMany(Game::class)
            ->withPivot('play_time', 'acquisition_date', 'is_favorite')
            ->withTimestamps();
    }

    public function addGame(Game $game, int $price = null)
    {
        $this->games()->attach($game, ['acquisition_date' => now(), 'purchase_cost' => $price, 'is_favorite' => false, 'play_time' => 0]);
        $this->save();
    }

    public function removeGame(Game $game)
    {
        $this->games()->detach($game);
    }

    public function addMoney(int $amount)
    {
        $this->balance += $amount;
        $this->save();
    }

    public function deductMoney(int $amount)
    {
        if ($this->balance < $amount) {
            return false;
        }

        $this->balance -= $amount;
        $this->save();
    }

    public function buyGame(Game $game)
    {
        if ($this->ownsGame($game)) {
            throw new \Exception('You already own this game.');
        }

        $price = $game->getPrice();

        if ($this->balance < $price) {
            throw new \Exception('You don\'t have enough money to buy this game.');
        }

        $this->deductMoney($price);
        $this->addGame($game, $price);
    }

    public function ownsGame(Game $game): bool
    {
        return $this->games->contains($game);
    }

    ///
    public function favoriteGame(Game $game)
    {
        $this->games()->updateExistingPivot($game, ['is_favorite' => true]);
    }

    public function unfavoriteGame(Game $game)
    {
        $this->games()->updateExistingPivot($game, ['is_favorite' => false]);
    }
    ///
    public function isFavoriteGame(Game $game): bool
    {
        return $this->games->where('id', $game->id)->first()->pivot->is_favorite;
    }

    // public function play(Game $game, int $playTime)
    // {
    //     $this->games()->updateExistingPivot($game, ['play_time' => $playTime]);
    // }


    // public function playTime(Game $game): int
    // {
    //     return $this->games->where('id', $game->id)->first()->pivot->play_time;
    // }

    // public function acquisitionDate(Game $game): string
    // {
    //     return $this->games->where('id', $game->id)->first()->pivot->acquisition_date;
    // }
}
