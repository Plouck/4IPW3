<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthSession
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
