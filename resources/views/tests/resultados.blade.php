@extends('layouts.app')

@section('content')
<style>
    /* ===== ESTILOS COPIADOS EXACTAMENTE DEL TEST DE DEPRESIÓN ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #e0f7f4 0%, #d4f1f9 50%, #e8f5f3 100%);
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Partículas flotantes */
    .floating-particle {
        position: fixed;
        width: 6px;
        height: 6px;
        background: rgba(77, 184, 168, 0.3);
        border-radius: 50%;
        animation: floatParticle 8s ease-in-out infinite;
        z-index: 0;
        pointer-events: none;
    }

    @keyframes floatParticle {

        0%,
        100% {
            transform: translate(0, 0);
        }

        25% {
            transform: translate(10px, -8px);
        }

        50% {
            transform: translate(5px, 12px);
        }

        75% {
            transform: translate(-8px, 6px);
        }
    }

    /* Contenedor principal */
    .results-wrapper {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Header del test */
    .test-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 50px rgba(77, 184, 168, 0.15);
        border: 1px solid rgba(77, 184, 168, 0.1);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .test-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4db8a8, #5bc4b3);
        border-radius: 24px 24px 0 0;
    }

    .test-logo {
        font-family: 'Quicksand', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #2c5f5d, #4db8a8);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .test-logo i {
        font-size: 2.2rem;
        animation: gentleFloat 3s ease-in-out infinite;
    }

    @keyframes gentleFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .test-title {
        font-family: 'Quicksand', sans-serif;
        font-size: 2rem;
        color: #2c5f5d;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .test-subtitle {
        color: #5a7c7a;
        font-size: 1.1rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Resultados - Diseño Horizontal (igual que en test_depresion) */
    .results-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 50px rgba(77, 184, 168, 0.15);
        border: 1px solid rgba(77, 184, 168, 0.1);
        position: relative;
        overflow: hidden;
        animation: fadeIn 0.8s ease forwards;
    }

    .results-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4db8a8, #5bc4b3);
        border-radius: 24px 24px 0 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .results-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .results-title {
        font-family: 'Quicksand', sans-serif;
        font-size: 2.2rem;
        color: #2c5f5d;
        margin-bottom: 0.5rem;
    }

    .results-subtitle {
        color: #5a7c7a;
        font-size: 1.1rem;
    }

    /* Layout horizontal */
    .results-content {
        display: flex;
        gap: 2.5rem;
        align-items: flex-start;
    }

    /* Panel izquierdo - Gráfico de progreso */
    .progress-chart {
        flex: 1;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
        border: 1px solid rgba(77, 184, 168, 0.08);
    }

    .chart-header {
        margin-bottom: 2rem;
    }

    .chart-title {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.5rem;
        color: #2c5f5d;
        margin-bottom: 0.5rem;
    }

    .chart-subtitle {
        color: #5a7c7a;
        font-size: 1rem;
    }

    /* Gráfico de líneas */
    .line-chart {
        position: relative;
        height: 200px;
        margin: 2rem 0;
    }

    .chart-grid {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .grid-line {
        border-bottom: 1px solid rgba(77, 184, 168, 0.1);
    }

    .chart-labels-y {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding-right: 1rem;
        color: #5a7c7a;
        font-size: 0.9rem;
        text-align: right;
        width: 40px;
    }

    .chart-line {
        position: absolute;
        left: 50px;
        right: 0;
        top: 0;
        bottom: 0;
    }

    .chart-labels-x {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
        padding-left: 50px;
        color: #5a7c7a;
        font-size: 0.9rem;
    }

    /* Leyenda */
    .chart-legend {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #5a7c7a;
        font-size: 0.9rem;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    /* Panel derecho - Interpretación */
    .results-interpretation {
        flex: 1;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
        border: 1px solid rgba(77, 184, 168, 0.08);
    }

    .interpretation-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .interpretation-title {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.5rem;
        color: #2c5f5d;
        margin-bottom: 1rem;
    }

    /* Círculo de puntuación */
    .score-circle {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 0 auto 2rem;
    }

    .circle-bg {
        fill: none;
        stroke: rgba(77, 184, 168, 0.1);
        stroke-width: 10;
    }

    .circle-score {
        fill: none;
        stroke-width: 10;
        stroke-linecap: round;
        stroke-dasharray: 565;
        stroke-dashoffset: 565;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
        transition: stroke-dashoffset 1.5s ease;
    }

    .circle-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .circle-total {
        font-family: 'Quicksand', sans-serif;
        font-size: 3rem;
        font-weight: 700;
        color: #2c5f5d;
        line-height: 1;
    }

    .circle-max {
        color: #5a7c7a;
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    /* Nivel de resultado */
    .result-level {
        text-align: center;
        margin: 1.5rem 0;
        padding: 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .level-title {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.6rem;
        color: #2c5f5d;
        margin-bottom: 0.5rem;
    }

    .level-description {
        color: #5a7c7a;
        line-height: 1.6;
        font-size: 1rem;
    }

    /* Descripción y detalles */
    .result-description {
        margin-top: 1.5rem;
    }

    .result-text {
        color: #5a7c7a;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .result-details {
        background: rgba(77, 184, 168, 0.05);
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
    }

    .details-title {
        color: #2c5f5d;
        font-weight: 600;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .details-list {
        color: #5a7c7a;
        line-height: 1.6;
        margin: 0;
        padding-left: 1.5rem;
    }

    .details-list li {
        margin-bottom: 0.5rem;
    }

    .details-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #4db8a8;
        font-size: 1.2rem;
    }

    /* Impacto funcional (para depresión) */
    .impact-info {
        background: rgba(77, 184, 168, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 2rem;
        border-left: 4px solid #4db8a8;
    }

    .impact-title {
        color: #2c5f5d;
        font-weight: 600;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .impact-text {
        color: #5a7c7a;
        font-size: 1rem;
        line-height: 1.6;
    }

    /* Botones de acción */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 3rem;
        flex-wrap: wrap;
    }

    .action-button {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        text-decoration: none;
        border: none;
    }

    .dashboard-button {
        background: linear-gradient(135deg, #4db8a8, #5bc4b3);
        color: white;
    }

    .dashboard-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
    }

    .retake-button {
        background: transparent;
        color: #4db8a8;
        border: 2px solid #4db8a8;
    }

    .retake-button:hover {
        background: rgba(77, 184, 168, 0.1);
        transform: translateY(-3px);
    }

    /* Contenedor de respuestas (estilo tipo código) */
    .answers-container {
        background: #0b1220;
        color: #e5e7eb;
        border-radius: 12px;
        padding: 1rem;
        overflow: auto;
        font-size: 0.85rem;
        line-height: 1.5;
        max-height: 400px;
        font-family: 'Monaco', 'Menlo', monospace;
        border: 1px solid rgba(77, 184, 168, 0.2);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .results-content {
            flex-direction: column;
        }

        .progress-chart,
        .results-interpretation {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .results-wrapper {
            gap: 1rem;
            padding: 1rem;
        }

        .test-header,
        .results-container {
            padding: 1.5rem;
        }

        .test-logo {
            font-size: 2rem;
            flex-direction: column;
            gap: 0.5rem;
        }

        .test-title {
            font-size: 1.6rem;
        }

        .results-title {
            font-size: 1.8rem;
        }

        .chart-title,
        .interpretation-title {
            font-size: 1.3rem;
        }

        .score-circle {
            width: 150px;
            height: 150px;
        }

        .circle-total {
            font-size: 2.2rem;
        }

        .chart-labels-x {
            font-size: 0.8rem;
            padding-left: 40px;
        }

        .chart-labels-y {
            width: 30px;
            font-size: 0.8rem;
        }

        .chart-line {
            left: 40px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Partículas flotantes -->
<div class="floating-particle" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
<div class="floating-particle" style="top: 80%; right: 10%; animation-delay: 1s;"></div>
<div class="floating-particle" style="bottom: 20%; left: 15%; animation-delay: 2s;"></div>
<div class="floating-particle" style="top: 30%; right: 20%; animation-delay: 3s;"></div>

<div class="results-wrapper">
    <!-- Header -->
    <div class="test-header">
        <div class="test-logo">
            <i class="fas fa-clipboard-check"></i> Mentally
        </div>
        <h1 class="test-title">
            Resultados:
            <span style="color: #4db8a8;">
                @if($attempt->test_type === 'wellbeing')
                    Test de Bienestar (OMS-5)
                @elseif($attempt->test_type === 'depression')
                    Test de Depresión (PHQ-9)
                @else
                    Test de Ansiedad (GAD-7)
                @endif
            </span>
        </h1>
        <p class="test-subtitle">
            Fecha: {{ optional($attempt->taken_at)->format('d/m/Y H:i') }} |
            Puntuación: <strong>{{ $attempt->score ?? 'N/A' }}</strong> |
            Resultado: <strong>{{ $attempt->result ?? 'N/A' }}</strong>
        </p>
    </div>

    <!-- Resultados principales -->
    <div class="results-container" id="resultsContainer">
        <div class="results-header">
            <h2 class="results-title">
                @if($attempt->test_type === 'wellbeing')
                    Tu Nivel de Bienestar
                @elseif($attempt->test_type === 'depression')
                    Resultados del PHQ-9
                @else
                    Resultados del GAD-7
                @endif
            </h2>
            <p class="results-subtitle">
                @if($attempt->test_type === 'wellbeing')
                    Evaluación de bienestar subjetivo (OMS-5)
                @elseif($attempt->test_type === 'depression')
                    Evaluación de síntomas depresivos
                @else
                    Evaluación de síntomas de ansiedad
                @endif
            </p>
        </div>

        <div class="results-content">
            <!-- Panel izquierdo - Gráfico de progreso (solo para depresión) -->
            @if($attempt->test_type === 'depression' && isset($ui['historicalData']))
                <div class="progress-chart">
                    <div class="chart-header">
                        <h3 class="chart-title">Tu Progreso</h3>
                        <p class="chart-subtitle">Evolución de tu puntuación PHQ-9</p>
                    </div>

                    <!-- Gráfico de líneas -->
                    <div class="line-chart">
                        <div class="chart-grid">
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                        </div>
                        <div class="chart-labels-y">
                            <span>27</span>
                            <span>20</span>
                            <span>14</span>
                            <span>9</span>
                            <span>4</span>
                        </div>
                        <svg class="chart-line" viewBox="0 0 500 200" preserveAspectRatio="none" id="chartSvg">
                            <!-- La línea se dibujará con JS -->
                        </svg>
                    </div>
                    <div class="chart-labels-x" id="chartLabelsX">
                        <!-- Las etiquetas se llenarán con JS -->
                    </div>

                    <!-- Leyenda -->
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #4db8a8;"></div>
                            <span>Mínima (0-4)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #8bd3c7;"></div>
                            <span>Leve (5-9)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #c6e6e0;"></div>
                            <span>Moderada (10-14)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #2c5f5d;"></div>
                            <span>Mod. Severa (15-19)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #5a7c7a;"></div>
                            <span>Severa (20-27)</span>
                        </div>
                    </div>

                    <!-- Impacto funcional (si existe) -->
                    @if(isset($ui['impactText']))
                        <div class="impact-info">
                            <h4 class="impact-title">
                                <i class="fas fa-clipboard-check"></i> Impacto Funcional
                            </h4>
                            <p class="impact-text">{{ $ui['impactText'] }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Panel derecho - Interpretación (siempre visible) -->
            <div class="results-interpretation">
                <div class="interpretation-header">
                    <h3 class="interpretation-title">
                        @if($attempt->test_type === 'wellbeing')
                            Tu Puntuación OMS-5
                        @elseif($attempt->test_type === 'depression')
                            Tu Puntuación PHQ-9
                        @else
                            Tu Puntuación GAD-7
                        @endif
                    </h3>
                </div>

                <!-- Círculo de puntuación -->
                <div class="score-circle">
                    <svg width="200" height="200">
                        <circle class="circle-bg" cx="100" cy="100" r="90"></circle>
                        <circle class="circle-score" cx="100" cy="100" r="90"
                            style="stroke: {{ $ui['color'] ?? '#4db8a8' }};"></circle>
                    </svg>
                    <div class="circle-text">
                        <div class="circle-total">{{ $attempt->score ?? 0 }}</div>
                        <div class="circle-max">
                            @if($attempt->test_type === 'wellbeing')
                                de 25 puntos
                            @elseif($attempt->test_type === 'depression')
                                de 27 puntos
                            @else
                                de 21 puntos
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Nivel de resultado -->
                <div class="result-level"
                    style="background: {{ $ui['lightColor'] ?? 'rgba(77, 184, 168, 0.1)' }};
                           border: 1px solid {{ $ui['color'] ?? '#4db8a8' }}40;
                           color: {{ $ui['color'] ?? '#4db8a8' }};">
                    <div class="level-title">{{ $ui['level'] ?? $attempt->result }}</div>
                    <div class="level-description">Puntuación: {{ $attempt->score }}/{{ $attempt->test_type === 'wellbeing' ? 25 : ($attempt->test_type === 'depression' ? 27 : 21) }}</div>
                </div>

                <!-- Descripción -->
                <div class="result-description">
                    <p class="result-text">{{ $ui['description'] ?? '' }}</p>

                    <!-- Recomendaciones -->
                    @if(!empty($ui['recommendations']))
                        <div class="result-details">
                            <h5 class="details-title">
                                <i class="fas fa-heartbeat"></i> Recomendaciones
                            </h5>
                            <ul class="details-list">
                                @foreach($ui['recommendations'] as $rec)
                                    <li>{{ $rec }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Detalles específicos para ansiedad -->
                    @if($attempt->test_type === 'anxiety' && isset($ui['cutoffs']))
                        <div class="result-details" style="margin-top: 1rem;">
                            <h5 class="details-title">
                                <i class="fas fa-exclamation-triangle"></i> Puntos de corte clínicos
                            </h5>
                            <ul class="details-list">
                                <li><strong>{{ $ui['cutoffs']['classic'] }}</strong></li>
                                <li><strong>{{ $ui['cutoffs']['spanish'] }}</strong></li>
                            </ul>
                        </div>

                        @if(isset($ui['nextDays']))
                            <div class="result-details" style="margin-top: 1rem;">
                                <h5 class="details-title">
                                    <i class="fas fa-calendar-check"></i> Próxima evaluación
                                </h5>
                                <p class="impact-text">Evaluación recomendada en {{ $ui['nextDays'] }} días</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Respuestas detalladas (siempre visibles al final) -->
        @if(!empty($attempt->answers))
            <div style="margin-top: 2rem;">
                <h3 style="font-family: 'Quicksand', sans-serif; color: #2c5f5d; margin-bottom: 1rem;">
                    <i class="fas fa-list-check"></i> Respuestas registradas
                </h3>
                <div class="answers-container">
                    <pre style="margin: 0;">{{ json_encode($attempt->answers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>
        @endif
    </div>

    <!-- Botones de acción -->
    @php
        $nextRoute = null;
        $nextLabel = null;

        if ($attempt->test_type === 'wellbeing') {
            $nextRoute = route('test.depresion');
            $nextLabel = 'Siguiente test: Depresión';
        } elseif ($attempt->test_type === 'depression') {
            $nextRoute = route('test.ansiedad');
            $nextLabel = 'Siguiente test: Ansiedad';
        } elseif ($attempt->test_type === 'anxiety') {
            $nextRoute = route('dashboard.paciente');
            $nextLabel = 'Finalizar (volver al dashboard)';
        }
    @endphp

    <div class="action-buttons">
        <a class="action-button retake-button" href="{{ route('dashboard.paciente') }}">
            <i class="fas fa-home"></i> Volver al dashboard
        </a>

        @if($nextRoute)
            <a class="action-button dashboard-button" href="{{ $nextRoute }}">
                <i class="fas fa-arrow-right"></i> {{ $nextLabel }}
            </a>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar el círculo de progreso
        const circleScore = document.querySelector('.circle-score');
        if (circleScore) {
            const totalScore = {{ $attempt->score ?? 0 }};
            const maxScore = {{ $attempt->test_type === 'wellbeing' ? 25 : ($attempt->test_type === 'depression' ? 27 : 21) }};
            const circumference = 2 * Math.PI * 90; // r=90
            const percentage = (totalScore / maxScore) * 100;
            const offset = circumference - (percentage / 100) * circumference;
            circleScore.style.strokeDasharray = circumference;
            circleScore.style.strokeDashoffset = offset;
        }

        // Dibujar gráfico de líneas para depresión (si hay datos históricos)
        @if($attempt->test_type === 'depression' && isset($ui['historicalData']))
            renderChart(@json($ui['historicalData']));
        @endif
    });

    // Función para renderizar el gráfico (igual que en test_depresion)
    function renderChart(historicalData) {
        const svg = document.getElementById('chartSvg');
        if (!svg || !historicalData || historicalData.length === 0) return;

        const labelsX = document.getElementById('chartLabelsX');
        svg.innerHTML = '';

        const width = 500;
        const height = 200;
        const padding = 20;

        const maxScore = 27;
        const xScale = (width - padding * 2) / (historicalData.length - 1);
        const yScale = (height - padding * 2) / maxScore;

        let pathData = '';

        historicalData.forEach((data, index) => {
            const x = padding + index * xScale;
            const y = height - padding - (data.score * yScale);

            if (index === 0) {
                pathData += `M ${x} ${y} `;
            } else {
                pathData += `L ${x} ${y} `;
            }

            // Determinar color según nivel
            let pointColor = "#4db8a8";
            if (data.score <= 4) pointColor = "#4db8a8";
            else if (data.score <= 9) pointColor = "#8bd3c7";
            else if (data.score <= 14) pointColor = "#c6e6e0";
            else if (data.score <= 19) pointColor = "#2c5f5d";
            else pointColor = "#5a7c7a";

            // Agregar punto
            const point = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            point.setAttribute('cx', x);
            point.setAttribute('cy', y);
            point.setAttribute('r', '6');
            point.setAttribute('fill', 'white');
            point.setAttribute('stroke', pointColor);
            point.setAttribute('stroke-width', '2');
            point.setAttribute('class', 'chart-point');
            svg.appendChild(point);
        });

        // Crear línea
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d', pathData);
        path.setAttribute('fill', 'none');
        path.setAttribute('stroke', '#4db8a8');
        path.setAttribute('stroke-width', '3');
        path.setAttribute('stroke-linecap', 'round');
        path.setAttribute('stroke-linejoin', 'round');
        svg.appendChild(path);

        // Actualizar etiquetas X
        labelsX.innerHTML = '';
        historicalData.forEach(data => {
            const label = document.createElement('div');
            label.textContent = data.month;
            labelsX.appendChild(label);
        });
    }
</script>
@endsection