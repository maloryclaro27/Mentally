<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicamento;
use App\Models\TomaMedicamento;
use App\Services\AdherenciaService;

class AdherenciaController extends Controller
{
    protected $adherenciaService;

    public function __construct(AdherenciaService $adherenciaService)
    {
        $this->adherenciaService = $adherenciaService;
    }
    public function index()
    {
        // Datos simulados para desarrollo
        $usuario = Auth::user();
        $evolutionStage = 1;

        $hoy = now()->toDateString();

        $medicamentosActivosEnFecha = fn($fecha) => $this->adherenciaService->getActiveMedicationIdsByDate($usuario->id, $fecha);

        $carbonHoy = now()->startOfDay();

        $fechasUltimos7Dias = collect(range(0, 6))
            ->map(fn($i) => $carbonHoy->copy()->subDays($i)->toDateString());

        $tomasPorFecha = TomaMedicamento::where('user_id', $usuario->id)
            ->whereDate('fecha_toma', '>=', $carbonHoy->copy()->subDays(6)->toDateString())
            ->get()
            ->groupBy(function ($toma) {
                return \Carbon\Carbon::parse($toma->fecha_toma)->toDateString();
            });
        $medicamentosActivosHoyIds = $medicamentosActivosEnFecha($hoy);

        $tomasHoyIds = TomaMedicamento::where('user_id', $usuario->id)
            ->whereDate('fecha_toma', $hoy)
            ->whereIn('medicamento_id', $medicamentosActivosHoyIds)
            ->distinct()
            ->pluck('medicamento_id');

        $medicamentos = Medicamento::whereIn('id', $medicamentosActivosHoyIds)
            ->orderBy('hora_toma')
            ->get()
            ->map(function ($medicamento) use ($tomasHoyIds) {
                return (object) [
                    'id' => $medicamento->id,
                    'nombre' => $medicamento->nombre,
                    'dosis' => $medicamento->dosis,
                    'hora_toma' => $medicamento->hora_toma,
                    'tomado_hoy' => $tomasHoyIds->contains($medicamento->id),
                ];
            });

        $totalMedicamentosActivos = $medicamentos->count();

        $medicamentosTomadosHoy = $tomasHoyIds->unique()->count();

        $totalTomasEsperadasUltimos7Dias = 0;
        $totalTomasRegistradasUltimos7Dias = 0;

        foreach ($fechasUltimos7Dias as $fecha) {
            $medicamentosActivosEseDia = $medicamentosActivosEnFecha($fecha);

            $esperadasEseDia = $medicamentosActivosEseDia->count();

            $registradasEseDia = collect($tomasPorFecha->get($fecha, []))
                ->whereIn('medicamento_id', $medicamentosActivosEseDia)
                ->unique('medicamento_id')
                ->count();

            $totalTomasEsperadasUltimos7Dias += $esperadasEseDia;
            $totalTomasRegistradasUltimos7Dias += min($registradasEseDia, $esperadasEseDia);
        }

        if ($totalTomasEsperadasUltimos7Dias > 0) {
            $adherenceRate = round(($totalTomasRegistradasUltimos7Dias / $totalTomasEsperadasUltimos7Dias) * 100);
        } else {
            $adherenceRate = 0;
        }
        $companionEnergy = $this->adherenciaService->getCompanionEnergy($totalMedicamentosActivos, $adherenceRate);
        $companionEnergyLevel = $this->adherenciaService->getCompanionEnergyLevel($totalMedicamentosActivos, $companionEnergy);
        // Datos de la mascota
        $streakDays = 0;

        for ($i = 0; $i < 365; $i++) {
            $fecha = $carbonHoy->copy()->subDays($i)->toDateString();

            $medicamentosActivosEseDia = $medicamentosActivosEnFecha($fecha);

            $esperadasEseDia = $medicamentosActivosEseDia->count();

            if ($esperadasEseDia === 0) {
                if ($i === 0) {
                    $streakDays = 0;
                }
                break;
            }

            $registradasEseDia = TomaMedicamento::where('user_id', $usuario->id)
                ->whereDate('fecha_toma', $fecha)
                ->whereIn('medicamento_id', $medicamentosActivosEseDia)
                ->distinct('medicamento_id')
                ->count('medicamento_id');

            if ($registradasEseDia === $esperadasEseDia) {
                $streakDays++;
            } else {
                break;
            }
        }

        // Mensaje motivacional
        $motivationalMessage = $this->getMotivationalMessage($totalMedicamentosActivos, $adherenceRate);

        // Progreso
        $dailyAffirmation = $this->getDailyAffirmation();

        // Logros
        $allAchievements = $this->getAchievements();

        // Logros del usuario (simulados)
        $allAchievements = $this->adherenciaService->markUnlockedAchievements($allAchievements, $streakDays);


        // Próximo logro
        $nextAchievement = $this->adherenciaService->getNextAchievement($allAchievements, $streakDays);
        $evolutionStage = $this->adherenciaService->getEvolutionStage($streakDays);

        $petColors = $this->adherenciaService->getPetColors($evolutionStage);

        $progressToNextAchievement = $this->adherenciaService->getProgressToNextAchievement($nextAchievement, $streakDays);

        return view('adherencia', compact(
            'usuario',
            'medicamentos',
            'evolutionStage',
            'companionEnergyLevel',
            'companionEnergy',
            'streakDays',
            'adherenceRate',
            'petColors',
            'motivationalMessage',
            'progressToNextAchievement',
            'dailyAffirmation',
            'allAchievements',
            'nextAchievement'
        ));
    }

    // Nota de diseño:
    // No se implementa una restricción única global en la tabla medicamentos
    // para (user_id, nombre, dosis, hora_toma) porque la lógica histórica permite
    // cerrar un medicamento y volver a crearlo o reactivarlo después.
    // La protección única a nivel BD sí existe en tomas_medicamentos
    // mediante (medicamento_id, fecha_toma), evitando duplicados de toma por día.

    public function guardarMedicamento(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'hora_toma' => 'required|date_format:H:i',
        ]);
        $hoy = now()->toDateString();

        $medicamento = Medicamento::where('user_id', Auth::id())
            ->where('nombre', $request->nombre)
            ->where('dosis', $request->dosis)
            ->where('hora_toma', $request->hora_toma)
            ->where(function ($query) use ($hoy) {
                $query->whereNotNull('fecha_fin')
                    ->whereDate('fecha_fin', '<', $hoy);
            })
            ->latest('id')
            ->first();

        $medicamentosActivosHoyIds = $this->adherenciaService->getActiveMedicationIdsByDate(Auth::id(), $hoy);

        $medicamentoActivoHoy = Medicamento::where('user_id', Auth::id())
            ->whereIn('id', $medicamentosActivosHoyIds)
            ->where('nombre', $request->nombre)
            ->where('dosis', $request->dosis)
            ->where('hora_toma', $request->hora_toma)
            ->first();

        if ($medicamentoActivoHoy) {
            return redirect('/adherencia')
                ->withErrors(['nombre' => 'Ese medicamento ya está registrado como activo.'])
                ->withInput();
        }

        if ($medicamento) {
            $medicamento->update([
                'activo' => true,
                'fecha_inicio' => $hoy,
                'fecha_fin' => null,
            ]);
        } else {
            Medicamento::create([
                'user_id' => Auth::id(),
                'nombre' => $request->nombre,
                'dosis' => $request->dosis,
                'hora_toma' => $request->hora_toma,
                'activo' => true,
                'fecha_inicio' => $hoy,
                'fecha_fin' => null,
            ]);
        }

        return redirect('/adherencia')->with('success', 'Medicamento añadido correctamente.');
    }

    public function actualizarMedicamento(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'hora_toma' => 'required|date_format:H:i',
        ]);

        $hoy = now()->toDateString();

        $medicamentosActivosHoyIds = $this->adherenciaService->getActiveMedicationIdsByDate(Auth::id(), $hoy);

        $medicamento = Medicamento::where('id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('id', $medicamentosActivosHoyIds)
            ->firstOrFail();

        $duplicado = Medicamento::where('user_id', Auth::id())
            ->whereIn('id', $medicamentosActivosHoyIds)
            ->where('nombre', $request->nombre)
            ->where('dosis', $request->dosis)
            ->where('hora_toma', $request->hora_toma)
            ->where('id', '!=', $medicamento->id)
            ->exists();

        if ($duplicado) {
            return redirect('/adherencia')
                ->withErrors(['nombre' => 'Ya tienes un medicamento activo con el mismo nombre, dosis y hora.'])
                ->withInput();
        }
        $medicamento->update([
            'nombre' => $request->nombre,
            'dosis' => $request->dosis,
            'hora_toma' => $request->hora_toma,
        ]);

        return redirect('/adherencia')->with('success', 'Medicamento actualizado correctamente.');
    }

    public function eliminarMedicamento($id)
    {
        $hoy = now()->toDateString();

        $medicamentosActivosHoyIds = $this->adherenciaService->getActiveMedicationIdsByDate(Auth::id(), $hoy);

        $medicamento = Medicamento::where('id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('id', $medicamentosActivosHoyIds)
            ->firstOrFail();

        $medicamento->update([
            'activo' => false,
            'fecha_fin' => \Carbon\Carbon::parse($hoy)->subDay()->toDateString(),
        ]);

        return redirect('/adherencia')->with('success', 'Medicamento eliminado correctamente.');
    }

    public function marcarToma($id)
    {
        $hoy = now()->toDateString();

        $medicamentosActivosHoyIds = $this->adherenciaService->getActiveMedicationIdsByDate(Auth::id(), $hoy);

        $medicamento = Medicamento::where('id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('id', $medicamentosActivosHoyIds)
            ->firstOrFail();

        TomaMedicamento::firstOrCreate(
            [
                'medicamento_id' => $medicamento->id,
                'fecha_toma' => $hoy,
            ],
            [
                'user_id' => Auth::id(),
                'tomado_en' => now(),
                'estado' => 'tomado',
            ]
        );

        return redirect('/adherencia')->with('success', 'Toma registrada correctamente.');
    }

    private function getAchievements()
    {
        return collect([
            (object) ['id' => 1, 'name' => 'Principiante', 'description' => '7 días de racha', 'days_required' => 7, 'icon_html' => '🌱'],
            (object) ['id' => 2, 'name' => 'Explorador', 'description' => '15 días de racha', 'days_required' => 15, 'icon_html' => '🔍'],
            (object) ['id' => 3, 'name' => 'Comprometido', 'description' => '30 días de racha', 'days_required' => 30, 'icon_html' => '🤝'],
            (object) ['id' => 4, 'name' => 'Dedicado', 'description' => '60 días de racha', 'days_required' => 60, 'icon_html' => '⭐'],
            (object) ['id' => 5, 'name' => 'Experto', 'description' => '90 días de racha', 'days_required' => 90, 'icon_html' => '🏆'],
            (object) ['id' => 6, 'name' => 'Maestro', 'description' => '180 días de racha', 'days_required' => 180, 'icon_html' => '👑'],
            (object) ['id' => 7, 'name' => 'Leyenda', 'description' => '365 días de racha', 'days_required' => 365, 'icon_html' => '🌟'],
        ]);
    }

    private function getMotivationalMessage($totalMedicamentosActivos, $adherenceRate)
    {
        if ($totalMedicamentosActivos === 0) {
            return (object) [
                'title' => 'Comencemos juntos',
                'description' => 'Añade tus medicamentos para que tu compañero pueda acompañarte y reflejar tu continuidad con apoyo y constancia.'
            ];
        }

        if ($adherenceRate >= 80) {
            return (object) [
                'title' => '¡Vamos por un gran día!',
                'description' => 'Tu compañero se siente con mucha energía gracias a tu constancia. Sigue así, cada día cuenta.'
            ];
        }

        if ($adherenceRate >= 40) {
            return (object) [
                'title' => 'Vas paso a paso',
                'description' => 'Tu compañero sigue contigo. Cada toma suma y hoy también cuenta como una nueva oportunidad.'
            ];
        }

        return (object) [
            'title' => 'Hoy también es un buen día para retomar',
            'description' => 'Tu compañero necesita un poco más de cuidado, pero sigue a tu lado. Puedes volver a empezar con calma.'
        ];
    }

    private function getDailyAffirmation()
    {
        return 'Cada paso que das hacia tu bienestar es un acto de amor propio. Hoy es un buen día para cuidarte.';
    }

}
