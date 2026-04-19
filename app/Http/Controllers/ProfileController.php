<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $emergencyContact = null;

        if (
            $user->emergency_name ||
            $user->emergency_country_code ||
            $user->emergency_phone ||
            $user->emergency_relation
        ) {
            $emergencyContact = (object) [
                'name' => $user->emergency_name,
                'country_code' => $user->emergency_country_code ?: '57',
                'phone' => $user->emergency_phone,
                'relationship' => $user->emergency_relation,
            ];
        }

        return view('perfil', compact('user', 'emergencyContact'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'birthdate' => ['nullable', 'date'],
        ]);

        $firstName = trim($validated['first_name'] ?? '');
        $lastName = trim($validated['last_name'] ?? '');

        $user->first_name = $firstName !== '' ? $firstName : null;
        $user->last_name = $lastName !== '' ? $lastName : null;

        $fullName = trim($firstName . ' ' . $lastName);
        $user->name = $fullName !== '' ? $fullName : ($user->name ?: 'Usuario');

        $user->email = $validated['email'];
        $user->birthdate = $validated['birthdate'] ?? null;
        $user->save();

        return response()->json([
            'success' => true,
            'user' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'name' => $user->name,
                'email' => $user->email,
                'birthdate' => $user->birthdate?->format('Y-m-d'),
            ],
        ]);
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $validated['avatar']->store('avatars', 'public');

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'avatar_url' => Storage::url($path),
        ]);
    }

    public function updateEmergency(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country_code' => ['nullable', 'string', 'max:10'],
            'phone' => ['required', 'string', 'max:30'],
            'relationship' => ['required', 'string', 'max:100'],
        ]);

        $user->emergency_name = $validated['name'];
        $user->emergency_country_code = $validated['country_code'] ?? '57';
        $user->emergency_phone = $validated['phone'];
        $user->emergency_relation = $validated['relationship'];
        $user->save();

        return response()->json([
            'success' => true,
            'emergency' => [
                'name' => $user->emergency_name,
                'country_code' => $user->emergency_country_code ?? '57',
                'phone' => $user->emergency_phone,
                'relationship' => $user->emergency_relation,
            ],
        ]);
    }
}
