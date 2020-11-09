<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }
        return redirect(route('admin.dashboard'));
    }
}
