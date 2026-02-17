<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Especialista;
use Symfony\Component\HttpFoundation\Response;

class IsEspecialista
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $esEspecialista = Especialista::where('user_id', $user->id)->exists();

        if (!$esEspecialista) {
            abort(403, 'Acceso solo para especialistas');
        }

        return $next($request);
    }
}
