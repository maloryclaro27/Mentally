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
}
