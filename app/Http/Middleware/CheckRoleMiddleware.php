<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        
        // If no user is authenticated, abort
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // Allow access based on role requirements
        if ($role === 'student') {
            // Students and instructors can access student routes
            if (!in_array($user->role, ['student', 'instructor'])) {
                abort(403, 'Unauthorized action.');
            }
        } elseif ($role === 'instructor') {
            // Only instructors can access instructor routes
            if ($user->role !== 'instructor') {
                abort(403, 'Unauthorized action.');
            }
        } else {
            // For any other role, exact match is required
            if ($user->role !== $role) {
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
