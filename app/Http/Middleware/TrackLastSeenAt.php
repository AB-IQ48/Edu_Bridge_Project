<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLastSeenAt
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            $user = $request->user();
            $lastSeen = $user->last_seen_at;

            // Avoid DB write on every request; update at most once per minute.
            if (! $lastSeen || $lastSeen->lt(now()->subMinute())) {
                $user->forceFill(['last_seen_at' => now()])->save();
            }
        }

        return $next($request);
    }
}
