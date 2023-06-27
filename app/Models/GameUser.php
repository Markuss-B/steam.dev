<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GameUser extends Pivot
{
    protected $casts = [
        'acquisition_date' => 'datetime',
        'last_played' => 'datetime',
    ];
}
