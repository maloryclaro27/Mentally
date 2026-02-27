<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestAttempt;
use Carbon\Carbon;

class TestAttemptController extends Controller
{
    public function store(Request $request)
    {
        $testType = $request->route('testType'); // viene de ->defaults('testType', ...)

        $validated = $request->validate([
            'score' => ['nullable', 'integer', 'min:0'],
            'result' => ['nullable', 'string', 'max:255'],
            'answers' => ['nullable'], // llega como string JSON desde el input hidden
        ]);

        $answers = null;
        if (!empty($validated['answers'])) {
            // si viene como string JSON, lo convertimos a array
            $decoded = json_decode($validated['answers'], true);
            $answers = json_last_error() === JSON_ERROR_NONE ? $decoded : $validated['answers'];
        }

        $attempt = TestAttempt::create([
            'user_id'   => auth()->id(),
            'test_type' => $testType,
            'score'     => $validated['score'] ?? null,
            'result'    => $validated['result'] ?? null,
            'answers'   => $answers,
            'taken_at'  => now(),
        ]);

        // ✅ Nuevo flujo: ir al detalle revisitable
        return redirect()->route('tests.resultados.show', $attempt);
    }

    public function show(TestAttempt $attempt)
    {
        if ((int) auth()->id() !== (int) $attempt->user_id) {
            abort(403);
        }

        $viewData = [
            'attempt' => $attempt,
            'ui' => null, // info extra para pintar bonito según test_type
        ];

        if ($attempt->test_type === 'wellbeing') {
            $score = (int) ($attempt->score ?? 0);
            $ui = $this->wellbeingUi($score, $attempt->taken_at);

            $viewData['ui'] = $ui;
        } elseif ($attempt->test_type === 'depression') {
            $score = (int) ($attempt->score ?? 0);
            $ui = $this->depressionUi($score, $attempt->answers ?? []);
            $viewData['ui'] = $ui;
        } elseif ($attempt->test_type === 'anxiety') {
            $score = (int) ($attempt->score ?? 0);
            $ui = $this->anxietyUi($score, $attempt->answers ?? []);
            $viewData['ui'] = $ui;
        }

        // ====== Serie para gráfica cada 14 días (Q1/Q2 por mes) ======
        $attemptsSameTest = TestAttempt::where('user_id', auth()->id())
            ->where('test_type', $attempt->test_type)
            ->whereNotNull('taken_at')
            ->orderBy('taken_at')
            ->get(['taken_at', 'score']);

        $grouped = $attemptsSameTest->groupBy(function ($a) {
            $d = Carbon::parse($a->taken_at);
            $half = ($d->day <= 14) ? 'Q1' : 'Q2';
            return $d->format('Y-m') . '-' . $half; // ej: 2026-02-Q1
        });

        $points = $grouped->map(function ($group) {
            $last = $group->sortBy('taken_at')->last();
            $d = Carbon::parse($last->taken_at);

            $halfLabel = ($d->day <= 14) ? '1' : '2';
            return [
                'label' => $d->translatedFormat('M Y') . ' - ' . $halfLabel, // "feb 2026 - 1"
                'score' => (int) ($last->score ?? 0),
            ];
        })->values();

        $viewData['chart'] = [
            'labels' => $points->pluck('label')->all(),
            'data'   => $points->pluck('score')->all(),
        ];


        return view('tests.resultados', $viewData);
    }

    /**
     * Replica la lógica visual/interpretación del JS de bienestar.
     */
    private function wellbeingUi(int $score, $takenAt): array
    {
        // Score OMS-5: 0..25 → porcentaje 0..100
        $percentage = (int) round(($score / 25) * 100);

        // Interpretaciones (igual a tu JS)
        if ($score <= 13) {
            $level = "Bienestar general bajo";
            $description = "Tu puntuación indica un nivel bajo de bienestar general. Es posible que últimamente hayas estado lidiando con emociones negativas, sintiendo una falta de satisfacción en varios aspectos.";
            $recommendations = [
                "Programa una consulta con un profesional de salud mental",
                "Practica 10 minutos de meditación diaria",
                "Mantén un diario emocional para registrar tus sentimientos",
                "Establece una rutina de sueño consistente",
                "Conecta con amigos o familiares regularmente",
            ];
        } elseif ($score <= 17) {
            $level = "Bienestar moderado";
            $description = "Tu puntuación indica un bienestar moderado. Puedes estar experimentando algunos desafíos emocionales, pero generalmente te sientes equilibrado.";
            $recommendations = [
                "Explora ejercicios de respiración profunda",
                "Incorpora actividad física regular a tu rutina",
                "Practica la gratitud diariamente",
                "Establece límites saludables en tus relaciones",
                "Dedica tiempo a actividades que disfrutes",
            ];
        } else {
            $level = "Bienestar general alto";
            $description = "¡Excelente! Tu puntuación indica un alto nivel de bienestar. Te sientes positivo, energético y satisfecho con tu vida.";
            $recommendations = [
                "Mantén un equilibrio entre trabajo y vida personal",
                "Explora nuevas actividades o hobbies",
                "Comparte tu bienestar ayudando a otros",
                "Continúa con tus prácticas de autocuidado",
                "Establece metas personales para seguir creciendo",
            ];
        }

        $labelDate = $takenAt ? $takenAt->translatedFormat('F Y') : '';

        return [
            'percentage' => $percentage,
            'level' => $level,
            'description' => $description,
            'recommendations' => $recommendations,
            'label_date' => $labelDate, // para el circulito
        ];
    }

    private function depressionUi(int $score, $answers): array
    {
        // Interpretaciones PHQ-9 (igual que en tu JS)
        $levels = [
            [
                0,
                4,
                "Depresión Mínima",
                "#4db8a8",
                "rgba(77, 184, 168, 0.1)",
                "Tu puntuación indica síntomas depresivos mínimos o ausentes."
            ],
            [
                5,
                9,
                "Depresión Leve",
                "#8bd3c7",
                "rgba(139, 211, 199, 0.1)",
                "Tu puntuación sugiere síntomas depresivos leves."
            ],
            [
                10,
                14,
                "Depresión Moderada",
                "#c6e6e0",
                "rgba(198, 230, 224, 0.1)",
                "Tu puntuación indica síntomas depresivos moderados."
            ],
            [
                15,
                19,
                "Depresión Moderadamente Severa",
                "#2c5f5d",
                "rgba(44, 95, 93, 0.1)",
                "Tu puntuación sugiere síntomas depresivos moderadamente severos."
            ],
            [
                20,
                27,
                "Depresión Severa",
                "#5a7c7a",
                "rgba(90, 124, 122, 0.1)",
                "Tu puntuación indica síntomas depresivos severos."
            ]
        ];

        $levelData = $levels[0];

        foreach ($levels as $lvl) {
            if ($score >= $lvl[0] && $score <= $lvl[1]) {
                $levelData = $lvl;
                break;
            }
        }

        $impactText = null;

        if (isset($answers['impactAnswer'])) {
            $impactTexts = [
                "Los problemas no te han dificultado realizar tus actividades.",
                "Los problemas te han dificultado algo realizar tus actividades.",
                "Los problemas te han dificultado mucho realizar tus actividades.",
                "Los problemas te han dificultado extremadamente realizar tus actividades."
            ];

            $impactIndex = (int) $answers['impactAnswer'];
            $impactText = $impactTexts[$impactIndex] ?? null;
        }

        $percentage = round(($score / 27) * 100);

        // Recomendaciones PHQ-9 (para que la vista las muestre)
        $recommendations = match (true) {
            $score <= 4 => [
                "Mantén rutinas estables de sueño y alimentación",
                "Realiza actividad física suave 3 veces por semana",
                "Haz una actividad agradable al día (aunque sea pequeña)",
            ],
            $score <= 9 => [
                "Estructura tu día con 2–3 tareas pequeñas alcanzables",
                "Practica respiración/relajación 10 minutos al día",
                "Habla con alguien de confianza sobre cómo te sientes",
            ],
            $score <= 14 => [
                "Considera agendar una consulta con un profesional",
                "Reduce la carga: prioriza lo esencial esta semana",
                "Registra tu ánimo y pensamientos para ver patrones",
            ],
            $score <= 19 => [
                "Busca apoyo profesional (prioritario)",
                "Pide apoyo a alguien cercano para acompañarte",
                "Evita aislarte: plan mínimo de contacto diario",
            ],
            default => [
                "Busca ayuda profesional lo antes posible",
                "Si te sientes en crisis o en riesgo, busca ayuda inmediata",
                "No te quedes solo/a si te sientes en riesgo",
            ],
        };

        return [
            'level'        => $levelData[2],
            'color'        => $levelData[3],
            'lightColor'   => $levelData[4],
            'description'  => $levelData[5],
            'recommendations' => $recommendations,
            'score'        => $score,
            'percentage'   => $percentage,
            'impactText'   => $impactText,
        ];
    }

    private function anxietyUi(int $score, $answers): array
    {
        // Interpretaciones GAD-7 (como tu JS) + usando paleta Mentally (sin rojos/amarillos fuertes)
        // 0-4 mínima, 5-9 leve, 10-14 moderada, 15-21 grave
        $levels = [
            [
                0,
                4,
                "Ansiedad mínima",
                "#c6e6e0",
                "rgba(198, 230, 224, 0.12)",
                "Tu puntuación indica un nivel mínimo de síntomas de ansiedad. Esto sugiere que no presentas signos significativos de ansiedad generalizada."
            ],
            [
                5,
                9,
                "Ansiedad leve",
                "#8bd3c7",
                "rgba(139, 211, 199, 0.12)",
                "Tu puntuación indica síntomas leves de ansiedad. Puedes estar experimentando cierta inquietud o preocupación, pero generalmente manejable."
            ],
            [
                10,
                14,
                "Ansiedad moderada",
                "#4db8a8",
                "rgba(77, 184, 168, 0.12)",
                "Tu puntuación indica síntomas moderados de ansiedad. Es recomendable considerar una evaluación profesional."
            ],
            [
                15,
                21,
                "Ansiedad grave",
                "#2c5f5d",
                "rgba(44, 95, 93, 0.12)",
                "Tu puntuación indica síntomas graves de ansiedad. Se recomienda evaluación profesional prioritaria."
            ]
        ];

        $levelData = $levels[0];
        foreach ($levels as $lvl) {
            if ($score >= $lvl[0] && $score <= $lvl[1]) {
                $levelData = $lvl;
                break;
            }
        }

        // Recomendaciones (las mismas de tu JS)
        $recommendations = match (true) {
            $score <= 4 => [
                "Mantén tus hábitos saludables actuales",
                "Practica técnicas de relajación preventivas",
                "Monitorea tu bienestar emocional regularmente",
                "Mantén un equilibrio entre trabajo y vida personal",
                "Realiza actividad física regular",
            ],
            $score <= 9 => [
                "Practica técnicas de respiración profunda diariamente",
                "Establece una rutina de sueño consistente",
                "Reduce el consumo de cafeína y estimulantes",
                "Practica mindfulness o meditación 10 min/día",
                "Habla con amigos o familiares sobre tus preocupaciones",
            ],
            $score <= 14 => [
                "Consulta con un profesional de salud mental",
                "Considera terapia cognitivo-conductual (TCC)",
                "Establece límites saludables en tus responsabilidades",
                "Practica ejercicio físico regularmente",
                "Lleva un diario de pensamientos ansiosos",
            ],
            default => [
                "Consulta prioritariamente con un profesional de salud mental",
                "Considera opciones de tratamiento profesional",
                "Establece una red de apoyo con familiares y amigos",
                "Evita el aislamiento social",
                "Sigue un plan de tratamiento profesional",
            ],
        };

        // Próximo chequeo (igual que tu lógica)
        $nextDays = 30;
        if ($score >= 15) $nextDays = 7;
        elseif ($score >= 10) $nextDays = 14;

        $percentage = round(($score / 21) * 100);

        return [
            'level'          => $levelData[2],
            'color'          => $levelData[3],
            'lightColor'     => $levelData[4],
            'description'    => $levelData[5],
            'recommendations' => $recommendations,
            'score'          => $score,
            'percentage'     => $percentage,
            'nextDays'       => $nextDays,
        ];
    }
}
