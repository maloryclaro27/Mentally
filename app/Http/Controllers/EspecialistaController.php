<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Especialista;

class EspecialistaController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.registro_especialista');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:100'],
            'last_name' => ['required', 'string', 'min:2', 'max:100'],
            'psychiatry_license_number' => ['required', 'string', 'min:3', 'max:50', 'unique:especialistas,psychiatry_license_number'],
            'medical_school' => ['required', 'string', 'min:2', 'max:150'],
            'phone' => ['required', 'string', 'min:7', 'max:30'],
            'city' => ['required', 'string', 'min:2', 'max:80'],

            'specialties' => ['nullable', 'string'], // viene como JSON string desde el hidden
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ]);

        // specialties: convertir a array (si viene vacío, queda [])
        $specialtiesArray = [];
        if (!empty($validated['specialties'])) {
            $decoded = json_decode($validated['specialties'], true);
            if (is_array($decoded)) {
                $specialtiesArray = $decoded;
            }
        }

        DB::transaction(function () use ($validated, $specialtiesArray) {

            $user = User::create([
                'name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Especialista::create([
                'user_id' => $user->id,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'psychiatry_license_number' => $validated['psychiatry_license_number'],
                'medical_school' => $validated['medical_school'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'specialties' => $specialtiesArray,
                'is_verified' => false,
            ]);

            // Opcional: loguear automáticamente al especialista recién creado
            Auth::login($user);
        });

        $request->session()->regenerate();

        // Redirige al dashboard del especialista (luego lo blindamos para que solo especialistas entren)
        return redirect()->route('especialista.dashboard_especialista');
    }

    public function dashboard()
    {
        $user = auth()->user();

        // Si el usuario NO tiene perfil de especialista, no puede entrar
        $esEspecialista = \App\Models\Especialista::where('user_id', $user->id)->exists();

        if (!$esEspecialista) {
            abort(403, 'No autorizado');
        }

        return view('especialista.dashboard_especialista');
    }
}
