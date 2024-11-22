<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studios = Studio::paginate(10); // Paginate with 10 studios per page
        return view('studios.index', compact('studios'));
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
    public function edit(Studio $studio)
    {
        return view('studios.edit', compact('studio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Studio $studio)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $studio->update($request->all());

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
