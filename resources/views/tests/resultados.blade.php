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
        .results-wrapper {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 8rem 1.5rem 2rem 1.5rem;
            position: relative;
            z-index: 1;
        }

        /* ===== HEADER COMPACTO ===== */
        .results-header {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 1.25rem 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        .results-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary), var(--primary-dark));
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(44, 95, 93, 0.1));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.3rem;
        }

        .header-info h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-dark);
            line-height: 1.2;
        }

        .header-info p {
            color: var(--gray);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.2rem;
        }

        .header-info p i {
            color: var(--primary);
            font-size: 0.8rem;
        }

        .header-score {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(44, 95, 93, 0.3);
        }

        .header-score .score-number {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            line-height: 1;
            font-family: 'Quicksand', sans-serif;
        }

        .header-score .score-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        /* ===== CARRUSEL DE ARTÍCULOS ===== */
        .articles-carousel {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
            position: relative;
            overflow: hidden;
        }

        .carousel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .carousel-title {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .carousel-title i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .carousel-title h3 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.3rem;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .carousel-controls {
            display: flex;
            gap: 0.5rem;
        }

        .carousel-control {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            border: 1px solid rgba(77, 184, 168, 0.2);
            color: var(--primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .carousel-control:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .carousel-container {
            position: relative;
            min-height: 180px;
            overflow: hidden;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-slide {
            flex: 0 0 100%;
            padding: 0.5rem;
        }

        .article-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
        }

        .article-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary);
        }

        .article-image {
            width: 180px;
            background: linear-gradient(135deg, var(--primary-soft), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .article-image i {
            font-size: 3rem;
            color: white;
            opacity: 0.9;
        }

        .article-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.2), rgba(44, 95, 93, 0.2));
        }

        .article-content {
            flex: 1;
            padding: 1.5rem;
        }

        .article-category {
            display: inline-block;
            padding: 0.2rem 1rem;
            background: rgba(77, 184, 168, 0.1);
            color: var(--primary-dark);
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 0.8rem;
        }

        .article-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .article-excerpt {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.8rem;
            color: var(--gray);
        }

        .article-meta i {
            color: var(--primary);
            margin-right: 0.3rem;
        }

        .article-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .article-btn:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(44, 95, 93, 0.3);
        }

        .carousel-indicators {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .carousel-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(77, 184, 168, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: var(--primary);
            transform: scale(1.2);
        }

        /* ===== GRID DE RESULTADOS ===== */
        .results-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 0.9fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* ===== TARJETAS ===== */
        .card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid rgba(77, 184, 168, 0.1);
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(44, 95, 93, 0.1));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .card-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.3rem;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .card-subtitle {
            color: var(--gray);
            font-size: 0.8rem;
        }

        /* ===== CIRCULO DE PUNTUACIÓN COMPACTO ===== */
        .score-circle-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            margin: 0.5rem 0 1.5rem;
            flex-wrap: wrap;
        }

        .score-circle-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
        }

        .score-circle-svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .circle-bg {
            fill: none;
            stroke: rgba(77, 184, 168, 0.1);
            stroke-width: 8;
        }

        .circle-progress {
            fill: none;
            stroke-width: 8;
            stroke-linecap: round;
            stroke-dasharray: 377;
            stroke-dashoffset: 377;
            transition: stroke-dashoffset 1s ease;
        }

        .circle-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .circle-number {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            line-height: 1;
        }

        .circle-max {
            color: var(--gray);
            font-size: 0.75rem;
        }

        .score-stats {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .stat-row {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .stat-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.85rem;
            min-width: 80px;
        }

        .stat-value {
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* ===== NIVEL DE RESULTADO ===== */
        .level-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(77, 184, 168, 0.1);
            border-radius: 50px;
            color: var(--primary-dark);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .level-display {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1.2rem;
            border: 1px solid rgba(77, 184, 168, 0.15);
        }

        .level-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .level-desc {
            color: var(--gray);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* ===== RECOMENDACIONES ===== */
        .recommendations-list {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .rec-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.6rem;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.2s ease;
        }

        .rec-item:hover {
            background: white;
            border-color: var(--primary);
            transform: translateX(3px);
        }

        .rec-icon {
            width: 28px;
            height: 28px;
            background: rgba(77, 184, 168, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 0.8rem;
        }

        .rec-text {
            color: var(--primary-dark);
            font-size: 0.9rem;
            font-weight: 500;
            flex: 1;
        }

        /* ===== GRÁFICO COMPACTO ===== */
        .chart-container {
            margin-top: 1rem;
            width: 100%;
            height: 150px;
            position: relative;
        }

        .chart-header-mini {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .chart-stats-mini {
            display: flex;
            gap: 0.8rem;
        }

        .stat-mini {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            background: rgba(77, 184, 168, 0.05);
            padding: 0.2rem 0.8rem;
            border-radius: 50px;
            font-size: 0.75rem;
            color: var(--gray);
        }

        /* ===== IMPACTO FUNCIONAL ===== */
        .impact-mini {
            margin-top: 1.2rem;
            padding: 1rem;
            background: rgba(77, 184, 168, 0.05);
            border-radius: 16px;
            border-left: 3px solid var(--primary);
            font-size: 0.9rem;
            color: var(--gray);
            line-height: 1.5;
        }

        /* ===== BOTONES ===== */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .btn {
            padding: 0.7rem 1.8rem;
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
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-item {
            animation: fadeInUp 0.4s ease forwards;
            opacity: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .results-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .results-wrapper {
                padding: 10rem 1rem 2rem 1rem;
            }

            .results-header {
                padding: 1rem;
            }

            .header-info h1 {
                font-size: 1.3rem;
            }

            .header-score {
                padding: 0.6rem 1.5rem;
            }

            .header-score .score-number {
                font-size: 1.6rem;
            }

            .score-circle-container {
                flex-direction: column;
                gap: 1rem;
            }

            .article-card {
                flex-direction: column;
            }

            .article-image {
                width: 100%;
                height: 120px;
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
            .results-wrapper {
                padding-top: 12rem;
            }
        }
    </style>

    <!-- Partículas flotantes -->
    <div class="floating-particle" style="top: 10%; left: 5%;"></div>
    <div class="floating-particle" style="top: 80%; right: 10%;"></div>
    <div class="floating-particle" style="bottom: 20%; left: 15%;"></div>
    <div class="floating-particle" style="top: 30%; right: 20%;"></div>

    <div class="results-wrapper">
        <!-- HEADER COMPACTO -->
        <div class="results-header animate-item" style="animation-delay: 0.1s;">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="header-info">
                    <h1>
                        @if ($attempt->test_type === 'wellbeing')
                            Test de Bienestar
                        @elseif($attempt->test_type === 'depression')
                            Test de Depresión
                        @else
                            Test de Ansiedad
                        @endif
                    </h1>
                    <p>
                        <i class="fas fa-calendar"></i> {{ optional($attempt->taken_at)->format('d/m/Y') }}
                        <i class="fas fa-clock"></i> {{ optional($attempt->taken_at)->format('H:i') }}
                    </p>
                </div>
            </div>
            <div class="header-score">
                <div class="score-number">{{ $attempt->score ?? 0 }}</div>
                <div class="score-label">
                    @if ($attempt->test_type === 'wellbeing')
                        / 25
                    @elseif($attempt->test_type === 'depression')
                        / 27
                    @else
                        / 21
                    @endif
                </div>
            </div>
        </div>

                <!-- GRID DE RESULTADOS -->
        <div class="results-grid">
            <!-- TARJETA DE INTERPRETACIÓN -->
            <div class="card animate-item" style="animation-delay: 0.2s;">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div>
                        <h2 class="card-title">Interpretación</h2>
                        <p class="card-subtitle">Análisis de tus respuestas</p>
                    </div>
                </div>

                <!-- Círculo de puntuación compacto -->
                <div class="score-circle-container">
                    <div class="score-circle-wrapper">
                        <svg class="score-circle-svg" viewBox="0 0 130 130">
                            <circle class="circle-bg" cx="65" cy="65" r="60"></circle>
                            <circle class="circle-progress" id="scoreProgress" cx="65" cy="65" r="60"
                                style="stroke: {{ $ui['color'] ?? '#4db8a8' }};"></circle>
                        </svg>
                        <div class="circle-text">
                            <div class="circle-number">{{ $attempt->score ?? 0 }}</div>
                            <div class="circle-max">
                                @if ($attempt->test_type === 'wellbeing')
                                    /25
                                @elseif($attempt->test_type === 'depression')
                                    /27
                                @else
                                    /21
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="score-stats">
                        <div class="stat-row">
                            <div class="stat-dot" style="background: {{ $ui['color'] ?? '#4db8a8' }};"></div>
                            <span class="stat-label">Nivel</span>
                            <span class="stat-value">{{ $ui['level'] ?? $attempt->result }}</span>
                        </div>
                        <div class="stat-row">
                            <div class="stat-dot" style="background: var(--primary-light);"></div>
                            <span class="stat-label">Percentil</span>
                            <span class="stat-value">
                                @php
                                    $maxScore = $attempt->test_type === 'wellbeing' ? 25 : ($attempt->test_type === 'depression' ? 27 : 21);
                                    $percentil = round(($attempt->score / $maxScore) * 100);
                                @endphp
                                {{ $percentil }}%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Nivel detallado -->
                <div class="level-display"
                    style="background: {{ $ui['lightColor'] ?? 'rgba(77, 184, 168, 0.05)' }};">
                    <div class="level-title" style="color: {{ $ui['color'] ?? '#4db8a8' }};">
                        {{ $ui['level'] ?? $attempt->result }}
                    </div>
                    <div class="level-desc">
                        {{ $ui['description'] ?? 'No hay descripción disponible.' }}
                    </div>
                </div>

                <!-- Recomendaciones -->
                @if (!empty($ui['recommendations']))
                    <div style="margin-top: 1rem;">
                        <div class="level-badge">
                            <i class="fas fa-lightbulb"></i>
                            <span>Recomendaciones</span>
                        </div>
                        <div class="recommendations-list">
                            @foreach ($ui['recommendations'] as $rec)
                                <div class="rec-item">
                                    <div class="rec-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="rec-text">{{ $rec }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Impacto funcional (depresión) -->
                @if ($attempt->test_type === 'depression' && isset($ui['impactText']))
                    <div class="impact-mini">
                        <i class="fas fa-clipboard-check" style="color: var(--primary); margin-right: 0.5rem;"></i>
                        {{ $ui['impactText'] }}
                    </div>
                @endif

                <!-- Info ansiedad -->
                @if ($attempt->test_type === 'anxiety' && isset($ui['cutoffs']))
                    <div class="impact-mini" style="margin-top: 1rem;">
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                            <span><i class="fas fa-circle" style="color: var(--primary); font-size: 0.5rem;"></i> {{ $ui['cutoffs']['classic'] }}</span>
                            <span><i class="fas fa-circle" style="color: var(--primary); font-size: 0.5rem;"></i> {{ $ui['cutoffs']['spanish'] }}</span>
                        </div>
                        @if (isset($ui['nextDays']))
                            <div style="margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid rgba(77,184,168,0.2);">
                                <i class="fas fa-calendar"></i> Próxima evaluación: {{ $ui['nextDays'] }} días
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- TARJETA DE EVOLUCIÓN + CARRUSEL -->
            <div class="card animate-item" style="animation-delay: 0.3s;">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <h2 class="card-title">Evolución</h2>
                        <p class="card-subtitle">Seguimiento cada 14 días</p>
                    </div>
                </div>

                @if (isset($chart) && !empty($chart['labels']) && !empty($chart['data']))
                    <div class="chart-header-mini">
                        <div class="chart-stats-mini">
                            <span class="stat-mini">
                                <i class="fas fa-arrow-up" style="color: var(--primary);"></i>
                                {{ end($chart['data']) }}
                            </span>
                            <span class="stat-mini">
                                <i class="fas fa-chart-bar"></i>
                                {{ count($chart['data']) }} mediciones
                            </span>
                        </div>
                    </div>

                    <div class="chart-container">
                        <canvas id="evolutionChart"></canvas>
                    </div>
                @else
                    <div style="text-align: center; padding: 1.5rem;">
                        <i class="fas fa-chart-line" style="font-size: 2rem; color: var(--primary); opacity: 0.3;"></i>
                        <p style="color: var(--gray); font-size: 0.9rem; margin-top: 0.5rem;">Completa más tests para ver tu evolución</p>
                    </div>
                @endif

                <!-- CARRUSEL DE ARTÍCULOS (AHORA DENTRO DE LA MISMA TARJETA) -->
                @php
                    // Artículos según el tipo de test
                    $articles = [];
                    
                    if ($attempt->test_type === 'wellbeing') {
                        $articles = [
                            [
                                'title' => '10 hábitos diarios para mejorar tu bienestar emocional',
                                'excerpt' => 'Descubre pequeñas acciones que puedes implementar hoy para aumentar tu bienestar general.',
                                'category' => 'Bienestar',
                                'image_icon' => 'fa-smile',
                                'read_time' => '5 min',
                                'author' => 'Dra. María González',
                                'url' => '#'
                            ],
                            [
                                'title' => 'La ciencia de la felicidad: ¿Qué dice la investigación?',
                                'excerpt' => 'Conoce los hallazgos científicos más recientes sobre qué nos hace realmente felices.',
                                'category' => 'Psicología',
                                'image_icon' => 'fa-heart',
                                'read_time' => '8 min',
                                'author' => 'Dr. Carlos Ruiz',
                                'url' => '#'
                            ],
                            [
                                'title' => 'Mindfulness para principiantes: Guía paso a paso',
                                'excerpt' => 'Aprende técnicas sencillas de mindfulness que te ayudarán a reducir el estrés.',
                                'category' => 'Mindfulness',
                                'image_icon' => 'fa-brain',
                                'read_time' => '6 min',
                                'author' => 'Laura Martínez',
                                'url' => '#'
                            ]
                        ];
                    } elseif ($attempt->test_type === 'depression') {
                        $articles = [
                            [
                                'title' => 'Estrategias para manejar la depresión en el día a día',
                                'excerpt' => 'Consejos prácticos y herramientas para sobrellevar los síntomas depresivos.',
                                'category' => 'Depresión',
                                'image_icon' => 'fa-shield-heart',
                                'read_time' => '7 min',
                                'author' => 'Dr. Roberto Méndez',
                                'url' => '#'
                            ],
                            [
                                'title' => 'Terapia cognitivo-conductual para la depresión',
                                'excerpt' => 'Cómo la TCC puede ayudarte a identificar y cambiar patrones de pensamiento negativos.',
                                'category' => 'Terapia',
                                'image_icon' => 'fa-brain',
                                'read_time' => '10 min',
                                'author' => 'Psic. Patricia López',
                                'url' => '#'
                            ],
                            [
                                'title' => 'El ejercicio como antidepresivo natural',
                                'excerpt' => 'La ciencia detrás de cómo la actividad física puede mejorar tu estado de ánimo.',
                                'category' => 'Salud física',
                                'image_icon' => 'fa-person-running',
                                'read_time' => '5 min',
                                'author' => 'Dr. Javier Solís',
                                'url' => '#'
                            ]
                        ];
                    } else {
                        $articles = [
                            [
                                'title' => 'Técnicas de respiración para calmar la ansiedad',
                                'excerpt' => 'Ejercicios prácticos de respiración que puedes hacer en cualquier momento.',
                                'category' => 'Ansiedad',
                                'image_icon' => 'fa-lungs',
                                'read_time' => '3 min',
                                'author' => 'Lic. Ana Flores',
                                'url' => '#'
                            ],
                            [
                                'title' => 'Entendiendo los ataques de pánico: Síntomas y manejo',
                                'excerpt' => 'Qué sucede durante un ataque de pánico y estrategias para manejarlos.',
                                'category' => 'Pánico',
                                'image_icon' => 'fa-heart-crack',
                                'read_time' => '6 min',
                                'author' => 'Dr. Miguel Ángel',
                                'url' => '#'
                            ],
                            [
                                'title' => 'Mindfulness para la ansiedad: Ejercicios prácticos',
                                'excerpt' => 'Aprende a usar la atención plena para romper el ciclo de pensamientos ansiosos.',
                                'category' => 'Mindfulness',
                                'image_icon' => 'fa-feather',
                                'read_time' => '5 min',
                                'author' => 'Sofía Herrera',
                                'url' => '#'
                            ]
                        ];
                    }
                @endphp

                <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(77, 184, 168, 0.2);">
                    <div class="carousel-header" style="margin-bottom: 1rem;">
                        <div class="carousel-title">
                            <i class="fas fa-newspaper"></i>
                            <h3 style="font-size: 1.1rem;">Artículos relacionados</h3>
                        </div>
                        <div class="carousel-controls">
                            <button class="carousel-control" id="prevArticle">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-control" id="nextArticle">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="carousel-container" style="min-height: 160px;">
                        <div class="carousel-track" id="articleTrack">
                            @foreach ($articles as $article)
                                <div class="carousel-slide">
                                    <div class="article-card" style="flex-direction: row; background: rgba(255,255,255,0.7);">
                                        <div class="article-image" style="width: 100px; height: 100px;">
                                            <i class="fas {{ $article['image_icon'] }}" style="font-size: 2rem;"></i>
                                        </div>
                                        <div class="article-content" style="padding: 1rem;">
                                            <span class="article-category" style="font-size: 0.65rem;">{{ $article['category'] }}</span>
                                            <h4 class="article-title" style="font-size: 1rem; margin-bottom: 0.3rem;">{{ $article['title'] }}</h4>
                                            <div class="article-meta" style="font-size: 0.7rem; margin-bottom: 0.5rem;">
                                                <span><i class="fas fa-clock"></i> {{ $article['read_time'] }}</span>
                                                <span><i class="fas fa-user"></i> {{ $article['author'] }}</span>
                                            </div>
                                            <a href="{{ $article['url'] }}" class="article-btn" style="padding: 0.3rem 1rem; font-size: 0.75rem;">
                                                Leer <i class="fas fa-arrow-right" style="font-size: 0.6rem;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="carousel-indicators" id="carouselIndicators">
                        @foreach ($articles as $index => $article)
                            <div class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTONES DE ACCIÓN -->
        @php
            $nextRoute = null;
            $nextLabel = null;

            if ($attempt->test_type === 'wellbeing') {
                $nextRoute = route('test.depresion');
                $nextLabel = 'Test de Depresión';
            } elseif ($attempt->test_type === 'depression') {
                $nextRoute = route('test.ansiedad');
                $nextLabel = 'Test de Ansiedad';
            } elseif ($attempt->test_type === 'anxiety') {
                $nextRoute = route('dashboard.paciente');
                $nextLabel = 'Finalizar';
            }
        @endphp

        <div class="action-buttons">
            <a class="btn btn-secondary" href="{{ route('dashboard.paciente') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            @if ($nextRoute)
                <a class="btn btn-primary" href="{{ $nextRoute }}">
                    {{ $nextLabel }} <i class="fas fa-arrow-right"></i>
                </a>
            @endif
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Círculo de progreso
            const circleProgress = document.getElementById('scoreProgress');
            if (circleProgress) {
                const totalScore = {{ $attempt->score ?? 0 }};
                const maxScore =
                    {{ $attempt->test_type === 'wellbeing' ? 25 : ($attempt->test_type === 'depression' ? 27 : 21) }};
                const circumference = 2 * Math.PI * 60;
                const percentage = (totalScore / maxScore) * 100;
                const offset = circumference - (percentage / 100) * circumference;

                setTimeout(() => {
                    circleProgress.style.strokeDasharray = circumference;
                    circleProgress.style.strokeDashoffset = offset;
                }, 200);
            }

            // Gráfico
            @if (isset($chart) && !empty($chart['labels']) && !empty($chart['data']))
                const labels = @json($chart['labels']);
                const data = @json($chart['data']);
                const maxY =
                    {{ $attempt->test_type === 'wellbeing' ? 25 : ($attempt->test_type === 'depression' ? 27 : 21) }};

                const canvas = document.getElementById('evolutionChart');
                if (canvas && window.Chart) {
                    new Chart(canvas, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                borderColor: '{{ $ui['color'] ?? '#4db8a8' }}',
                                backgroundColor: 'rgba(77, 184, 168, 0.05)',
                                borderWidth: 2,
                                pointBackgroundColor: 'white',
                                pointBorderColor: '{{ $ui['color'] ?? '#4db8a8' }}',
                                pointBorderWidth: 1.5,
                                pointRadius: 3,
                                pointHoverRadius: 5,
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: 'white',
                                    titleColor: '#2c5f5d',
                                    bodyColor: '#5a7c7a',
                                    borderColor: 'rgba(77,184,168,0.2)',
                                    borderWidth: 1,
                                    padding: 8,
                                    displayColors: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: maxY,
                                    grid: { color: 'rgba(77,184,168,0.05)' },
                                    ticks: { stepSize: 5, color: '#5a7c7a', font: { size: 9 } }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { color: '#5a7c7a', font: { size: 9 }, maxRotation: 45 }
                                }
                            }
                        }
                    });
                }
            @endif

            // CARRUSEL AUTOMÁTICO
            const track = document.getElementById('articleTrack');
            const prevBtn = document.getElementById('prevArticle');
            const nextBtn = document.getElementById('nextArticle');
            const dots = document.querySelectorAll('.carousel-dot');
            
            if (track) {
                const slides = document.querySelectorAll('.carousel-slide');
                const slideCount = slides.length;
                let currentIndex = 0;
                let autoSlideInterval;

                // Función para actualizar el carrusel
                function updateCarousel(index) {
                    if (index < 0) index = slideCount - 1;
                    if (index >= slideCount) index = 0;
                    
                    track.style.transform = `translateX(-${index * 100}%)`;
                    
                    // Actualizar dots
                    dots.forEach((dot, i) => {
                        if (i === index) {
                            dot.classList.add('active');
                        } else {
                            dot.classList.remove('active');
                        }
                    });
                    
                    currentIndex = index;
                }

                // Event listeners para botones
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        updateCarousel(currentIndex - 1);
                        resetAutoSlide();
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        updateCarousel(currentIndex + 1);
                        resetAutoSlide();
                    });
                }

                // Event listeners para dots
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        updateCarousel(index);
                        resetAutoSlide();
                    });
                });

                // Auto-slide cada 6 segundos
                function startAutoSlide() {
                    autoSlideInterval = setInterval(() => {
                        updateCarousel(currentIndex + 1);
                    }, 6000);
                }

                function resetAutoSlide() {
                    clearInterval(autoSlideInterval);
                    startAutoSlide();
                }

                // Iniciar auto-slide
                startAutoSlide();

                // Pausar auto-slide cuando el mouse está sobre el carrusel
                const carousel = document.querySelector('.articles-carousel');
                if (carousel) {
                    carousel.addEventListener('mouseenter', () => {
                        clearInterval(autoSlideInterval);
                    });

                    carousel.addEventListener('mouseleave', () => {
                        startAutoSlide();
                    });
                }
            }
        });
    </script>
@endsection