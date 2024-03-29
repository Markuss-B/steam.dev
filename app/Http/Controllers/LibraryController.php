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

    public function index(): View
    {
        // authorize user
        //$this->authorize('view', User::class);

        // get current user
        $user = Auth::user();

        // get users games
        $games = $user->games;

        return view('library.index', compact('games'));
    }

    public function show(Game $game): View
    {
        $user = Auth::user();

        // check if user owns game
        if (!$user->games->contains($game)) {
            return redirect()->back()->with('error_message', 'You do not own this game.');
        }

        // get the user data for game
        $game = $user->games->find($game->id);

        return view('library.show', compact('game'));
    }

    public function favorite(Request $request)
    {
        $user = Auth::user();

        $game = Game::find($request->game);

        // check if user already favourited game
        if ($user->isFavoriteGame($game)) {
            return redirect()->back()->with('error_message', 'You have already favorited this game.');
        }

        $user->favoriteGame($game);

        return redirect()->back()->with('success_message', 'You have successfully favorited this game.');
    }

    public function unfavorite(Request $request)
    {
        $user = Auth::user();

        $game = Game::find($request->game);

        // check if user already favourited game
        if (!$user->isFavoriteGame($game)) {
            return redirect()->back()->with('error_message', 'You have not favorited this game.');
        }

        $user->unfavoriteGame($game);

        return redirect()->back()->with('success_message', 'You have successfully unfavorited this game.');
    }

    public function play(Request $request)
    {
        $user = Auth()->user();

        $game = Game::find($request->game);
        try {
            $msg = $user->startPlaying($game);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }

        return redirect()->back()->with('success_message', $msg[0])->with('info_message', $msg[1]);
    }

    public function stop(Request $request)
    {
        $user = Auth::user();

        $game = Game::find($request->game);

        $user->stopPlaying();

        return redirect()->back()->with('success_message', 'You have successfully stopped playing this game.');
    }
}
