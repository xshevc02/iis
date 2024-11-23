<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
    {
        $user = Auth::user();

        if (! $user || ! $user->role || ! in_array($user->role->name, explode('|', $roles))) {
            return redirect()->route('dashboard')->with('error', 'You do not have the required permissions.');
        }

        return $next($request);
    }
}
