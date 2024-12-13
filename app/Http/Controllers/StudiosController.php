<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $search = $request->input('search'); // Retrieve the 'search' query parameter

        // Use the `search` scope to filter results
        $studios = Studio::search($search); // Paginate results for better usability

        return view('studios.index', compact('studios', 'search')); // Pass $studios and $search to the view
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        Studio::create($request->all());

        return redirect()->route('studios.index')->with('success', 'Studio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Studio $studio)
    {
        return view('studios.show', compact('studio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $studio = Studio::findOrFail($id);

        return view('studios.edit', compact('studio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // Update the studio with the validated data
        $studio->update($validated);

        return redirect()->route('studios.index')->with('success', 'Studio updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studio $studio)
    {
        try {
            $studio->delete();

            return redirect()->route('studios.index')->with('success', 'Studio deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('studios.index')->with('error', 'Unable to delete studio. It may be linked to other records.');
        }
    }
}
