<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
