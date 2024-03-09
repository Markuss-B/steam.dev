<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public static function getDiscountedGames($num = null)
    {
        if ($num)
        {
            return Game::where('discount', '>', 0)->orderByDesc('discount')->paginate($num);
        }
        else
        {
            return Game::where('discount', '>', 0)->orderByDesc('discount')->get();
        }
    }

    public static function getNewGames($num = null)
    {
        $query = Game::where('release_date', '>', date('Y-m-d', strtotime('-5 year')))->orderByDesc('release_date');

        return $num ? $query->paginate($num) : $query->get();
    }

    public static function getTopSellers($num = null)
    {
        $query = Game::has('users', '>', 0)
            ->withCount('users')
            ->orderBy('users_count', 'desc');

        return $num ? $query->paginate($num) : $query->get();
    }
}
