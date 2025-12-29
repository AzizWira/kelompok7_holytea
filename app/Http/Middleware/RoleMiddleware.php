<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, string $role)
    {
        $user = $request->user();

        if (!$user)
            abort(401);
        if (!$user->is_active)
            abort(403, 'User inactive');
        if ($user->role !== $role)
            abort(403, 'Forbidden');

        return $next($request);
    }

}
