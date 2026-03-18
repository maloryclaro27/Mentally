@extends('layouts.app')

@section('title', 'Asistente Emocional - Mentally')

@push('styles')
<style>
    /* ========== VARIABLES Y ESTILOS BASE ========== */
    :root {
        --primary: #4db8a8;
        --primary-dark: #2c5f5d;
        --primary-soft: rgba(77, 184, 168, 0.1);
        --primary-gradient: linear-gradient(135deg, #4db8a8, #5bc4b3);
        --text: #2c5f5d;
        --text-soft: #5a7c7a;
        --white: #ffffff;
        --border: rgba(77, 184, 168, 0.2);
        --shadow: 0 20px 40px rgba(77, 184, 168, 0.15);
        --shadow-soft: 0 10px 25px rgba(77, 184, 168, 0.1);
        --gradient-bg: linear-gradient(135deg, #f0f9f8 0%, #e6f4f7 50%, #f2f9f8 100%);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: var(--gradient-bg);
        min-height: 100vh;
        overflow: hidden;
    }

    /* ========== ELEMENTOS DECORATIVOS ========== */
    .floating-circle {
        position: fixed;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.1));
        pointer-events: none;
        z-index: 0;
        animation: float 6s ease-in-out infinite;
    }

    .circle-1 {
        width: 300px;
        height: 300px;
        top: 10%;
        right: 10%;
    }

    .circle-2 {
        width: 200px;
        height: 200px;
        bottom: 15%;
        left: 5%;
        animation: float 8s ease-in-out infinite reverse;
    }

    .circle-3 {
        width: 150px;
        height: 150px;
        top: 40%;
        left: 20%;
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.05), rgba(255, 193, 7, 0.1));
        animation: float 10s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(30px, 30px); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes typingPulse {
        0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
        30% { transform: translateY(-8px); opacity: 1; }
    }

    /* ========== LAYOUT PRINCIPAL ========== */
    .chatbot-page {
        position: fixed;
        top: 80px;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 20px 24px 20px;
        overflow: hidden;
        background: var(--gradient-bg);
    }

    .chatbot-shell {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 24px;
        height: 100%;
        position: relative;
        z-index: 2;
        animation: slideInUp 0.8s ease;
    }

    /* ========== PANEL DE INFORMACIÓN - CORREGIDO ========== */
    .chatbot-info {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--border);
        border-radius: 30px;
        box-shadow: var(--shadow);
        padding: 28px 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        position: relative;
        overflow-y: auto; /* AHORA SÍ PUEDE HACER SCROLL */
        height: 100%;
        animation: slideInUp 0.8s ease 0.1s backwards;
    }

    /* Estilo para la barra de scroll (opcional, más bonito) */
    .chatbot-info::-webkit-scrollbar {
        width: 6px;
    }

    .chatbot-info::-webkit-scrollbar-track {
        background: rgba(77, 184, 168, 0.05);
        border-radius: 10px;
    }

    .chatbot-info::-webkit-scrollbar-thumb {
        background: rgba(77, 184, 168, 0.3);
        border-radius: 10px;
    }

    .chatbot-info::-webkit-scrollbar-thumb:hover {
        background: rgba(77, 184, 168, 0.5);
    }

    .chatbot-info::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(77, 184, 168, 0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .chatbot-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        align-self: flex-start;
        background: linear-gradient(135deg, rgba(77, 184, 168, 0.15), rgba(91, 196, 179, 0.2));
        color: var(--primary-dark);
        border-radius: 999px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid rgba(77, 184, 168, 0.3);
        backdrop-filter: blur(5px);
    }

    .chatbot-title {
        margin: 0;
        font-family: 'Quicksand', sans-serif;
        font-size: 2rem;
        line-height: 1.2;
        color: var(--text);
        background: linear-gradient(135deg, var(--text), var(--primary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .chatbot-description {
        margin: 0;
        color: var(--text-soft);
        line-height: 1.7;
        font-size: 0.95rem;
        padding-left: 1rem;
        border-left: 3px solid var(--primary);
    }

    .chatbot-features {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin: 5px 0;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateX(5px);
        background: rgba(255, 255, 255, 0.8);
    }

    .feature-icon {
        width: 36px;
        height: 36px;
        background: var(--primary-gradient);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }

    .feature-text {
        color: var(--text);
        font-weight: 500;
        font-size: 0.9rem;
    }

    .chatbot-note {
        margin-top: auto;
        padding: 16px;
        background: linear-gradient(135deg, rgba(255, 245, 225, 0.8), rgba(255, 240, 210, 0.9));
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 193, 7, 0.3);
        border-radius: 20px;
        color: #8a6841;
        line-height: 1.6;
        font-size: 0.9rem;
        position: relative;
        overflow: hidden;
        flex-shrink: 0; /* Evita que se encoja */
    }

    .chatbot-note::before {
        content: '⚠️';
        position: absolute;
        top: -10px;
        right: -10px;
        font-size: 3rem;
        opacity: 0.1;
        transform: rotate(15deg);
    }

    /* ========== PANEL PRINCIPAL DEL CHAT ========== */
    .chatbot-panel {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--border);
        border-radius: 30px;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden;
        position: relative;
        animation: slideInUp 0.8s ease 0.2s backwards;
    }

    .chatbot-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        z-index: 1;
    }

    .chatbot-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
        background: linear-gradient(180deg, rgba(77, 184, 168, 0.05), transparent);
        flex-shrink: 0;
    }

    .chatbot-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .chatbot-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem;
        box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
        flex-shrink: 0;
        position: relative;
        animation: pulse 3s ease-in-out infinite;
    }

    .chatbot-avatar::after {
        content: '';
        position: absolute;
        top: -2px;
        right: -2px;
        width: 12px;
        height: 12px;
        background: #4fd38a;
        border-radius: 50%;
        border: 2px solid white;
    }

    .chatbot-header h2 {
        margin: 0 0 2px;
        font-family: 'Quicksand', sans-serif;
        font-size: 1.3rem;
        color: var(--text);
    }

    .chatbot-status {
        margin: 0;
        color: var(--text-soft);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .chatbot-status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #4fd38a;
        box-shadow: 0 0 0 4px rgba(79, 211, 138, 0.2);
        animation: pulse 2s ease-in-out infinite;
    }

    .chatbot-actions {
        display: flex;
        gap: 8px;
    }

    .chatbot-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid var(--border);
        color: var(--text);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .chatbot-action-btn:hover {
        background: var(--primary-gradient);
        color: white;
        transform: rotate(15deg);
    }

    /* ========== ÁREA DE MENSAJES ========== */
    .chatbot-messages {
        flex: 1 1 auto;
        padding: 20px 24px;
        overflow-y: auto;
        background: 
            linear-gradient(180deg, rgba(255,255,255,0.8), rgba(247,252,251,0.95)),
            radial-gradient(circle at top, rgba(77,184,168,0.08), transparent 40%);
        display: flex;
        flex-direction: column;
        gap: 16px;
        min-height: 0;
        scroll-behavior: smooth;
    }

    /* Estilo para la barra de scroll del chat */
    .chatbot-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chatbot-messages::-webkit-scrollbar-track {
        background: rgba(77, 184, 168, 0.05);
        border-radius: 10px;
    }

    .chatbot-messages::-webkit-scrollbar-thumb {
        background: rgba(77, 184, 168, 0.3);
        border-radius: 10px;
    }

    .chatbot-message-row {
        display: flex;
        animation: slideInUp 0.3s ease;
        width: 100%;
    }

    .chatbot-message-row.user {
        justify-content: flex-end;
    }

    .chatbot-message-row.bot {
        justify-content: flex-start;
    }

    .chatbot-message {
        max-width: 76%;
        padding: 14px 18px;
        border-radius: 22px;
        line-height: 1.5;
        font-size: 0.95rem;
        box-shadow: var(--shadow-soft);
        word-break: break-word;
        position: relative;
        transition: all 0.3s ease;
    }

    /* CORRECCIÓN: Eliminado el borde negro */
    .chatbot-message.bot {
        background: var(--white);
        border: 1px solid var(--border);
        color: var(--text);
        border-bottom-left-radius: 6px;
    }

    .chatbot-message.user {
        background: var(--primary-gradient);
        color: white;
        border-bottom-right-radius: 6px;
        /* ELIMINADO: cualquier borde que pudiera causar la línea negra */
        border: none;
    }

    /* Eliminado el pseudo-elemento que podría estar causando la línea negra */
    .chatbot-message.user::after {
        display: none;
    }

    /* Diseño más limpio para los mensajes */
    .chatbot-meta {
        margin-top: 6px;
        font-size: 0.7rem;
        opacity: 0.8;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .user .chatbot-meta {
        color: rgba(255, 255, 255, 0.9);
    }

    .emotion-tag {
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 8px;
        border-radius: 999px;
        font-size: 0.65rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* ========== SUGERENCIAS RÁPIDAS ========== */
    .quick-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.5);
        border-top: 1px solid var(--border);
        flex-shrink: 0;
    }

    .suggestion-chip {
        padding: 6px 14px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid var(--border);
        border-radius: 999px;
        color: var(--text);
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .suggestion-chip:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
        border-color: transparent;
    }

    /* ========== FORMULARIO ========== */
    .chatbot-form-wrap {
        border-top: 1px solid var(--border);
        padding: 16px 24px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        flex-shrink: 0;
    }

    .chatbot-form {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .chatbot-input-wrapper {
        flex: 1;
        position: relative;
    }

    .chatbot-input {
        width: 100%;
        border: 2px solid var(--border);
        border-radius: 18px;
        padding: 14px 18px;
        font-size: 0.95rem;
        outline: none;
        color: var(--text);
        background: #fbfefe;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .chatbot-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 5px rgba(77, 184, 168, 0.15);
        background: white;
    }

    .chatbot-input::placeholder {
        color: var(--text-soft);
        opacity: 0.6;
    }

    .input-char-count {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.7rem;
        color: var(--text-soft);
        opacity: 0.7;
    }

    .chatbot-send {
        border: none;
        border-radius: 18px;
        padding: 14px 28px;
        background: var(--primary-gradient);
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(77, 184, 168, 0.3);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
    }

    .chatbot-send:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(77, 184, 168, 0.4);
    }

    .chatbot-send:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .chatbot-typing {
        display: none;
        align-items: center;
        gap: 10px;
        color: var(--text-soft);
        font-size: 0.85rem;
        margin-top: 10px;
        padding-left: 8px;
        animation: slideInUp 0.3s ease;
    }

    .chatbot-typing.show {
        display: flex;
    }

    .typing-dots {
        display: inline-flex;
        gap: 5px;
    }

    .typing-dots span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--primary-gradient);
        animation: typingPulse 1.2s infinite ease-in-out;
    }

    /* ========== TOAST NOTIFICATION ========== */
    .toast-notification {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: var(--primary-gradient);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(77, 184, 168, 0.4);
        display: flex;
        align-items: center;
        gap: 1rem;
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 3000;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .toast-notification.show {
        transform: translateY(0);
        opacity: 1;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 980px) {
        .chatbot-shell {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .chatbot-info {
            display: none;
        }

        .chatbot-page {
            top: 70px;
            padding: 16px;
        }
    }

    @media (max-width: 640px) {
        .chatbot-form {
            flex-direction: column;
        }

        .chatbot-send {
            width: 100%;
        }

        .chatbot-message {
            max-width: 90%;
        }

        .quick-suggestions {
            padding: 10px 16px;
            overflow-x: auto;
            flex-wrap: nowrap;
            -webkit-overflow-scrolling: touch;
        }
        
        .suggestion-chip {
            flex-shrink: 0;
        }
    }
</style>
@endpush

@section('content')
<!-- Elementos decorativos flotantes -->
<div class="floating-circle circle-1"></div>
<div class="floating-circle circle-2"></div>
<div class="floating-circle circle-3"></div>

<div class="chatbot-page">
    <div class="chatbot-shell">
        <!-- Panel de información lateral - AHORA CON SCROLL -->
        <aside class="chatbot-info">
            <div class="chatbot-badge">
                <i class="fas fa-heart"></i>
                Apoyo 24/7
            </div>

            <h1 class="chatbot-title">Asistente Emocional</h1>

            <p class="chatbot-description">
                Un espacio seguro para expresar cómo te sientes. Estoy aquí para escucharte.
            </p>

            <div class="chatbot-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-comment-dots"></i>
                    </div>
                    <span class="feature-text">Conversación confidencial</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <span class="feature-text">Detección de emociones</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span class="feature-text">Espacio sin juicios</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-moon"></i>
                    </div>
                    <span class="feature-text">Disponible 24/7</span>
                </div>
            </div>

            <div class="chatbot-note">
                <strong>🌟 Importante:</strong> Este asistente complementa tu proceso de bienestar emocional pero no reemplaza la atención profesional. Si estás en crisis, sientes que podrías hacerte daño o necesitas ayuda inmediata, por favor contacta a una persona de confianza o llama a la línea de emergencia de tu país.
                <div style="margin-top: 12px; padding: 8px; background: rgba(255,255,255,0.5); border-radius: 12px; text-align: center;">
                    <i class="fas fa-phone-alt"></i> <strong>Línea de apoyo:</strong> 123
                </div>
            </div>

            <!-- Mensaje adicional para asegurar que el panel tiene contenido -->
            <div style="margin-top: 10px; padding: 12px; background: rgba(77,184,168,0.05); border-radius: 16px;">
                <p style="color: var(--text-soft); font-size: 0.85rem; margin-bottom: 8px;">
                    <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                    Recuerda que puedes hablar de lo que necesites: ansiedad, estrés, tristeza, dificultades para dormir, o simplemente cómo fue tu día.
                </p>
            </div>
        </aside>

        <!-- Panel principal del chat -->
        <section class="chatbot-panel">
            <div class="chatbot-header">
                <div class="chatbot-header-left">
                    <div class="chatbot-avatar">
                        <i class="fas fa-comment-medical"></i>
                    </div>
                    <div>
                        <h2>Mentally Assistant</h2>
                        <p class="chatbot-status">
                            <span class="chatbot-status-dot"></span>
                            Conectado
                        </p>
                    </div>
                </div>
                <div class="chatbot-actions">
                    <button class="chatbot-action-btn" onclick="clearChat()" title="Limpiar conversación">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>

            <!-- Área de mensajes - ÚNICO CON SCROLL -->
            <div id="chat-box" class="chatbot-messages">
                <div class="chatbot-message-row bot">
                    <div class="chatbot-message bot">
                        <i class="fas fa-hand-sparkles" style="margin-right: 8px;"></i>
                        Hola, estoy aquí para escucharte. ¿Cómo te sientes hoy?
                        <div class="chatbot-meta">
                            <span>Asistente</span>
                            <span class="emotion-tag">
                                <i class="fas fa-smile"></i> Escuchando
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sugerencias rápidas -->
            <div class="quick-suggestions">
                <span class="suggestion-chip" onclick="useSuggestion('Me siento ansioso/a')">
                    <i class="fas fa-heartbeat"></i> Ansiedad
                </span>
                <span class="suggestion-chip" onclick="useSuggestion('He tenido un mal día')">
                    <i class="fas fa-cloud-rain"></i> Mal día
                </span>
                <span class="suggestion-chip" onclick="useSuggestion('Problemas para dormir')">
                    <i class="fas fa-moon"></i> Dormir
                </span>
                <span class="suggestion-chip" onclick="useSuggestion('Mucho estrés')">
                    <i class="fas fa-briefcase"></i> Estrés
                </span>
                <span class="suggestion-chip" onclick="useSuggestion('Me siento solo/a')">
                    <i class="fas fa-heart"></i> Soledad
                </span>
            </div>

            <!-- Formulario de envío -->
            <div class="chatbot-form-wrap">
                <form id="chat-form" class="chatbot-form">
                    @csrf
                    <div class="chatbot-input-wrapper">
                        <input
                            type="text"
                            id="message"
                            name="message"
                            class="chatbot-input"
                            placeholder="Escribe tu mensaje..."
                            maxlength="500"
                            autocomplete="off"
                            required
                        >
                        <span class="input-char-count" id="charCount">0/500</span>
                    </div>
                    <button type="submit" class="chatbot-send" id="send-btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>Enviar</span>
                    </button>
                </form>

                <div id="typing-indicator" class="chatbot-typing">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span>El asistente está escribiendo...</span>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Notificación flotante -->
<div class="toast-notification" id="toastNotification">
    <i class="fas fa-check-circle"></i>
    <span id="toastMessage"></span>
</div>
@endsection

@push('scripts')
<script>
    // ========== CONFIGURACIÓN INICIAL ==========
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message');
    const chatBox = document.getElementById('chat-box');
    const typingIndicator = document.getElementById('typing-indicator');
    const sendBtn = document.getElementById('send-btn');
    const charCount = document.getElementById('charCount');

    // Contador de caracteres
    messageInput.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = `${length}/500`;
        charCount.style.color = length > 450 ? '#ff9800' : '#5a7c7a';
    });

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.innerText = text;
        return div.innerHTML;
    }

    function detectEmotion(text) {
        const emotions = {
            'triste': '😔 Tristeza',
            'ansioso': '😰 Ansiedad',
            'ansiosa': '😰 Ansiedad',
            'feliz': '😊 Alegría',
            'contento': '😊 Alegría',
            'enojado': '😠 Enojo',
            'enojada': '😠 Enojo',
            'cansado': '😴 Cansancio',
            'cansada': '😴 Cansancio',
            'preocupado': '😟 Preocupación',
            'preocupada': '😟 Preocupación',
            'gracias': '🙏 Gratitud',
            'dormir': '😴 Insomnio',
            'solo': '💔 Soledad',
            'sola': '💔 Soledad',
            'estrés': '😫 Estrés',
            'estres': '😫 Estrés'
        };
        
        text = text.toLowerCase();
        for (let [key, value] of Object.entries(emotions)) {
            if (text.includes(key)) {
                return value;
            }
        }
        return '🤔 Reflexión';
    }

    function showToast(message, icon = '✅', duration = 3000) {
        const toast = document.getElementById('toastNotification');
        const toastMessage = document.getElementById('toastMessage');
        
        toastMessage.innerHTML = `${icon} ${message}`;
        toast.classList.add('show');
        
        setTimeout(() => {
            toast.classList.remove('show');
        }, duration);
    }

    function clearChat() {
        if (confirm('¿Limpiar conversación?')) {
            chatBox.innerHTML = `
                <div class="chatbot-message-row bot">
                    <div class="chatbot-message bot">
                        <i class="fas fa-hand-sparkles" style="margin-right: 8px;"></i>
                        Hola, estoy aquí para escucharte. ¿Cómo te sientes hoy?
                        <div class="chatbot-meta">
                            <span>Asistente</span>
                            <span class="emotion-tag">
                                <i class="fas fa-smile"></i> Escuchando
                            </span>
                        </div>
                    </div>
                </div>
            `;
            showToast('Conversación limpiada', '🧹');
        }
    }

    function useSuggestion(text) {
        messageInput.value = text;
        charCount.textContent = `${text.length}/500`;
        messageInput.focus();
    }

    function appendMessage(text, type = 'bot', meta = '', emotion = null) {
        const row = document.createElement('div');
        row.className = `chatbot-message-row ${type}`;

        const bubble = document.createElement('div');
        bubble.className = `chatbot-message ${type}`;
        
        let metaHtml = `<div class="chatbot-meta">`;
        metaHtml += `<span>${meta}</span>`;
        if (emotion) {
            metaHtml += `<span class="emotion-tag"><i class="fas fa-heart"></i> ${emotion}</span>`;
        }
        metaHtml += `</div>`;

        bubble.innerHTML = `
            ${escapeHtml(text)}
            ${metaHtml}
        `;

        row.appendChild(bubble);
        chatBox.appendChild(row);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const message = messageInput.value.trim();
        if (!message) return;

        const userEmotion = detectEmotion(message);
        appendMessage(message, 'user', 'Tú', userEmotion);
        
        messageInput.value = '';
        charCount.textContent = '0/500';
        messageInput.focus();

        sendBtn.disabled = true;
        typingIndicator.classList.add('show');

        try {
            const response = await fetch("{{ route('chatbot.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            
            setTimeout(() => {
                appendMessage(
                    data.reply ?? 'Gracias por compartir eso conmigo. ¿Hay algo más en lo que pueda ayudarte?',
                    'bot',
                    'Asistente',
                    data.emotion ?? '🤔 Reflexión'
                );
                typingIndicator.classList.remove('show');
                sendBtn.disabled = false;
            }, 1500);

        } catch (error) {
            setTimeout(() => {
                appendMessage(
                    'Lo siento, hay problemas de conexión. Por favor, intenta de nuevo.',
                    'bot',
                    'Asistente',
                    '⚠️ Error de conexión'
                );
                typingIndicator.classList.remove('show');
                sendBtn.disabled = false;
            }, 1000);
        }
    });

    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        showToast('Bienvenido al chat emocional', '👋', 4000);
    });
</script>
@endpush