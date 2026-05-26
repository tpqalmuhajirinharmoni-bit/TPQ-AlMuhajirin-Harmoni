<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->user();
        if ($user->roles()->where('slug', 'admin')->exists()) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}
