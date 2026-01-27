<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diario Emocional - Mentally</title>
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
            overflow-x: hidden;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(77, 184, 168, 0.2);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #128674d5;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: #2c5f5d;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #4db8a8;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.8rem;
            border-radius: 25px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            border: none;
        }

        .btn-login {
            background: transparent;
            color: #4db8a8;
            border: 2px solid #4db8a8;
        }

        .btn-login:hover {
            background: #4db8a8;
            color: white;
            transform: translateY(-2px);
        }

        /* Contenedor principal */
        .diary-container {
            max-width: 1200px;
            margin: 100px auto 0;
            padding: 2rem;
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2.5rem;
        }

        /* Sección de escritura */
        .writing-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: fadeInUp 0.6s ease;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(77, 184, 168, 0.1);
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c5f5d;
        }

        .current-date {
            color: #5a7c7a;
            font-size: 1rem;
            background: rgba(77, 184, 168, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 10px;
        }

        /* Área de escritura */
        .writing-area {
            position: relative;
            margin-bottom: 2rem;
        }

        .writing-textarea {
            width: 100%;
            min-height: 300px;
            padding: 1.5rem;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            color: #2c5f5d;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 15px;
            resize: vertical;
            transition: all 0.3s ease;
        }

        .writing-textarea:focus {
            outline: none;
            border-color: #4db8a8;
            box-shadow: 0 0 0 3px rgba(77, 184, 168, 0.1);
        }

        .writing-textarea::placeholder {
            color: #9bb5b3;
            font-style: italic;
        }

        .writing-tips {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .tip-bubble {
            background: rgba(77, 184, 168, 0.1);
            color: #4db8a8;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tip-bubble:hover {
            background: rgba(77, 184, 168, 0.2);
            transform: translateY(-2px);
        }

        /* Selector de estado de ánimo */
        .mood-selector {
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            border: 1px solid rgba(77, 184, 168, 0.1);
        }

        .mood-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 1rem;
        }

        .mood-options {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }

        .mood-option {
            flex: 1;
            text-align: center;
            padding: 1rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.5);
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mood-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .mood-option.selected {
            border-color: #4db8a8;
            background: rgba(77, 184, 168, 0.1);
            transform: translateY(-5px);
        }

        .mood-emoji {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .mood-label {
            font-size: 0.9rem;
            color: #5a7c7a;
            font-weight: 500;
        }

        /* Botones de acción */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-save {
            flex: 1;
            padding: 1rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
        }

        .btn-analyze {
            flex: 1;
            padding: 1rem;
            background: transparent;
            color: #4db8a8;
            border: 2px solid #4db8a8;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-analyze:hover {
            background: rgba(77, 184, 168, 0.1);
            transform: translateY(-3px);
        }

        /* Panel lateral */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Tarjeta de estadísticas */
        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: fadeInUp 0.6s ease 0.2s backwards;
        }

        .stats-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            border-radius: 12px;
            background: rgba(77, 184, 168, 0.05);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(77, 184, 168, 0.1);
            transform: translateY(-2px);
        }

        .stat-value {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #4db8a8;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #5a7c7a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Gráfico de emociones */
        .emotion-chart {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: fadeInUp 0.6s ease 0.4s backwards;
        }

        .chart-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .chart-container {
            height: 200px;
            position: relative;
            display: flex;
            align-items: flex-end;
            gap: 0.5rem;
            padding: 1rem;
        }

        .chart-bar {
            flex: 1;
            background: linear-gradient(to top, #4db8a8, #5bc4b3);
            border-radius: 8px 8px 0 0;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .chart-bar:hover {
            opacity: 0.8;
            transform: scaleY(1.05);
        }

        .chart-bar-label {
            position: absolute;
            bottom: -25px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.8rem;
            color: #5a7c7a;
            font-weight: 500;
        }

        /* Entradas recientes */
        .recent-entries {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: fadeInUp 0.6s ease 0.6s backwards;
        }

        .entries-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .entries-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .entry-item {
            padding: 1rem;
            background: rgba(77, 184, 168, 0.05);
            border-radius: 12px;
            border-left: 4px solid #4db8a8;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .entry-item:hover {
            background: rgba(77, 184, 168, 0.1);
            transform: translateX(5px);
        }

        .entry-date {
            font-size: 0.8rem;
            color: #5a7c7a;
            margin-bottom: 0.5rem;
        }

        .entry-preview {
            font-size: 0.9rem;
            color: #2c5f5d;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Modal de análisis */
        .analysis-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .analysis-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 600px;
            border-radius: 20px;
            padding: 3rem;
            position: relative;
            transform: translateY(30px);
            transition: transform 0.3s ease;
        }

        .analysis-modal.active .modal-content {
            transform: translateY(0);
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #5a7c7a;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            color: #4db8a8;
            transform: rotate(90deg);
        }

        .modal-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .analysis-result {
            text-align: center;
            margin: 2rem 0;
        }

        .result-emoji {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: block;
        }

        .result-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1rem;
        }

        .result-description {
            color: #5a7c7a;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .result-stats {
            display: flex;
            justify-content: space-around;
            gap: 1rem;
            margin: 2rem 0;
        }

        .result-stat {
            text-align: center;
            padding: 1rem;
            border-radius: 12px;
            background: rgba(77, 184, 168, 0.1);
        }

        .stat-percentage {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #4db8a8;
            margin-bottom: 0.5rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        /* Elementos decorativos */
        .floating-element {
            position: absolute;
            opacity: 0.1;
            z-index: 0;
            pointer-events: none;
        }

        .element-1 {
            top: 10%;
            right: 5%;
            font-size: 8rem;
            color: #4db8a8;
            animation: gentleFloat 15s ease-in-out infinite;
        }

        .element-2 {
            bottom: 20%;
            left: 5%;
            font-size: 6rem;
            color: #5bc4b3;
            animation: gentleFloat 20s ease-in-out infinite reverse;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(20px, -15px) rotate(5deg); }
            50% { transform: translate(10px, 20px) rotate(-3deg); }
            75% { transform: translate(-15px, 10px) rotate(2deg); }
        }

        /* Responsive */
        @media (max-width: 968px) {
            .diary-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .sidebar {
                order: -1;
            }

            .mood-options {
                flex-wrap: wrap;
            }

            .mood-option {
                flex: 1 0 calc(50% - 0.5rem);
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            nav {
                padding: 1rem 1.5rem;
            }

            .diary-container {
                padding: 1rem;
                margin-top: 80px;
            }

            .writing-section,
            .stats-card,
            .emotion-chart,
            .recent-entries {
                padding: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Elementos decorativos flotantes -->
    <div class="floating-element element-1">
        <i class="fas fa-heart"></i>
    </div>
    <div class="floating-element element-2">
        <i class="fas fa-brain"></i>
    </div>

    <!-- Navbar -->
    <nav>
        <div class="logo-section">
            <div class="logo-placeholder">
                <img src="{{ asset('logo_pg.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <span class="brand-name">Mentally</span>
        </div>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>
            <li><a href="{{ route('diario.emocional') }}" class="nav-link">Diario</a></li>
            <li><a href="#" class="nav-link">Tests</a></li>
            <li><a href="#" class="nav-link">Especialistas</a></li>
        </ul>

        <div class="auth-buttons">
            <button class="btn btn-login" id="userProfile">
                <i class="fas fa-user"></i>
                Mi Perfil
            </button>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="diary-container">
        <!-- Sección principal de escritura -->
        <div class="writing-section">
            <div class="section-header">
                <h1 class="section-title">Mi Diario Emocional</h1>
                <div class="current-date" id="currentDate">
                    <!-- Fecha se llena con JavaScript -->
                </div>
            </div>

            <div class="writing-area">
                <textarea class="writing-textarea" 
                          id="diaryEntry" 
                          placeholder="¿Cómo te sientes hoy? Escribe libremente tus pensamientos, emociones o reflexiones. No hay reglas, solo sé honesto contigo mismo. ✨"
                          rows="10"></textarea>
                
                <div class="writing-tips">
                    <span class="tip-bubble" onclick="insertTip('Hoy me siento...')">Hoy me siento...</span>
                    <span class="tip-bubble" onclick="insertTip('Estoy agradecido por...')">Estoy agradecido por...</span>
                    <span class="tip-bubble" onclick="insertTip('Me preocupa...')">Me preocupa...</span>
                    <span class="tip-bubble" onclick="insertTip('Aprendí que...')">Aprendí que...</span>
                </div>
            </div>

            <!-- Selector de estado de ánimo -->
            <div class="mood-selector">
                <h3 class="mood-title">Selecciona tu estado de ánimo predominante:</h3>
                <div class="mood-options">
                    <div class="mood-option" data-mood="muy-feliz">
                        <span class="mood-emoji">😊</span>
                        <span class="mood-label">Muy Feliz</span>
                    </div>
                    <div class="mood-option" data-mood="tranquilo">
                        <span class="mood-emoji">😌</span>
                        <span class="mood-label">Tranquilo</span>
                    </div>
                    <div class="mood-option" data-mood="neutral">
                        <span class="mood-emoji">😐</span>
                        <span class="mood-label">Neutral</span>
                    </div>
                    <div class="mood-option" data-mood="preocupado">
                        <span class="mood-emoji">😟</span>
                        <span class="mood-label">Preocupado</span>
                    </div>
                    <div class="mood-option" data-mood="triste">
                        <span class="mood-emoji">😔</span>
                        <span class="mood-label">Triste</span>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="action-buttons">
                <button class="btn-save" id="saveEntry">
                    <i class="fas fa-save"></i>
                    Guardar Entrada
                </button>
                <button class="btn-analyze" id="analyzeText">
                    <i class="fas fa-robot"></i>
                    Analizar Emociones (IA)
                </button>
            </div>
        </div>

        <!-- Panel lateral -->
        <div class="sidebar">
            <!-- Tarjeta de estadísticas -->
            <div class="stats-card">
                <h3 class="stats-title">Tu Progreso</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-value" id="entriesCount">0</div>
                        <div class="stat-label">Entradas</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="streakDays">0</div>
                        <div class="stat-label">Días seguidos</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="positiveRate">0%</div>
                        <div class="stat-label">Positivas</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="avgWords">0</div>
                        <div class="stat-label">Palabras/prom</div>
                    </div>
                </div>
            </div>

            <!-- Gráfico de emociones -->
            <div class="emotion-chart">
                <h3 class="chart-title">Tus Emociones</h3>
                <div class="chart-container" id="emotionChart">
                    <!-- Barras del gráfico se generan con JavaScript -->
                </div>
            </div>

            <!-- Entradas recientes -->
            <div class="recent-entries">
                <h3 class="entries-title">Entradas Recientes</h3>
                <div class="entries-list" id="recentEntriesList">
                    <!-- Entradas se cargan con JavaScript -->
                    <div class="entry-item">
                        <div class="entry-date">Hoy, 14:30</div>
                        <div class="entry-preview">Hoy me siento muy agradecido por las pequeñas cosas de la vida...</div>
                    </div>
                    <div class="entry-item">
                        <div class="entry-date">Ayer, 20:15</div>
                        <div class="entry-preview">Tuve un día productivo aunque con algo de estrés en el trabajo...</div>
                    </div>
                    <div class="entry-item">
                        <div class="entry-date">26 Ene, 19:00</div>
                        <div class="entry-preview">Reflexionando sobre mis relaciones personales y cómo puedo mejorarlas...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de análisis -->
    <div class="analysis-modal" id="analysisModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModal">
                <i class="fas fa-times"></i>
            </button>
            
            <h2 class="modal-title">Análisis de Emociones</h2>
            
            <div class="analysis-result">
                <span class="result-emoji" id="resultEmoji">😊</span>
                <h3 class="result-title" id="resultTitle">Emoción Predominante: Positiva</h3>
                <p class="result-description" id="resultDescription">
                    Nuestro modelo de IA ha detectado que tu escritura refleja principalmente emociones positivas. 
                    Muestras gratitud, esperanza y satisfacción en tus reflexiones.
                </p>
                
                <div class="result-stats">
                    <div class="result-stat">
                        <div class="stat-percentage" id="positivePercent">75%</div>
                        <div>Positiva</div>
                    </div>
                    <div class="result-stat">
                        <div class="stat-percentage" id="neutralPercent">20%</div>
                        <div>Neutral</div>
                    </div>
                    <div class="result-stat">
                        <div class="stat-percentage" id="negativePercent">5%</div>
                        <div>Negativa</div>
                    </div>
                </div>

                <div class="result-insights">
                    <h4>Insights Detectados:</h4>
                    <ul id="insightsList">
                        <li>Expresas gratitud en 3 ocasiones</li>
                        <li>Mencionas relaciones interpersonales saludables</li>
                        <li>Usas lenguaje orientado a soluciones</li>
                    </ul>
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn-save" style="flex: 1;" onclick="saveWithAnalysis()">
                    <i class="fas fa-save"></i>
                    Guardar con Análisis
                </button>
                <button class="btn-analyze" style="flex: 1;" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        // Inicialización cuando el DOM está listo
        document.addEventListener('DOMContentLoaded', function() {
            // Establecer fecha actual
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('es-ES', options);
            
            // Inicializar estadísticas
            updateStats();
            initMoodSelector();
            initEmotionChart();
            loadRecentEntries();
            
            // Configurar evento para guardar entrada
            document.getElementById('saveEntry').addEventListener('click', saveEntry);
            
            // Configurar evento para analizar texto
            document.getElementById('analyzeText').addEventListener('click', analyzeText);
            
            // Configurar evento para cerrar modal
            document.getElementById('closeModal').addEventListener('click', closeModal);
            
            // Cerrar modal al hacer clic fuera
            document.getElementById('analysisModal').addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });
        });

        // Inicializar selector de estado de ánimo
        function initMoodSelector() {
            const moodOptions = document.querySelectorAll('.mood-option');
            moodOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remover selección anterior
                    moodOptions.forEach(opt => opt.classList.remove('selected'));
                    // Agregar selección actual
                    this.classList.add('selected');
                    
                    // Efecto visual
                    this.style.animation = 'pulse 0.5s ease';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 500);
                });
            });
        }

        // Insertar tips de escritura
        function insertTip(text) {
            const textarea = document.getElementById('diaryEntry');
            const currentText = textarea.value;
            const cursorPos = textarea.selectionStart;
            
            const newText = currentText.substring(0, cursorPos) + text + ' ' + currentText.substring(cursorPos);
            textarea.value = newText;
            
            // Efecto visual
            const tipBubble = event.target;
            tipBubble.style.transform = 'scale(0.95)';
            tipBubble.style.background = 'rgba(77, 184, 168, 0.2)';
            setTimeout(() => {
                tipBubble.style.transform = '';
                tipBubble.style.background = '';
            }, 300);
            
            // Enfocar textarea
            textarea.focus();
            textarea.selectionStart = cursorPos + text.length + 1;
            textarea.selectionEnd = cursorPos + text.length + 1;
        }

        // Actualizar estadísticas
        function updateStats() {
            // Simular datos (en producción vendrían de una API)
            const entries = JSON.parse(localStorage.getItem('diaryEntries') || '[]');
            
            document.getElementById('entriesCount').textContent = entries.length;
            document.getElementById('streakDays').textContent = calculateStreak(entries);
            document.getElementById('positiveRate').textContent = calculatePositiveRate(entries) + '%';
            document.getElementById('avgWords').textContent = calculateAvgWords(entries);
        }

        function calculateStreak(entries) {
            if (entries.length === 0) return 0;
            
            let streak = 1;
            const today = new Date().toDateString();
            const lastEntryDate = new Date(entries[0].date).toDateString();
            
            return lastEntryDate === today ? streak : 0;
        }

        function calculatePositiveRate(entries) {
            if (entries.length === 0) return 0;
            
            const positiveEntries = entries.filter(entry => 
                entry.analysis && entry.analysis.emotion === 'positive'
            ).length;
            
            return Math.round((positiveEntries / entries.length) * 100);
        }

        function calculateAvgWords(entries) {
            if (entries.length === 0) return 0;
            
            const totalWords = entries.reduce((sum, entry) => {
                return sum + (entry.text ? entry.text.split(' ').length : 0);
            }, 0);
            
            return Math.round(totalWords / entries.length);
        }

        // Inicializar gráfico de emociones
        function initEmotionChart() {
            const chartContainer = document.getElementById('emotionChart');
            const emotions = [
                { label: 'Positiva', value: 65, color: '#4db8a8' },
                { label: 'Neutral', value: 25, color: '#9bb5b3' },
                { label: 'Negativa', value: 10, color: '#ff9fc0' }
            ];
            
            chartContainer.innerHTML = '';
            
            emotions.forEach(emotion => {
                const bar = document.createElement('div');
                bar.className = 'chart-bar';
                bar.style.height = emotion.value + '%';
                bar.style.background = `linear-gradient(to top, ${emotion.color}, ${emotion.color}cc)`;
                bar.title = `${emotion.label}: ${emotion.value}%`;
                
                const label = document.createElement('div');
                label.className = 'chart-bar-label';
                label.textContent = emotion.label;
                
                bar.appendChild(label);
                chartContainer.appendChild(bar);
                
                // Animación de entrada
                setTimeout(() => {
                    bar.style.transform = 'scaleY(1)';
                }, 100);
            });
        }

        // Cargar entradas recientes
        function loadRecentEntries() {
            const entries = JSON.parse(localStorage.getItem('diaryEntries') || '[]');
            const entriesList = document.getElementById('recentEntriesList');
            
            if (entries.length === 0) {
                entriesList.innerHTML = `
                    <div class="entry-item" style="text-align: center; color: #9bb5b3;">
                        <i class="fas fa-book-open" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                        <div>No hay entradas aún. ¡Escribe tu primera entrada!</div>
                    </div>
                `;
                return;
            }
            
            entriesList.innerHTML = '';
            const recentEntries = entries.slice(0, 3);
            
            recentEntries.forEach(entry => {
                const entryItem = document.createElement('div');
                entryItem.className = 'entry-item';
                
                const date = new Date(entry.date).toLocaleDateString('es-ES', {
                    day: 'numeric',
                    month: 'short',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                const preview = entry.text.length > 100 
                    ? entry.text.substring(0, 100) + '...' 
                    : entry.text;
                
                entryItem.innerHTML = `
                    <div class="entry-date">${date}</div>
                    <div class="entry-preview">${preview}</div>
                `;
                
                entryItem.addEventListener('click', function() {
                    loadEntry(entry.id);
                });
                
                entriesList.appendChild(entryItem);
            });
        }

        // Guardar entrada
        function saveEntry() {
            const text = document.getElementById('diaryEntry').value.trim();
            const selectedMood = document.querySelector('.mood-option.selected');
            
            if (!text) {
                showNotification('Por favor escribe algo antes de guardar', 'warning');
                return;
            }
            
            if (!selectedMood) {
                showNotification('Por favor selecciona tu estado de ánimo', 'warning');
                return;
            }
            
            const entry = {
                id: Date.now(),
                date: new Date().toISOString(),
                text: text,
                mood: selectedMood.getAttribute('data-mood'),
                wordCount: text.split(' ').length
            };
            
            // Obtener entradas existentes
            const entries = JSON.parse(localStorage.getItem('diaryEntries') || '[]');
            entries.unshift(entry); // Agregar al inicio
            localStorage.setItem('diaryEntries', JSON.stringify(entries));
            
            // Actualizar UI
            updateStats();
            loadRecentEntries();
            
            // Limpiar formulario
            document.getElementById('diaryEntry').value = '';
            document.querySelectorAll('.mood-option').forEach(opt => opt.classList.remove('selected'));
            
            // Mostrar confirmación
            showNotification('¡Entrada guardada exitosamente!', 'success');
            
            // Efecto visual
            const saveBtn = document.getElementById('saveEntry');
            saveBtn.innerHTML = '<i class="fas fa-check"></i> ¡Guardado!';
            saveBtn.style.background = 'linear-gradient(135deg, #3a9c8c, #4db8a8)';
            
            setTimeout(() => {
                saveBtn.innerHTML = '<i class="fas fa-save"></i> Guardar Entrada';
                saveBtn.style.background = 'linear-gradient(135deg, #4db8a8, #5bc4b3)';
            }, 2000);
        }

        // Analizar texto con IA (simulación)
        function analyzeText() {
            const text = document.getElementById('diaryEntry').value.trim();
            
            if (!text) {
                showNotification('Por favor escribe algo para analizar', 'warning');
                return;
            }
            
            // Simular análisis con IA
            showLoading('Analizando tus emociones...');
            
            setTimeout(() => {
                // Simular resultados del análisis
                const analysis = simulateAIAnalysis(text);
                showAnalysisResults(analysis);
                hideLoading();
            }, 1500);
        }

        function simulateAIAnalysis(text) {
            const words = text.toLowerCase().split(' ');
            
            // Palabras clave para cada emoción
            const positiveWords = ['feliz', 'contento', 'agradecido', 'alegre', 'amor', 'éxito', 'bueno', 'mejor', 'esperanza', 'sonrisa'];
            const negativeWords = ['triste', 'preocupado', 'enojo', 'miedo', 'problema', 'difícil', 'malo', 'peor', 'fracaso', 'solo'];
            const neutralWords = ['pienso', 'creo', 'considero', 'reflexiono', 'día', 'hoy', 'mañana', 'ayer'];
            
            let positiveScore = 0;
            let negativeScore = 0;
            let neutralScore = 0;
            
            words.forEach(word => {
                if (positiveWords.some(pw => word.includes(pw))) positiveScore++;
                if (negativeWords.some(nw => word.includes(nw))) negativeScore++;
                if (neutralWords.some(nw => word.includes(nw))) neutralScore++;
            });
            
            const total = positiveScore + negativeScore + neutralScore || 1;
            
            // Determinar emoción predominante
            let emotion, emoji, title, description;
            
            if (positiveScore > negativeScore && positiveScore > neutralScore) {
                emotion = 'positive';
                emoji = '😊';
                title = 'Emoción Predominante: Positiva';
                description = 'Nuestro modelo detecta que tu escritura refleja principalmente emociones positivas como gratitud, alegría y satisfacción.';
            } else if (negativeScore > positiveScore && negativeScore > neutralScore) {
                emotion = 'negative';
                emoji = '😔';
                title = 'Emoción Predominante: Reflexiva';
                description = 'Detectamos que estás procesando emociones más complejas. Esto es completamente normal y parte del crecimiento personal.';
            } else {
                emotion = 'neutral';
                emoji = '😌';
                title = 'Emoción Predominante: Neutral';
                description = 'Tu escritura muestra un estado de reflexión tranquila y equilibrio emocional.';
            }
            
            return {
                emotion: emotion,
                emoji: emoji,
                title: title,
                description: description,
                percentages: {
                    positive: Math.round((positiveScore / total) * 100),
                    negative: Math.round((negativeScore / total) * 100),
                    neutral: Math.round((neutralScore / total) * 100)
                },
                insights: [
                    `Usas ${words.length} palabras en total`,
                    positiveScore > 0 ? `Expresas gratitud o alegría ${positiveScore} veces` : null,
                    negativeScore > 0 ? `Mencionas preocupaciones ${negativeScore} veces` : null
                ].filter(Boolean)
            };
        }

        function showAnalysisResults(analysis) {
            document.getElementById('resultEmoji').textContent = analysis.emoji;
            document.getElementById('resultTitle').textContent = analysis.title;
            document.getElementById('resultDescription').textContent = analysis.description;
            document.getElementById('positivePercent').textContent = analysis.percentages.positive + '%';
            document.getElementById('neutralPercent').textContent = analysis.percentages.neutral + '%';
            document.getElementById('negativePercent').textContent = analysis.percentages.negative + '%';
            
            const insightsList = document.getElementById('insightsList');
            insightsList.innerHTML = '';
            analysis.insights.forEach(insight => {
                const li = document.createElement('li');
                li.textContent = insight;
                insightsList.appendChild(li);
            });
            
            document.getElementById('analysisModal').classList.add('active');
        }

        function saveWithAnalysis() {
            // Aquí iría la lógica para guardar con el análisis
            saveEntry();
            closeModal();
        }

        function closeModal() {
            document.getElementById('analysisModal').classList.remove('active');
        }

        // Utilidades
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                background: ${type === 'success' ? '#4db8a8' : '#ff9fc0'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 10px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                z-index: 3000;
                animation: slideIn 0.3s ease;
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        function showLoading(message) {
            const loading = document.createElement('div');
            loading.id = 'loadingOverlay';
            loading.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(255,255,255,0.9);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                z-index: 4000;
                backdrop-filter: blur(5px);
            `;
            
            loading.innerHTML = `
                <div style="text-align: center;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 3rem; color: #4db8a8; margin-bottom: 1rem;"></i>
                    <p style="color: #2c5f5d; font-size: 1.2rem; font-weight: 500;">${message}</p>
                </div>
            `;
            
            document.body.appendChild(loading);
        }

        function hideLoading() {
            const loading = document.getElementById('loadingOverlay');
            if (loading) {
                loading.style.opacity = '0';
                loading.style.transition = 'opacity 0.3s ease';
                setTimeout(() => loading.remove(), 300);
            }
        }

        // Animaciones CSS adicionales
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            @keyframes gentleFloat {
                0%, 100% { transform: translate(0, 0) rotate(0deg); }
                25% { transform: translate(20px, -15px) rotate(5deg); }
                50% { transform: translate(10px, 20px) rotate(-3deg); }
                75% { transform: translate(-15px, 10px) rotate(2deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>