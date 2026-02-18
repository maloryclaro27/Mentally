<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHQ-9 - Mentally</title>
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

        .question-period {
            color: #5a7c7a;
            font-size: 1rem;
            margin-top: 0.5rem;
            font-style: italic;
        }

        /* Opciones de respuesta PHQ-9 */
        .options-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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

        .option-frequency {
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

        /* Pregunta adicional de impacto funcional */
        .impact-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 50px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            margin-top: 2rem;
            display: none;
        }

        .impact-question {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.4rem;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
        }

        .impact-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        .impact-option {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 12px;
            padding: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .impact-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.1);
            border-color: rgba(77, 184, 168, 0.4);
        }

        .impact-option.selected {
            background: rgba(77, 184, 168, 0.1);
            border-color: #4db8a8;
        }

        @media (max-width: 768px) {
            .test-container {
                gap: 1rem;
            }

            .test-header,
            .carousel-container,

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

            .impact-options {
                grid-template-columns: 1fr;
            }

            .chart-legend {
                flex-direction: column;
                align-items: center;
                gap: 0.8rem;
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
                <i class="fas fa-stethoscope"></i>
                Mentally
            </div>
            <h1 class="test-title">Patient Health Questionnaire (PHQ-9)</h1>
            <p class="test-subtitle">
                Este cuestionario evalúa la presencia y severidad de síntomas depresivos
                durante las últimas 2 semanas. Es una herramienta validada internacionalmente
                para el screening de depresión.
            </p>

            <div class="test-instructions">
                <h3 class="instructions-title">
                    <i class="fas fa-info-circle"></i>
                    Instrucciones
                </h3>
                <ul class="instructions-list">
                    <li>Para cada pregunta, selecciona la respuesta que mejor describa cómo te has sentido en las
                        últimas 2 semanas</li>
                    <li>Considera la frecuencia con la que has experimentado cada síntoma</li>
                    <li>Responde todas las preguntas para obtener un resultado preciso</li>
                    <li>Tus respuestas son completamente confidenciales</li>
                </ul>
            </div>
        </div>

        <!-- Carrusel de preguntas PHQ-9 -->
        <div class="carousel-container" id="carouselContainer">
            <!-- Las preguntas se generarán dinámicamente con JavaScript -->
        </div>

        <!-- Pregunta adicional de impacto funcional -->
        <div class="impact-container" id="impactContainer">
            <h3 class="impact-question" id="impactQuestion"></h3>
            <div class="impact-options" id="impactOptions">
                <!-- Las opciones se generarán dinámicamente -->
            </div>
        </div>

        <!-- Botón de enviar -->
        <button type="button" class="submit-button" id="submitButton" disabled>
            <i class="fas fa-chart-bar"></i>
            Ver Resultados del PHQ-9
        </button>
    </div>

    <script>
        // Preguntas del test PHQ-9
        const phqQuestions = [{
                id: 1,
                text: "Poco interés o placer en hacer cosas",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 2,
                text: "Se ha sentido decaído(a), deprimido(a) o sin esperanzas",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 3,
                text: "Ha tenido dificultad para quedarse o permanecer dormido(a), o ha dormido demasiado",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 4,
                text: "Se ha sentido cansado(a) o con poca energía",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 5,
                text: "Tiene poco apetito o ha comido en exceso",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 6,
                text: "Se ha sentido mal con usted mismo(a) — o que es un fracaso o que ha quedado mal con usted mismo(a) o con su familia",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 7,
                text: "Ha tenido dificultad para concentrarse en cosas, tales como leer el periódico o ver la televisión",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 8,
                text: "¿Se ha movido o hablado tan lento que otras personas podrían haberlo notado? ¿O lo contrario — estar tan inquieto(a) o agitado(a) que se ha movido mucho más de lo acostumbrado?",
                period: "En las últimas 2 semanas..."
            },
            {
                id: 9,
                text: "Pensamientos de que estaría mejor muerto(a) o de lastimarse de alguna manera",
                period: "En las últimas 2 semanas..."
            }
        ];

        // Opciones de respuesta PHQ-9 (0-3 puntos)
        const phqOptions = [{
                value: 0,
                label: "Ningún día",
                frequency: "0 días"
            },
            {
                value: 1,
                label: "Varios días",
                frequency: "1-6 días"
            },
            {
                value: 2,
                label: "Más de la mitad de los días",
                frequency: "7-11 días"
            },
            {
                value: 3,
                label: "Casi todos los días",
                frequency: "12-14 días"
            }
        ];

        // Opciones para la pregunta adicional de impacto funcional
        const impactOptions = [{
                value: 0,
                label: "Nada difícil",
                description: "No interfiere"
            },
            {
                value: 1,
                label: "Algo difícil",
                description: "Interfiere ligeramente"
            },
            {
                value: 2,
                label: "Muy difícil",
                description: "Interfiere significativamente"
            },
            {
                value: 3,
                label: "Extremadamente difícil",
                description: "Interfiere severamente"
            }
        ];

        // Datos históricos para el gráfico (simulados)
        const historicalData = [{
                month: "May",
                score: 8
            },
            {
                month: "Jun",
                score: 10
            },
            {
                month: "Jul",
                score: 12
            },
            {
                month: "Aug",
                score: 15
            },
            {
                month: "Sep",
                score: 14
            },
            {
                month: "Oct",
                score: 16
            },
            {
                month: "Nov",
                score: 18
            },
            {
                month: "Dec",
                score: 16
            },
            {
                month: "2026",
                score: 14
            },
            {
                month: "Jan",
                score: 16
            }
        ];

        // Interpretaciones de resultados PHQ-9 - CON COLORES DE NUESTRA PALETA
        const phqInterpretations = [{
                minScore: 0,
                maxScore: 4,
                level: "Depresión Mínima",
                color: "#4db8a8", // Turquesa principal
                lightColor: "rgba(77, 184, 168, 0.1)",
                description: "Tu puntuación indica síntomas depresivos mínimos o ausentes. Es probable que no necesites tratamiento específico para la depresión en este momento.",
                recommendations: [
                    "Mantén hábitos de vida saludables",
                    "Practica actividades que disfrutes",
                    "Mantén conexiones sociales",
                    "Realiza ejercicio físico regular",
                    "Monitorea tu estado de ánimo periódicamente"
                ]
            },
            {
                minScore: 5,
                maxScore: 9,
                level: "Depresión Leve",
                color: "#8bd3c7", // Turquesa claro
                lightColor: "rgba(139, 211, 199, 0.1)",
                description: "Tu puntuación sugiere síntomas depresivos leves. Puedes beneficiarte de intervenciones psicoeducativas o apoyo psicológico.",
                recommendations: [
                    "Considera terapia psicológica de apoyo",
                    "Practica técnicas de mindfulness",
                    "Establece una rutina de sueño regular",
                    "Participa en actividades sociales",
                    "Considera seguimiento en 2-4 semanas"
                ]
            },
            {
                minScore: 10,
                maxScore: 14,
                level: "Depresión Moderada",
                color: "#c6e6e0", // Turquesa muy claro
                lightColor: "rgba(198, 230, 224, 0.1)",
                description: "Tu puntuación indica síntomas depresivos moderados. Se recomienda evaluación profesional y posible tratamiento.",
                recommendations: [
                    "Consulta con un profesional de salud mental",
                    "Considera terapia psicológica estructurada",
                    "Evalúa necesidad de tratamiento farmacológico",
                    "Establece un plan de autocuidado",
                    "Busca apoyo social y familiar"
                ]
            },
            {
                minScore: 15,
                maxScore: 19,
                level: "Depresión Moderadamente Severa",
                color: "#2c5f5d", // Verde oscuro
                lightColor: "rgba(44, 95, 93, 0.1)",
                description: "Tu puntuación sugiere síntomas depresivos moderadamente severos. Se recomienda evaluación profesional urgente.",
                recommendations: [
                    "Consulta inmediatamente con un profesional",
                    "Considera tratamiento combinado (psicoterapia + medicación)",
                    "Establece un plan de seguridad",
                    "Busca apoyo constante",
                    "Considera seguimiento frecuente"
                ]
            },
            {
                minScore: 20,
                maxScore: 27,
                level: "Depresión Severa",
                color: "#5a7c7a", // Verde grisáceo
                lightColor: "rgba(90, 124, 122, 0.1)",
                description: "Tu puntuación indica síntomas depresivos severos. Se requiere evaluación y tratamiento profesional inmediato.",
                recommendations: [
                    "Busca atención profesional inmediata",
                    "Considera evaluación psiquiátrica urgente",
                    "Desarrolla un plan de seguridad",
                    "No dejes de buscar ayuda",
                    "Considera hospitalización si hay ideación suicida"
                ]
            }
        ];

        // Estado de la aplicación
        let currentQuestion = 0;
        let answers = new Array(phqQuestions.length).fill(null);
        let impactAnswer = null;
        let totalScore = 0;

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            createCarousel();
            updateProgressDots();
            updateNavigation();
            updateSubmitButton();

            document.getElementById('submitButton').addEventListener('click', handleSubmitClick);

            // Configurar pregunta de impacto
            setupImpactQuestion();

        });

        // Crear carrusel de preguntas PHQ-9
        function createCarousel() {
            const container = document.getElementById('carouselContainer');
            container.innerHTML = '';

            phqQuestions.forEach((question, index) => {
                const slide = document.createElement('div');
                slide.className = `carousel-slide ${index === 0 ? 'active' : ''}`;
                slide.dataset.questionId = question.id;

                slide.innerHTML = `
                    <div class="question-number">
                        <div class="number-circle">${question.id}</div>
                        <h3 class="question-text">${question.text}</h3>
                    </div>
                    <p class="question-period">${question.period}</p>
                    <div class="options-container">
                        ${phqOptions.map(option => `
                                                                    <div class="option ${answers[index] === option.value ? 'selected' : ''}" 
                                                                         data-value="${option.value}"
                                                                         onclick="selectPHQOption(${index}, ${option.value})">
                                                                        <div class="option-value">${option.value}</div>
                                                                        <div class="option-label">${option.label}</div>
                                                                        <div class="option-frequency">${option.frequency}</div>
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

        // Seleccionar una opción PHQ-9
        window.selectPHQOption = function(questionIndex, value) {
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
            if (currentQuestion < phqQuestions.length - 1) {
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
            nextButton.disabled = currentQuestion === phqQuestions.length - 1;

            // Cambiar texto del último botón
            if (currentQuestion === phqQuestions.length - 1) {
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

            phqQuestions.forEach((_, index) => {
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

        // Configurar pregunta de impacto funcional
        function setupImpactQuestion() {
            const container = document.getElementById('impactContainer');
            const question = document.getElementById('impactQuestion');
            const options = document.getElementById('impactOptions');

            question.textContent =
                "Si has marcado algún problema, ¿qué tan difícil te han hecho estos problemas hacer tu trabajo, ocuparte de las cosas en casa o llevarte bien con otras personas?";

            options.innerHTML = impactOptions.map(option => `
                <div class="impact-option" data-value="${option.value}" onclick="selectImpactOption(${option.value})">
                    <div style="font-weight: 600; color: #2c5f5d; margin-bottom: 0.3rem;">${option.label}</div>
                    <div style="font-size: 0.9rem; color: #5a7c7a;">${option.description}</div>
                </div>
            `).join('');
        }

        // Seleccionar opción de impacto
        window.selectImpactOption = function(value) {
            impactAnswer = value;

            // Actualizar opciones
            const options = document.querySelectorAll('.impact-option');
            options.forEach(option => {
                option.classList.remove('selected');
                if (parseInt(option.dataset.value) === value) {
                    option.classList.add('selected');
                }
            });

            // Mostrar botón para ver resultados
            document.getElementById('submitButton').disabled = false;
            document.getElementById('submitButton').innerHTML =
                `<i class="fas fa-chart-bar"></i> Guardar y ver resultados`;
        };

        // Mostrar pregunta de impacto
        function showImpactQuestion() {
            // Verificar si todas las preguntas están respondidas
            const answeredCount = answers.filter(answer => answer !== null).length;
            if (answeredCount < phqQuestions.length) {
                alert('Por favor, responde todas las preguntas antes de continuar.');
                return;
            }

            // Mostrar pregunta de impacto
            document.getElementById('carouselContainer').style.display = 'none';
            document.getElementById('impactContainer').style.display = 'block';
            document.getElementById('submitButton').disabled = true;
            document.getElementById('submitButton').innerHTML = `<i class="fas fa-lock"></i> Selecciona una opción`;

            // Scroll a la pregunta de impacto
            document.getElementById('impactContainer').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function handleSubmitClick() {
            const answeredCount = answers.filter(a => a !== null).length;

            // Si no ha respondido todo, no debería poder (igual por seguridad)
            if (answeredCount < phqQuestions.length) {
                alert('Por favor, responde todas las preguntas antes de continuar.');
                return;
            }

            // Si aún no ha respondido impacto, mostramos esa pantalla
            if (impactAnswer === null) {
                showImpactQuestion();
                return;
            }

            // Ya hay impacto => guardamos el intento en backend
            submitAttempt();
        }

        function submitAttempt() {
            // Calcular puntuación total
            totalScore = answers.reduce((sum, answer) => sum + (answer || 0), 0);

            // Determinar interpretación
            const interpretation = phqInterpretations.find(int =>
                totalScore >= int.minScore && totalScore <= int.maxScore
            ) || phqInterpretations[0];

            // Payload para backend
            const payload = {
                score: totalScore,
                result: interpretation.level,
                answers: {
                    items: phqQuestions.map((q, idx) => ({
                        id: q.id,
                        text: q.text,
                        value: answers[idx]
                    })),
                    impactAnswer: impactAnswer
                }
            };

            // llenar inputs ocultos
            document.getElementById('phq9_score').value = payload.score;
            document.getElementById('phq9_result').value = payload.result;
            document.getElementById('phq9_answers').value = JSON.stringify(payload.answers);

            // enviar al backend
            document.getElementById('phq9SaveForm').submit();
        }


        // Actualizar botón de enviar
        function updateSubmitButton() {
            const answeredCount = answers.filter(answer => answer !== null).length;
            const submitButton = document.getElementById('submitButton');

            if (answeredCount === phqQuestions.length) {
                submitButton.disabled = false;
                submitButton.innerHTML = `<i class="fas fa-chart-bar"></i> Ver Resultados del PHQ-9`;
            } else {
                submitButton.disabled = true;
                submitButton.innerHTML = `<i class="fas fa-lock"></i> Responde todas las preguntas`;
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
        // DEBUG: confirmar que el click está llegando y cuántas respuestas hay
        document.getElementById('submitButton').addEventListener('click', function() {
            const answeredCount = answers.filter(a => a !== null).length;
            console.log('CLICK submitButton', {
                answeredCount,
                totalQuestions: phqQuestions.length,
                currentQuestion,
                answers
            });
        });
    </script>
    <form id="phq9SaveForm" method="POST" action="{{ route('test.depresion.submit') }}" style="display:none;">
        @csrf
        <input type="hidden" name="score" id="phq9_score">
        <input type="hidden" name="result" id="phq9_result">
        <input type="hidden" name="answers" id="phq9_answers">
    </form>

</body>
</html>