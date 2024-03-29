<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    use HasMergedRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'description',
        'password',
        'balance',
        'currently_playing',
        'started_playing_at',
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

    // Avatar
    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? Storage::url($this->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    // Friends
    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function pendingFriendsTo()
    {
        return $this->friendsTo()->where('status', 'pending');
    }

    public function pendingFriendsFrom()
    {
        return $this->friendsFrom()->where('status', 'pending');
    }

    public function acceptedFriendsTo()
    {
        return $this->friendsTo()->where('status', 'accepted');
    }

    public function acceptedFriendsFrom()
    {
        return $this->friendsFrom()->where('status', 'accepted');
    }

    public function declinedFriendsTo()
    {
        return $this->friendsTo()->where('status', 'declined');
    }

    public function friends()
    {
        return $this->mergedRelationWithModel(User::class, 'friends_view');
    }

    public function unfriend(User $user)
    {
        $this->friendsTo()->detach($user);
        $this->friendsFrom()->detach($user);
    }
    

    public function sendFriendRequest(User $recipient)
    {
        $this->pendingFriendsTo()->attach($recipient);
    }

    public function acceptFriendRequest(User $sender)
    {
        $this->friendsFrom()->updateExistingPivot($sender, ['status' => 'accepted']);
    }

    public function declineFriendRequest(User $sender)
    {
        $this->friendsFrom()->detach($sender);
    }

    public function cancelFriendRequest(User $recipient)
    {
        $this->pendingFriendsTo()->detach($recipient);
    }

    public function isFriendsWith(User $user): bool
    {
        return $this->acceptedFriendsTo->contains($user) || $this->acceptedFriendsFrom->contains($user);
    }

    public function hasSentFriendRequestTo(User $user): bool
    {
        return $this->pendingFriendsTo->contains($user);
    }

    public function hasReceivedFriendRequestFrom(User $user): bool
    {
        return $this->pendingFriendsFrom->contains($user);
    }

    public function isPendingFriendRequestFrom(User $user): bool
    {
        return $this->pendingFriendsFrom->contains($user);
    }

    public function hasDeclinedFriendRequestFrom(User $user): bool
    {
        return $this->friendsFrom->where('pivot.status', 'declined')->contains($user);
    }


    // developers
    public function developers()
    {
        return $this->belongsToMany(Developer::class);
    }

    public function isDeveloperOf(Game $game): bool
    {
        return $game->developers->intersect($this->developers)->isNotEmpty();
    }

    // games in common
    public function commonGames(User $user)
    {
        return $this->games->intersect($user->games);
    }
    
    public function hasGamesInCommonWith(User $user): bool
    {
        return $this->commonGames($user)->isNotEmpty();
    }

    // friends with game
    public function friendsWithGame(Game $game)
    {
        return $this->friends->filter(function ($friend) use ($game) {
            return $friend->games->contains($game);
        })
        ->sortByDesc(function ($friend) use ($game) {
            return $friend->isPlaying($game);
        });
    }

    // Games
    public function games()
    {
        return $this->belongsToMany(Game::class)
            ->using(GameUser::class)
            ->withPivot('play_time', 'acquisition_date', 'is_favorite', 'purchase_cost', 'last_played')
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

    // categories
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // balance
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

    // favorite games
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

    // playing games
    public function addPlayTime(Game $game, int $minutesPlayed)
    {
        $this->games()->updateExistingPivot($game, ['play_time' => DB::raw('play_time + ' . $minutesPlayed)]);
    }

    public function isPlaying($game = null): bool
    {
        if ($game) {
            return $this->currently_playing === $game->id;
        }

        return $this->currently_playing !== null;
    }

    public function activeGame()
    {
        return $this->belongsTo(Game::class, 'currently_playing');
    }

    public function startPlaying(Game $game)
    {
        if ($this->isPlaying()) {
            $msg = $this->stopPlaying();
        }

        $this->update(['currently_playing' => $game->id, 'started_playing_at' => now()]);

        return ["You started playing {$game->name}.", $msg ?? null];
    }

    public function stopPlaying()
    {
        if (!$this->isPlaying()) {
            throw new \Exception('You are not playing this game.');
        }

        $game = Game::find($this->currently_playing);
        $minutesPlayed = now()->diffInMinutes($this->started_playing_at);

        $this->addPlayTime($game, $minutesPlayed);

        $this->update(['currently_playing' => null, 'started_playing_at' => null]);

        // last played in the pivot
        $this->games()->updateExistingPivot($game, ['last_played' => now()]);

        return "You stopped playing {$game->name}. You played for {$minutesPlayed} minutes.";
    }

    public function lastPlayed($game)
    {
        return $this->games->where('id', $game->id)->first()->pivot->last_played;
    }

    public function lastPlayedGame()
    {
        // either current playing or last played
        if ($this->currently_playing) {
            return Game::find($this->currently_playing);
        } else {
            return $this->games->sortByDesc('pivot.last_played')->first();
        }
    }

    public function playTime(Game $game): int
    {
        return $this->games->where('id', $game->id)->first()->pivot->play_time;
    }

    public function acquired(Game $game)
    {
        return $this->games->where('id', $game->id)->first()->pivot->acquisition_date;
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
