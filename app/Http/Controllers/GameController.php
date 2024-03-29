<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use App\Models\Publisher;
use App\Models\Tag;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $games = Game::orderBy('name')->paginate(25);

        if($request->ajax()) {
            $view = view('components.scroller.load', ['view' => 'games', 'data' => $games])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $games->nextPageUrl()]);
        }

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

        // icon, library_hero, header
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            $game->icon = $iconPath;
        }
        if ($request->hasFile('library_hero')) {
            $libraryHeroPath = $request->file('library_hero')->store('library_heroes', 'public');
            $game->library_hero = $libraryHeroPath;
        }
        if ($request->hasFile('header')) {
            $headerPath = $request->file('header')->store('headers', 'public');
            $game->header = $headerPath;
        }

        $game->save();

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

        // icon, library_hero, header
        if ($request->hasFile('icon')) {
            // Delete the old icon
            if ($game->icon) {
                Storage::disk('public')->delete($game->icon);
            }
            $iconPath = $request->file('icon')->store('icons', 'public');
            $game->icon = $iconPath;
        }
        if ($request->hasFile('library_hero')) {
            // Delete the old library_hero
            if ($game->library_hero) {
                Storage::disk('public')->delete($game->library_hero);
            }
            $libraryHeroPath = $request->file('library_hero')->store('library_heroes', 'public');
            $game->library_hero = $libraryHeroPath;
        }
        if ($request->hasFile('header')) {
            // Delete the old header
            if ($game->header) {
                Storage::disk('public')->delete($game->header);
            }
            $headerPath = $request->file('header')->store('headers', 'public');
            $game->header = $headerPath;
        }

        $game->save();

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

    /**
     * Show the form for searching the specified resource.
     */
    public function search(Request $request)
    {
        // Start the query
        $query = Game::query();
        $searchTerm = $request->input('search');
        // Normalize the search term to handle hyphens/spaces interchangeably
        $normalizedSearchTerm = str_replace(['-', ' '], ['%', '%'], $searchTerm);
    
        $query->where('name', 'like', '%' . $normalizedSearchTerm . '%');
    
        $query = $this->selectSearch($query, $request);
        $games = $query;
        $devsQuery = null;
        // check if the search term matches any developer names
        // if it does, add the games with that developer to the results
        $developer = Developer::where('name', 'like', '%' . $normalizedSearchTerm . '%')->first();
        if ($developer)
        {
            $devsQuery = Game::query();
            $devsQuery->whereHas('developers', function ($query) use ($developer) {
                $query->where('name', $developer->name);
            });
            $devsQuery = $this->selectSearch($devsQuery, $request);

            $games = $query->union($devsQuery);
        }

        $tagsQuery = null;
        // check if the search term matches any tag names
        $tag = Tag::where('name', 'like', '%' . $normalizedSearchTerm . '%')->first();
        // if it does, add the games with that tag to the results
        if ($tag)
        {
            $tagsQuery = Game::query();
            $tagsQuery->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag->name);
            });
            $tagsQuery = $this->selectSearch($tagsQuery, $request);
            $games = $query->union($tagsQuery);
        }
    

        // Get the results and pass them to the view
        $games = $games->paginate(10);
    
        $tags = Tag::all()->sortBy('name');
    
        $request->flash();
    
        return view('games.search', ['games' => $games, 'tags' => $tags]);
    }
    
    public function selectSearch($query, $request)
    {
        if ($request->filled('tags')) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->whereIn('name', $request->input('tags'));
            });
        }
    
        // Check if an on sale filter is set
        if ($request->filled('on_sale')) {
            $query->where('discount', '>', 0);
        }
    
        // Check for sorting options
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $query->orderBy($sort, ($request->input('order')) ? 'desc' : 'asc');
        }
        return $query;
    }
    
}
