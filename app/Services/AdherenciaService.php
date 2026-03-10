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
}