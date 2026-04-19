@extends('layouts.app')

@section('content')
    <style>
        /* ===== VARIABLES ===== */
        :root {
            --primary: #4db8a8;
            --primary-dark: #2c5f5d;
            --primary-light: #8bd3c7;
            --primary-soft: #c6e6e0;
            --gray: #5a7c7a;
            --gray-light: #e8f5f3;
            --white: #ffffff;
            --shadow-sm: 0 5px 20px rgba(77, 184, 168, 0.08);
            --shadow-md: 0 10px 30px rgba(77, 184, 168, 0.12);
            --shadow-lg: 0 20px 40px rgba(77, 184, 168, 0.15);
            --success: #4db8a8;
            --warning: #f1c40f;
            --danger: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f7f4 0%, #d4f1f9 50%, #e8f5f3 100%);
            min-height: 100vh;
        }

        /* ===== PARTICULAS ===== */
        .floating-particle {
            position: fixed;
            width: 4px;
            height: 4px;
            background: rgba(77, 184, 168, 0.2);
            border-radius: 50%;
            animation: floatParticle 10s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes floatParticle {

            0%,
            100% {
                transform: translate(0, 0);
            }

            25% {
                transform: translate(8px, -6px);
            }

            50% {
                transform: translate(4px, 10px);
            }

            75% {
                transform: translate(-6px, 4px);
            }
        }

        /* ===== CONTENEDOR PRINCIPAL ===== */
        .checks-wrapper {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 8rem 1.5rem 2rem 1.5rem;
            position: relative;
            z-index: 1;
        }

        /* ===== HEADER ===== */
        .checks-header {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .header-info h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 0.2rem;
        }

        .header-info p {
            color: var(--gray);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-alert {
            background: rgba(231, 76, 60, 0.1);
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            border-left: 4px solid var(--danger);
        }

        .header-alert i {
            color: var(--danger);
            margin-right: 0.5rem;
        }

        .header-alert span {
            color: var(--danger);
            font-weight: 600;
        }

        /* ===== TARJETAS DE TESTS ===== */
        .tests-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .test-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .test-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .test-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        }

        .test-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .test-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .test-title i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .test-title h3 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            color: var(--primary-dark);
        }

        .test-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-wellbeing {
            background: rgba(77, 184, 168, 0.1);
            color: var(--primary-dark);
        }

        .badge-depression {
            background: rgba(44, 95, 93, 0.1);
            color: var(--primary-dark);
        }

        .badge-anxiety {
            background: rgba(90, 124, 122, 0.1);
            color: var(--primary-dark);
        }

        .test-score {
            text-align: center;
            margin: 1rem 0;
        }

        .score-number {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            line-height: 1;
        }

        .score-max {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .test-level {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin: 0.5rem 0;
            padding: 0.5rem;
            border-radius: 50px;
            font-weight: 600;
        }

        .level-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .level-high {
            background: rgba(77, 184, 168, 0.1);
            color: var(--primary);
        }

        .level-mild {
            background: rgba(241, 196, 15, 0.1);
            color: #f39c12;
        }

        .level-minimal {
            background: rgba(46, 204, 113, 0.1);
            color: #27ae60;
        }

        .level-low {
            background: rgba(231, 76, 60, 0.08);
            color: #c0392b;
        }

        .level-moderate {
            background: rgba(243, 156, 18, 0.14);
            color: #d68910;
        }

        .level-mod-severe {
            background: rgba(230, 126, 34, 0.12);
            color: #d35400;
        }

        .level-severe {
            background: rgba(231, 76, 60, 0.10);
            color: #e74c3c;
        }

        .test-dates {
            margin: 1rem 0;
            padding: 0.8rem;
            background: rgba(77, 184, 168, 0.05);
            border-radius: 16px;
            font-size: 0.85rem;
        }

        .mini-chart-wrap {
            margin-top: 0.8rem;
        }

        .mini-chart-box {
            position: relative;
            width: 100%;
            height: 60px;
        }

        .mini-chart-box canvas {
            width: 100% !important;
            height: 100% !important;
            display: block;
        }

        .date-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.3rem;
        }

        .date-item:last-child {
            margin-bottom: 0;
        }

        .date-label {
            color: var(--gray);
        }

        .date-value {
            font-weight: 600;
            color: var(--primary-dark);
        }

        .test-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            text-align: center;
            width: 100%;
        }

        .status-ok {
            background: rgba(77, 184, 168, 0.1);
            color: var(--primary);
        }

        .status-pending {
            background: rgba(241, 196, 15, 0.1);
            color: #f39c12;
        }

        .status-expired {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger);
        }

        .test-action {
            margin-top: 1rem;
            text-align: center;
        }

        .btn-test {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-test:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 95, 93, 0.3);
        }

        /* ===== GRÁFICO DE EVOLUCIÓN ===== */
        .chart-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .chart-title {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .chart-title i {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .chart-title h2 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            color: var(--primary-dark);
        }

        .chart-legend {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .color-wellbeing {
            background: #4db8a8;
        }

        .color-depression {
            background: #2c5f5d;
        }

        .color-anxiety {
            background: #8bd3c7;
        }

        .chart-container {
            width: 100%;
            height: 320px;
            position: relative;
        }

        .chart-container canvas {
            display: block;
        }

        /* ===== METAS Y RECOMENDACIONES ===== */
        .goals-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
        }

        .goals-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .goals-header i {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .goals-header h2 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            color: var(--primary-dark);
        }

        .goals-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .goal-item {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            padding: 1.2rem;
            border: 1px solid rgba(77, 184, 168, 0.1);
        }

        .goal-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .goal-progress {
            margin: 1rem 0;
        }

        .progress-text {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(77, 184, 168, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .goal-next {
            margin-top: 1rem;
            padding-top: 0.8rem;
            border-top: 1px solid rgba(77, 184, 168, 0.1);
            font-size: 0.85rem;
        }

        /* ===== ALERTAS CLÍNICAS ===== */
        .alerts-card {
            background: rgba(231, 76, 60, 0.05);
            border-radius: 24px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 6px solid var(--danger);
        }

        .alert-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem;
            background: white;
            border-radius: 16px;
            margin-bottom: 0.8rem;
        }

        .alert-item:last-child {
            margin-bottom: 0;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--danger);
            font-size: 1.2rem;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.2rem;
        }

        .alert-text {
            color: var(--gray);
            font-size: 0.85rem;
        }

        .alert-action {
            background: var(--danger);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ===== BOTONES DE ACCIÓN ===== */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white;
            box-shadow: 0 4px 12px rgba(44, 95, 93, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(44, 95, 93, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary-dark);
            border: 1.5px solid var(--primary);
        }

        .btn-secondary:hover {
            background: rgba(77, 184, 168, 0.05);
            transform: translateY(-2px);
        }

        /* ===== ANIMACIONES ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-item {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .tests-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .goals-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .checks-wrapper {
                padding: 10rem 1rem 2rem 1rem;
            }

            .tests-grid {
                grid-template-columns: 1fr;
            }

            .goals-grid {
                grid-template-columns: 1fr;
            }

            .chart-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .checks-wrapper {
                padding-top: 12rem;
            }

            .header-info h1 {
                font-size: 1.4rem;
            }
        }
    </style>

    <!-- Partículas flotantes -->
    <div class="floating-particle" style="top: 10%; left: 5%;"></div>
    <div class="floating-particle" style="top: 80%; right: 10%;"></div>
    <div class="floating-particle" style="bottom: 20%; left: 15%;"></div>
    <div class="floating-particle" style="top: 30%; right: 20%;"></div>

    <div class="checks-wrapper">

        @php

            // Helpers
            $maxByType = [
                'wellbeing' => 25,
                'depression' => 27,
                'anxiety' => 21,
            ];

            // Construye info UI por test (mínimo viable)
            $buildTestCard = function (string $type, $attempt) use ($maxByType) {
                $now = now();

                // Defaults cuando no hay attempts aún
                $score = $attempt?->score !== null ? (int) $attempt->score : null;
                $max = $maxByType[$type];

                $takenAt = $attempt?->taken_at ? \Carbon\Carbon::parse($attempt->taken_at) : null;

                $lastDate = $takenAt ? $takenAt->format('d/m/Y') : '—';
                $lastDays = $takenAt ? $takenAt->diffInDays($now) : null;

                // Próxima fecha: +14 días desde última toma (si existe)
                $nextAt = $takenAt ? $takenAt->copy()->addDays(14) : null;
                $nextDate = $nextAt ? $nextAt->format('d/m/Y') : '—';

                // Estado según vencimiento
                // - Si no hay attempt: "Pendiente"
                // - Si nextAt <= hoy: "Vencido"
                // - Si faltan <=3 días: "Próximo"
                // - Si no: "Al día"
                if (!$takenAt) {
                    $status = 'Pendiente';
                    $statusClass = 'status-pending';
                } else {
                    if ($nextAt->lt($now->copy()->startOfDay())) {
                        $status = 'Vencido';
                        $statusClass = 'status-expired';
                    } elseif (
                        $now
                            ->copy()
                            ->startOfDay()
                            ->diffInDays($nextAt->copy()->startOfDay()) <= 3
                    ) {
                        $status = 'Próximo';
                        $statusClass = 'status-pending';
                    } else {
                        $status = 'Al día';
                        $statusClass = 'status-ok';
                    }
                }

                // Nombre, short, icon, badge
                $meta = match ($type) {
                    'wellbeing' => [
                        'name' => 'Bienestar',
                        'short' => 'OMS-5',
                        'badge_class' => 'badge-wellbeing',
                        'icon' => 'fa-smile',
                    ],
                    'depression' => [
                        'name' => 'Depresión',
                        'short' => 'PHQ-9',
                        'badge_class' => 'badge-depression',
                        'icon' => 'fa-frown',
                    ],
                    default => [
                        'name' => 'Ansiedad',
                        'short' => 'GAD-7',
                        'badge_class' => 'badge-anxiety',
                        'icon' => 'fa-heart-crack',
                    ],
                };

                // Nivel: usa el "result" guardado (tu TestAttempt ya lo guarda)
                $levelText = $attempt?->result ?? '—';

                if ($score !== null) {
                    if ($type === 'depression') {
                        if ($score <= 4) {
                            $levelText = 'Depresión mínima';
                        } elseif ($score <= 9) {
                            $levelText = 'Depresión leve';
                        } elseif ($score <= 14) {
                            $levelText = 'Depresión moderada';
                        } elseif ($score <= 19) {
                            $levelText = 'Depresión moderadamente severa';
                        } else {
                            $levelText = 'Depresión severa';
                        }
                    } elseif ($type === 'anxiety') {
                        if ($score <= 4) {
                            $levelText = 'Ansiedad mínima';
                        } elseif ($score <= 9) {
                            $levelText = 'Ansiedad leve';
                        } elseif ($score <= 14) {
                            $levelText = 'Ansiedad moderada';
                        } else {
                            $levelText = 'Ansiedad grave';
                        }
                    } else {
                        if ($score >= 18) {
                            $levelText = 'Bienestar general alto';
                        } elseif ($score >= 14) {
                            $levelText = 'Bienestar general medio';
                        } else {
                            $levelText = 'Bienestar general bajo';
                        }
                    }
                }

                // Para no romper tus clases, asignamos una clase simple según severidad aproximada
                // (luego lo refinamos si quieres)
                $levelClass = 'level-high';
                $levelIcon = 'fa-check';

                if ($type === 'depression') {
                    // PHQ-9: 0-4 mínima, 5-9 leve, 10-14 moderada, 15-19 mod. severa, 20-27 severa
                    if ($score === null) {
                        $levelClass = 'level-mild';
                        $levelIcon = 'fa-minus';
                    } elseif ($score <= 4) {
                        $levelClass = 'level-minimal';
                        $levelIcon = 'fa-check';
                    } elseif ($score <= 9) {
                        $levelClass = 'level-mild';
                        $levelIcon = 'fa-arrow-down';
                    } elseif ($score <= 14) {
                        $levelClass = 'level-moderate';
                        $levelIcon = 'fa-exclamation';
                    } elseif ($score <= 19) {
                        $levelClass = 'level-mod-severe';
                        $levelIcon = 'fa-triangle-exclamation';
                    } else {
                        $levelClass = 'level-severe';
                        $levelIcon = 'fa-triangle-exclamation';
                    }
                } elseif ($type === 'anxiety') {
                    // GAD-7: 0-4 mínima, 5-9 leve, 10-14 moderada, 15-21 grave
                    if ($score === null) {
                        $levelClass = 'level-mild';
                        $levelIcon = 'fa-minus';
                    } elseif ($score <= 4) {
                        $levelClass = 'level-minimal';
                        $levelIcon = 'fa-check';
                    } elseif ($score <= 9) {
                        $levelClass = 'level-mild';
                        $levelIcon = 'fa-arrow-down';
                    } elseif ($score <= 14) {
                        $levelClass = 'level-moderate';
                        $levelIcon = 'fa-exclamation';
                    } else {
                        $levelClass = 'level-severe';
                        $levelIcon = 'fa-triangle-exclamation';
                    }
                } else {
                    // OMS-5
                    if ($score === null) {
                        $levelClass = 'level-mild';
                        $levelIcon = 'fa-minus';
                    } elseif ($score >= 18) {
                        $levelClass = 'level-high';
                        $levelIcon = 'fa-arrow-up';
                    } elseif ($score >= 14) {
                        $levelClass = 'level-mild';
                        $levelIcon = 'fa-minus';
                    } else {
                        $levelClass = 'level-low';
                        $levelIcon = 'fa-arrow-down';
                    }
                }

                return [
                    'type' => $type,
                    'name' => $meta['name'],
                    'short' => $meta['short'],
                    'icon' => $meta['icon'],
                    'badge_class' => $meta['badge_class'],

                    'score' => $score,
                    'max' => $max,

                    'level' => $levelText,
                    'level_class' => $levelClass,
                    'level_icon' => $levelIcon,

                    'last_date' => $lastDate,
                    'last_days' => $lastDays,
                    'next_date' => $nextDate,

                    'status' => $status,
                    'status_class' => $statusClass,

                    // Para botones/links
                    'route_take' => match ($type) {
                        'wellbeing' => route('test.bienestar'),
                        'depression' => route('test.depresion'),
                        default => route('test.ansiedad'),
                    },
                    'has_attempt' => (bool) $attempt,
                    'route_results' => $attempt ? route('tests.resultados.show', $attempt) : null,
                ];
            };

            // Datos reales desde controller: $lastAttempts['wellbeing'|'depression'|'anxiety']
            $tests = [
                'wellbeing' => $buildTestCard('wellbeing', $lastAttempts['wellbeing'] ?? null),
                'depression' => $buildTestCard('depression', $lastAttempts['depression'] ?? null),
                'anxiety' => $buildTestCard('anxiety', $lastAttempts['anxiety'] ?? null),
            ];

            // Conteo de vencidos para el badge rojo del header
            $expiredCount = collect($tests)->filter(fn($t) => $t['status'] === 'Vencido')->count();

            $latestAttemptDate = collect($lastAttempts)
                ->filter()
                ->map(fn($attempt) => \Carbon\Carbon::parse($attempt->taken_at))
                ->sortDesc()
                ->first();

        @endphp
        <!-- HEADER -->
        <div class="checks-header animate-item" style="animation-delay: 0.1s;">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="header-info">
                    <h1>
                        @if ($modoEspecialista && $pacienteVisto)
                            Chequeos de {{ $pacienteVisto->name }}
                        @else
                            Mis Chequeos de Salud Mental
                        @endif
                    </h1>
                    <p>
                        @if ($modoEspecialista && $pacienteVisto)
                            <i class="fas fa-user"></i>
                            Paciente: {{ $pacienteVisto->name }}

                            @if ($pacienteVisto->email)
                                <span style="margin-left:.35rem;">• {{ $pacienteVisto->email }}</span>
                            @endif

                            <span style="margin-left:.35rem;">
                                • Última actualización: {{ now()->format('d/m/Y') }}
                            </span>

                            @if ($latestAttemptDate)
                                <span style="margin-left:.35rem;">• Último chequeo:
                                    {{ $latestAttemptDate->format('d/m/Y') }}</span>
                            @endif
                        @else
                            <i class="fas fa-calendar"></i>
                            Última actualización: {{ now()->format('d/m/Y') }}
                            @if ($latestAttemptDate)
                                <span style="margin-left:.35rem;">• Último chequeo:
                                    {{ $latestAttemptDate->format('d/m/Y') }}</span>
                            @endif
                            <i class="fas fa-clock"></i> Cada test se realiza cada 14 días
                        @endif
                    </p>
                </div>
            </div>
            @if ($expiredCount > 0)
                <div class="header-alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ $expiredCount }} test{{ $expiredCount === 1 ? '' : 's' }}
                        vencido{{ $expiredCount === 1 ? '' : 's' }}</span>
                </div>
            @endif
        </div>

        <!-- TARJETAS DE TESTS -->

        <div class="tests-grid">
            @foreach ($tests as $key => $test)
                <div class="test-card animate-item" style="animation-delay: 0.{{ 2 + $loop->index * 2 }}s;">
                    <div class="test-header">
                        <div class="test-title">
                            <i class="fas {{ $test['icon'] }}"></i>
                            <h3>{{ $test['name'] }} <span
                                    style="font-size: 0.8rem; color: var(--gray);">({{ $test['short'] }})</span></h3>
                        </div>
                        <span class="test-badge {{ $test['badge_class'] }}">{{ $test['short'] }}</span>
                    </div>

                    <div class="test-score">
                        <div class="score-number">{{ $test['score'] === null ? '—' : $test['score'] }}</div>
                        <div class="score-max">de {{ $test['max'] }} puntos</div>
                    </div>

                    <div class="test-level {{ $test['level_class'] }}">
                        <div class="level-icon">
                            <i class="fas {{ $test['level_icon'] }}"></i>
                        </div>
                        <span>{{ $test['level'] }}</span>
                    </div>

                    @if (
                        !empty($charts['labels']) &&
                            collect($charts[$key] ?? [])->filter(fn($v) => $v !== null)->isNotEmpty())
                        <div class="mini-chart-wrap">
                            <div class="mini-chart-box">
                                <canvas id="miniChart_{{ $key }}"></canvas>
                            </div>

                            @php
                                $dlt = $delta[$key] ?? null;
                                $deltaText = null;

                                if ($dlt !== null) {
                                    $improved = false;

                                    if ($key === 'wellbeing') {
                                        $improved = $dlt > 0;
                                    } else {
                                        $improved = $dlt < 0;
                                    }

                                    if ($dlt === 0) {
                                        $deltaText = 'Sin cambio vs anterior';
                                    } else {
                                        $abs = abs($dlt);
                                        $deltaText = $improved
                                            ? "Mejoraste {$abs} punto" . ($abs === 1 ? '' : 's') . ' vs anterior'
                                            : "Empeoraste {$abs} punto" . ($abs === 1 ? '' : 's') . ' vs anterior';
                                    }
                                }
                            @endphp

                            @if ($deltaText)
                                <div style="margin-top:.6rem; text-align:center; font-size:.85rem; color: var(--gray);">
                                    <i class="fas {{ $key === 'wellbeing' ? (($dlt ?? 0) >= 0 ? 'fa-arrow-up' : 'fa-arrow-down') : (($dlt ?? 0) <= 0 ? 'fa-arrow-down' : 'fa-arrow-up') }}"
                                        style="color: {{ isset($dlt) && $dlt !== 0 ? 'var(--primary)' : 'var(--gray)' }};"></i>
                                    {{ $deltaText }}
                                </div>
                            @endif
                            <div
                                style="margin-top:.35rem; text-align:center; font-size:.72rem; color: var(--gray); opacity:.8;">
                                Tendencia de los últimos 6 meses (escala porcentual)
                            </div>
                        </div>
                    @endif


                    <div class="test-dates">
                        <div class="date-item">
                            <span class="date-label"><i class="fas fa-calendar-check"></i> Último:</span>
                            <span class="date-value">{{ $test['last_date'] }}</span>
                        </div>
                        <div class="date-item">
                            <span class="date-label"><i class="fas fa-clock"></i> Hace:</span>
                            <span class="date-value">
                                {{ $test['last_days'] !== null ? (int) $test['last_days'] . ' días' : '—' }}
                            </span>
                        </div>
                        <div class="date-item">
                            <span class="date-label"><i class="fas fa-hourglass-half"></i> Próximo:</span>
                            <span class="date-value">{{ $test['next_date'] }}</span>
                        </div>
                    </div>

                    <div class="test-status {{ $test['status_class'] }}">
                        {{ $test['status'] }}
                    </div>

                    <div class="test-action" style="display:flex; gap:.6rem; flex-wrap:wrap;">
                        @if ($test['has_attempt'] && $test['route_results'])
                            <a href="{{ $test['route_results'] }}" class="btn-test"
                                style="flex:1; background: transparent; color: var(--primary-dark); border: 1.5px solid rgba(77,184,168,.6);">
                                <i class="fas fa-eye"></i> Ver resultados
                            </a>
                        @endif

                        @if (!$modoEspecialista && in_array($test['status'], ['Vencido', 'Próximo', 'Pendiente']))
                            @php
                                $actionLabel = match ($test['status']) {
                                    'Pendiente' => 'Comenzar test',
                                    'Próximo' => 'Realizar anticipadamente',
                                    'Vencido' => 'Realizar ahora',
                                    default => 'Realizar ahora',
                                };
                            @endphp

                            <a href="{{ $test['route_take'] }}" class="btn-test" style="flex:1;">
                                <i class="fas fa-play"></i> {{ $actionLabel }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @php
            $hasEvolutionData = collect($charts['wellbeing'] ?? [])
                ->merge($charts['depression'] ?? [])
                ->merge($charts['anxiety'] ?? [])
                ->contains(fn($v) => $v !== null);
        @endphp

        <!-- GRÁFICO DE EVOLUCIÓN COMBINADO -->
        <div class="chart-header">
            <div class="chart-title">
                <i class="fas fa-chart-line"></i>
                <h2>Evolución comparativa</h2>
            </div>

            @if ($hasEvolutionData)
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color color-wellbeing"></div>
                        <span>Bienestar</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color color-depression"></div>
                        <span>Depresión</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color color-anxiety"></div>
                        <span>Ansiedad</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="chart-container">
            <canvas id="evolutionChart" height="320"></canvas>
        </div>

        @if ($hasEvolutionData)
            <div style="margin-top: 1rem; color: var(--gray); font-size: 0.8rem; text-align: center;">
                Evolución de los últimos 6 meses en cortes quincenales. En esta gráfica, valores más altos indican una
                evolución más favorable.
            </div>
        @endif
    </div>

    <!-- ALERTAS IMPORTANTES (DINÁMICAS) -->
    @php
        $alerts = [];

        // Alertas por estado del test
        foreach ($tests as $k => $t) {
            if ($t['status'] === 'Vencido') {
                $alerts[] = [
                    'icon' => 'fa-clock',
                    'title' => "Test de {$t['name']} vencido",
                    'text' => "Debes realizarlo cada 14 días. Último chequeo: {$t['last_date']}.",
                    'action_text' => 'Realizar',
                    'action_href' => $t['route_take'],
                    'priority' => 1,
                ];
            } elseif ($t['status'] === 'Pendiente') {
                $alerts[] = [
                    'icon' => 'fa-circle-info',
                    'title' => "Test de {$t['name']} pendiente",
                    'text' =>
                        'Aún no has realizado este test. Te recomendamos completarlo para iniciar tu seguimiento.',
                    'action_text' => 'Realizar',
                    'action_href' => $t['route_take'],
                    'priority' => 5,
                ];
            }
        }

        // Alertas clínicas básicas por severidad (usamos score bruto actual)
        $depScore = $tests['depression']['score'];
        $anxScore = $tests['anxiety']['score'];
        $wbScore = $tests['wellbeing']['score'];

        if ($depScore !== null) {
            if ($depScore >= 20) {
                $alerts[] = [
                    'icon' => 'fa-triangle-exclamation',
                    'title' => 'Depresión severa (PHQ-9)',
                    'text' => "Tu puntuación actual es {$depScore}/27. Se recomienda seguimiento profesional prioritario.",
                    'action_text' => 'Ver resultados',
                    'action_href' => route('tests.resultados.show', $lastAttempts['depression']),
                    'priority' => 0,
                ];
            } elseif ($depScore >= 15) {
                $alerts[] = [
                    'icon' => 'fa-circle-exclamation',
                    'title' => 'Depresión moderadamente severa (PHQ-9)',
                    'text' => "Tu puntuación actual es {$depScore}/27. Considera seguimiento profesional cercano.",
                    'action_text' => 'Ver resultados',
                    'action_href' => route('tests.resultados.show', $lastAttempts['depression']),
                    'priority' => 2,
                ];
            }
        }

        if ($anxScore !== null && $anxScore >= 15) {
            $alerts[] = [
                'icon' => 'fa-triangle-exclamation',
                'title' => 'Ansiedad grave (GAD-7)',
                'text' => "Tu puntuación actual es {$anxScore}/21. Se recomienda evaluación profesional prioritaria.",
                'action_text' => 'Ver resultados',
                'action_href' => route('tests.resultados.show', $lastAttempts['anxiety']),
                'priority' => 0,
            ];
        } elseif ($anxScore !== null && $anxScore >= 10) {
            $alerts[] = [
                'icon' => 'fa-circle-exclamation',
                'title' => 'Ansiedad moderada (GAD-7)',
                'text' => "Tu puntuación actual es {$anxScore}/21. Considera seguimiento profesional.",
                'action_text' => 'Ver resultados',
                'action_href' => route('tests.resultados.show', $lastAttempts['anxiety']),
                'priority' => 3,
            ];
        }

        if ($wbScore !== null && $wbScore <= 13) {
            $alerts[] = [
                'icon' => 'fa-heart-crack',
                'title' => 'Bienestar bajo (OMS-5)',
                'text' => "Tu puntuación actual es {$wbScore}/25. Considera reforzar rutinas de autocuidado y apoyo.",
                'action_text' => 'Ver resultados',
                'action_href' => route('tests.resultados.show', $lastAttempts['wellbeing']),
                'priority' => 4,
            ];
        }

        // Ordenar por prioridad (0 = más importante)
        usort($alerts, fn($a, $b) => ($a['priority'] ?? 99) <=> ($b['priority'] ?? 99));
    @endphp

    @if (count($alerts))
        <div class="alerts-card animate-item" style="animation-delay: 1.2s;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <i class="fas fa-exclamation-circle" style="color: var(--danger); font-size: 1.5rem;"></i>
                <h3 style="font-family: 'Quicksand', sans-serif; color: var(--primary-dark);">Alertas importantes</h3>
            </div>

            @foreach ($alerts as $al)
                <div class="alert-item">
                    <div class="alert-icon">
                        <i class="fas {{ $al['icon'] }}"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">{{ $al['title'] }}</div>
                        <div class="alert-text">{{ $al['text'] }}</div>
                    </div>

                    @if (!empty($al['action_href']) && !$modoEspecialista)
                        <a href="{{ $al['action_href'] }}" class="alert-action">{{ $al['action_text'] ?? 'Ver' }}</a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- BOTONES DE ACCIÓN -->
    <div class="action-buttons">
        @if ($modoEspecialista)
            <a href="{{ route('especialista.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al panel clínico
            </a>
        @endif

        <a href="{{ url()->current() }}" class="btn btn-secondary">
            <i class="fas fa-sync-alt"></i> Actualizar
        </a>

        @if (!$modoEspecialista)
            <a href="#" class="btn btn-primary">
                <i class="fas fa-share-alt"></i> Compartir con especialista
            </a>
        @endif
    </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===== Datos desde backend =====
            const labels = @json($charts['labels'] ?? []);
            const dataW = @json($charts['wellbeing'] ?? []);
            const dataD = @json($charts['depression'] ?? []);
            const dataA = @json($charts['anxiety'] ?? []);

            const hasLabels = labels.length > 0;
            const hasMainData = [...dataW, ...dataD, ...dataA].some(value => value !== null && value !== undefined);

            // ===== Gráfica grande =====
            const mainCanvas = document.getElementById('evolutionChart');

            if (mainCanvas && hasLabels && hasMainData) {
                const ctx = mainCanvas.getContext('2d');

                const wData = @json($charts['wellbeing'] ?? []);
                const dData = @json($charts['depression'] ?? []);
                const aData = @json($charts['anxiety'] ?? []);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [{
                                label: 'Bienestar',
                                data: wData,
                                spanGaps: true,
                                borderColor: '#4db8a8',
                                backgroundColor: 'rgba(77, 184, 168, 0.12)',
                                borderWidth: 3,
                                pointRadius: 2,
                                pointHoverRadius: 5,
                                tension: 0.35,
                                fill: true
                            },
                            {
                                label: 'Depresión',
                                data: dData,
                                spanGaps: true,
                                borderColor: '#2c5f5d',
                                backgroundColor: 'rgba(44, 95, 93, 0.10)',
                                borderWidth: 3,
                                pointRadius: 2,
                                pointHoverRadius: 5,
                                tension: 0.35,
                                fill: true
                            },
                            {
                                label: 'Ansiedad',
                                data: aData,
                                spanGaps: true,
                                borderColor: '#8bd3c7',
                                backgroundColor: 'rgba(139, 211, 199, 0.10)',
                                borderWidth: 3,
                                pointRadius: 2,
                                pointHoverRadius: 5,
                                tension: 0.35,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'white',
                                titleColor: '#2c5f5d',
                                bodyColor: '#5a7c7a',
                                borderColor: 'rgba(77,184,168,0.2)',
                                borderWidth: 1,
                                padding: 12,
                            }
                        },
                        scales: {
                            y: {
                                min: 0,
                                max: 100,
                                grid: {
                                    color: 'rgba(77,184,168,0.06)'
                                },
                                ticks: {
                                    stepSize: 20,
                                    color: '#5a7c7a',
                                    callback: function(value) {
                                        return value + '%';
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#5a7c7a',
                                    maxRotation: 0,
                                    minRotation: 0,
                                    autoSkip: true,
                                    maxTicksLimit: 6,
                                    callback: function(value, index) {
                                        // muestra solo 1 de cada ~2/3 etiquetas para que quede limpio
                                        const label = labels[index] || '';
                                        // "Feb 2026 - 1/2" -> "Feb 2026"
                                        return label.split(' - ')[0];
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // ===== Mini gráficas =====
            function renderMiniChart(id, data, color) {
                const c = document.getElementById(id);
                if (!c || !hasLabels) return;

                const cleanData = Array.isArray(data) ? data : [];
                const hasMiniData = cleanData.some(value => value !== null && value !== undefined);

                if (!hasMiniData) return;

                new Chart(c.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [{
                            data: cleanData,
                            borderColor: color,
                            borderWidth: 2,
                            pointRadius: 0,
                            pointHitRadius: 0,
                            tension: 0.35,
                            fill: false,
                            spanGaps: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: false,
                        events: [],
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        elements: {
                            line: {
                                capBezierPoints: true
                            }
                        },
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        }
                    }
                });
            }

            renderMiniChart('miniChart_wellbeing', dataW, '#4db8a8');
            renderMiniChart('miniChart_depression', dataD, '#2c5f5d');
            renderMiniChart('miniChart_anxiety', dataA, '#8bd3c7');

        });
    </script>
@endsection
