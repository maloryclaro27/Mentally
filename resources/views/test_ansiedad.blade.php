<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test GAD-7 - Mentally</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f7f4 0%, #d4f1f9 50%, #e8f5f3 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            padding: 1rem;
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
        .test-container {
            width: 100%;
            max-width: 1200px;
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
            margin-bottom: 1.5rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .test-instructions {
            background: rgba(77, 184, 168, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            text-align: left;
            border-left: 4px solid #4db8a8;
        }

        .instructions-title {
            color: #2c5f5d;
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .instructions-title i {
            color: #4db8a8;
        }

        .instructions-list {
            color: #5a7c7a;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .instructions-list li {
            margin-bottom: 0.5rem;
            margin-left: 1.5rem;
        }

        /* Carrusel de preguntas */
        .carousel-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 50px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            position: relative;
            overflow: hidden;
            min-height: 500px;
            display: flex;
            flex-direction: column;
        }

        .carousel-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 20px 20px 0 0;
        }

        .carousel-slide {
            display: none;
            animation: fadeIn 0.6s ease forwards;
        }

        .carousel-slide.active {
            display: block;
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

        .question-number {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .number-circle {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.3rem;
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.3);
        }

        .question-text {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.6rem;
            color: #2c5f5d;
            line-height: 1.4;
        }

        .question-description {
            color: #5a7c7a;
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            font-style: italic;
        }

        /* Opciones de respuesta para GAD-7 (0-3 puntos) */
        .options-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }

        .option {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .option:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.15);
            border-color: rgba(77, 184, 168, 0.4);
        }

        .option.selected {
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.1));
            border-color: #4db8a8;
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.2);
        }

        .option-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #4db8a8;
            margin-bottom: 0.8rem;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
        }

        .option.selected .option-value {
            background: #4db8a8;
            color: white;
            transform: scale(1.1);
        }

        .option-label {
            font-size: 1.1rem;
            color: #2c5f5d;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .option-description {
            font-size: 0.9rem;
            color: #5a7c7a;
            line-height: 1.4;
        }

        /* Navegación del carrusel */
        .carousel-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(77, 184, 168, 0.1);
        }

        .carousel-button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: transparent;
            color: #4db8a8;
            border: 2px solid #4db8a8;
        }

        .carousel-button:hover:not(:disabled) {
            background: rgba(77, 184, 168, 0.1);
            transform: translateX(-3px);
        }

        .carousel-button.next {
            margin-left: auto;
        }

        .carousel-button.next:hover:not(:disabled) {
            transform: translateX(3px);
        }

        .carousel-button:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Indicador de progreso */
        .progress-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin: 0 1rem;
        }

        .progress-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(77, 184, 168, 0.2);
            transition: all 0.3s ease;
        }

        .progress-dot.active {
            background: #4db8a8;
            transform: scale(1.2);
        }

        .progress-dot.completed {
            background: #4db8a8;
        }

        /* Botón de enviar */
        .submit-button {
            background: linear-gradient(135deg, #2c5f5d, #4db8a8);
            color: white;
            padding: 1.2rem 3rem;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem auto 0;
            position: relative;
            overflow: hidden;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .submit-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(44, 95, 93, 0.3);
        }

        .submit-button:disabled {
            background: rgba(90, 124, 122, 0.3);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Resultados - Diseño Horizontal */
        .results-container {
            display: none;
            animation: fadeIn 0.8s ease forwards;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 50px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            position: relative;
            overflow: hidden;
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

        /* Gráfico de progreso */
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

        /* Gráfico de líneas para GAD-7 (0-21 puntos) */
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

        .chart-path {
            fill: none;
            stroke: #4db8a8;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
            filter: drop-shadow(0 4px 8px rgba(77, 184, 168, 0.3));
        }

        .chart-point {
            fill: white;
            stroke: #4db8a8;
            stroke-width: 2;
            r: 6;
            transition: all 0.3s ease;
        }

        .chart-point:hover {
            r: 8;
            fill: #4db8a8;
        }

        .chart-labels-x {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            padding-left: 50px;
            color: #5a7c7a;
            font-size: 0.9rem;
        }

        /* Leyenda del gráfico adaptada para GAD-7 */
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

        .legend-severe {
            background: #ff6b6b;
        }

        .legend-moderate {
            background: #ffd166;
        }

        .legend-mild {
            background: #8bd3c7;
        }

        .legend-minimal {
            background: #c6e6e0;
        }

        /* Información de próximo chequeo */
        .checkup-info {
            background: rgba(77, 184, 168, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            border-left: 4px solid #4db8a8;
        }

        .checkup-title {
            color: #2c5f5d;
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .checkup-text {
            color: #5a7c7a;
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Interpretación de resultados */
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

        /* Círculo de porcentaje para GAD-7 (0-21 puntos) */
        .percentage-circle {
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

        .circle-progress {
            fill: none;
            stroke: #4db8a8;
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

        .circle-percentage {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c5f5d;
            line-height: 1;
        }

        .circle-label {
            color: #5a7c7a;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        /* Descripción de resultados */
        .result-description {
            margin-top: 2rem;
        }

        .result-level {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            color: #2c5f5d;
            margin-bottom: 1rem;
            text-align: center;
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
        }

        .details-list li {
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .details-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #4db8a8;
            font-size: 1.2rem;
        }

        /* Información de puntos de corte GAD-7 */
        .cutoff-info {
            background: rgba(255, 107, 107, 0.05);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            border-left: 4px solid #ff6b6b;
        }

        .cutoff-title {
            color: #d64545;
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            .test-container {
                gap: 1rem;
            }

            .test-header,
            .carousel-container,
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

            .test-subtitle {
                font-size: 1rem;
            }

            .question-text {
                font-size: 1.3rem;
            }

            .options-container {
                grid-template-columns: 1fr;
            }

            .option {
                padding: 1.2rem;
            }

            .results-title {
                font-size: 1.8rem;
            }

            .chart-title,
            .interpretation-title {
                font-size: 1.3rem;
            }

            .percentage-circle {
                width: 150px;
                height: 150px;
            }

            .circle-percentage {
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
        }

        @media (max-width: 480px) {
            .test-logo {
                font-size: 1.8rem;
            }

            .test-title {
                font-size: 1.4rem;
            }

            .carousel-container {
                padding: 1.2rem;
            }

            .question-text {
                font-size: 1.2rem;
            }

            .option-label {
                font-size: 1rem;
            }

            .results-container {
                padding: 1rem;
            }

            .results-title {
                font-size: 1.6rem;
            }

            .carousel-navigation {
                flex-direction: column;
                gap: 1rem;
            }

            .carousel-button {
                width: 100%;
                justify-content: center;
            }

            .progress-indicator {
                order: -1;
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
</head>

<body>
    <!-- Partículas flotantes -->
    <div class="floating-particle" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
    <div class="floating-particle" style="top: 80%; right: 10%; animation-delay: 1s;"></div>
    <div class="floating-particle" style="bottom: 20%; left: 15%; animation-delay: 2s;"></div>
    <div class="floating-particle" style="top: 30%; right: 20%; animation-delay: 3s;"></div>

    <!-- Contenedor principal -->
    <div class="test-container">
        <!-- Header del test -->
        <div class="test-header">
            <div class="test-logo">
                <i class="fas fa-brain"></i>
                Mentally
            </div>
            <h1 class="test-title">Evaluación de Ansiedad Generalizada (GAD-7)</h1>
            <p class="test-subtitle">
                El Cuestionario de Ansiedad Generalizada (GAD-7) es una herramienta validada para evaluar
                síntomas de ansiedad durante las últimas dos semanas. Basado en el trabajo de Spitzer,
                Kroenke, Williams y Löwe (2006).
            </p>

            <div class="test-instructions">
                <h3 class="instructions-title">
                    <i class="fas fa-info-circle"></i>
                    Instrucciones
                </h3>
                <ul class="instructions-list">
                    <li>Para cada pregunta, seleccione la opción que mejor describa <strong>cómo se ha sentido durante
                            las últimas dos semanas</strong></li>
                    <li>No hay respuestas correctas o incorrectas - sea lo más honesto posible</li>
                    <li>El test toma aproximadamente 2-3 minutos en completarse</li>
                    <li>Sus respuestas son completamente confidenciales</li>
                </ul>
            </div>
        </div>

        <!-- Carrusel de preguntas -->
        <div class="carousel-container" id="carouselContainer">
            <!-- Las preguntas se generarán dinámicamente con JavaScript -->
        </div>

        <!-- Botón de enviar -->
        <button class="submit-button" id="submitButton" disabled>
            <i class="fas fa-paper-plane"></i>
            Ver Mis Resultados GAD-7
        </button>

        <!-- Resultados -->
        <div class="results-container" id="resultsContainer">
            <div class="results-header">
                <h2 class="results-title">Resultados GAD-7</h2>
                <p class="results-subtitle">Evaluación de síntomas de ansiedad generalizada</p>
            </div>

            <div class="results-content">
                <!-- Gráfico de progreso -->
                <div class="progress-chart">
                    <div class="chart-header">
                        <h3 class="chart-title">Tu Progreso en Ansiedad</h3>
                        <p class="chart-subtitle">Evolución de tu nivel de ansiedad (puntuación GAD-7)</p>
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
                            <span>21</span>
                            <span>15</span>
                            <span>10</span>
                            <span>5</span>
                            <span>0</span>
                        </div>

                        <svg class="chart-line" id="chartLine" viewBox="0 0 500 200" preserveAspectRatio="none">
                            <!-- La línea del gráfico se generará dinámicamente -->
                        </svg>
                    </div>

                    <div class="chart-labels-x" id="chartLabelsX">
                        <!-- Los meses se generarán dinámicamente -->
                    </div>

                    <!-- Leyenda adaptada para GAD-7 -->
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color legend-minimal"></div>
                            <span>Mínima (0-4)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-mild"></div>
                            <span>Leve (5-9)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-moderate"></div>
                            <span>Moderada (10-14)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-severe"></div>
                            <span>Grave (15-21)</span>
                        </div>
                    </div>

                    <!-- Información de próximo chequeo -->
                    <div class="checkup-info">
                        <h4 class="checkup-title">
                            <i class="fas fa-calendar-check"></i>
                            Próxima Evaluación Recomendada
                        </h4>
                        <p class="checkup-text" id="nextCheckup">Evaluación recomendada en 30 días</p>
                    </div>
                </div>

                <!-- Interpretación de resultados -->
                <div class="results-interpretation">
                    <div class="interpretation-header">
                        <h3 class="interpretation-title">Interpretación GAD-7</h3>
                    </div>

                    <!-- Círculo de porcentaje -->
                    <div class="percentage-circle">
                        <svg width="200" height="200">
                            <circle class="circle-bg" cx="100" cy="100" r="90"></circle>
                            <circle class="circle-progress" cx="100" cy="100" r="90"></circle>
                        </svg>
                        <div class="circle-text">
                            <div class="circle-percentage" id="anxietyScore">0</div>
                            <div class="circle-label">Puntuación GAD-7</div>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="result-description">
                        <h4 class="result-level" id="resultLevel">Ansiedad mínima</h4>
                        <p class="result-text" id="resultDescription">
                            Tu puntuación indica un nivel mínimo de síntomas de ansiedad.
                        </p>

                        <!-- Información de puntos de corte según el documento -->
                        <div class="cutoff-info">
                            <h5 class="cutoff-title">
                                <i class="fas fa-exclamation-triangle"></i>
                                Puntos de Corte Clínicos
                            </h5>
                            <ul class="details-list">
                                <li><strong>≥ 10 puntos</strong>: Posible trastorno de ansiedad (Sensibilidad .87;
                                    Especificidad .78)</li>
                                <li><strong>≥ 8 puntos</strong> (versión española): Posible trastorno de ansiedad
                                    (Sensibilidad .93; Especificidad .85)</li>
                            </ul>
                        </div>

                        <div class="result-details">
                            <h5 class="details-title">
                                <i class="fas fa-lightbulb"></i>
                                Recomendaciones
                            </h5>
                            <ul class="details-list" id="recommendationsList">
                                <!-- Las recomendaciones se generarán dinámicamente -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="action-buttons">
                <button class="action-button dashboard-button" id="dashboardButton">
                    <i class="fas fa-home"></i>
                    Ir al Dashboard
                </button>
                <button class="action-button retake-button" id="retakeButton">
                    <i class="fas fa-redo"></i>
                    Realizar Test Nuevamente
                </button>
            </div>
        </div>
    </div>

    <script>
        // Preguntas del test GAD-7 según el documento
        const questions = [{
                id: 1,
                text: "Sentirse nervioso/a, angustiado/a o muy tenso/a",
                description: "En los últimos 14 días..."
            },
            {
                id: 2,
                text: "Ser incapaz de dejar de preocuparse o de controlar la preocupación",
                description: "En los últimos 14 días..."
            },
            {
                id: 3,
                text: "Preocuparse demasiado por diferentes cuestiones",
                description: "En los últimos 14 días..."
            },
            {
                id: 4,
                text: "Tener problemas para relajarse",
                description: "En los últimos 14 días..."
            },
            {
                id: 5,
                text: "Estar tan inquieto/a que le resulta difícil permanecer sentado/a",
                description: "En los últimos 14 días..."
            },
            {
                id: 6,
                text: "Enfadarse o irritarse con facilidad",
                description: "En los últimos 14 días..."
            },
            {
                id: 7,
                text: "Sentir miedo de que algo terrible pueda ocurrir",
                description: "En los últimos 14 días..."
            }
        ];

        // Opciones de respuesta GAD-7 (0-3 puntos)
        const options = [{
                value: 0,
                label: "No, en absoluto",
                description: "0 días"
            },
            {
                value: 1,
                label: "Algunos días",
                description: "1-7 días"
            },
            {
                value: 2,
                label: "Más de la mitad de los días",
                description: "8-11 días"
            },
            {
                value: 3,
                label: "Casi todos los días",
                description: "12-14 días"
            }
        ];

        // Datos históricos para el gráfico (simulados para GAD-7)
        const historicalData = [{
                month: "May",
                score: 4
            },
            {
                month: "Jun",
                score: 6
            },
            {
                month: "Jul",
                score: 8
            },
            {
                month: "Aug",
                score: 10
            },
            {
                month: "Sep",
                score: 9
            },
            {
                month: "Oct",
                score: 7
            },
            {
                month: "Nov",
                score: 8
            },
            {
                month: "Dec",
                score: 6
            },
            {
                month: "Ene",
                score: 5
            }
        ];

        // Interpretaciones de resultados GAD-7 según el documento
        const interpretations = [{
                minScore: 0,
                maxScore: 4,
                level: "Ansiedad mínima",
                description: "Tu puntuación indica un nivel mínimo de síntomas de ansiedad. Esto sugiere que no presentas signos significativos de ansiedad generalizada.",
                cutoffInfo: "Por debajo del punto de corte clínico.",
                recommendations: [
                    "Mantén tus hábitos saludables actuales",
                    "Practica técnicas de relajación preventivas",
                    "Monitorea tu bienestar emocional regularmente",
                    "Mantén un equilibrio entre trabajo y vida personal",
                    "Realiza actividad física regular"
                ],
                color: "#c6e6e0"
            },
            {
                minScore: 5,
                maxScore: 9,
                level: "Ansiedad leve",
                description: "Tu puntuación indica síntomas leves de ansiedad. Puedes estar experimentando cierta inquietud o preocupación, pero generalmente manejable.",
                cutoffInfo: "Por debajo del punto de corte clínico, pero monitorear.",
                recommendations: [
                    "Practica técnicas de respiración profunda diariamente",
                    "Establece una rutina de sueño consistente",
                    "Reduce el consumo de cafeína y estimulantes",
                    "Practica mindfulness o meditación 10 min/día",
                    "Habla con amigos o familiares sobre tus preocupaciones"
                ],
                color: "#8bd3c7"
            },
            {
                minScore: 10,
                maxScore: 14,
                level: "Ansiedad moderada",
                description: "Tu puntuación indica síntomas moderados de ansiedad. Es recomendable considerar una evaluación profesional.",
                cutoffInfo: "Por encima del punto de corte clínico (≥10). Considerar evaluación profesional.",
                recommendations: [
                    "Consulta con un profesional de salud mental",
                    "Considera terapia cognitivo-conductual (TCC)",
                    "Establece límites saludables en tus responsabilidades",
                    "Practica ejercicio físico regularmente",
                    "Lleva un diario de pensamientos ansiosos"
                ],
                color: "#ffd166"
            },
            {
                minScore: 15,
                maxScore: 21,
                level: "Ansiedad grave",
                description: "Tu puntuación indica síntomas graves de ansiedad. Se recomienda evaluación profesional urgente.",
                cutoffInfo: "Muy por encima del punto de corte clínico. Evaluación profesional recomendada.",
                recommendations: [
                    "Consulta urgentemente con un profesional de salud mental",
                    "Considera opciones de tratamiento profesional",
                    "Establece una red de apoyo con familiares y amigos",
                    "Evita el aislamiento social",
                    "Sigue un plan de tratamiento profesional"
                ],
                color: "#ff6b6b"
            }
        ];

        // Estado de la aplicación
        let currentQuestion = 0;
        let answers = new Array(questions.length).fill(null);
        let totalScore = 0;

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            createCarousel();
            updateProgressDots();
            updateNavigation();
            updateSubmitButton();

            // Configurar eventos
            document.getElementById('submitButton').addEventListener('click', showResults);
            document.getElementById('retakeButton').addEventListener('click', resetTest);
            document.getElementById('dashboardButton').addEventListener('click', goToDashboard);

            // Inicializar gráfico
            renderChart();
        });

        // Crear carrusel de preguntas
        function createCarousel() {
            const container = document.getElementById('carouselContainer');
            container.innerHTML = '';

            questions.forEach((question, index) => {
                const slide = document.createElement('div');
                slide.className = `carousel-slide ${index === 0 ? 'active' : ''}`;
                slide.dataset.questionId = question.id;

                slide.innerHTML = `
                    <div class="question-number">
                        <div class="number-circle">${question.id}</div>
                        <h3 class="question-text">${question.text}</h3>
                    </div>
                    <p class="question-description">${question.description}</p>
                    <div class="options-container">
                        ${options.map(option => `
                                        <div class="option ${answers[index] === option.value ? 'selected' : ''}" 
                                             data-value="${option.value}"
                                             onclick="selectOption(${index}, ${option.value})">
                                            <div class="option-value">${option.value}</div>
                                            <div class="option-label">${option.label}</div>
                                            <div class="option-description">${option.description}</div>
                                        </div>
                                    `).join('')}
                    </div>
                `;

                container.appendChild(slide);
            });

            // Agregar navegación
            const navigation = document.createElement('div');
            navigation.className = 'carousel-navigation';
            navigation.innerHTML = `
                <button class="carousel-button prev" onclick="previousQuestion()" disabled>
                    <i class="fas fa-arrow-left"></i>
                    Pregunta Anterior
                </button>
                <div class="progress-indicator" id="progressIndicator"></div>
                <button class="carousel-button next" onclick="nextQuestion()">
                    Siguiente Pregunta
                    <i class="fas fa-arrow-right"></i>
                </button>
            `;
            container.appendChild(navigation);
        }

        // Seleccionar una opción
        window.selectOption = function(questionIndex, value) {
            answers[questionIndex] = value;

            // Actualizar la opción seleccionada
            const slide = document.querySelector(`.carousel-slide[data-question-id="${questionIndex + 1}"]`);
            const options = slide.querySelectorAll('.option');
            options.forEach(option => {
                option.classList.remove('selected');
                if (parseInt(option.dataset.value) === value) {
                    option.classList.add('selected');
                }
            });

            updateProgressDots();
            updateNavigation();
            updateSubmitButton();
        };

        // Navegar a la siguiente pregunta
        window.nextQuestion = function() {
            if (currentQuestion < questions.length - 1) {
                changeQuestion(currentQuestion + 1);
            }
        };

        // Navegar a la pregunta anterior
        window.previousQuestion = function() {
            if (currentQuestion > 0) {
                changeQuestion(currentQuestion - 1);
            }
        };

        // Cambiar pregunta
        function changeQuestion(index) {
            // Ocultar pregunta actual
            const currentSlide = document.querySelector('.carousel-slide.active');
            if (currentSlide) {
                currentSlide.classList.remove('active');
            }

            // Mostrar nueva pregunta
            const slides = document.querySelectorAll('.carousel-slide');
            if (slides[index]) {
                slides[index].classList.add('active');
                currentQuestion = index;
            }

            updateNavigation();
        }

        // Actualizar navegación
        function updateNavigation() {
            const prevButton = document.querySelector('.carousel-button.prev');
            const nextButton = document.querySelector('.carousel-button.next');

            prevButton.disabled = currentQuestion === 0;
            nextButton.disabled = currentQuestion === questions.length - 1;

            // Cambiar texto del último botón
            if (currentQuestion === questions.length - 1) {
                nextButton.style.display = 'none';
            } else {
                nextButton.style.display = 'flex';
            }
        }

        // Actualizar puntos de progreso
        function updateProgressDots() {
            const indicator = document.getElementById('progressIndicator');
            if (!indicator) return;

            indicator.innerHTML = '';

            questions.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = 'progress-dot';

                if (index === currentQuestion) {
                    dot.classList.add('active');
                } else if (answers[index] !== null) {
                    dot.classList.add('completed');
                }

                dot.onclick = () => changeQuestion(index);
                indicator.appendChild(dot);
            });
        }

        // Actualizar botón de enviar
        function updateSubmitButton() {
            const answeredCount = answers.filter(answer => answer !== null).length;
            const submitButton = document.getElementById('submitButton');

            submitButton.disabled = answeredCount < questions.length;

            if (answeredCount === questions.length) {
                submitButton.innerHTML = `<i class="fas fa-paper-plane"></i> Ver Mis Resultados GAD-7`;
            } else {
                submitButton.innerHTML =
                    `<i class="fas fa-lock"></i> Completa todas las preguntas (${answeredCount}/${questions.length})`;
            }
        }

        // Mostrar resultados
        function showResults() {
            // Calcular puntuación total GAD-7 (0-21)
            totalScore = answers.reduce((sum, answer) => sum + (answer || 0), 0);

            // Determinar interpretación
            const interpretation = interpretations.find(int =>
                totalScore >= int.minScore && totalScore <= int.maxScore
            ) || interpretations[0];

            // Actualizar elementos de resultados
            document.getElementById('anxietyScore').textContent = totalScore;
            document.getElementById('resultLevel').textContent = interpretation.level;
            document.getElementById('resultDescription').textContent = interpretation.description;

            // Actualizar lista de recomendaciones
            const recommendationsList = document.getElementById('recommendationsList');
            recommendationsList.innerHTML = interpretation.recommendations.map(rec =>
                `<li>${rec}</li>`
            ).join('');

            // Actualizar círculo de progreso (0-21 puntos)
            const circleProgress = document.querySelector('.circle-progress');
            const circumference = 2 * Math.PI * 90;
            const scorePercentage = (totalScore / 21) * 100;
            const offset = circumference - (scorePercentage / 100) * circumference;
            circleProgress.style.strokeDashoffset = offset;

            // Cambiar color del círculo según la severidad
            circleProgress.style.stroke = interpretation.color;

            // Actualizar gráfico con nuevo dato
            historicalData[historicalData.length - 1].score = totalScore;
            renderChart();

            // Actualizar próximo chequeo según severidad
            let nextDays;
            if (totalScore >= 15) {
                nextDays = 7; // Grave: revisar en 7 días
            } else if (totalScore >= 10) {
                nextDays = 14; // Moderada: revisar en 14 días
            } else {
                nextDays = 30; // Leve/mínima: revisar en 30 días
            }
            document.getElementById('nextCheckup').textContent = `Evaluación recomendada en ${nextDays} días`;

            // Mostrar resultados y ocultar preguntas
            document.getElementById('carouselContainer').style.display = 'none';
            document.getElementById('submitButton').style.display = 'none';
            document.getElementById('resultsContainer').style.display = 'block';

            // Guardar payload para enviar al backend
            window.gad7Payload = {
                score: totalScore,
                result: interpretation.level,
                answers: {
                    items: questions.map((q, idx) => ({
                        id: q.id,
                        text: q.text,
                        value: answers[idx]
                    }))
                }
            };


            // Scroll a resultados
            document.getElementById('resultsContainer').scrollIntoView({
                behavior: 'smooth'
            });

            // Mostrar alerta si puntuación es alta
            if (totalScore >= 10) {
                setTimeout(() => {
                    alert(
                        `Importante: Tu puntuación GAD-7 de ${totalScore} puntos sugiere posible ansiedad clínicamente significativa.\n\nConsidera consultar con un profesional de salud mental para una evaluación completa.`
                    );
                }, 500);
            }
        }

        // Renderizar gráfico
        function renderChart() {
            const svg = document.getElementById('chartLine');
            const labelsX = document.getElementById('chartLabelsX');

            // Limpiar SVG
            svg.innerHTML = '';

            // Configurar dimensiones
            const width = 500;
            const height = 200;
            const padding = 20;

            // Calcular escalas para GAD-7 (0-21 puntos)
            const maxScore = 21;
            const xScale = (width - padding * 2) / (historicalData.length - 1);
            const yScale = (height - padding * 2) / maxScore;

            // Crear línea
            let pathData = '';
            historicalData.forEach((data, index) => {
                const x = padding + index * xScale;
                const y = height - padding - (data.score * yScale);

                if (index === 0) {
                    pathData += `M ${x} ${y} `;
                } else {
                    pathData += `L ${x} ${y} `;
                }

                // Determinar color del punto según severidad
                let pointColor = '#4db8a8';
                if (data.score >= 15) pointColor = '#ff6b6b';
                else if (data.score >= 10) pointColor = '#ffd166';
                else if (data.score >= 5) pointColor = '#8bd3c7';

                // Agregar punto
                const point = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                point.setAttribute('class', 'chart-point');
                point.setAttribute('cx', x);
                point.setAttribute('cy', y);
                point.setAttribute('data-score', data.score);
                point.setAttribute('data-month', data.month);
                point.setAttribute('title', `${data.month}: ${data.score} puntos (GAD-7)`);
                point.style.stroke = pointColor;
                svg.appendChild(point);
            });

            // Crear camino
            const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('class', 'chart-path');
            path.setAttribute('d', pathData);
            svg.appendChild(path);

            // Actualizar etiquetas
            labelsX.innerHTML = '';
            historicalData.forEach(data => {
                const label = document.createElement('div');
                label.textContent = data.month;
                labelsX.appendChild(label);
            });
        }

        // Reiniciar test
        function resetTest() {
            // Resetear estado
            currentQuestion = 0;
            answers = new Array(questions.length).fill(null);
            totalScore = 0;

            // Mostrar preguntas y ocultar resultados
            document.getElementById('carouselContainer').style.display = 'flex';
            document.getElementById('submitButton').style.display = 'flex';
            document.getElementById('resultsContainer').style.display = 'none';

            // Recrear carrusel
            createCarousel();
            updateProgressDots();
            updateNavigation();
            updateSubmitButton();

            // Scroll al inicio
            document.querySelector('.test-header').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Ir al dashboard
        function goToDashboard() {
            if (!window.gad7Payload) {
                alert('Primero debes completar el test para guardar los resultados.');
                return;
            }

            // llenar inputs ocultos
            document.getElementById('gad7_score').value = window.gad7Payload.score;
            document.getElementById('gad7_result').value = window.gad7Payload.result;
            document.getElementById('gad7_answers').value = JSON.stringify(window.gad7Payload.answers);

            // enviar al backend
            document.getElementById('gad7SaveForm').submit();
        }


        // Añadir keyframes para animaciones
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                to {
                    opacity: 0;
                    transform: translateY(-30px);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    <form id="gad7SaveForm" method="POST" action="{{ route('test.ansiedad.submit') }}" style="display:none;">
        @csrf
        <input type="hidden" name="score" id="gad7_score">
        <input type="hidden" name="result" id="gad7_result">
        <input type="hidden" name="answers" id="gad7_answers">
    </form>
</body>

</html>
