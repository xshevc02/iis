<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RegisteredUser
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Registrovaný uživatel nebo vyšší role
        if (! $user || ! in_array($user->role->name, ['Registered User', 'Instructor', 'Studio Manager', 'Administrator'])) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Nemáte oprávnění k přístupu na tuto stránku.']);
        }

        return $next($request);
    }
}
