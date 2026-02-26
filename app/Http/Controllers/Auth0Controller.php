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
        $auth0 = $this->auth0();

        return redirect($auth0->login(
            env('AUTH0_REDIRECT_URI'),
            [
                'scope' => 'openid profile email',
                'connection' => 'google-oauth2',
            ]
        ));
    }

    // Callback: Auth0 devuelve el code, aquí lo intercambiamos por el usuario
    public function callback(Request $request)
    {
        $auth0 = $this->auth0();

        try {
            $code = $request->query('code');

            $auth0->exchange(
                env('AUTH0_REDIRECT_URI'),
                $code
            );

            $userInfo = $auth0->getUser();
            $auth0Id = $userInfo['sub'] ?? null; // ejemplo: google-oauth2|1234567890
        } catch (\Throwable $e) {
            // Log detallado para verlo en storage/logs/laravel.log
            Log::error('Auth0 callback error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'query' => $request->query(),
                'redirect_uri' => env('AUTH0_REDIRECT_URI'),
                'domain' => env('AUTH0_DOMAIN'),
                'client_id' => env('AUTH0_CLIENT_ID'),
            ]);

            // Mostrar el mensaje real (temporal, solo debug)
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

        // Crea o actualiza usuario en tu BD
        $auth0Id = $userInfo['sub'] ?? null;

        $user = User::firstOrNew(['email' => $email]);

        $user->name = $fullName; // lo dejamos por compatibilidad
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->auth0_id = $auth0Id;

        // Solo si es nuevo usuario
        if (!$user->exists) {
            $user->password = bcrypt(Str::random(32));
            // $user->role = 'paciente'; // si quieres default
        }

        $user->save();

        Auth::login($user);

        // Redirige a donde tenga sentido en tu app
        return redirect()->route('test.bienestar');
    }

    public function logout()
    {
        Auth::logout();

        $auth0 = $this->auth0();

        $returnTo = route('home');

        return redirect($auth0->logout($returnTo));
    }
}
