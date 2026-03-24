<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Redirect authenticated users to their role-based dashboard when they try to access login/register.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $user->loadMissing('role');

                return match ($user->role?->name) {
                    'administrator' => redirect()->route('admin.index'),
                    'counsellor' => redirect()->route('counsellor.index'),
                    'student' => redirect()->route('student.index'),
                    default => redirect()->route('dashboard'),
                };
            }
        }

        return $next($request);
    }
}
