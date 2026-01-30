<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user || ($user->role ?? 'client') !== 'admin') {
            abort(403, 'Acesso negado: somente administradores podem acessar esta área.');
        }

        return $next($request);
    }
}
