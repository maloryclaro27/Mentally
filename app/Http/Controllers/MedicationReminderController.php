<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Models\TomaMedicamento;

class MedicationReminderController extends Controller
{
    public function confirm(Request $request, $schedule, $user)
    {
        $hoy = now()->toDateString();

        $medicamento = Medicamento::where('id', $schedule)
            ->where('user_id', $user)
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->where(function ($query) use ($hoy) {
                $query->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', $hoy);
            })
            ->firstOrFail();

        TomaMedicamento::firstOrCreate(
            [
                'medicamento_id' => $medicamento->id,
                'fecha_toma' => $hoy,
            ],
            [
                'user_id' => $medicamento->user_id,
                'tomado_en' => now(),
                'estado' => 'tomado',
            ]
        );

        return view('reminder-confirmed', [
            'scheduleId' => $medicamento->id,
        ]);
    }
}
