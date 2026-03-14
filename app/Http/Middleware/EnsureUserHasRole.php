<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request. Expects role name as first argument, e.g. 'administrator'.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $roleName = $request->user()->role?->name;

        if (! $roleName || ! in_array($roleName, $roles, true)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
