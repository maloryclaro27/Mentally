@extends('layouts.app')

@section('title', 'Mentally - Tu espacio digital de bienestar emocional')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/diario_emocional.css') }}">
@endpush
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
        margin: 0 auto;
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
        height: 220px;
        position: relative;
        display: flex;
        align-items: flex-end;
        gap: 0.9rem;
        padding: 1rem 1rem 2.5rem;
        overflow-x: auto;
    }

    .chart-col {
        height: 100%;
        flex: 0 0 78px;
        /* ancho fijo por columna (evita pisarse) */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
    }

    .chart-bar {
        width: 100%;
        background: linear-gradient(to top, #4db8a8, #5bc4b3);
        border-radius: 10px 10px 0 0;
        position: relative;
        transition: transform 0.3s ease, opacity 0.3s ease;
        cursor: pointer;
        transform-origin: bottom;
        transform: scaleY(0);
    }

    .chart-bar:hover {
        opacity: 0.8;
        transform: scaleY(1.05);
    }

    .chart-bar-label {
        margin-top: 0.5rem;
        position: static;
        bottom: -25px;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 0.8rem;
        color: #5a7c7a;
        font-weight: 500;
        white-space: nowrap;
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
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
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

        0%,
        100% {
            transform: translate(0, 0) rotate(0deg);
        }

        25% {
            transform: translate(20px, -15px) rotate(5deg);
        }

        50% {
            transform: translate(10px, 20px) rotate(-3deg);
        }

        75% {
            transform: translate(-15px, 10px) rotate(2deg);
        }
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

    /* Consentimiento + toggle */
    .consent-card {
        background: rgba(77, 184, 168, 0.06);
        border: 1px solid rgba(77, 184, 168, 0.18);
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .consent-title {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: #2c5f5d;
        margin-bottom: 0.5rem;
    }

    .consent-text {
        color: #5a7c7a;
        line-height: 1.6;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .consent-footnote {
        color: #5a7c7a;
        font-size: 0.9rem;
        margin-top: 0.75rem;
    }

    /* Toggle */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.75rem 0;
        cursor: pointer;
        user-select: none;
    }

    .toggle-label {
        font-weight: 600;
        color: #2c5f5d;
    }

    /* escondemos el checkbox real */
    .toggle-input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    /* switch visual */
    .toggle-switch {
        width: 56px;
        height: 32px;
        background: rgba(155, 181, 179, 0.7);
        border-radius: 999px;
        position: relative;
        transition: all 0.25s ease;
        flex-shrink: 0;
    }

    .toggle-switch::after {
        content: '';
        width: 26px;
        height: 26px;
        background: white;
        border-radius: 50%;
        position: absolute;
        top: 3px;
        left: 3px;
        transition: all 0.25s ease;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    /* cuando el checkbox está checked, pintamos el switch */
    .toggle-input:checked+.toggle-switch {
        background: rgba(77, 184, 168, 0.95);
    }

    .toggle-input:checked+.toggle-switch::after {
        transform: translateX(24px);
    }

    /* Scroll interno para Entradas Recientes */
    .entries-list {
        max-height: 280px;
        /* ajusta a gusto */
        overflow-y: auto;
        padding-right: 6px;
        /* espacio para scrollbar */
    }

    /* Scrollbar bonito (Chrome/Brave/Edge) */
    .entries-list::-webkit-scrollbar {
        width: 8px;
    }

    .entries-list::-webkit-scrollbar-thumb {
        background: rgba(77, 184, 168, 0.35);
        border-radius: 999px;
    }

    .entries-list::-webkit-scrollbar-track {
        background: rgba(77, 184, 168, 0.08);
        border-radius: 999px;
    }
</style>
</head>

@section('content')
    <!-- Elementos decorativos flotantes -->

    <div class="floating-element element-1">
        <i class="fas fa-heart"></i>
    </div>
    <div class="floating-element element-2">
        <i class="fas fa-brain"></i>
    </div>


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

            <!-- Consentimiento informado (resumen) -->
            <div class="consent-card" role="note" aria-label="Consentimiento informado">
                <h3 class="consent-title">Tu privacidad y el análisis automático</h3>
                <p class="consent-text">
                    Este diario es para tu bienestar. Si activas el análisis automático, un modelo estimará el
                    <strong>tono general</strong> de tu texto (por ejemplo: positivo/neutral/negativo) únicamente para
                    mostrarte
                    tendencias. <strong>No es un diagnóstico</strong> ni reemplaza la evaluación de un profesional.
                </p>
                <p class="consent-text">
                    Puedes usar el diario sin análisis. Tú decides y puedes cambiarlo cuando quieras.
                </p>

                <label class="toggle-row">
                    <span class="toggle-label">Activar análisis automático (opcional)</span>

                    <input type="checkbox" id="analysisOptIn" class="toggle-input">
                    <span class="toggle-switch" aria-hidden="true"></span>
                </label>

                <p class="consent-footnote" id="consentFootnote">
                    Estado actual: <strong>Desactivado</strong>
                </p>
            </div>


            <div class="writing-area">
                <textarea class="writing-textarea" id="diaryEntry"
                    placeholder="¿Cómo te sientes hoy? Escribe libremente tus pensamientos, emociones o reflexiones. No hay reglas, solo sé honesto contigo mismo. ✨"
                    rows="10"></textarea>

                <div class="writing-tips">
                    <span class="tip-bubble" onclick="insertTip('Hoy me siento...')">Hoy me siento...</span>
                    <span class="tip-bubble" onclick="insertTip('Estoy agradecido por...')">Estoy agradecido
                        por...</span>
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
                <button class="btn-save" id="saveEntry" type="button">
                    <i class="fas fa-save"></i>
                    Guardar Entrada
                </button>
            </div>
        </div>

        <!-- Panel lateral -->
        <div class="sidebar">
            <!-- Tarjeta de estadísticas -->
            <div class="stats-card">
                <h3 class="stats-title">Resumen de tu diario emocional</h3>
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
                <h3 class="chart-title">Tu estado anímico los últimos días</h3>
                <div class="chart-container" id="emotionChart">
                    <!-- Barras del gráfico se generan con JavaScript -->
                </div>
            </div>

            <!-- Entradas recientes -->
            <div class="recent-entries">
                <h3 class="entries-title">Entradas Recientes</h3>
                <button class="btn-analyze" id="exportCsvBtn" type="button" style="width:100%; margin-bottom: 1rem;">
                    <i class="fas fa-file-csv"></i>
                    Exportar CSV
                </button>
                <div class="entries-list" id="recentEntriesList">
                    <!-- Entradas se cargan con JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de análisis
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
                                                                                                        </div> -->
    <!-- Modal: Ver entrada (detalle) -->
    <div class="analysis-modal" id="entryModal" aria-hidden="true">
        <div class="modal-content">
            <button class="modal-close" id="closeEntryModal" type="button">
                <i class="fas fa-times"></i>
            </button>

            <h2 class="modal-title">Tu entrada</h2>

            <div class="analysis-result" style="text-align:left;">
                <div style="display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                    <p style="color:#5a7c7a; margin:0;">
                        <strong>Fecha:</strong> <span id="entryModalDate">—</span>
                    </p>
                    <p style="color:#5a7c7a; margin:0;">
                        <strong>Estado:</strong> <span id="entryModalMood">—</span>
                    </p>
                    <p style="color:#5a7c7a; margin:0;">
                        <strong>Palabras:</strong> <span id="entryModalWords">—</span>
                    </p>
                </div>

                <hr style="margin:1.25rem 0; border:none; border-top:1px solid rgba(77,184,168,0.2);">

                <p style="color:#2c5f5d; font-weight:600; margin-bottom:0.5rem;">Texto</p>
                <div id="entryModalText"
                    style="
                white-space: pre-wrap;
                background: rgba(77,184,168,0.06);
                border: 1px solid rgba(77,184,168,0.18);
                border-radius: 12px;
                padding: 1rem;
                color:#2c5f5d;
                line-height:1.6;
                max-height: 45vh;
                overflow:auto;
            ">
                    —</div>

                <p style="margin-top:0.75rem; color:#5a7c7a; font-size:0.9rem;">
                    Nota: Esta información es privada. No se comparte con nadie a menos que tú la exportes o la compartas.
                </p>
            </div>

            <div class="modal-actions">
                <button class="btn-analyze" style="flex:1;" id="deleteEntryBtn" type="button">
                    <i class="fas fa-trash"></i>
                    Eliminar
                </button>

                <button class="btn-analyze" style="flex:1;" id="closeEntryModalBtn" type="button">
                    <i class="fas fa-times"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>

@endsection

<script>
    let currentEntryId = null;
    //Inicialización cuando el DOM está listo 
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer fecha actual
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('currentDate').textContent = now.toLocaleDateString('es-ES', options);

        // Inicializar estadísticas
        updateStats();
        initMoodSelector();
        initEmotionChart();
        loadRecentEntries();

        // Toggle de consentimiento para análisis
        initAnalysisOptIn();
        initEntryModal();


        // Configurar evento para guardar entrada
        document.getElementById('saveEntry').addEventListener('click', saveEntry);

        const exportBtn = document.getElementById('exportCsvBtn');
        if (exportBtn) exportBtn.addEventListener('click', exportCsv);


        // Configurar evento para analizar texto
        //document.getElementById('analyzeText').addEventListener('click', analyzeText);

        // Configurar evento para cerrar modal
        //document.getElementById('closeModal').addEventListener('click', closeModal);

        // Cerrar modal al hacer clic fuera
        //document.getElementById('analysisModal').addEventListener('click', function(e) {
        // if (e.target === this) closeModal();
        // });
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

    function initAnalysisOptIn() {
        const checkbox = document.getElementById('analysisOptIn');
        const footnote = document.getElementById('consentFootnote');

        // Cargar preferencia guardada (si existe)
        const savedPref = localStorage.getItem('analysisOptIn');
        const isOn = savedPref === 'true';

        checkbox.checked = isOn;
        updateConsentFootnote(isOn);

        checkbox.addEventListener('change', function() {
            localStorage.setItem('analysisOptIn', String(this.checked));
            updateConsentFootnote(this.checked);
            showNotification(
                this.checked ?
                'Análisis automático activado (opcional).' :
                'Análisis automático desactivado.',
                'success'
            );
        });

        function updateConsentFootnote(state) {
            footnote.innerHTML = `Estado actual: <strong>${state ? 'Activado' : 'Desactivado'}</strong>`;
        }
    }


    // Insertar tips de escritura
    function insertTip(ev, text) {
        const textarea = document.getElementById('diaryEntry');
        const currentText = textarea.value;
        const cursorPos = textarea.selectionStart;

        const newText = currentText.substring(0, cursorPos) + text + ' ' + currentText.substring(cursorPos);
        textarea.value = newText;

        // Efecto visual
        const tipBubble = ev.currentTarget;
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
    async function updateStats() {
        try {
            const res = await fetch("{{ route('diary.entries.stats') }}", {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) return;

            const data = await res.json();
            if (!data.ok) return;

            document.getElementById('entriesCount').textContent = data.stats.entriesCount ?? 0;
            document.getElementById('streakDays').textContent = data.stats.streakDays ?? 0;
            document.getElementById('positiveRate').textContent = (data.stats.positiveRate ?? 0) + '%';
            document.getElementById('avgWords').textContent = data.stats.avgWords ?? 0;

        } catch (e) {
            console.error(e);
        }
    }

    // Inicializar gráfico de emociones

    async function initEmotionChart() {
        const chartContainer = document.getElementById('emotionChart');
        if (!chartContainer) return;

        chartContainer.innerHTML = `
        <div style="width:100%; text-align:center; color:#5a7c7a; padding:2rem 1rem;">
            Cargando gráfico...
        </div>
    `;

        try {
            const res = await fetch("{{ route('diary.entries.moodChart') }}", {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) {
                chartContainer.innerHTML = `
                <div style="width:100%; text-align:center; color:#9bb5b3; padding:2rem 1rem;">
                    No se pudo cargar el gráfico.
                </div>
            `;
                return;
            }

            const data = await res.json();
            if (!data.ok) return;

            const items = data.data || [];
            const total = items.reduce((sum, it) => sum + Number(it.count || 0), 0);

            if (!total) {
                chartContainer.innerHTML = `
                <div style="width:100%; text-align:center; color:#5a7c7a; padding:2rem 1rem;">
                    <i class="fas fa-chart-line" style="font-size:2rem; margin-bottom:1rem; opacity:0.4;"></i>
                    <div>Aún no hay suficiente información para mostrar tendencias emocionales.</div>
                    <div style="font-size:0.85rem; margin-top:0.5rem; opacity:0.7;">
                        Las tendencias se activan automáticamente cuando haya más entradas registradas.
                    </div>
                </div>
            `;
                return;
            }

            const moodLabelMap = {
                'muy-feliz': 'Muy Feliz',
                'tranquilo': 'Tranquilo',
                'neutral': 'Neutral',
                'preocupado': 'Preocupado',
                'triste': 'Triste'
            };

            const moodColorMap = {
                'muy-feliz': '#4db8a8',
                'tranquilo': '#5bc4b3',
                'neutral': '#9bb5b3',
                'preocupado': '#ffb36b',
                'triste': '#ff9fc0'
            };

            chartContainer.innerHTML = '';

            items.forEach(it => {
                const pct = Math.round(((it.count || 0) / total) * 100);

                const col = document.createElement('div');
                col.className = 'chart-col';

                const bar = document.createElement('div');
                bar.className = 'chart-bar';
                bar.style.height = pct + '%';

                const c = moodColorMap[it.mood] || '#4db8a8';
                bar.style.background = `linear-gradient(to top, ${c}, ${c}cc)`;
                bar.title = `${moodLabelMap[it.mood] || it.mood}: ${pct}% (${it.count})`;

                const label = document.createElement('div');
                label.className = 'chart-bar-label';
                label.textContent = moodLabelMap[it.mood] || it.mood;

                col.appendChild(bar);
                col.appendChild(label);
                chartContainer.appendChild(col);

                setTimeout(() => {
                    bar.style.transform = 'scaleY(1)';
                }, 50);
            });

        } catch (e) {
            console.error(e);
            chartContainer.innerHTML = `
            <div style="width:100%; text-align:center; color:#9bb5b3; padding:2rem 1rem;">
                Error de red cargando el gráfico.
            </div>
        `;
        }
    }



    // Cargar entradas recientes
    async function loadRecentEntries() {
        const entriesList = document.getElementById('recentEntriesList');

        try {
            const res = await fetch("{{ route('diary.entries.recent') }}?limit=10", {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) {
                entriesList.innerHTML = `
                <div class="entry-item" style="text-align: center; color: #9bb5b3;">
                    <div>No se pudieron cargar tus entradas.</div>
                </div>
            `;
                return;
            }

            const data = await res.json();
            const entries = data.entries || [];

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

            const moodLabelMap = {
                'muy-feliz': 'Muy Feliz',
                'tranquilo': 'Tranquilo',
                'neutral': 'Neutral',
                'preocupado': 'Preocupado',
                'triste': 'Triste'
            };

            entries.forEach(e => {
                const entryItem = document.createElement('div');
                entryItem.className = 'entry-item';

                const date = new Date(e.date).toLocaleDateString('es-ES', {
                    day: 'numeric',
                    month: 'short',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // No mostramos texto por privacidad en la lista.
                const preview = `Estado: ${moodLabelMap[e.mood] || e.mood} · ${e.word_count || 0} palabras`;

                entryItem.innerHTML = `
                    <div class="entry-date">${date}</div>
                    <div class="entry-preview">${preview}</div>
                `;

                // El click VA APARTE, no dentro del innerHTML
                entryItem.addEventListener('click', () => openEntry(e.id));

                entriesList.appendChild(entryItem);
            });



        } catch (e) {
            console.error(e);
            entriesList.innerHTML = `
            <div class="entry-item" style="text-align: center; color: #9bb5b3;">
                <div>Error cargando entradas.</div>
            </div>
        `;
        }
    }


    // Guardar entrada
    async function saveEntry() {
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

        const payload = {
            entry_text: text,
            mood: selectedMood.getAttribute('data-mood'),
            word_count: text.split(' ').filter(Boolean).length,
            analysis_opt_in: (localStorage.getItem('analysisOptIn') === 'true'),
        };

        try {
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const res = await fetch("{{ route('diary.entries.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            if (!res.ok) {
                const err = await res.json().catch(() => ({}));
                showNotification(err.message || 'No se pudo guardar. Revisa los campos.', 'warning');
                return;
            }

            await res.json();

            document.getElementById('diaryEntry').value = '';
            document.querySelectorAll('.mood-option').forEach(opt => opt.classList.remove('selected'));

            showNotification('¡Entrada guardada en el servidor!', 'success');

            // feedback visual del botón
            const saveBtn = document.getElementById('saveEntry');
            saveBtn.innerHTML = '<i class="fas fa-check"></i> ¡Guardado!';
            saveBtn.style.background = 'linear-gradient(135deg, #3a9c8c, #4db8a8)';

            setTimeout(() => {
                saveBtn.innerHTML = '<i class="fas fa-save"></i> Guardar Entrada';
                saveBtn.style.background = 'linear-gradient(135deg, #4db8a8, #5bc4b3)';
            }, 2000);

            // Por ahora NO llamamos updateStats/loadRecentEntries porque aún dependen de localStorage
            await updateStats();
            await loadRecentEntries();

        } catch (e) {
            console.error(e);
            showNotification('Error de red/servidor al guardar.', 'warning');
        }
        await initEmotionChart();
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
        const positiveWords = ['feliz', 'contento', 'agradecido', 'alegre', 'amor', 'éxito', 'bueno', 'mejor',
            'esperanza', 'sonrisa'
        ];
        const negativeWords = ['triste', 'preocupado', 'enojo', 'miedo', 'problema', 'difícil', 'malo', 'peor',
            'fracaso', 'solo'
        ];
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
            description =
                'Nuestro modelo detecta que tu escritura refleja principalmente emociones positivas como gratitud, alegría y satisfacción.';
        } else if (negativeScore > positiveScore && negativeScore > neutralScore) {
            emotion = 'negative';
            emoji = '😔';
            title = 'Emoción Predominante: Reflexiva';
            description =
                'Detectamos que estás procesando emociones más complejas. Esto es completamente normal y parte del crecimiento personal.';
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

    function initEntryModal() {
        const modal = document.getElementById('entryModal');
        const closeBtn = document.getElementById('closeEntryModal');
        const closeBtn2 = document.getElementById('closeEntryModalBtn');
        const deleteBtn = document.getElementById('deleteEntryBtn');


        if (!modal || !closeBtn || !closeBtn2) {
            console.warn('Entry modal elements missing. Skipping initEntryModal().');
            return;
        }

        const close = () => {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            currentEntryId = null;
        };

        closeBtn.addEventListener('click', close);
        closeBtn2.addEventListener('click', close);
        deleteBtn.addEventListener('click', deleteCurrentEntry);

        modal.addEventListener('click', function(e) {
            if (e.target === this) close();
        });
    }


    async function openEntry(entryId) {
        currentEntryId = entryId;
        const modal = document.getElementById('entryModal');
        const dateEl = document.getElementById('entryModalDate');
        const moodEl = document.getElementById('entryModalMood');
        const wordsEl = document.getElementById('entryModalWords');
        const textEl = document.getElementById('entryModalText');

        // estado de carga
        dateEl.textContent = 'Cargando...';
        moodEl.textContent = '—';
        wordsEl.textContent = '—';
        textEl.textContent = 'Cargando...';

        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');

        try {
            const res = await fetch(`/diary-entries/${entryId}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) {
                textEl.textContent = 'No se pudo cargar la entrada.';
                return;
            }

            const data = await res.json();
            if (!data.ok) {
                textEl.textContent = 'No se pudo cargar la entrada.';
                return;
            }

            const e = data.entry;

            const moodLabelMap = {
                'muy-feliz': 'Muy Feliz',
                'tranquilo': 'Tranquilo',
                'neutral': 'Neutral',
                'preocupado': 'Preocupado',
                'triste': 'Triste'
            };

            dateEl.textContent = new Date(e.date).toLocaleString('es-ES', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            moodEl.textContent = moodLabelMap[e.mood] || e.mood;
            wordsEl.textContent = e.word_count ?? 0;
            textEl.textContent = e.entry_text || '';
        } catch (err) {
            console.error(err);
            textEl.textContent = 'Error de red al cargar la entrada.';
        }
    }

    async function deleteCurrentEntry() {
        if (!currentEntryId) {
            showNotification('No hay una entrada seleccionada.', 'warning');
            return;
        }

        const ok = confirm('¿Seguro que deseas eliminar esta entrada? Esta acción no se puede deshacer.');
        if (!ok) return;

        try {
            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const res = await fetch(`/diary-entries/${currentEntryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                }
            });

            if (!res.ok) {
                showNotification('No se pudo eliminar la entrada.', 'warning');
                return;
            }

            showNotification('Entrada eliminada.', 'success');

            // cerrar modal
            const modal = document.getElementById('entryModal');
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');

            currentEntryId = null;

            // refrescar UI
            await updateStats();
            await loadRecentEntries();

        } catch (e) {
            console.error(e);
            showNotification('Error de red al eliminar.', 'warning');
        }
    }

    async function exportCsv() {
        try {
            const res = await fetch("{{ route('diary.entries.recent') }}", {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) {
                showNotification('No se pudieron obtener las entradas para exportar.', 'warning');
                return;
            }

            const data = await res.json();
            const entries = data.entries || [];

            if (entries.length === 0) {
                showNotification('No tienes entradas para exportar.', 'warning');
                return;
            }

            // CSV header (sin texto completo por privacidad; solo metadata)
            const rows = [
                ['id', 'date', 'mood', 'word_count', 'analysis_opt_in']
            ];

            entries.forEach(e => {
                rows.push([
                    e.id,
                    e.date,
                    e.mood,
                    e.word_count ?? 0,
                    e.analysis_opt_in ? 'true' : 'false'
                ]);
            });

            const csv = rows
                .map(r => r.map(v => `"${String(v).replaceAll('"', '""')}"`).join(','))
                .join('\n');

            const blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            const url = URL.createObjectURL(blob);

            const a = document.createElement('a');
            a.href = url;

            const stamp = new Date().toISOString().slice(0, 10);
            a.download = `mentally_diary_export_${stamp}.csv`;

            document.body.appendChild(a);
            a.click();
            a.remove();

            URL.revokeObjectURL(url);

            showNotification('CSV descargado.', 'success');
        } catch (e) {
            console.error(e);
            showNotification('Error exportando CSV.', 'warning');
        }
    }
</script>
