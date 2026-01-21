<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de Bienestar - Mentally</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(10px, -8px); }
            50% { transform: translate(5px, 12px); }
            75% { transform: translate(-8px, 6px); }
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
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
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
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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

        /* Opciones de respuesta */
        .options-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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

        /* Leyenda del gráfico */
        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
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

        .legend-high { background: #4db8a8; }
        .legend-medium { background: #8bd3c7; }
        .legend-low { background: #c6e6e0; }

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

        /* Círculo de porcentaje */
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
            font-size: 3rem;
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

            .test-header, .carousel-container, .results-container {
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

            .chart-title, .interpretation-title {
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
            
            <h1 class="test-title">Descubre tu Nivel de Bienestar Actual</h1>
            <p class="test-subtitle">
                El Test OMS-5 de la Organización Mundial de la Salud evalúa tu bienestar subjetivo 
                durante las últimas dos semanas. Tus respuestas nos ayudarán a comprender mejor tu 
                estado emocional actual.
            </p>
            
            <div class="test-instructions">
                <h3 class="instructions-title">
                    <i class="fas fa-info-circle"></i>
                    Instrucciones
                </h3>
                <ul class="instructions-list">
                    <li>Responde cada pregunta seleccionando la opción que mejor describa cómo te has sentido en las últimas dos semanas</li>
                    <li>No hay respuestas correctas o incorrectas - sé lo más honesto posible</li>
                    <li>El test toma aproximadamente 3-5 minutos en completarse</li>
                    <li>Tus respuestas son completamente confidenciales</li>
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
            Ver Mis Resultados
        </button>

        <!-- Resultados -->
        <div class="results-container" id="resultsContainer">
            <div class="results-header">
                <h2 class="results-title">Tus Resultados de Bienestar</h2>
                <p class="results-subtitle">Resumen de tu progreso y nivel actual de bienestar</p>
            </div>

            <div class="results-content">
                <!-- Gráfico de progreso -->
                <div class="progress-chart">
                    <div class="chart-header">
                        <h3 class="chart-title">Tu Progreso</h3>
                        <p class="chart-subtitle">Así ha evolucionado tu nivel de bienestar</p>
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
                            <span>Alto</span>
                            <span>Mod</span>
                            <span>Bajo</span>
                        </div>

                        <svg class="chart-line" id="chartLine" viewBox="0 0 500 200" preserveAspectRatio="none">
                            <!-- La línea del gráfico se generará dinámicamente -->
                        </svg>
                    </div>

                    <div class="chart-labels-x" id="chartLabelsX">
                        <!-- Los meses se generarán dinámicamente -->
                    </div>

                    <!-- Leyenda -->
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color legend-high"></div>
                            <span>Alto (18-25)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-medium"></div>
                            <span>Moderado (14-17)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color legend-low"></div>
                            <span>Bajo (0-13)</span>
                        </div>
                    </div>

                    <!-- Información de próximo chequeo -->
                    <div class="checkup-info">
                        <h4 class="checkup-title">
                            <i class="fas fa-calendar-check"></i>
                            Próximo Chequeo
                        </h4>
                        <p class="checkup-text" id="nextCheckup">Nos vemos en 13d para tu próximo chequeo</p>
                    </div>
                </div>

                <!-- Interpretación de resultados -->
                <div class="results-interpretation">
                    <div class="interpretation-header">
                        <h3 class="interpretation-title">¿Qué significan tus resultados?</h3>
                    </div>

                    <!-- Círculo de porcentaje -->
                    <div class="percentage-circle">
                        <svg width="200" height="200">
                            <circle class="circle-bg" cx="100" cy="100" r="90"></circle>
                            <circle class="circle-progress" cx="100" cy="100" r="90"></circle>
                        </svg>
                        <div class="circle-text">
                            <div class="circle-percentage" id="wellnessPercentage">8%</div>
                            <div class="circle-label">enero 2026</div>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="result-description">
                        <h4 class="result-level" id="resultLevel">Bienestar general bajo</h4>
                        <p class="result-text" id="resultDescription">
                            Tu puntuación indica un nivel bajo de bienestar general. Es posible que últimamente 
                            hayas estado lidiando con emociones negativas, sintiendo una falta de satisfacción 
                            en varios aspectos.
                        </p>

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
                    Coninúa con el siguiente test
                </button>
                <button class="action-button retake-button" id="retakeButton">
                    <i class="fas fa-redo"></i>
                    Realizar Test Nuevamente
                </button>
            </div>
        </div>
    </div>

    <script>
        // Preguntas del test OMS-5
        const questions = [
            {
                id: 1,
                text: "Me he sentido alegre y de buen humor",
                description: "En las últimas dos semanas..."
            },
            {
                id: 2,
                text: "Me he sentido calmado y relajado",
                description: "En las últimas dos semanas..."
            },
            {
                id: 3,
                text: "Me he sentido activo y enérgico",
                description: "En las últimas dos semanas..."
            },
            {
                id: 4,
                text: "Me he despertado sintiéndome fresco y descansado",
                description: "En las últimas dos semanas..."
            },
            {
                id: 5,
                text: "Mi vida diaria ha estado llena de cosas que me interesan",
                description: "En las últimas dos semanas..."
            }
        ];

        // Opciones de respuesta (0-5 puntos)
        const options = [
            { value: 0, label: "En ningún momento", description: "0% del tiempo" },
            { value: 1, label: "Algunas veces", description: "Menos del 25% del tiempo" },
            { value: 2, label: "Menos de la mitad del tiempo", description: "25-49% del tiempo" },
            { value: 3, label: "Más de la mitad del tiempo", description: "50-75% del tiempo" },
            { value: 4, label: "La mayor parte del tiempo", description: "76-99% del tiempo" },
            { value: 5, label: "Todo el tiempo", description: "100% del tiempo" }
        ];

        // Datos históricos para el gráfico (simulados)
        const historicalData = [
            { month: "May", score: 18 },
            { month: "Jun", score: 16 },
            { month: "Jul", score: 14 },
            { month: "Aug", score: 12 },
            { month: "Sep", score: 10 },
            { month: "Oct", score: 8 },
            { month: "Nov", score: 9 },
            { month: "Dec", score: 8 },
            { month: "2026", score: 8 },
            { month: "Jan", score: 8 }
        ];

        // Interpretaciones de resultados
        const interpretations = [
            {
                minScore: 0,
                maxScore: 13,
                level: "Bienestar general bajo",
                description: "Tu puntuación indica un nivel bajo de bienestar general. Es posible que últimamente hayas estado lidiando con emociones negativas, sintiendo una falta de satisfacción en varios aspectos.",
                recommendations: [
                    "Programa una consulta con un profesional de salud mental",
                    "Practica 10 minutos de meditación diaria",
                    "Mantén un diario emocional para registrar tus sentimientos",
                    "Establece una rutina de sueño consistente",
                    "Conecta con amigos o familiares regularmente"
                ],
                color: "#c6e6e0"
            },
            {
                minScore: 14,
                maxScore: 17,
                level: "Bienestar moderado",
                description: "Tu puntuación indica un bienestar moderado. Puedes estar experimentando algunos desafíos emocionales, pero generalmente te sientes equilibrado.",
                recommendations: [
                    "Explora ejercicios de respiración profunda",
                    "Incorpora actividad física regular a tu rutina",
                    "Practica la gratitud diariamente",
                    "Establece límites saludables en tus relaciones",
                    "Dedica tiempo a actividades que disfrutes"
                ],
                color: "#8bd3c7"
            },
            {
                minScore: 18,
                maxScore: 25,
                level: "Bienestar general alto",
                description: "¡Excelente! Tu puntuación indica un alto nivel de bienestar. Te sientes positivo, energético y satisfecho con tu vida.",
                recommendations: [
                    "Mantén un equilibrio entre trabajo y vida personal",
                    "Explora nuevas actividades o hobbies",
                    "Comparte tu bienestar ayudando a otros",
                    "Continúa con tus prácticas de autocuidado",
                    "Establece metas personales para seguir creciendo"
                ],
                color: "#4db8a8"
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
                submitButton.innerHTML = `<i class="fas fa-paper-plane"></i> Ver Mis Resultados`;
            } else {
                submitButton.innerHTML = `<i class="fas fa-lock"></i> Completa todas las preguntas`;
            }
        }

        // Mostrar resultados
        function showResults() {
            // Calcular puntuación total
            totalScore = answers.reduce((sum, answer) => sum + (answer || 0), 0);
            
            // Determinar interpretación
            const interpretation = interpretations.find(int => 
                totalScore >= int.minScore && totalScore <= int.maxScore
            ) || interpretations[0];
            
            // Calcular porcentaje de bienestar (0-25 a 0-100%)
            const wellnessPercentage = Math.round((totalScore / 25) * 100);
            
            // Actualizar elementos de resultados
            document.getElementById('wellnessPercentage').textContent = `${wellnessPercentage}%`;
            document.getElementById('resultLevel').textContent = interpretation.level;
            document.getElementById('resultDescription').textContent = interpretation.description;
            
            // Actualizar lista de recomendaciones
            const recommendationsList = document.getElementById('recommendationsList');
            recommendationsList.innerHTML = interpretation.recommendations.map(rec => 
                `<li>${rec}</li>`
            ).join('');
            
            // Actualizar círculo de progreso
            const circleProgress = document.querySelector('.circle-progress');
            const circumference = 2 * Math.PI * 90;
            const offset = circumference - (wellnessPercentage / 100) * circumference;
            circleProgress.style.strokeDashoffset = offset;
            
            // Actualizar gráfico con nuevo dato
            historicalData[historicalData.length - 1].score = totalScore;
            renderChart();
            
            // Actualizar próximo chequeo (aleatorio entre 7-30 días)
            const nextDays = Math.floor(Math.random() * 23) + 7;
            document.getElementById('nextCheckup').textContent = `Nos vemos en ${nextDays}d para tu próximo chequeo`;
            
            // Mostrar resultados y ocultar preguntas
            document.getElementById('carouselContainer').style.display = 'none';
            document.getElementById('submitButton').style.display = 'none';
            document.getElementById('resultsContainer').style.display = 'block';
            
            // Efecto de confeti para celebrar
            createConfetti();
            
            // Scroll a resultados
            document.getElementById('resultsContainer').scrollIntoView({ behavior: 'smooth' });
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
            
            // Calcular escalas
            const maxScore = 25;
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
                
                // Agregar punto
                const point = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                point.setAttribute('class', 'chart-point');
                point.setAttribute('cx', x);
                point.setAttribute('cy', y);
                point.setAttribute('data-score', data.score);
                point.setAttribute('data-month', data.month);
                point.setAttribute('title', `${data.month}: ${data.score} puntos`);
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
            document.querySelector('.test-header').scrollIntoView({ behavior: 'smooth' });
        }

        // Ir al dashboard
        function goToDashboard() {
            // Animación de salida
            document.querySelector('.test-container').style.animation = 'fadeOut 0.6s ease forwards';
            
            setTimeout(() => {
                alert('Redirigiendo al dashboard...');
                // En producción, redirigiría a la página real del dashboard
                // window.location.href = '/dashboard';
            }, 600);
        }

        // Efecto de confeti
        function createConfetti() {
            const colors = ['#4db8a8', '#5bc4b3', '#2c5f5d', '#5a7c7a'];
            
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'floating-particle';
                confetti.style.width = `${Math.random() * 8 + 4}px`;
                confetti.style.height = confetti.style.width;
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.position = 'fixed';
                confetti.style.left = `${Math.random() * 100}vw`;
                confetti.style.top = '-20px';
                confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
                confetti.style.zIndex = '2';
                
                document.body.appendChild(confetti);
                
                // Remover después de la animación
                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
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
            @keyframes fall {
                0% {
                    transform: translateY(0) rotate(0deg);
                    opacity: 1;
                }
                100% {
                    transform: translateY(100vh) rotate(720deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>