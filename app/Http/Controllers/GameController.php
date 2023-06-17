<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use App\Models\Publisher;
use App\Models\Tag;
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
        // authorize user
        $this->authorize('create', Game::class);

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
        // authorize user
        $this->authorize('create', Game::class);

        // Store the game
        $game = Game::create($request->validated());

        // Store the developers
        $game->developers()->sync($request->input('developers'));

        // Store the publishers
        $game->publishers()->sync($request->input('publishers'));

        return redirect()->route('games.show', ['game' => $game->id])->with('success_message', 'Game ' . $game->name . ' successfully created.');
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
        // authorize user
        $this->authorize('update', $game);

        // show the edit form
        $developers = Developer::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('games.edit', compact('game', 'developers', 'publishers', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        // authorize user
        $this->authorize('update', $game);

        // Update the game
        $game->update($request->validated());

        // Update the developers
        $game->developers()->sync($request->input('developers'));

        // Update the publishers
        $game->publishers()->sync($request->input('publishers'));

        // Update the tags
        $game->tags()->sync($request->input('tags'));

        return redirect()->route('games.show', ['game' => $game->id])->with('success_message', 'Game ' . $game->name . ' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        // authorize user
        $this->authorize('delete', $game);

        // Delete the many to many relationships
        $game->developers()->detach();
        $game->publishers()->detach();
        // Delete the game
        $game->delete();
        return redirect()->route('games.index')->with('success_message', 'Game ' . $game->name . ' successfully deleted.');
    }
}
