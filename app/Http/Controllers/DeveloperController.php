<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all developers from the database
        $developers = Developer::all();
        return view('developers.index', compact('developers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // show the create form
        return view('developers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeveloperRequest $request)
    {
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
        // show the edit form
        return view('developers.edit', compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeveloperRequest $request, Developer $developer)
    {
        // Update the developer
        $developer->update($request->validated());

        return redirect()->route('developers.show', ['developer' => $developer->id])->with('success_message', 'Developer ' . $developer->name . ' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Developer $developer)
    {
        // Delete the developer
        $developer->delete();

        return redirect()->route('developers.index')->with('success_message', 'Developer ' . $developer->name . ' successfully deleted.');
    }
}
