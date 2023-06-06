<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    ];

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
}
