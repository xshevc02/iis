<?php
namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
// Validate the input, including the photo
$request->validate([
'name' => 'required|string|max:255',
'location' => 'nullable|string|max:255',
'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

// Handle the photo upload
$validated = $request->all();
if ($request->hasFile('photo')) {
// Store the photo in the public disk under the 'studio_photos' folder
$photoPath = $request->file('photo')->store('studio_photos', 'public');
$validated['photo'] = $photoPath; // Add photo path to the validated data
}

// Create the studio record with the validated data, including photo
Studio::create($validated);

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
'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
]);

// If a new photo is uploaded, store it and update the photo path
if ($request->hasFile('photo')) {
$photoPath = $request->file('photo')->store('studio_photos', 'public');
$validated['photo'] = $photoPath;
}

// Update the studio with the validated data, including photo if uploaded
$studio->update($validated);

return redirect()->route('studios.index')->with('success', 'Studio updated successfully.');
}

/**
* Remove the specified resource from storage.
*/
public function destroy(Studio $studio)
{
try {
// Delete the studio record
$studio->delete();

return redirect()->route('studios.index')->with('success', 'Studio deleted successfully.');
} catch (\Exception $e) {
return redirect()->route('studios.index')->with('error', 'Unable to delete studio. It may be linked to other records.');
}
}
}
