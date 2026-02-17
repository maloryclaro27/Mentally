<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de registro
     */
    public function showRegisterForm()
    {
        return view('auth.registro');
    }

    /**
     * Procesar registro de usuario
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'paciente',
            'terms' => 'required|accepted',
        ], [
            'firstName.required' => 'El nombre es obligatorio.',
            'lastName.required' => 'El apellido es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'terms.required' => 'Debes aceptar los términos y condiciones.',
            'terms.accepted' => 'Debes aceptar los términos y condiciones.',
        ]);

        // Si la validación falla, retornar errores
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el usuario
        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'name' => $request->firstName . ' ' . $request->lastName, // Para compatibilidad
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        // Autenticar al usuario automáticamente después del registro
        Auth::login($user);

        // Redirigir al dashboard o página de inicio
        return redirect()->route('test.bienestar')->with('success', '¡Registro exitoso! Bienvenido a Mentally.');
    }

    /**
     * Mostrar formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar login de usuario
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Detectar si es especialista (por tabla especialistas)
            $especialista = \App\Models\Especialista::where('user_id', $user->id)->first();

            // Si es especialista y NO está verificado -> SIEMPRE a esperando verificación (ignorar redirect)
            if ($especialista && !$especialista->is_verified) {
                return redirect()->route('especialista.esperando_verificacion')
                    ->with('success', 'Tu cuenta aún está en revisión para verificación.');
            }

            // Tomar redirect (solo si es interno) - recomendado: solo permitirlo a NO especialistas
            $redirect = $request->input('redirect');
            if (!$especialista && $redirect && str_starts_with($redirect, '/')) {
                return redirect($redirect)->with('success', '¡Bienvenido de vuelta!');
            }

            // Si es especialista verificado -> dashboard especialista
            if ($especialista) {
                return redirect()->route('especialista.dashboard')->with('success', '¡Bienvenido de vuelta!');
            }

            // Si no es especialista -> dashboard paciente
            return redirect()->route('dashboard.paciente')->with('success', '¡Bienvenido de vuelta!');
        }



        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
