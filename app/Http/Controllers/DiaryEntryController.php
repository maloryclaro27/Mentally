<?php

namespace App\Http\Controllers;

use App\Models\DiaryEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiaryEntryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'entry_text' => ['required', 'string', 'min:1'],
            'mood' => ['required', 'string', 'max:50'],
            'word_count' => ['required', 'integer', 'min:0'],
            'analysis_opt_in' => ['required', 'boolean'],
        ]);

        $text = mb_strtolower($validated['entry_text']);

        // Reglas simples (NO diagnóstico). Ajusta/expande luego.
        $crisisPatterns = [
            'suicid',          // suicidio, suicidarme
            'matarme',         // "quiero matarme"
            'me quiero morir',
            'quiero morir',
            'no quiero vivir',
            'autolesion',      // autolesión
            'cortarme',        // "me quiero cortar"
            'hacerme daño',
            'lastimarme',
        ];

        $crisis_flag = false;
        foreach ($crisisPatterns as $p) {
            if (str_contains($text, $p)) {
                $crisis_flag = true;
                break;
            }
        }

        // Estado de análisis: si opt-in → queued, si no → null
        $analysis_status = $validated['analysis_opt_in'] ? 'queued' : null;


        $entry = DiaryEntry::create([
            'user_id' => $request->user()->id,
            'entry_text' => $validated['entry_text'],
            'mood' => $validated['mood'],
            'word_count' => $validated['word_count'],
            'analysis_opt_in' => $validated['analysis_opt_in'],
            'analysis_status' => $analysis_status,
            'crisis_flag' => $crisis_flag,
        ]);

        // Si el usuario dio consentimiento, llamamos al servicio BETO (Docker) y guardamos resultados
        if ($entry->analysis_opt_in) {
            try {
                $base = rtrim(env('BETO_URL', 'http://beto:8000'), '/');
                $url = $base . '/predict';

                $res = Http::timeout(60)->post($url, [
                    'text' => $validated['entry_text'],
                ]);

                if ($res->successful()) {
                    $out = $res->json();

                    if (($out['ok'] ?? false) === true) {
                        $entry->analysis_status = 'done';
                        $entry->sentiment_label = $out['label'] ?? null;
                        $entry->sentiment_score = $out['score'] ?? null;
                        $entry->sentiment_meta  = $out['meta'] ?? null;
                        $entry->analyzed_at = now();
                        $entry->model_version = $out['meta']['model'] ?? 'beto';
                        $entry->save();
                    } else {
                        $entry->analysis_status = 'error';
                        $entry->sentiment_meta = [
                            'error' => 'Invalid response from BETO',
                            'body' => $out,
                        ];
                        $entry->save();
                    }
                } else {
                    $entry->analysis_status = 'error';
                    $entry->sentiment_meta = [
                        'error' => 'BETO HTTP error',
                        'status' => $res->status(),
                        'body' => $res->body(),
                    ];
                    $entry->save();
                }
            } catch (\Throwable $e) {
                $entry->analysis_status = 'error';
                $entry->sentiment_meta = [
                    'error' => 'Exception calling BETO',
                    'message' => $e->getMessage(),
                ];
                $entry->save();
            }
        }


        return response()->json([
            'ok' => true,
            'entry' => [
                'id' => $entry->id,
                'date' => $entry->created_at->toISOString(),
                'mood' => $entry->mood,
                'word_count' => $entry->word_count,
                'analysis_opt_in' => $entry->analysis_opt_in,
                'crisis_flag' => (bool) $entry->crisis_flag,
                'analysis_status' => $entry->analysis_status,
                'sentiment_label' => $entry->sentiment_label,
                'sentiment_score' => $entry->sentiment_score,
            ],
        ], 201);
    }

    public function recent(Request $request)
    {
        $limit = (int) $request->query('limit', 10);
        $limit = max(1, min($limit, 50)); // límite seguro

        $entries = DiaryEntry::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get(['id', 'created_at', 'mood', 'word_count', 'analysis_opt_in']);

        return response()->json([
            'ok' => true,
            'entries' => $entries->map(function ($e) {
                return [
                    'id' => $e->id,
                    'date' => $e->created_at->toISOString(),
                    'mood' => $e->mood,
                    'word_count' => $e->word_count,
                    'analysis_opt_in' => $e->analysis_opt_in,
                ];
            }),
        ]);
    }

    public function stats(Request $request)
    {
        $userId = $request->user()->id;

        $total = \App\Models\DiaryEntry::where('user_id', $userId)->count();
        $avgWords = (int) round(\App\Models\DiaryEntry::where('user_id', $userId)->avg('word_count') ?? 0);

        // Streak simple: si hay entrada hoy = 1, si no = 0 (igual que tu versión inicial)
        $latest = \App\Models\DiaryEntry::where('user_id', $userId)->latest()->first();
        $streak = 0;
        if ($latest) {
            $streak = $latest->created_at->isToday() ? 1 : 0;
        }

        return response()->json([
            'ok' => true,
            'stats' => [
                'entriesCount' => $total,
                'streakDays' => $streak,
                'avgWords' => $avgWords,
                // Por ahora dejamos positiveRate en 0 hasta que implementemos análisis real en backend
                'positiveRate' => 0,
            ],
        ]);
    }

    public function show(Request $request, int $id)
    {
        $entry = \App\Models\DiaryEntry::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json([
            'ok' => true,
            'entry' => [
                'id' => $entry->id,
                'date' => $entry->created_at->toISOString(),
                'mood' => $entry->mood,
                'word_count' => $entry->word_count,
                'analysis_opt_in' => $entry->analysis_opt_in,
                // Texto completo SOLO aquí (acción explícita del usuario)
                'entry_text' => $entry->entry_text,
            ],
        ]);
    }

    public function destroy(\Illuminate\Http\Request $request, int $id)
    {
        $entry = \App\Models\DiaryEntry::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $entry->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Entrada eliminada.'
        ]);
    }

    public function moodTrend()
    {
        $rows = \App\Models\DiaryEntry::query()
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->limit(14)
            ->get(['id', 'created_at', 'mood']);

        // Transformamos created_at → date
        $entries = $rows->map(function ($r) {
            return [
                'id'   => $r->id,
                'date' => $r->created_at->toISOString(),
                'mood' => $r->mood,
            ];
        });

        return response()->json([
            'ok' => true,
            'entries' => $entries,
        ]);
    }

    public function moodChart(Request $request)
    {
        $userId = auth()->id();

        // últimos 14 días (puedes ajustar)
        $since = now()->subDays(14);

        $rows = DiaryEntry::where('user_id', $userId)
            ->where('created_at', '>=', $since)
            ->select('mood')
            ->get();

        // conteo por mood
        $counts = $rows->groupBy('mood')->map->count();

        // orden consistente en la UI
        $moodOrder = ['muy-feliz', 'tranquilo', 'neutral', 'preocupado', 'triste'];

        $data = collect($moodOrder)->map(fn($m) => [
            'mood'  => $m,
            'count' => (int) ($counts[$m] ?? 0),
        ])->values();

        return response()->json([
            'ok' => true,
            'since' => $since->toISOString(),
            'total' => (int) $rows->count(),
            'data' => $data,
        ]);
    }
}
