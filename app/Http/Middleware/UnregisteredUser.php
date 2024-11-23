<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UnregisteredUser
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Neregistrovaný uživatel nemá žádná zvláštní omezení, protože není přihlášen
        if (! $user) {
            return $next($request);
        }

        return redirect()->route('dashboard')->withErrors(['error' => 'Tato stránka není dostupná registrovaným uživatelům.']);
    }
}
