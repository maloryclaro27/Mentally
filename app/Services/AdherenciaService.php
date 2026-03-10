<?php

namespace App\Services;

use App\Models\Medicamento;

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
}
