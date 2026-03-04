<?php

namespace App\Http\Controllers;

use Auth0\SDK\Auth0;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Auth0Controller extends Controller
{
    private function auth0(): Auth0
    {
        return new Auth0([
            'domain' => env('AUTH0_DOMAIN'),
            'clientId' => env('AUTH0_CLIENT_ID'),
            'clientSecret' => env('AUTH0_CLIENT_SECRET'),
            'cookieSecret' => env('AUTH0_COOKIE_SECRET'),
        ]);
    }

    // Inicia login con Auth0 forzando Google
    public function loginGoogle()
    {
        // Si ya está logeado, no inicies un flow nuevo (evita estados duplicados)
        if (Auth::check()) {
            return redirect()->route('dashboard.paciente'); // o dashboard
        }

        $auth0 = $this->auth0();

        $url = $auth0->login(
            env('AUTH0_REDIRECT_URI'),
            [
                'scope' => 'openid profile email',
                'connection' => 'google-oauth2',
            ]
        );

        // Para URLs externas es mejor away()
        return redirect()->away($url);
    }

    // Callback: Auth0 devuelve el code, aquí lo intercambiamos por el usuario
    public function callback(Request $request)
    {
        $auth0 = $this->auth0();

        try {
            $code = $request->query('code');

            // Si no viene code, no tiene sentido intentar exchange
            if (!$code) {
                // Si ya está logeado, ignora y manda a home
                if (Auth::check()) {
                    return redirect()->route('home');
                }
                return redirect('/login')->withErrors(['auth0' => 'No llegó el código de autorización (code).']);
            }

            $auth0->exchange(env('AUTH0_REDIRECT_URI'), $code);

            $userInfo = $auth0->getUser();
        } catch (\Throwable $e) {
            // Si este callback falló por "Invalid state" pero el usuario ya quedó logeado
            // (por un callback previo en paralelo), no muestres el error.
            if (Auth::check()) {
                return redirect()->route('home'); // o dashboard_paciente
            }

            Log::error('Auth0 callback error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'query' => $request->query(),
                'redirect_uri' => env('AUTH0_REDIRECT_URI'),
                'domain' => env('AUTH0_DOMAIN'),
                'client_id' => env('AUTH0_CLIENT_ID'),
            ]);

            return redirect('/login')->withErrors(['auth0' => 'Auth0 error: ' . $e->getMessage()]);
        }

        $email = $userInfo['email'] ?? null;
        if (!$email) {
            return redirect('/login')->withErrors(['auth0' => 'Google no devolvió email.']);
        }

        $fullName = $userInfo['name'] ?? ($userInfo['nickname'] ?? 'Usuario');

        // Separar nombre completo
        $parts = preg_split('/\s+/', trim($fullName), -1, PREG_SPLIT_NO_EMPTY);
        $firstName = $parts[0] ?? '';
        $lastName = count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';

        $auth0Id = $userInfo['sub'] ?? null; // ejemplo: google-oauth2|1234567890

        $user = User::firstOrNew(['email' => $email]);

        $user->name = $fullName; // compatibilidad
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->auth0_id = $auth0Id;

        if (!$user->exists) {
            $user->password = bcrypt(Str::random(32));
            // $user->role = 'paciente'; // si quieres default
        }

        $user->save();

        Auth::login($user);

        return redirect()->route('test.bienestar');
    }

    public function logout()
    {
        Auth::logout();

        $auth0 = $this->auth0();
        $returnTo = route('home');

        return redirect()->away($auth0->logout($returnTo));
    }
}