<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\View\View;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
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
}
