@extends('layouts.app')

@section('content')
    <style>
        .results-wrapper {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f7f4 0%, #d4f1f9 50%, #e8f5f3 100%);
            padding: 24px 12px;
        }

        .card {
            max-width: 1100px;
            margin: 0 auto;
            background: rgba(255, 255, 255, .95);
            border: 1px solid rgba(77, 184, 168, .1);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(77, 184, 168, .15);
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
        }

        .card-inner {
            padding: 28px;
        }

        .title {
            font-family: 'Quicksand', sans-serif;
            font-size: 28px;
            color: #2c5f5d;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #5a7c7a;
            margin-bottom: 18px;
        }

        .meta {
            color: #5a7c7a;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .results-content {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        .panel {
            flex: 1;
            background: rgba(255, 255, 255, .9);
            border: 1px solid rgba(77, 184, 168, .08);
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 10px 30px rgba(77, 184, 168, .1);
        }

        .interpretation-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 20px;
            color: #2c5f5d;
            text-align: center;
            margin-bottom: 14px;
        }

        .percentage-circle {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 18px;
        }

        .circle-bg {
            fill: none;
            stroke: rgba(77, 184, 168, .12);
            stroke-width: 10;
        }

        .circle-progress {
            fill: none;
            stroke: #4db8a8;
            stroke-width: 10;
            stroke-linecap: round;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
            transition: stroke-dashoffset 1s ease;
        }

        .circle-text {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .circle-percentage {
            font-family: 'Quicksand', sans-serif;
            font-size: 46px;
            font-weight: 700;
            color: #2c5f5d;
            line-height: 1;
        }

        .circle-label {
            color: #5a7c7a;
            margin-top: 6px;
        }

        .result-level {
            font-family: 'Quicksand', sans-serif;
            font-size: 24px;
            color: #2c5f5d;
            text-align: center;
            margin: 8px 0 10px;
        }

        .result-text {
            color: #5a7c7a;
            line-height: 1.6;
            text-align: center;
        }

        .details {
            background: rgba(77, 184, 168, .06);
            border-radius: 12px;
            padding: 16px;
            margin-top: 16px;
        }

        .details-title {
            color: #2c5f5d;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .details-list {
            color: #5a7c7a;
            line-height: 1.6;
            margin: 0;
            padding-left: 18px;
        }

        .details-list li {
            margin-bottom: 6px;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        .btn {
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2c5f5d, #4db8a8);
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #4db8a8;
            color: #4db8a8;
        }

        .btn-primary:hover,
        .btn-outline:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 900px) {
            .results-content {
                flex-direction: column;
            }

            .percentage-circle {
                width: 160px;
                height: 160px;
            }
        }
    </style>

    <div class="results-wrapper">
        <div class="card">
            <div class="card-inner">
                <div>
                    <div class="title">
                        Resultados del test:
                        <span class="capitalize">
                            {{ $attempt->test_type === 'wellbeing' ? 'Bienestar' : ($attempt->test_type === 'depression' ? 'Depresión' : 'Ansiedad') }}
                        </span>
                    </div>
                    <div class="subtitle">Detalle del chequeo guardado (revisitable)</div>
                    <div class="meta">
                        Fecha: {{ optional($attempt->taken_at)->format('Y-m-d H:i') }}
                        · Score: <strong>{{ $attempt->score ?? 'N/A' }}</strong>
                        · Resultado: <strong>{{ $attempt->result ?? 'N/A' }}</strong>
                    </div>
                </div>

                {{-- Bienestar: UI bonita igual a la anterior --}}
                @if ($attempt->test_type === 'wellbeing' && $ui)
                    @php
                        $circumference = 2 * pi() * 90; // r=90
                        $offset = $circumference - ($ui['percentage'] / 100) * $circumference;
                    @endphp

                    <div class="results-content">
                        <div class="panel">
                            <div class="interpretation-title">¿Qué significan tus resultados?</div>

                            <div class="percentage-circle">
                                <svg width="200" height="200" viewBox="0 0 200 200">
                                    <circle class="circle-bg" cx="100" cy="100" r="90"></circle>
                                    <circle class="circle-progress" cx="100" cy="100" r="90"
                                        style="stroke-dasharray: {{ $circumference }}; stroke-dashoffset: {{ $offset }};">
                                    </circle>
                                </svg>

                                <div class="circle-text">
                                    <div class="circle-percentage">{{ $ui['percentage'] }}%</div>
                                    <div class="circle-label">{{ $ui['label_date'] }}</div>
                                </div>
                            </div>

                            <div class="result-level">{{ $ui['level'] }}</div>
                            <div class="result-text">{{ $ui['description'] }}</div>

                            <div class="details">
                                <div class="details-title">
                                    <i class="fas fa-lightbulb"></i> Recomendaciones
                                </div>
                                <ul class="details-list">
                                    @foreach ($ui['recommendations'] as $rec)
                                        <li>{{ $rec }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="interpretation-title">Respuestas (guardadas)</div>
                            @if (!empty($attempt->answers))
                                <pre
                                    style="background:#0b1220;color:#e5e7eb;border-radius:12px;padding:14px;overflow:auto;font-size:13px;line-height:1.5;">{{ json_encode($attempt->answers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            @else
                                <div class="subtitle">No hay respuestas registradas.</div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Depresión: UI bonita --}}
                @if ($attempt->test_type === 'depression' && $ui)
                    @php
                        $circumference = 2 * pi() * 90;
                        $offset = $circumference - ($ui['percentage'] / 100) * $circumference;
                    @endphp

                    <div class="results-content">
                        <div class="panel">
                            <div class="interpretation-title">Tu Puntuación PHQ-9</div>

                            <div class="percentage-circle">
                                <svg width="200" height="200" viewBox="0 0 200 200">
                                    <circle class="circle-bg" cx="100" cy="100" r="90"></circle>
                                    <circle class="circle-progress" cx="100" cy="100" r="90"
                                        style="stroke: {{ $ui['color'] }};
                               stroke-dasharray: {{ $circumference }};
                               stroke-dashoffset: {{ $offset }};">
                                    </circle>
                                </svg>

                                <div class="circle-text">
                                    <div class="circle-percentage">{{ $ui['score'] }}</div>
                                    <div class="circle-label">de 27 puntos</div>
                                </div>
                            </div>

                            <div class="result-level"
                                style="background: {{ $ui['lightColor'] }};
                       border:1px solid {{ $ui['color'] }}40;
                       color: {{ $ui['color'] }};">
                                {{ $ui['level'] }}
                            </div>

                            <div class="result-text">{{ $ui['description'] }}</div>

                            @if ($ui['impactText'])
                                <div class="details" style="margin-top:20px;">
                                    <div class="details-title">
                                        <i class="fas fa-clipboard-check"></i> Impacto Funcional
                                    </div>
                                    <p style="color:#5a7c7a;">{{ $ui['impactText'] }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="panel">
                            <div class="interpretation-title">Respuestas registradas</div>

                            @if (!empty($attempt->answers))
                                <pre
                                    style="background:#0b1220;color:#e5e7eb;border-radius:12px;padding:14px;overflow:auto;font-size:13px;line-height:1.5;">{{ json_encode($attempt->answers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            @else
                                <div class="subtitle">No hay respuestas registradas.</div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Ansiedad: UI bonita --}}
                @if ($attempt->test_type === 'anxiety' && $ui)
                    @php
                        $circumference = 2 * pi() * 90; // r=90
                        $offset = $circumference - ($ui['percentage'] / 100) * $circumference;
                    @endphp

                    <div class="results-content">
                        <!-- Interpretación -->
                        <div class="panel">
                            <div class="interpretation-title">Tu Puntuación GAD-7</div>

                            <div class="percentage-circle">
                                <svg width="200" height="200" viewBox="0 0 200 200">
                                    <circle class="circle-bg" cx="100" cy="100" r="90"></circle>
                                    <circle class="circle-progress" cx="100" cy="100" r="90"
                                        style="stroke: {{ $ui['color'] }};
                               stroke-dasharray: {{ $circumference }};
                               stroke-dashoffset: {{ $offset }};">
                                    </circle>
                                </svg>

                                <div class="circle-text">
                                    <div class="circle-percentage">{{ $ui['score'] }}</div>
                                    <div class="circle-label">de 21 puntos</div>
                                </div>
                            </div>

                            <div class="result-level"
                                style="background: {{ $ui['lightColor'] }};
                       border:1px solid {{ $ui['color'] }}40;
                       color: {{ $ui['color'] }};">
                                {{ $ui['level'] }}
                            </div>

                            <div class="result-text">{{ $ui['description'] }}</div>

                            <div class="details" style="margin-top:16px;">
                                <div class="details-title">
                                    <i class="fas fa-calendar-check"></i> Próxima evaluación recomendada
                                </div>
                                <p style="color:#5a7c7a; margin:0;">
                                    Evaluación recomendada en {{ $ui['nextDays'] }} días
                                </p>
                            </div>

                            <div class="details" style="margin-top:16px;">
                                <div class="details-title">
                                    <i class="fas fa-exclamation-triangle"></i> Puntos de corte clínicos
                                </div>
                                <ul class="details-list" style="margin-top:10px;">
                                    <li><strong>{{ $ui['cutoffs']['classic'] }}</strong></li>
                                    <li><strong>{{ $ui['cutoffs']['spanish'] }}</strong></li>
                                </ul>
                            </div>

                            <div class="details" style="margin-top:16px;">
                                <div class="details-title">
                                    <i class="fas fa-lightbulb"></i> Recomendaciones
                                </div>
                                <ul class="details-list">
                                    @foreach ($ui['recommendations'] as $rec)
                                        <li>{{ $rec }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Respuestas -->
                        <div class="panel">
                            <div class="interpretation-title">Respuestas registradas</div>
                            @if (!empty($attempt->answers))
                                <pre
                                    style="background:#0b1220;color:#e5e7eb;border-radius:12px;padding:14px;overflow:auto;font-size:13px;line-height:1.5;">{{ json_encode($attempt->answers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            @else
                                <div class="subtitle">No hay respuestas registradas.</div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Fallback: si por alguna razón no existe $ui, muestra al menos el JSON --}}
                @if (empty($ui))
                    <div class="panel">
                        <div class="interpretation-title">Detalle guardado</div>
                        @if (!empty($attempt->answers))
                            <pre
                                style="background:#0b1220;color:#e5e7eb;border-radius:12px;padding:14px;overflow:auto;font-size:13px;line-height:1.5;">{{ json_encode($attempt->answers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        @else
                            <div class="subtitle">No hay respuestas registradas.</div>
                        @endif
                    </div>
                @endif

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

                <div class="actions">
                    <a class="btn btn-outline" href="{{ route('dashboard.paciente') }}">
                        <i class="fas fa-home"></i> Volver al dashboard
                    </a>

                    @if ($nextRoute)
                        <a class="btn btn-primary" href="{{ $nextRoute }}">
                            <i class="fas fa-arrow-right"></i> {{ $nextLabel }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
