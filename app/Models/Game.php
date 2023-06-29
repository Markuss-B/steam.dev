<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'release_date',
        'developer_id',
        'distributor_id',
        'icon',
        'library_hero',
        'header',
    ];

    public function getHeaderAttribute(): string
    {
        if ($this->attributes['header'] && Storage::disk('public')->exists($this->attributes['header'])) {
            return Storage::url($this->attributes['header']);
        } elseif (file_exists(public_path('img/header/' . $this->id . '.jpg'))) {
            return asset('img/header/' . $this->id . '.jpg');
        } else {
            return 'https://picsum.photos/500/225';
        }
    }
    
    public function getIconAttribute(): string
    {
        if ($this->attributes['icon'] && Storage::disk('public')->exists($this->attributes['icon'])) {
            return Storage::url($this->attributes['icon']);
        } elseif (file_exists(public_path('img/icon/' . $this->id . '.jpg'))) {
            return asset('img/icon/' . $this->id . '.jpg');
        } else {
            return 'https://picsum.photos/500/500';
        }
    }
    
    public function getLibraryHeroAttribute(): string
    {
        if ($this->attributes['library_hero'] && Storage::disk('public')->exists($this->attributes['library_hero'])) {
            return Storage::url($this->attributes['library_hero']);
        } elseif (file_exists(public_path('img/library_hero/' . $this->id . '.jpg'))) {
            return asset('img/library_hero/' . $this->id . '.jpg');
        } else {
            return 'https://picsum.photos/500/500';
        }
    }
    

    // categories
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class);
    }

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Publisher::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(GameUser::class)
            ->withPivot('play_time', 'acquisition_date', 'is_favorite', 'purchase_cost', 'last_played')
            ->withTimestamps();
    }

    public function userOwnsGame(): bool
    {
        return $this->users()->where('user_id', auth()->id())->exists();
    }

    public function getPrice()
    {
        return $this->price;
        //- ($this->price * ($this->discount / 100));
    }
}
