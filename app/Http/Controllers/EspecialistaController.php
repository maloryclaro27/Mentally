<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Especialista;
use App\Models\TestAttempt;
use App\Models\Medicamento;
use App\Models\TomaMedicamento;

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
                'role' => 'especialista',
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
        return redirect()->route('especialista.esperando_verificacion')->with('success', 'Registro exitoso. Tu cuenta está en revisión para verificación.');
    }

    public function dashboard()
    {
        $user = auth()->user();

        $especialista = \App\Models\Especialista::where('user_id', $user->id)->first();

        if (!$especialista) {
            abort(403, 'No autorizado');
        }

        $totalPacientes = $user->pacientes()
            ->wherePivot('estado', 'aceptado')
            ->count();

        $pacientesVinculados = $user->pacientes()
            ->wherePivot('estado', 'aceptado')
            ->select('users.id', 'users.name', 'users.email')
            ->get();

        $idsPacientes = $pacientesVinculados->pluck('id');

        $testsEsteMes = TestAttempt::whereIn('user_id', $idsPacientes)
            ->whereMonth('taken_at', now()->month)
            ->whereYear('taken_at', now()->year)
            ->count();

        $alertasActivas = 0;

        foreach ($idsPacientes as $pacienteId) {
            $ultimoDepresion = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'depression')
                ->orderByDesc('taken_at')
                ->first();

            $ultimaAnsiedad = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'anxiety')
                ->orderByDesc('taken_at')
                ->first();

            $ultimoBienestar = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'wellbeing')
                ->orderByDesc('taken_at')
                ->first();

            $alerta = false;

            if ($ultimoDepresion && $ultimoDepresion->score !== null && (int) $ultimoDepresion->score >= 15) {
                $alerta = true;
            }

            if ($ultimaAnsiedad && $ultimaAnsiedad->score !== null && (int) $ultimaAnsiedad->score >= 15) {
                $alerta = true;
            }

            foreach ([$ultimoDepresion, $ultimaAnsiedad, $ultimoBienestar] as $ultimoTest) {
                if ($ultimoTest && \Carbon\Carbon::parse($ultimoTest->taken_at)->addDays(14)->isPast()) {
                    $alerta = true;
                }
            }

            if ($alerta) {
                $alertasActivas++;
            }

            $pacientesPrioritarios = collect();

            foreach ($pacientesVinculados as $paciente) {
                $ultimoDepresion = TestAttempt::where('user_id', $paciente->id)
                    ->where('test_type', 'depression')
                    ->orderByDesc('taken_at')
                    ->first();

                $ultimaAnsiedad = TestAttempt::where('user_id', $paciente->id)
                    ->where('test_type', 'anxiety')
                    ->orderByDesc('taken_at')
                    ->first();

                $ultimoBienestar = TestAttempt::where('user_id', $paciente->id)
                    ->where('test_type', 'wellbeing')
                    ->orderByDesc('taken_at')
                    ->first();

                $motivo = null;
                $nivel = 'moderado';

                if ($ultimoDepresion && $ultimoDepresion->score !== null && (int) $ultimoDepresion->score >= 20) {
                    $motivo = 'PHQ-9 severo';
                    $nivel = 'alto';
                } elseif ($ultimoDepresion && $ultimoDepresion->score !== null && (int) $ultimoDepresion->score >= 15) {
                    $motivo = 'PHQ-9 elevado';
                    $nivel = 'moderado';
                } elseif ($ultimaAnsiedad && $ultimaAnsiedad->score !== null && (int) $ultimaAnsiedad->score >= 15) {
                    $motivo = 'GAD-7 elevado';
                    $nivel = 'moderado';
                } else {
                    foreach ([$ultimoDepresion, $ultimaAnsiedad, $ultimoBienestar] as $ultimoTest) {
                        if ($ultimoTest && \Carbon\Carbon::parse($ultimoTest->taken_at)->addDays(14)->isPast()) {
                            $motivo = 'Test vencido';
                            $nivel = 'moderado';
                            break;
                        }
                    }
                }

                if ($motivo) {
                    $paciente->motivo_alerta = $motivo;
                    $paciente->nivel_alerta = $nivel;
                    $pacientesPrioritarios->push($paciente);
                }

                $prescripcionesActivas = Medicamento::whereIn('user_id', $idsPacientes)
                    ->where('activo', true)
                    ->count();

                $hoy = now()->toDateString();
                $inicioVentana = now()->subDays(6)->toDateString();

                $medicamentosEsperados = Medicamento::whereIn('user_id', $idsPacientes)
                    ->where('activo', true)
                    ->whereDate('fecha_inicio', '<=', $hoy)
                    ->where(function ($q) use ($inicioVentana) {
                        $q->whereNull('fecha_fin')
                            ->orWhereDate('fecha_fin', '>=', $inicioVentana);
                    })
                    ->get(['id', 'user_id', 'fecha_inicio', 'fecha_fin']);

                $expectedDoses = 0;

                foreach ($medicamentosEsperados as $medicamento) {
                    $inicioReal = \Carbon\Carbon::parse($medicamento->fecha_inicio)->startOfDay();
                    $finReal = $medicamento->fecha_fin
                        ? \Carbon\Carbon::parse($medicamento->fecha_fin)->endOfDay()
                        : now()->endOfDay();

                    $inicioConteo = \Carbon\Carbon::parse($inicioVentana)->startOfDay();
                    $finConteo = \Carbon\Carbon::parse($hoy)->endOfDay();

                    $desde = $inicioReal->greaterThan($inicioConteo) ? $inicioReal : $inicioConteo;
                    $hasta = $finReal->lessThan($finConteo) ? $finReal : $finConteo;

                    if ($desde->lte($hasta)) {
                        $expectedDoses += $desde->diffInDays($hasta) + 1;
                    }
                }

                $registeredDoses = TomaMedicamento::whereIn('user_id', $idsPacientes)
                    ->whereBetween('fecha_toma', [$inicioVentana, $hoy])
                    ->distinct('medicamento_id', 'fecha_toma')
                    ->count('id');

                $adherenciaGlobal = $expectedDoses > 0
                    ? (int) round(($registeredDoses / $expectedDoses) * 100)
                    : 0;
            }
        }

        return view('especialista.dashboard_especialista', compact(
            'especialista',
            'totalPacientes',
            'pacientesVinculados',
            'testsEsteMes',
            'alertasActivas',
            'pacientesPrioritarios',
            'prescripcionesActivas',
            'adherenciaGlobal'
        ));
    }

    public function esperandoVerificacion()
    {
        return view('especialista.esperando_verificacion');
    }
}
