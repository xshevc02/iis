<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrator
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Administrátor musí mít roli "Administrator"
        if (!$user || $user->role->name !== 'Administrator') {
            return redirect()->route('dashboard')->withErrors(['error' => 'Nemáte oprávnění k přístupu na tuto stránku.']);
        }

        return $next($request);
    }
}

