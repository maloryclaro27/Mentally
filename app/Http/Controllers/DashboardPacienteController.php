<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\TomaMedicamento;
use Illuminate\Support\Facades\Auth;
use App\Services\AdherenciaService;

class DashboardPacienteController extends Controller
{
    protected $adherenciaService;

    public function __construct(AdherenciaService $adherenciaService)
    {
        $this->adherenciaService = $adherenciaService;
    }

    public function index()
    {
        $usuario = Auth::user();

        $petData = $this->getPetData($usuario);

        return view('dashboard_paciente', array_merge($petData, [
            'usuario' => $usuario,
        ]));
    }

    private function getPetData($usuario)
    {
        $hoy = now()->toDateString();

        $medicamentosActivosEnFecha = fn($fecha) => $this->adherenciaService->getActiveMedicationIdsByDate($usuario->id, $fecha);

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

        $adherenceRate = $this->adherenciaService->calculateAdherenceRateLast7Days($usuario->id, $hoy);
        $companionEnergy = $this->adherenciaService->getCompanionEnergy($totalMedicamentosActivos, $adherenceRate);
        $companionEnergyLevel = $this->adherenciaService->getCompanionEnergyLevel($totalMedicamentosActivos, $companionEnergy);
        $streakDays = $this->adherenciaService->calculateStreakDays($usuario->id, $hoy);

        $motivationalMessage = $this->adherenciaService->getMotivationalMessage($totalMedicamentosActivos, $adherenceRate);
        $dailyAffirmation = $this->adherenciaService->getDailyAffirmation();

        $allAchievements = $this->getAchievements();
        $allAchievements = $this->adherenciaService->markUnlockedAchievements($allAchievements, $streakDays);

        $nextAchievement = $this->adherenciaService->getNextAchievement($allAchievements, $streakDays);
        $evolutionStage = $this->adherenciaService->getEvolutionStage($streakDays);
        $petColors = $this->adherenciaService->getPetColors($evolutionStage);
        $progressToNextAchievement = $this->adherenciaService->getProgressToNextAchievement($nextAchievement, $streakDays);

        return compact(
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
        );
    }

    private function getAchievements()
    {
        return collect([
            (object) [
                'id' => 1,
                'name' => 'Principiante',
                'description' => '7 días de racha',
                'days_required' => 7,
                'icon_html' => '🌱',
            ],
            (object) [
                'id' => 2,
                'name' => 'Explorador',
                'description' => '15 días de racha',
                'days_required' => 15,
                'icon_html' => '🔍',
            ],
            (object) [
                'id' => 3,
                'name' => 'Comprometido',
                'description' => '30 días de racha',
                'days_required' => 30,
                'icon_html' => '🤝',
            ],
            (object) [
                'id' => 4,
                'name' => 'Dedicado',
                'description' => '60 días de racha',
                'days_required' => 60,
                'icon_html' => '⭐',
            ],
            (object) [
                'id' => 5,
                'name' => 'Experto',
                'description' => '90 días de racha',
                'days_required' => 90,
                'icon_html' => '🏆',
            ],
            (object) [
                'id' => 6,
                'name' => 'Maestro',
                'description' => '180 días de racha',
                'days_required' => 180,
                'icon_html' => '👑',
            ],
            (object) [
                'id' => 7,
                'name' => 'Leyenda',
                'description' => '365 días de racha',
                'days_required' => 365,
                'icon_html' => '🌟',
            ],
        ]);
    }
}