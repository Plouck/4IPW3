<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié et a le rôle 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // L'utilisateur est un admin, il peut passer
        }

        // Si ce n'est pas un admin, redirige vers une autre page
        return redirect()->route('home')->with('error', 'Accès interdit');
    }
}
