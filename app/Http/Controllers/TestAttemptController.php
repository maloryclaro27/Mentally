<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestAttempt;

class TestAttemptController extends Controller
{
    public function store(Request $request, string $testType)
    {
        $user = $request->user();
        $testType = $request->route('testType'); // viene del defaults()

        TestAttempt::create([
            'user_id'  => $user->id,
            'test_type' => $testType,
            'score'    => $request->input('score'),
            'result'   => $request->input('result'),
            'answers'  => is_string($request->input('answers'))
                ? json_decode($request->input('answers'), true)
                : $request->input('answers'),
            'taken_at' => now(),
        ]);

        // decidir siguiente paso según tipo de test
        $nextRoute = match ($testType) {
            'wellbeing' => 'test.depresion',
            'depression' => 'test.ansiedad',
            'anxiety' => 'dashboard.paciente',
            default => 'dashboard.paciente',
        };

        return redirect()
            ->route($nextRoute)
            ->with('success', 'Test registrado correctamente.');
    }
}
