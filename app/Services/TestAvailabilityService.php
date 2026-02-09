<?php

namespace App\Services;

use App\Models\User;

class TestAvailabilityService
{
    private int $cooldownDays = 14;

    private array $map = [
        'bienestar' => 'wellbeing',
        'depresion' => 'depression',
        'ansiedad'  => 'anxiety',
    ];

    public function forUser(?User $user): array
    {
        // fallback seguro
        $fallback = [
            'bienestar' => ['available' => true, 'next_date' => null, 'remaining_days' => 0],
            'depresion' => ['available' => true, 'next_date' => null, 'remaining_days' => 0],
            'ansiedad'  => ['available' => true, 'next_date' => null, 'remaining_days' => 0],
        ];

        if (!$user) {
            return $fallback;
        }

        $testAvailability = [];

        foreach ($this->map as $key => $type) {
            $lastAttempt = $user->testAttempts()
                ->where('test_type', $type)
                ->orderByDesc('taken_at')
                ->first();

            if (!$lastAttempt) {
                $testAvailability[$key] = $fallback[$key];
                continue;
            }

            $nextAllowed = $lastAttempt->taken_at->copy()->addDays($this->cooldownDays);
            $available = now()->greaterThanOrEqualTo($nextAllowed);
            $serviceRemaining = $available ? 0 : now()->diffInDays($nextAllowed);

            $testAvailability[$key] = [
                'available' => $available,
                'next_date' => $nextAllowed->format('d/m/Y'),
                'remaining_days' => $serviceRemaining,
            ];
        }

        return $testAvailability;
    }
}
