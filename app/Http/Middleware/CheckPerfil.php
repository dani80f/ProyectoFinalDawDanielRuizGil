<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->user()) {
            return redirect()->route('login');
        }

        // 2) Si está logueado pero no es admin, devolvemos 403 (o redirigimos)
        if ($request->user()->perfil !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta sección.');
            // o: return redirect('/')->with('error', 'No autorizado');
        }

        return $next($request);
    }
}
