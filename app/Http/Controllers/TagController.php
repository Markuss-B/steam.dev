<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // authorize user
        $this->authorize('create', Tag::class);

        // create a tag
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        // authorize user
        $this->authorize('create', Tag::class);

        // store a tag
        $tag = Tag::create($request->validated());

        return redirect()->route('tags.show', ['tag' => $tag->id])->with('success_message', 'Tag ' . $tag->name . ' successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($tag)
    {

        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        // authorize user
        $this->authorize('update', $tag);

        // edit a tag
        $games = Game::all();
        return view('tags.edit', compact('tag', 'games'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // authorize user
        $this->authorize('update', Tag::class);

        // update a tag
        $tag->update($request->validated());

        return redirect()->route('tags.show', ['tag' => $tag->id])->with('success_message', 'Tag ' . $tag->name . ' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // authorize user
        $this->authorize('delete', Tag::class);

        // delete a tag
        $tag->delete();

        return redirect()->route('tags.index')->with('success_message', 'Tag ' . $tag->name . ' successfully deleted.');
    }
}
