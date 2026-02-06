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

        return redirect()
            ->route('dashboard.paciente')
            ->with('success', 'Test registrado correctamente.');
    }
}
