<?php

namespace App\Http\Controllers;

use App\Models\TestAttempt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChequeosController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Último intento por tipo (para las tarjetas)
        $lastAttempts = [
            'wellbeing'  => TestAttempt::where('user_id', $userId)->where('test_type', 'wellbeing')->orderByDesc('taken_at')->first(),
            'depression' => TestAttempt::where('user_id', $userId)->where('test_type', 'depression')->orderByDesc('taken_at')->first(),
            'anxiety'    => TestAttempt::where('user_id', $userId)->where('test_type', 'anxiety')->orderByDesc('taken_at')->first(),
        ];

        // ===== Config de máximos (para normalizar a 0-100) =====
        $maxByType = [
            'wellbeing'  => 25,
            'depression' => 27,
            'anxiety'    => 21,
        ];

        // ===== 6 meses -> buckets cada 14 días (2 por mes aprox) =====
        $now = Carbon::now();
        $start = $now->copy()->subMonths(6)->startOfMonth(); // ventana
        $end   = $now->copy()->endOfDay();

        // Crea una lista de buckets: (mes, H1/H2)
        // H1: días 1-14, H2: días 15-fin de mes
        $buckets = collect();
        $cursor = $start->copy()->startOfMonth();

        while ($cursor->lte($now)) {
            $m = $cursor->copy();

            $buckets->push([
                'key'   => $m->format('Y-m') . '-H1',
                'label' => $m->translatedFormat('M Y') . ' - 1/2',
                'start' => $m->copy()->day(1)->startOfDay(),
                'end'   => $m->copy()->day(14)->endOfDay(),
            ]);

            $buckets->push([
                'key'   => $m->format('Y-m') . '-H2',
                'label' => $m->translatedFormat('M Y') . ' - 2/2',
                'start' => $m->copy()->day(15)->startOfDay(),
                'end'   => $m->copy()->endOfMonth()->endOfDay(),
            ]);

            $cursor->addMonth();
        }

        // ===== Trae intentos dentro de la ventana (por usuario) =====
        $attempts = TestAttempt::where('user_id', $userId)
            ->whereIn('test_type', ['wellbeing', 'depression', 'anxiety'])
            ->whereBetween('taken_at', [$start, $end])
            ->orderBy('taken_at')
            ->get(['id', 'test_type', 'score', 'taken_at']);

        // ===== Construye serie por tipo (0-100) usando "último intento dentro del bucket" =====
        $series = [
            'wellbeing'  => array_fill(0, $buckets->count(), null),
            'depression' => array_fill(0, $buckets->count(), null),
            'anxiety'    => array_fill(0, $buckets->count(), null),
        ];

        foreach (['wellbeing', 'depression', 'anxiety'] as $type) {
            $max = $maxByType[$type];
            $typeAttempts = $attempts->where('test_type', $type);

            foreach ($buckets as $i => $b) {
                $lastInBucket = $typeAttempts
                    ->filter(function ($a) use ($b) {
                        $t = Carbon::parse($a->taken_at);
                        return $t->betweenIncluded($b['start'], $b['end']);
                    })
                    ->sortByDesc('taken_at')
                    ->first();

                if ($lastInBucket && $lastInBucket->score !== null) {
                    $raw = (int) $lastInBucket->score;
                    $percent = (int) round(($raw / $max) * 100);

                    if (in_array($type, ['depression', 'anxiety'])) {
                        $percent = 100 - $percent;
                    }

                    $series[$type][$i] = $percent;
                }
            }
        }

        $charts = [
            'labels'     => $buckets->pluck('label')->values()->all(),
            'wellbeing'  => $series['wellbeing'],
            'depression' => $series['depression'],
            'anxiety'    => $series['anxiety'],
        ];

        // ===== Delta (últimos 2 intentos por tipo) EN SCORE BRUTO =====
        $delta = [];
        foreach (['wellbeing', 'depression', 'anxiety'] as $type) {
            $lastTwo = TestAttempt::where('user_id', $userId)
                ->where('test_type', $type)
                ->orderByDesc('taken_at')
                ->take(2)
                ->get(['score']);

            if ($lastTwo->count() === 2 && $lastTwo[0]->score !== null && $lastTwo[1]->score !== null) {
                // último - anterior (bruto)
                $delta[$type] = (int)$lastTwo[0]->score - (int)$lastTwo[1]->score;
            } else {
                $delta[$type] = null;
            }
        }

        return view('chequeos', [
            'lastAttempts' => $lastAttempts,
            'charts'       => $charts,
            'delta'        => $delta,
        ]);
    }
}
