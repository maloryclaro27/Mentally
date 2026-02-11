<?php

namespace App\Http\Controllers;

use App\Models\DiaryEntry;
use Illuminate\Http\Request;

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

        $entry = DiaryEntry::create([
            'user_id' => $request->user()->id,
            'entry_text' => $validated['entry_text'],
            'mood' => $validated['mood'],
            'word_count' => $validated['word_count'],
            'analysis_opt_in' => $validated['analysis_opt_in'],
        ]);

        return response()->json([
            'ok' => true,
            'entry' => [
                'id' => $entry->id,
                'date' => $entry->created_at->toISOString(),
                'mood' => $entry->mood,
                'word_count' => $entry->word_count,
                'analysis_opt_in' => $entry->analysis_opt_in,
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
}
