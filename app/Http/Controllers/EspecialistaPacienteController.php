<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialistaPacienteController extends Controller
{
    public function vincular(Request $request)
    {
        $request->validate([
            'paciente_id' => ['required', 'exists:users,id'],
        ]);

        $especialista = Auth::user();

        $paciente = User::findOrFail($request->paciente_id);

        $especialista->pacientes()->syncWithoutDetaching([
            $paciente->id => [
                'estado' => 'aceptado',
                'consentimiento_aceptado' => true,
                'consentimiento_aceptado_en' => now(),
                'codigo_vinculacion' => null,
            ]
        ]);

        return back()->with('success', 'Paciente vinculado correctamente.');
    }
}