<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ejecutar la petición y obtener la respuesta
        $response = $next($request);

        // Si el usuario está autenticado, registrar su actividad
        if (Auth::check()) {
            Log::info('Actividad de usuario', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
            ]);
        }

        return $response;
    }
}