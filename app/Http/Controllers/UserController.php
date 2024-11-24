<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with(['role', 'studio'])->get(); // Eager load role and studio
        $roles = Role::all(); // Fetch all roles
        $studios = Studio::all(); // Fetch all studios

        return view('users.index', compact('users', 'roles', 'studios'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {

        $roles = Role::all(); // Fetch all roles
        $studios = Studio::all(); // Fetch all studios

        return view('users.edit', compact('user', 'roles', 'studios'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'studio_id' => 'nullable|exists:studios,id',
        ]);

        $user->update([
            'role_id' => $validated['role_id'],
            'studio_id' => $validated['studio_id'],
        ]);
        // Update the "can_make_reservations" flag
        $user->can_make_reservations = $request->has('can_make_reservations');

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function toggleReservationAccess($id)
    {
        $user = User::findOrFail($id);

        // Toggle the reservation access
        $user->can_make_reservations = ! $user->can_make_reservations;
        $user->save();

        $status = $user->can_make_reservations ? 'enabled' : 'disabled';

        return redirect()->back()->with('success', "Reservation access {$status} for the user.");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
