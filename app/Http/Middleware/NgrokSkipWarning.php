<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NgrokSkipWarning
{
    public function handle(Request $request, Closure $next)
    {
        header('ngrok-skip-browser-warning: true');
        return $next($request);
    }
}
