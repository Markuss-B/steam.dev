<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use App\Models\Publisher;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Contracts\View\View;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Get all games from the database
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // show the create form
        $developers = Developer::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        return view('games.create', compact('developers', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        // Store the game
        $game = Game::create($request->validated());

        // Store the developers
        $game->developers()->sync($request->input('developers'));

        // Store the publishers
        $game->publishers()->sync($request->input('publishers'));

        return redirect()->route('games.show', ['game' => $game->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game): View
    {
        // show the game
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game): View
    {
        // show the edit form
        $developers = Developer::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        return view('games.edit', compact('game', 'developers', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        // Update the game
        $game->update($request->validated());

        // Update the developers
        $game->developers()->sync($request->input('developers'));

        // Update the publishers
        $game->publishers()->sync($request->input('publishers'));

        return redirect()->route('games.show', ['game' => $game->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        // Delete the many to many relationships
        $game->developers()->detach();
        $game->publishers()->detach();
        // Delete the game
        $game->delete();
        return redirect()->route('games.index');
    }
}
