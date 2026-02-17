<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Especialista;
use Symfony\Component\HttpFoundation\Response;

class BlockUnverifiedEspecialista
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            return $next($request);
        }

        $especialista = Especialista::where('user_id', $user->id)->first();

        // Si no es especialista, no bloqueamos nada (paciente normal)
        if (!$especialista) {
            return $next($request);
        }

        // Si es especialista y está verificado, ok
        if ($especialista->is_verified) {
            return $next($request);
        }

        // Si es especialista NO verificado, solo permitimos:
        if (
            $request->routeIs('especialista.esperando_verificacion') ||
            $request->routeIs('logout') // para que pueda salir
        ) {
            return $next($request);
        }

        // Cualquier otra ruta autenticada -> lo mandamos a la espera
        return redirect()->route('especialista.esperando_verificacion');
    }
}
