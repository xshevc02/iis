<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Instructor
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Učitel nebo vyšší role
        if (!$user || !in_array($user->role->name, ['Instructor', 'Studio Manager', 'Administrator'])) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Nemáte oprávnění k přístupu na tuto stránku.']);
        }

        return $next($request);
    }
}

