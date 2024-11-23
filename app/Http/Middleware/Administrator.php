<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;


class Administrator
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Administrátor musí mít roli "Administrator"
        if (! auth()->check() || auth()->user()->role->name !== 'Administrator') {
            return redirect()->route('dashboard')->withErrors(['error' => 'Nemáte oprávnění k přístupu na tuto stránku.']);
        }

        return $next($request);
    }
}
