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
        $pacientesPrioritarios = collect();
        $alertasDeterioro = collect();
        $alertasAdherencia = collect();

        $hoy = now()->toDateString();
        $inicioVentana = now()->subDays(6)->toDateString();

        $prescripcionesActivas = Medicamento::whereIn('user_id', $idsPacientes)
            ->where('activo', true)
            ->count();

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

        foreach ($pacientesVinculados as $paciente) {
            $pacienteId = $paciente->id;

            $ultimoDepresion = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'depression')
                ->orderByDesc('taken_at')
                ->first();

            $penultimoDepresion = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'depression')
                ->orderByDesc('taken_at')
                ->skip(1)
                ->first();

            $ultimaAnsiedad = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'anxiety')
                ->orderByDesc('taken_at')
                ->first();

            $penultimaAnsiedad = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'anxiety')
                ->orderByDesc('taken_at')
                ->skip(1)
                ->first();

            $ultimoBienestar = TestAttempt::where('user_id', $pacienteId)
                ->where('test_type', 'wellbeing')
                ->orderByDesc('taken_at')
                ->first();

            // ===== Alertas Activas =====
            $alertaActiva = false;
            if ($ultimoDepresion && $ultimoDepresion->score !== null && (int) $ultimoDepresion->score >= 15) {
                $alertaActiva = true;
            }
            if ($ultimaAnsiedad && $ultimaAnsiedad->score !== null && (int) $ultimaAnsiedad->score >= 15) {
                $alertaActiva = true;
            }
            foreach ([$ultimoDepresion, $ultimaAnsiedad, $ultimoBienestar] as $ultimoTest) {
                if ($ultimoTest && \Carbon\Carbon::parse($ultimoTest->taken_at)->addDays(14)->isPast()) {
                    $alertaActiva = true;
                }
            }
            if ($alertaActiva) {
                $alertasActivas++;
            }

            // ===== Pacientes Prioritarios =====
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

            // ===== Alertas de deterioro =====
            if (
                $ultimoDepresion && $penultimoDepresion &&
                $ultimoDepresion->score !== null && $penultimoDepresion->score !== null &&
                ((int) $ultimoDepresion->score - (int) $penultimoDepresion->score) >= 5
            ) {
                $alertasDeterioro->push((object) [
                    'paciente' => $paciente,
                    'tipo' => 'critical',
                    'mensaje' => 'PHQ-9 empeoró significativamente',
                    'detalle' => 'Aumentó ' . ((int) $ultimoDepresion->score - (int) $penultimoDepresion->score) . ' puntos',
                ]);
            }

            if (
                $ultimaAnsiedad && $penultimaAnsiedad &&
                $ultimaAnsiedad->score !== null && $penultimaAnsiedad->score !== null &&
                ((int) $ultimaAnsiedad->score - (int) $penultimaAnsiedad->score) >= 5
            ) {
                $alertasDeterioro->push((object) [
                    'paciente' => $paciente,
                    'tipo' => 'warning',
                    'mensaje' => 'GAD-7 empeoró significativamente',
                    'detalle' => 'Aumentó ' . ((int) $ultimaAnsiedad->score - (int) $penultimaAnsiedad->score) . ' puntos',
                ]);
            }

            // ===== Alertas de adherencia =====
            $medicamentosPaciente = $medicamentosEsperados->where('user_id', $pacienteId);

            $expectedPaciente = 0;

            foreach ($medicamentosPaciente as $medicamento) {
                $inicioReal = \Carbon\Carbon::parse($medicamento->fecha_inicio)->startOfDay();
                $finReal = $medicamento->fecha_fin
                    ? \Carbon\Carbon::parse($medicamento->fecha_fin)->endOfDay()
                    : now()->endOfDay();

                $inicioConteo = \Carbon\Carbon::parse($inicioVentana)->startOfDay();
                $finConteo = \Carbon\Carbon::parse($hoy)->endOfDay();

                $desde = $inicioReal->greaterThan($inicioConteo) ? $inicioReal : $inicioConteo;
                $hasta = $finReal->lessThan($finConteo) ? $finReal : $finConteo;

                if ($desde->lte($hasta)) {
                    $expectedPaciente += $desde->diffInDays($hasta) + 1;
                }
            }

            $registeredPaciente = TomaMedicamento::where('user_id', $pacienteId)
                ->whereBetween('fecha_toma', [$inicioVentana, $hoy])
                ->count();

            $adherenciaPaciente = $expectedPaciente > 0
                ? (int) round(($registeredPaciente / $expectedPaciente) * 100)
                : 0;

            if ($expectedPaciente > 0 && $adherenciaPaciente < 60) {
                $alertasAdherencia->push((object) [
                    'paciente' => $paciente,
                    'tipo' => 'warning',
                    'mensaje' => 'Baja adherencia al tratamiento',
                    'detalle' => 'Adherencia actual: ' . $adherenciaPaciente . '%',
                ]);
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
            'adherenciaGlobal',
            'alertasDeterioro',
            'alertasAdherencia'
        ));
    }

    public function adherencia()
    {
        $user = auth()->user();
        $especialista = \App\Models\Especialista::where('user_id', $user->id)->first();

        if (!$especialista) {
            abort(403, 'No autorizado');
        }

        $pacientesVinculados = $user->pacientes()
            ->wherePivot('estado', 'aceptado')
            ->select('users.id', 'users.name', 'users.email')
            ->get();

        $idsPacientes = $pacientesVinculados->pluck('id');

        $hoy = now();
        $inicioVentana = now()->subDays(30);

        $medicamentosEsperados = Medicamento::whereIn('user_id', $idsPacientes)
            ->where('fecha_inicio', '<=', $hoy)
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

        // Trend Data (Last 14 days)
        $trendLabels = [];
        $trendData = [];
        
        for ($i = 13; $i >= 0; $i--) {
            $dia = now()->subDays($i)->startOfDay();
            $trendLabels[] = $dia->format('d/m');
            
            $expectedDia = 0;
            foreach ($medicamentosEsperados as $medicamento) {
                $inicioReal = \Carbon\Carbon::parse($medicamento->fecha_inicio)->startOfDay();
                $finReal = $medicamento->fecha_fin
                    ? \Carbon\Carbon::parse($medicamento->fecha_fin)->endOfDay()
                    : now()->endOfDay();
                
                if ($dia->between($inicioReal, $finReal)) {
                    $expectedDia++;
                }
            }
            
            $registeredDia = TomaMedicamento::whereIn('user_id', $idsPacientes)
                ->whereDate('fecha_toma', $dia->format('Y-m-d'))
                ->distinct('medicamento_id')
                ->count('id');
                
            $trendData[] = $expectedDia > 0 ? (int) round(($registeredDia / $expectedDia) * 100) : 0;
        }

        // Adherencia Individual
        $pacientesData = [];
        $estadoCount = ['optimo' => 0, 'regular' => 0, 'peligro' => 0];

        foreach ($pacientesVinculados as $paciente) {
            $medicamentosPaciente = $medicamentosEsperados->where('user_id', $paciente->id);
            $expectedPaciente = 0;
            foreach ($medicamentosPaciente as $medicamento) {
                $inicioReal = \Carbon\Carbon::parse($medicamento->fecha_inicio)->startOfDay();
                $finReal = $medicamento->fecha_fin
                    ? \Carbon\Carbon::parse($medicamento->fecha_fin)->endOfDay()
                    : now()->endOfDay();

                $inicioConteo = \Carbon\Carbon::parse($inicioVentana)->startOfDay();
                $finConteo = \Carbon\Carbon::parse($hoy)->endOfDay();

                $desde = $inicioReal->greaterThan($inicioConteo) ? $inicioReal : $inicioConteo;
                $hasta = $finReal->lessThan($finConteo) ? $finReal : $finConteo;

                if ($desde->lte($hasta)) {
                    $expectedPaciente += $desde->diffInDays($hasta) + 1;
                }
            }
            
            $registeredPaciente = TomaMedicamento::where('user_id', $paciente->id)
                ->whereBetween('fecha_toma', [$inicioVentana, $hoy])
                ->distinct('medicamento_id', 'fecha_toma')
                ->count('id');
                
            $adherenciaPaciente = $expectedPaciente > 0
                ? (int) round(($registeredPaciente / $expectedPaciente) * 100)
                : 0;
            
            if ($adherenciaPaciente >= 85) {
                $estado = 'optimo';
                $estadoCount['optimo']++;
            } elseif ($adherenciaPaciente >= 60) {
                $estado = 'regular';
                $estadoCount['regular']++;
            } else {
                $estado = 'peligro';
                $estadoCount['peligro']++;
            }

            $pacientesData[] = (object) [
                'id' => $paciente->id,
                'name' => $paciente->name,
                'adherencia' => $adherenciaPaciente,
                'estado' => $estado
            ];
        }

        usort($pacientesData, function($a, $b) {
            return $a->adherencia <=> $b->adherencia; 
        });

        return view('especialista.adherencia_especialista', compact(
            'adherenciaGlobal', 
            'trendLabels', 
            'trendData', 
            'pacientesData',
            'estadoCount'
        ));
    }
}
