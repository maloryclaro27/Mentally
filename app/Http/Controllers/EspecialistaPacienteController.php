<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Especialista;
use App\Models\DiaryEntry;
use App\Models\ChatMessage;
use App\Models\TestAttempt;
use App\Models\Medicamento;
use App\Models\TomaMedicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EspecialistaPacienteController extends Controller
{
    // ─── Vinculación manual ────────────────────────────────────────────────────
    public function vincular(Request $request)
    {
        $request->validate([
            'paciente_id' => ['required', 'exists:users,id'],
        ]);

        $especialista = Auth::user();
        $paciente = User::findOrFail($request->paciente_id);

        $especialista->pacientes()->syncWithoutDetaching([
            $paciente->id => [
                'estado'                    => 'aceptado',
                'consentimiento_aceptado'   => true,
                'consentimiento_aceptado_en' => now(),
                'codigo_vinculacion'        => null,
            ]
        ]);

        return back()->with('success', 'Paciente vinculado correctamente.');
    }

    // ─── Directorio de pacientes ───────────────────────────────────────────────
    public function index()
    {
        $user = auth()->user();

        $especialista = Especialista::where('user_id', $user->id)->firstOrFail();

        $pacientes = $user->pacientes()
            ->wherePivot('estado', 'aceptado')
            ->select('users.id', 'users.name', 'users.email', 'users.avatar')
            ->get()
            ->map(function ($paciente) {
                // Último test
                $ultimoTest = TestAttempt::where('user_id', $paciente->id)
                    ->orderByDesc('taken_at')
                    ->first();

                $testAnteriorMismoTipo = null;

                if ($ultimoTest && isset($ultimoTest->test_type)) {
                    $testAnteriorMismoTipo = TestAttempt::where('user_id', $paciente->id)
                        ->where('test_type', $ultimoTest->test_type)
                        ->where('id', '!=', $ultimoTest->id)
                        ->orderByDesc('taken_at')
                        ->first();
                }

                // Crisis flag en diario
                $paciente->crisis_risk_level = 'none';
                $paciente->crisis_risk_level = 'none';
                $crisisRiskReasons = [];
                if (
                    $ultimoTest &&
                    $testAnteriorMismoTipo &&
                    isset($ultimoTest->score) &&
                    isset($testAnteriorMismoTipo->score) &&
                    $ultimoTest->score >= ($testAnteriorMismoTipo->score + 5)
                ) {
                    if ($paciente->crisis_risk_level === 'none') {
                        $paciente->crisis_risk_level = 'moderate';
                    }

                    $crisisRiskReasons[] = 'Empeoramiento clínico respecto al test anterior del mismo tipo';
                }
                if ($ultimoTest && isset($ultimoTest->score) && $ultimoTest->score >= 15) {
                    $paciente->crisis_risk_level = $paciente->crisis_risk_level === 'critical' ? 'critical' : 'high';
                    $crisisRiskReasons[] = 'Último test clínico con puntuación alta';
                } elseif ($ultimoTest && isset($ultimoTest->score) && $ultimoTest->score >= 10 && $paciente->crisis_risk_level === 'none') {
                    $paciente->crisis_risk_level = 'moderate';
                    $crisisRiskReasons[] = 'Último test clínico con puntuación intermedia';
                }
                $crisisFlag = DiaryEntry::where('user_id', $paciente->id)
                    ->where('crisis_flag', true)
                    ->where('created_at', '>=', now()->subDays(7))
                    ->exists();
                if ($crisisFlag) {
                    $paciente->crisis_risk_level = 'high';
                    $crisisRiskReasons[] = 'Señal de alto riesgo registrada en los últimos 7 días';
                }
                $recentCriticalEvents = DiaryEntry::where('user_id', $paciente->id)
                    ->where('crisis_flag', true)
                    ->where('created_at', '>=', now()->subDays(3))
                    ->count();
                if ($recentCriticalEvents >= 2) {
                    $paciente->crisis_risk_level = 'critical';
                    $crisisRiskReasons = [
                        'Múltiples señales de alto riesgo registradas en las últimas 72 horas'
                    ];
                }

                $negativeRecentEntries = DiaryEntry::where('user_id', $paciente->id)
                    ->where('analysis_opt_in', true)
                    ->where('created_at', '>=', now()->subDays(7))
                    ->whereIn('sentiment_label', ['negativo', 'muy_negativo', 'negativo_alto', 'depresivo'])
                    ->count();

                if ($paciente->crisis_risk_level === 'none' && $negativeRecentEntries >= 3) {
                    $paciente->crisis_risk_level = 'moderate';
                    $crisisRiskReasons[] = 'Tendencia emocional negativa sostenida en los últimos 7 días';
                }

                // Adherencia 30 días
                $medicamentos = Medicamento::where('user_id', $paciente->id)
                    ->where('fecha_inicio', '<=', now())
                    ->where(function ($q) {
                        $q->whereNull('fecha_fin')
                            ->orWhereDate('fecha_fin', '>=', now()->subDays(30));
                    })
                    ->get();

                $expectedDoses = 0;
                foreach ($medicamentos as $med) {
                    $desde = Carbon::parse($med->fecha_inicio)->startOfDay()->max(now()->subDays(30)->startOfDay());
                    $hasta = ($med->fecha_fin ? Carbon::parse($med->fecha_fin)->endOfDay() : now()->endOfDay())->min(now()->endOfDay());
                    if ($desde->lte($hasta)) {
                        $expectedDoses += $desde->diffInDays($hasta) + 1;
                    }
                }
                $registeredDoses = TomaMedicamento::where('user_id', $paciente->id)
                    ->whereBetween('fecha_toma', [now()->subDays(30), now()])
                    ->count();
                $adherencia = $expectedDoses > 0
                    ? (int) round(($registeredDoses / $expectedDoses) * 100)
                    : null;

                if ($paciente->crisis_risk_level === 'none' && $adherencia !== null && $adherencia < 70) {
                    $paciente->crisis_risk_level = 'moderate';
                    $crisisRiskReasons[] = 'Adherencia farmacológica baja en los últimos 30 días';
                } elseif ($paciente->crisis_risk_level === 'moderate' && $adherencia !== null && $adherencia < 70) {
                    $crisisRiskReasons[] = 'Adherencia farmacológica baja en los últimos 30 días';
                }
                if (
                    $ultimoTest &&
                    isset($ultimoTest->score) &&
                    $ultimoTest->score >= 10 &&
                    $adherencia !== null &&
                    $adherencia < 70 &&
                    $paciente->crisis_risk_level !== 'critical'
                ) {
                    $paciente->crisis_risk_level = 'high';

                    if (!in_array('Combinación de síntomas clínicos y baja adherencia farmacológica', $crisisRiskReasons)) {
                        $crisisRiskReasons[] = 'Combinación de síntomas clínicos y baja adherencia farmacológica';
                    }
                }

                $paciente->crisis_risk_reasons = array_values(array_unique($crisisRiskReasons));
                $paciente->ultimo_test    = $ultimoTest;
                $paciente->crisis_flag    = $crisisFlag;
                $paciente->adherencia     = $adherencia;
                $paciente->total_meds     = $medicamentos->count();

                return $paciente;
            });

        return view('especialista.pacientes.index', compact('pacientes', 'especialista'));
    }

    // ─── Hub del paciente (expediente) ────────────────────────────────────────
    public function show(User $paciente)
    {
        $user = auth()->user();

        // Verificar que este paciente está vinculado al especialista
        $vinculado = $user->pacientes()
            ->wherePivot('estado', 'aceptado')
            ->where('users.id', $paciente->id)
            ->exists();

        if (!$vinculado) {
            abort(403, 'No tienes acceso a este paciente.');
        }

        $especialista = Especialista::where('user_id', $user->id)->firstOrFail();

        // ── Chequeos ───────────────────────────────────────────────────────────
        $tests = TestAttempt::where('user_id', $paciente->id)
            ->orderByDesc('taken_at')
            ->get();

        $testsGrouped = $tests->groupBy('test_type');
        $chequeos = [
            'depression' => $testsGrouped->get('depression', collect()),
            'anxiety'    => $testsGrouped->get('anxiety', collect()),
            'wellbeing'  => $testsGrouped->get('wellbeing', collect()),
        ];

        // ── Adherencia ────────────────────────────────────────────────────────
        $hoy           = now();
        $inicioVentana = now()->subDays(30);

        $medicamentos = Medicamento::where('user_id', $paciente->id)
            ->where('fecha_inicio', '<=', $hoy)
            ->where(function ($q) use ($inicioVentana) {
                $q->whereNull('fecha_fin')
                    ->orWhereDate('fecha_fin', '>=', $inicioVentana);
            })
            ->get();

        $expectedTotal = 0;
        foreach ($medicamentos as $med) {
            $desde = Carbon::parse($med->fecha_inicio)->startOfDay()->max($inicioVentana->startOfDay());
            $hasta = ($med->fecha_fin ? Carbon::parse($med->fecha_fin)->endOfDay() : $hoy->copy()->endOfDay())->min($hoy->copy()->endOfDay());
            if ($desde->lte($hasta)) {
                $expectedTotal += $desde->diffInDays($hasta) + 1;
            }
        }

        $registeredTotal = TomaMedicamento::where('user_id', $paciente->id)
            ->whereBetween('fecha_toma', [$inicioVentana, $hoy])
            ->count();

        $adherenciaGlobal = $expectedTotal > 0
            ? (int) round(($registeredTotal / $expectedTotal) * 100)
            : 0;

        // Tendencia 14 días
        $trendLabels = [];
        $trendData   = [];
        for ($i = 13; $i >= 0; $i--) {
            $dia = now()->subDays($i)->startOfDay();
            $trendLabels[] = $dia->format('d/m');
            $expDia = 0;
            foreach ($medicamentos as $med) {
                $ini = Carbon::parse($med->fecha_inicio)->startOfDay();
                $fin = $med->fecha_fin ? Carbon::parse($med->fecha_fin)->endOfDay() : now()->endOfDay();
                if ($dia->between($ini, $fin)) $expDia++;
            }
            $regDia = TomaMedicamento::where('user_id', $paciente->id)
                ->whereDate('fecha_toma', $dia->format('Y-m-d'))
                ->count();
            $trendData[] = $expDia > 0 ? (int) round(($regDia / $expDia) * 100) : 0;
        }

        // Desglose por medicamento
        $medicamentosAdherencia = $medicamentos->map(function ($med) use ($inicioVentana, $hoy) {
            $desde = Carbon::parse($med->fecha_inicio)->startOfDay()->max($inicioVentana->startOfDay());
            $hasta = ($med->fecha_fin ? Carbon::parse($med->fecha_fin)->endOfDay() : $hoy->copy()->endOfDay())->min($hoy->copy()->endOfDay());
            $expected = $desde->lte($hasta) ? ($desde->diffInDays($hasta) + 1) : 0;
            $registered = TomaMedicamento::where('medicamento_id', $med->id)
                ->whereBetween('fecha_toma', [$inicioVentana, $hoy])
                ->count();
            $med->adherencia_pct = $expected > 0 ? (int) round(($registered / $expected) * 100) : 0;
            $med->dosis_registradas = $registered;
            $med->dosis_esperadas   = $expected;
            return $med;
        });

        // ── Diario Emocional (Análisis IA) ────────────────────────────────────
        $entradas = DiaryEntry::where('user_id', $paciente->id)
            ->where('analysis_opt_in', true)
            ->whereNotNull('sentiment_label')
            ->orderBy('created_at')
            ->get(['sentiment_label', 'sentiment_score', 'sentiment_meta', 'crisis_flag', 'mood', 'word_count', 'created_at']);

        // Tendencia de sentimiento (últimos 30 días, score promedio diario)
        $diaryLabels = [];
        $diaryScores = [];
        for ($i = 29; $i >= 0; $i--) {
            $dia = now()->subDays($i)->startOfDay();
            $diaryLabels[] = $dia->format('d/m');
            $avg = $entradas->filter(fn($e) => Carbon::parse($e->created_at)->isSameDay($dia))
                ->avg('sentiment_score');
            $diaryScores[] = $avg !== null ? round($avg, 2) : null;
        }

        // Distribución de sentimientos
        $sentimentDist = $entradas->groupBy('sentiment_label')
            ->map->count()
            ->sortByDesc(fn($v) => $v);

        // Crisis flags recientes
        $crisisFlags = DiaryEntry::where('user_id', $paciente->id)
            ->where('crisis_flag', true)
            ->orderByDesc('created_at')
            ->take(5)
            ->get(['created_at', 'mood']);

        // Racha de registros (frecuencia)
        $totalEntradas = $entradas->count();
        $primeraEntrada = $entradas->first();
        $frecuenciaMedia = $primeraEntrada
            ? round($totalEntradas / max(1, Carbon::parse($primeraEntrada->created_at)->diffInWeeks(now()) + 1), 1)
            : 0;

        // Extracción de temas clave desde sentiment_meta
        $temasRaw = $entradas->flatMap(function ($e) {
            $meta = $e->sentiment_meta;
            if (!$meta) return [];
            if (isset($meta['topics']) && is_array($meta['topics'])) return $meta['topics'];
            if (isset($meta['keywords']) && is_array($meta['keywords'])) return $meta['keywords'];
            return [];
        });
        $temasClave = $temasRaw->countBy()->sortByDesc(fn($v) => $v)->take(8);

        // Score de riesgo diario (basado en crisis y sentimiento negativo)
        $nivelRiesgo = 'bajo';
        $scoreRiesgo = 0;
        if ($crisisFlags->count() > 0) {
            $scoreRiesgo += 40;
        }
        $negativosRecientes = DiaryEntry::where('user_id', $paciente->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->whereIn('sentiment_label', ['negativo', 'muy_negativo', 'negativo_alto', 'depresivo'])
            ->count();
        $scoreRiesgo += min($negativosRecientes * 10, 40);
        $sinRegistros7dias = DiaryEntry::where('user_id', $paciente->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->count() === 0;
        if ($sinRegistros7dias) $scoreRiesgo += 20;

        if ($scoreRiesgo >= 60) $nivelRiesgo = 'alto';
        elseif ($scoreRiesgo >= 30) $nivelRiesgo = 'moderado';

        $diario = compact(
            'diaryLabels',
            'diaryScores',
            'sentimentDist',
            'crisisFlags',
            'totalEntradas',
            'frecuenciaMedia',
            'temasClave',
            'nivelRiesgo',
            'scoreRiesgo'
        );

        // ── Chatbot (Análisis IA) ──────────────────────────────────────────────
        $mensajes = ChatMessage::where('user_id', $paciente->id)
            ->whereNotNull('emotion')
            ->orderBy('created_at')
            ->get(['sender', 'emotion', 'created_at']);

        // Emociones del paciente (solo mensajes del user, no del bot)
        $emocionesUser = $mensajes->where('sender', 'user');

        $emocionDist = $emocionesUser->groupBy('emotion')
            ->map->count()
            ->sortByDesc(fn($v) => $v)
            ->take(6);

        // Frecuencia de uso semanal
        $sesionesSemanales = [];
        $chatLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $semana = now()->subWeeks($i);
            $chatLabels[] = 'Sem ' . $semana->format('d/m');
            $sesionesSemanales[] = ChatMessage::where('user_id', $paciente->id)
                ->where('sender', 'user')
                ->whereBetween('created_at', [
                    $semana->startOfWeek(),
                    $semana->copy()->endOfWeek()
                ])
                ->count();
        }

        // Uso en horario crítico (21h-6h)
        $mensajesTotales = ChatMessage::where('user_id', $paciente->id)
            ->where('sender', 'user')
            ->count();
        $mensajesNocturnosCount = ChatMessage::where('user_id', $paciente->id)
            ->where('sender', 'user')
            ->whereRaw('HOUR(created_at) >= 21 OR HOUR(created_at) < 6')
            ->count();
        $pctNocturno = $mensajesTotales > 0
            ? (int) round(($mensajesNocturnosCount / $mensajesTotales) * 100)
            : 0;

        // Emoción más frecuente = indicador principal
        $emocionPrincipal = $emocionDist->keys()->first() ?? 'Sin datos';

        $chatbot = compact(
            'emocionDist',
            'chatLabels',
            'sesionesSemanales',
            'mensajesTotales',
            'pctNocturno',
            'emocionPrincipal'
        );

        return view('especialista.pacientes.show', compact(
            'paciente',
            'especialista',
            'chequeos',
            'adherenciaGlobal',
            'trendLabels',
            'trendData',
            'medicamentosAdherencia',
            'expectedTotal',
            'registeredTotal',
            'diario',
            'chatbot'
        ));
    }
}
