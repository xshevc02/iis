<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image

        ]);

        // Retrieve the authenticated user
        $user = Auth::user();


        // Check if a new photo is uploaded
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public'); // Store the photo in 'storage/app/public/profile_photos'
            $user->photo = $photoPath; // Save the photo path to the database
        }
        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'photo' => $user->photo ?? null, // Save the photo path if exists

        ]);

        // Redirect back to the edit page with success message
        return redirect()->route('profile.edit')->with('success', 'Profil byl úspěšně aktualizován.');
    }
}
