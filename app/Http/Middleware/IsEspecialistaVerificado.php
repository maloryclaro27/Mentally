<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Especialista;
use Symfony\Component\HttpFoundation\Response;

class IsEspecialistaVerificado
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $especialista = Especialista::where('user_id', $user->id)->first();

        if (!$especialista) {
            abort(403, 'Acceso solo para especialistas');
        }

        if (!$especialista->is_verified) {
            return redirect()->route('especialista.esperando_verificacion');
        }

        return $next($request);
    }
}
