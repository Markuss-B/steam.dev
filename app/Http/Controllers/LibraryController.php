<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    //

    public function show(): View
    {
        // authorize user
        //$this->authorize('view', User::class);

        // get current user
        $user = Auth::user();

        // get users games
        $games = $user->games;

        return view('library.show', compact('games'));
    }

    public function purchase(Request $request)
    {
        //$this->authorize('purchase', User::class);

        // get current user
        $user = Auth::user();

        // get game
        $game = Game::find($request->game);

        // // check if user has enough money
        // if ($user->money < $game->price) {
        //     return redirect()->back()->with('error', 'You do not have enough money to purchase this game.');
        // }

        // check if user already owns game
        if ($user->games->contains($game)) {
            return redirect()->back()->with('error_message', 'You already own this game.');
        }

        // // deduct money from user
        // $user->money -= $game->price;
        // $user->save();

        // add game to user
        $user->addGame($game);

        return redirect()->back()->with('success_message', 'You have successfully purchased this game.');
    }
}
