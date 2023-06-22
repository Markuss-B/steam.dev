<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    //
    public function index()
    {
        $games = Game::all();

        return view('store', compact('games'));
    }
}
