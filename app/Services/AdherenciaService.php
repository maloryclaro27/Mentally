<?php

namespace App\Services;

use App\Models\Medicamento;
use App\Models\TomaMedicamento;

class AdherenciaService
{
    public function getActiveMedicationIdsByDate($userId, $fecha)
    {
        return Medicamento::where('user_id', $userId)
            ->whereDate('fecha_inicio', '<=', $fecha)
            ->where(function ($query) use ($fecha) {
                $query->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', $fecha);
            })
            ->pluck('id');
    }

    public function getCompanionEnergy($totalMedicamentosActivos, $adherenceRate)
    {
        return $totalMedicamentosActivos > 0 ? $adherenceRate : 100;
    }

    public function getCompanionEnergyLevel($totalMedicamentosActivos, $companionEnergy)
    {
        if ($totalMedicamentosActivos === 0) {
            return 'high';
        }

        if ($companionEnergy >= 80) {
            return 'high';
        }

        if ($companionEnergy >= 40) {
            return 'medium';
        }

        return 'low';
    }

    public function getEvolutionStage($streakDays)
    {
        if ($streakDays >= 30) {
            return 3;
        }

        if ($streakDays >= 7) {
            return 2;
        }

        return 1;
    }

    public function getNextAchievement($allAchievements, $streakDays)
    {
        $nextAchievement = $allAchievements->first(function ($achievement) use ($streakDays) {
            return $achievement->days_required > $streakDays;
        });

        if ($nextAchievement) {
            $nextAchievement->days_remaining = max($nextAchievement->days_required - $streakDays, 0);
        }

        return $nextAchievement;
    }

    public function getProgressToNextAchievement($nextAchievement, $streakDays)
    {
        if ($nextAchievement) {
            return min(($streakDays / $nextAchievement->days_required) * 100, 100);
        }

        return 100;
    }

    public function markUnlockedAchievements($allAchievements, $streakDays)
    {
        $userAchievements = $allAchievements
            ->filter(function ($achievement) use ($streakDays) {
                return $streakDays >= $achievement->days_required;
            })
            ->pluck('id');

        foreach ($allAchievements as $achievement) {
            $achievement->unlocked = $userAchievements->contains($achievement->id);
        }

        return $allAchievements;
    }

    public function getPetColors($evolutionStage)
    {
        return (object) [
            'primary' => $evolutionStage == 1 ? '#4db8a8' : ($evolutionStage == 2 ? '#9370DB' : '#FF6B6B'),
            'secondary' => $evolutionStage == 1 ? '#5bc4b3' : ($evolutionStage == 2 ? '#BA55D3' : '#FF8E8E'),
        ];
    }

    public function getMotivationalMessage($totalMedicamentosActivos, $adherenceRate)
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

    public function getDailyAffirmation()
    {
        return 'Cada paso que das hacia tu bienestar es un acto de amor propio. Hoy es un buen día para cuidarte.';
    }

    public function calculateAdherenceRateLast7Days($userId, $fechaBase)
    {
        $carbonFechaBase = \Carbon\Carbon::parse($fechaBase)->startOfDay();

        $fechasUltimos7Dias = collect(range(0, 6))
            ->map(fn($i) => $carbonFechaBase->copy()->subDays($i)->toDateString());

        $tomasPorFecha = TomaMedicamento::where('user_id', $userId)
            ->whereDate('fecha_toma', '>=', $carbonFechaBase->copy()->subDays(6)->toDateString())
            ->get()
            ->groupBy(function ($toma) {
                return \Carbon\Carbon::parse($toma->fecha_toma)->toDateString();
            });

        $totalTomasEsperadasUltimos7Dias = 0;
        $totalTomasRegistradasUltimos7Dias = 0;

        foreach ($fechasUltimos7Dias as $fecha) {
            $medicamentosActivosEseDia = $this->getActiveMedicationIdsByDate($userId, $fecha);

            $esperadasEseDia = $medicamentosActivosEseDia->count();

            $registradasEseDia = collect($tomasPorFecha->get($fecha, []))
                ->whereIn('medicamento_id', $medicamentosActivosEseDia)
                ->unique('medicamento_id')
                ->count();

            $totalTomasEsperadasUltimos7Dias += $esperadasEseDia;
            $totalTomasRegistradasUltimos7Dias += min($registradasEseDia, $esperadasEseDia);
        }

        if ($totalTomasEsperadasUltimos7Dias > 0) {
            return round(($totalTomasRegistradasUltimos7Dias / $totalTomasEsperadasUltimos7Dias) * 100);
        }

        return 0;
    }

    public function calculateStreakDays($userId, $fechaBase)
    {
        $carbonFechaBase = \Carbon\Carbon::parse($fechaBase)->startOfDay();
        $streakDays = 0;

        for ($i = 0; $i < 365; $i++) {
            $fecha = $carbonFechaBase->copy()->subDays($i)->toDateString();

            $medicamentosActivosEseDia = $this->getActiveMedicationIdsByDate($userId, $fecha);
            $esperadasEseDia = $medicamentosActivosEseDia->count();

            if ($esperadasEseDia === 0) {
                if ($i === 0) {
                    $streakDays = 0;
                }
                break;
            }

            $registradasEseDia = TomaMedicamento::where('user_id', $userId)
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

        return $streakDays;
    }
}
