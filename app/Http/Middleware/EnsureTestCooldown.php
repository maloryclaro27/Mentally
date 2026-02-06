<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTestCooldown
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next, $testType = null)
    {
        $user = $request->user();

        // Si por alguna razón no hay usuario autenticado, que lo maneje auth middleware
        if (!$user) {
            return redirect()->route('login');
        }

        if (!$testType) {
            abort(500, 'Test type no definido en el middleware.');
        }

        $lastAttempt = $user->testAttempts()
            ->where('test_type', $testType)
            ->orderByDesc('taken_at')
            ->first();

        if ($lastAttempt) {
            $nextAllowed = $lastAttempt->taken_at->addDays(14);

            if (now()->lt($nextAllowed)) {
                return redirect()
                    ->back()
                    ->with('error', 'Aún no puedes realizar este test. Podrás intentarlo de nuevo el ' . $nextAllowed->format('d/m/Y') . '.');
            }
        }

        return $next($request);
    }
}
