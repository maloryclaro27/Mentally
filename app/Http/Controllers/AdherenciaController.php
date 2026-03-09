<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicamento;
use App\Models\TomaMedicamento;

class AdherenciaController extends Controller
{
    /**
     * Muestra la vista de adherencia con datos de ejemplo
     */
    public function index()
    {
        // Datos simulados para desarrollo
        $usuario = Auth::user();
        $evolutionStage = 1;

        $medicamentos = Medicamento::where('user_id', $usuario->id)
            ->where('activo', true)
            ->orderBy('hora_toma')
            ->get()
            ->map(function ($medicamento) use ($usuario) {
                $tomadaHoy = TomaMedicamento::where('medicamento_id', $medicamento->id)
                    ->where('user_id', $usuario->id)
                    ->whereDate('fecha_toma', now()->toDateString())
                    ->exists();

                return (object) [
                    'id' => $medicamento->id,
                    'nombre' => $medicamento->nombre,
                    'dosis' => $medicamento->dosis,
                    'hora_toma' => $medicamento->hora_toma,
                    'tomado_hoy' => $tomadaHoy,
                ];
            });

        $totalMedicamentosActivos = $medicamentos->count();
        $medicamentosTomadosHoy = $medicamentos->where('tomado_hoy', true)->count();
        $completoHoy = $totalMedicamentosActivos > 0 && $medicamentosTomadosHoy === $totalMedicamentosActivos;
        if ($totalMedicamentosActivos > 0) {
            $tomasUltimos7Dias = TomaMedicamento::where('user_id', $usuario->id)
                ->whereDate('fecha_toma', '>=', now()->copy()->subDays(6)->toDateString())
                ->count();

            $tomasEsperadasUltimos7Dias = $totalMedicamentosActivos * 7;

            $adherenceRate = round(($tomasUltimos7Dias / $tomasEsperadasUltimos7Dias) * 100);
        } else {
            $adherenceRate = 0;
        }
        $companionEnergy = $totalMedicamentosActivos > 0 ? $adherenceRate : 100;
        if ($totalMedicamentosActivos === 0) {
            $companionEnergyLevel = 'high';
        } elseif ($companionEnergy >= 80) {
            $companionEnergyLevel = 'high';
        } elseif ($companionEnergy >= 40) {
            $companionEnergyLevel = 'medium';
        } else {
            $companionEnergyLevel = 'low';
        }
        // Datos de la mascota
        $streakDays = 0;

        if ($totalMedicamentosActivos > 0) {
            for ($i = 0; $i < 365; $i++) {
                $fecha = now()->copy()->subDays($i)->toDateString();

                $tomasEseDia = TomaMedicamento::where('user_id', $usuario->id)
                    ->whereDate('fecha_toma', $fecha)
                    ->count();

                if ($tomasEseDia === $totalMedicamentosActivos) {
                    $streakDays++;
                } else {
                    break;
                }
            }
        }

        // Colores según evolución
        $petColors = (object) [
            'primary' => $evolutionStage == 1 ? '#4db8a8' : ($evolutionStage == 2 ? '#9370DB' : '#FF6B6B'),
            'secondary' => $evolutionStage == 1 ? '#5bc4b3' : ($evolutionStage == 2 ? '#BA55D3' : '#FF8E8E')
        ];

        // Mensaje motivacional
        if ($totalMedicamentosActivos === 0) {
            $motivationalMessage = (object) [
                'title' => 'Comencemos juntos',
                'description' => 'Añade tus medicamentos para que tu compañero pueda acompañarte y reflejar tu continuidad con apoyo y constancia.'
            ];
        } elseif ($adherenceRate >= 80) {
            $motivationalMessage = (object) [
                'title' => '¡Vamos por un gran día!',
                'description' => 'Tu compañero se siente con mucha energía gracias a tu constancia. Sigue así, cada día cuenta.'
            ];
        } elseif ($adherenceRate >= 40) {
            $motivationalMessage = (object) [
                'title' => 'Vas paso a paso',
                'description' => 'Tu compañero sigue contigo. Cada toma suma y hoy también cuenta como una nueva oportunidad.'
            ];
        } else {
            $motivationalMessage = (object) [
                'title' => 'Hoy también es un buen día para retomar',
                'description' => 'Tu compañero necesita un poco más de cuidado, pero sigue a tu lado. Puedes volver a empezar con calma.'
            ];
        }

        // Progreso
        $dailyAffirmation = 'Cada paso que das hacia tu bienestar es un acto de amor propio. Hoy es un buen día para cuidarte.';

        // Logros
        $allAchievements = collect([
            (object) ['id' => 1, 'name' => 'Principiante', 'description' => '7 días de racha', 'days_required' => 7, 'icon_html' => '🌱'],
            (object) ['id' => 2, 'name' => 'Explorador', 'description' => '15 días de racha', 'days_required' => 15, 'icon_html' => '🔍'],
            (object) ['id' => 3, 'name' => 'Comprometido', 'description' => '30 días de racha', 'days_required' => 30, 'icon_html' => '🤝'],
            (object) ['id' => 4, 'name' => 'Dedicado', 'description' => '60 días de racha', 'days_required' => 60, 'icon_html' => '⭐'],
            (object) ['id' => 5, 'name' => 'Experto', 'description' => '90 días de racha', 'days_required' => 90, 'icon_html' => '🏆'],
            (object) ['id' => 6, 'name' => 'Maestro', 'description' => '180 días de racha', 'days_required' => 180, 'icon_html' => '👑'],
            (object) ['id' => 7, 'name' => 'Leyenda', 'description' => '365 días de racha', 'days_required' => 365, 'icon_html' => '🌟'],
        ]);

        // Logros del usuario (simulados)
        $userAchievements = $allAchievements
            ->filter(function ($achievement) use ($streakDays) {
                return $streakDays >= $achievement->days_required;
            })
            ->pluck('id');

        // Añadir propiedad 'unlocked' a cada logro
        foreach ($allAchievements as $achievement) {
            $achievement->unlocked = $userAchievements->contains($achievement->id);
        }

        // Medicamentos de ejemplo
        $activeMedications = collect([
            (object) [
                'id' => 1,
                'name' => 'Sertralina',
                'dosage' => '50mg',
                'dose_time' => '08:00',
                'logs' => collect([])
            ],
            (object) [
                'id' => 2,
                'name' => 'Escitalopram',
                'dosage' => '10mg',
                'dose_time' => '20:00',
                'logs' => collect([])
            ],
            (object) [
                'id' => 3,
                'name' => 'Bupropion',
                'dosage' => '150mg',
                'dose_time' => '14:00',
                'logs' => collect([])
            ]
        ]);

        // Próximo logro
        $nextAchievement = $allAchievements->first(function ($achievement) use ($streakDays) {
            return $achievement->days_required > $streakDays;
        });

        if ($nextAchievement) {
            $nextAchievement->days_remaining = max($nextAchievement->days_required - $streakDays, 0);
        }
        if ($streakDays >= 30) {
            $evolutionStage = 3;
        } elseif ($streakDays >= 7) {
            $evolutionStage = 2;
        } else {
            $evolutionStage = 1;
        }

        if ($nextAchievement) {
            $progressToNextAchievement = min(($streakDays / $nextAchievement->days_required) * 100, 100);
        } else {
            $progressToNextAchievement = 100;
        }

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
            'activeMedications',
            'nextAchievement'
        ));
    }

    public function guardarMedicamento(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'hora_toma' => 'required|date_format:H:i',
        ]);

        $medicamento = Medicamento::where('user_id', Auth::id())
            ->where('nombre', $request->nombre)
            ->where('dosis', $request->dosis)
            ->where('hora_toma', $request->hora_toma)
            ->first();

        if ($medicamento && $medicamento->activo) {
            return redirect('/adherencia')
                ->withErrors(['nombre' => 'Ese medicamento ya está registrado como activo.'])
                ->withInput();
        }

        if ($medicamento) {
            $medicamento->update([
                'activo' => true,
            ]);
        } else {
            Medicamento::create([
                'user_id' => Auth::id(),
                'nombre' => $request->nombre,
                'dosis' => $request->dosis,
                'hora_toma' => $request->hora_toma,
                'activo' => true,
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

        $medicamento = Medicamento::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('activo', true)
            ->firstOrFail();

        $duplicado = Medicamento::where('user_id', Auth::id())
            ->where('activo', true)
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
        $medicamento = Medicamento::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $medicamento->update([
            'activo' => false,
        ]);

        return redirect('/adherencia')->with('success', 'Medicamento eliminado correctamente.');
    }

    public function marcarToma($id)
    {
        $medicamento = Medicamento::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('activo', true)
            ->firstOrFail();

        TomaMedicamento::firstOrCreate(
            [
                'medicamento_id' => $medicamento->id,
                'fecha_toma' => now()->toDateString(),
            ],
            [
                'user_id' => Auth::id(),
                'tomado_en' => now(),
                'estado' => 'tomado',
            ]
        );

        return redirect('/adherencia')->with('success', 'Toma registrada correctamente.');
    }
}
