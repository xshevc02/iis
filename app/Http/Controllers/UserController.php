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
        $authUser = auth()->user(); // Get the authenticated user

        // Check the role of the authenticated user
        if ($authUser->role->name === 'administrator') {
            // Admin can see all users
            $users = User::with(['role', 'studio'])->get();
        } elseif ($authUser->role->name === 'studio manager') {
            // Manager can only see users from their studio
            $users = User::with(['role', 'studio'])
                ->where('studio_id', $authUser->studio_id)
                ->get();
        } else {
            // For other roles, deny access
            abort(403, 'You do not have access to this resource.');
        }

        $roles = Role::all(); // Fetch all roles
        $studios = Studio::all(); // Fetch all studios

        return view('users.index', compact('users', 'roles', 'studios'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $usersWithoutStudio = User::whereNull('studio_id')->with('role')->get();

        return view('users.create', compact('usersWithoutStudio'));
    }

    public function assignToStudio(Request $request, User $user)
    {
        $managerStudioId = auth()->user()->studio_id;

        if (! $managerStudioId) {
            return redirect()->back()->withErrors(['error' => 'You are not associated with any studio.']);
        }

        $user->studio_id = $managerStudioId;
        $user->save();

        return redirect()->back()->with('success', 'User successfully assigned to your studio.');
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
    public function show($id)
    {
        $authUser = auth()->user(); // Get the authenticated user

        // Check if the authenticated user is an administrator
        if ($authUser->role->name === 'administrator') {
            $user = User::findOrFail($id); // Admin can see all users
        } elseif ($authUser->role->name === 'studio manager') {
            // For managers, ensure the user belongs to their studio
            $user = User::where('id', $id)
                ->where('studio_id', $authUser->studio_id)
                ->firstOrFail();
        } else {
            // For any other roles, deny access
            abort(403, 'You do not have access to this user.');
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Fetch all roles
        return view('users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role_id' => 'nullable|exists:roles,id', // Allow null for restricted roles
        ]);

        // Check if the user is currently "registrovany uzivatel"
        if ($user->role->name === 'registered user') {
            // Allow changing role only to "instructor"
            if (isset($validated['role_id'])) {
                $newRole = Role::find($validated['role_id']);
                if ($newRole->name === 'instructor' || $newRole->name === 'studio manager') {
                    $user->role_id = $validated['role_id'];
                } else {
                    return redirect()->back()->withErrors(['error' => 'Role can only be changed to "instructor" for "registered user".']);
                }
            }
        } elseif ($request->has('role_id')) {
            return redirect()->back()->withErrors(['error' => 'Role cannot be changed for this user.']);
        }

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
