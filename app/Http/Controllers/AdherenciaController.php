<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdherenciaController extends Controller
{
    /**
     * Muestra la vista de adherencia con datos de ejemplo
     */
    public function index()
    {
        // Datos simulados para desarrollo
        $user = Auth::user();
        
        // Datos de la mascota
        $evolutionStage = 2; // 1, 2, o 3
        $companionEnergyLevel = 'high'; // high, medium, low
        $companionEnergy = 85;
        $streakDays = 7;
        $adherenceRate = 92;
        
        // Colores según evolución
        $petColors = (object) [
            'primary' => $evolutionStage == 1 ? '#4db8a8' : ($evolutionStage == 2 ? '#9370DB' : '#FF6B6B'),
            'secondary' => $evolutionStage == 1 ? '#5bc4b3' : ($evolutionStage == 2 ? '#BA55D3' : '#FF8E8E')
        ];
        
        // Mensaje motivacional
        $motivationalMessage = (object) [
            'title' => '¡Vamos por un gran día!',
            'description' => 'Tu compañero se siente lleno de energía gracias a tu compromiso. Sigue así, cada día cuenta.'
        ];
        
        // Progreso
        $progressToNextAchievement = 70;
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
        $userAchievements = collect([1]); // Tiene el primer logro
        
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
        $nextAchievement = (object) [
            'name' => 'Explorador',
            'description' => '15 días de compromiso constante',
            'days_required' => 15,
            'icon_html' => '🔍',
            'days_remaining' => 15 - $streakDays
        ];
        
        return view('adherencia', compact(
            'user',
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
}