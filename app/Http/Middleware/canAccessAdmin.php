<?php

namespace Rosa\Http\Middleware;

use Closure;

class canAccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->staff && auth()->user()->approved) {
            return $next($request);
        }

        return abort(401, 'Non-approved user');
    }
}
