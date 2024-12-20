<?php
/**
 * Veronika Novikova
 * xnovik03
 */
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
        $authUser = auth()->user();

        if (session('role_id') == '1') {
            $users = User::with(['role', 'studio'])->get();
        } elseif (session('role_id') == '2' || session('role_id') == '3') {
            $users = User::with(['role', 'studio'])
                ->where('studio_id', $authUser->studio_id)
                ->get();
        } else {
            return redirect()->route('no-access');
        }

        $roles = Role::all();
        $studios = Studio::all();

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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the photo
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ];

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            $userData['photo'] = $photoPath; // Save the photo path in the database
        }

        User::create($userData);

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

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user details
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle photo upload if a file is uploaded
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($user->photo) {
                Storage::delete('public/'.$user->photo);
            }

            // Store new photo
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            $user->photo = $photoPath;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
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
