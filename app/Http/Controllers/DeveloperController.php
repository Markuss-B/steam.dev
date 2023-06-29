<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;
use App\Models\Game;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\View\View;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $developers = Developer::query()
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->paginate(25);

        if ($request->ajax()) {
            $view = view('components.scroller.load', ['view' => 'developers', 'data' => $developers])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $developers->nextPageUrl()]);
        }

        return view('developers.index', compact('developers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // authorize user
        $this->authorize('create', Developer::class);

        // show the create form
        return view('developers.create');
    }

    public function createGame(Developer $developer)
    {
        // authorize user
        $this->authorize('create', Game::class);

        // show the create form
        $developers = Developer::where('id', $developer->id)->get();
        return view('games.create', compact('developers', 'developer'));
    }

    public function editGame(Developer $developer, Game $game)
    {
        // authorize user
        $this->authorize('update', $game);

        // show the edit form
        $developers = Developer::where('id', $developer->id)->get();
        $tags = Tag::orderBy('name')->get();
        return view('games.edit', compact('developers', 'developer', 'game', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeveloperRequest $request)
    {
        // authorize user
        $this->authorize('create', Developer::class);

        // Store the developer
        $developer = Developer::create($request->validated());

        return redirect()->route('developers.show', ['developer' => $developer->id])->with('success_message', 'Developer ' . $developer->name . ' successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Developer $developer)
    {
        // show the developer
        return view('developers.show', compact('developer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Developer $developer)
    {
        // authorize user
        $this->authorize('update', $developer);

        // show the edit form
        return view('developers.edit', compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeveloperRequest $request, Developer $developer)
    {
        // authorize user
        $this->authorize('update', $developer);

        // Update the developer
        $developer->update($request->validated());

        return redirect()->route('developers.show', ['developer' => $developer->id])->with('success_message', 'Developer ' . $developer->name . ' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Developer $developer)
    {
        // authorize user
        $this->authorize('delete', $developer);

        // Delete the developer
        $developer->delete();

        return redirect()->route('developers.index')->with('success_message', 'Developer ' . $developer->name . ' successfully deleted.');
    }

    public function addUser(Developer $developer, User $user)
    {
        // authorize user
        $this->authorize('update', $developer);

        if (!$user->hasRole('developer')) {
            return redirect()->back()->with('error_message', 'User ' . $user->name . ' does not have the developer role.');
        }

        // check if user is already added
        if ($developer->users->contains($user)) {
            return redirect()->back()->with('error_message', 'User ' . $user->name . ' is already added to developer ' . $developer->name . '.');
        }

        // add user to developer
        $developer->users()->attach($user);

        return redirect()->back()->with('success_message', 'User ' . $user->name . ' successfully added to developer ' . $developer->name . '.');
    }

    public function removeUser(Developer $developer, User $user)
    {
        // authorize user
        $this->authorize('update', $developer);

        // check if user is not
        if (!$developer->users->contains($user)) {
            return redirect()->back()->with('error_message', 'User ' . $user->name . ' is not added to developer ' . $developer->name . '.');
        }

        // remove user from developer
        $developer->users()->detach($user);

        return redirect()->back()->with('success_message', 'User ' . $user->name . ' successfully removed from developer ' . $developer->name . '.');
    }

    public function users(Developer $developer)
    {
        $users = User::orderBy('name')->paginate(25);

        return view('developers.users', compact('users', 'developer'));
    }

}
