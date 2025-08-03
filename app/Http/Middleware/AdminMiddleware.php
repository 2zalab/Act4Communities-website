<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->hasRole('admin') || auth()->user()->hasRole('user')) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
