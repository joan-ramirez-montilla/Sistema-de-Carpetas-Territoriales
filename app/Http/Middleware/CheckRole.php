<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  <-- aquí recibes 'admin'
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        if ($role == "admin" && $user->role != "admin") {
            abort(403, 'Acceso denegado: solo admins.');
        }

        if ($role == "employee" && $user->role != "employee") {
            abort(403, 'Acceso denegado: solo empleados.');
        }

        return $next($request);
    }
}
