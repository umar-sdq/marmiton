<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrateur
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'ADMIN') {
            abort(403, 'Accès refusé - Réservé aux administrateurs.');
        }

        return $next($request);
    }
}
