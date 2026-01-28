<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Mentally</title>
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

        /* Contenedor principal horizontal */
        .login-container {
            width: 100%;
            max-width: 1100px;
            padding: 1.5rem;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            gap: 0;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(44, 95, 93, 0.15);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
        }

        /* Panel de imagen decorativo */
        .image-panel {
            flex: 1;
            min-width: 450px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 24px 0 0 24px;
            background: linear-gradient(145deg, #2c5f5d 0%, #4db8a8 100%);
        }

        .image-frame {
            width: 90%;
            height: 80%;
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            border: 8px solid rgba(255, 255, 255, 0.1);
            transform: rotate(-2deg);
            transition: all 0.5s ease;
        }

        .image-frame:hover {
            transform: rotate(0deg) scale(1.02);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(44, 95, 93, 0.9), rgba(77, 184, 168, 0.9));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 2rem;
            position: relative;
        }

        .image-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: gentleFloat 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }

        .image-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .image-subtitle {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 90%;
            line-height: 1.6;
            opacity: 0.9;
        }

        .image-features {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .feature-tag {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-tag:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
        }

        .feature-tag i {
            font-size: 0.9rem;
        }

        .floating-hearts {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-heart {
            position: absolute;
            color: rgba(255, 255, 255, 0.3);
            font-size: 1.5rem;
            animation: floatHeart 8s linear infinite;
        }

        @keyframes floatHeart {
            0% {
                transform: translateY(100%) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.7;
            }

            90% {
                opacity: 0.7;
            }

            100% {
                transform: translateY(-100%) rotate(360deg);
                opacity: 0;
            }
        }

        /* Tarjeta de login */
        .login-card {
            flex: 1;
            min-width: 450px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 3rem;
            position: relative;
            overflow: hidden;
            border-radius: 0 24px 24px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
        }

        /* Logo y título */
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-logo {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.8rem;
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

        .login-logo i {
            font-size: 2.5rem;
            animation: gentleFloat 3s ease-in-out infinite;
        }

        @keyframes gentleFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .login-subtitle {
            color: #5a7c7a;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        /* Formulario */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.8rem;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #2c5f5d;
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-label i {
            color: #4db8a8;
            width: 20px;
        }

        .input-container {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            color: #2c5f5d;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input::placeholder {
            color: rgba(90, 124, 122, 0.6);
        }

        .form-input:focus {
            border-color: #4db8a8;
            box-shadow: 0 0 0 3px rgba(77, 184, 168, 0.2);
            transform: translateY(-2px);
        }

        .form-input.valid {
            border-color: #4db8a8;
            background: rgba(77, 184, 168, 0.05);
        }

        .form-input.error {
            border-color: #f44336;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #5a7c7a;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-input:focus+.input-icon {
            color: #4db8a8;
        }

        .error-message {
            color: #f44336;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: none;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Opciones adicionales */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #5a7c7a;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .remember-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .remember-checkbox:checked {
            background: #4db8a8;
            border-color: #4db8a8;
        }

        .remember-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 0.8rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .forgot-password {
            color: #4db8a8;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            text-decoration: underline;
            color: #2c5f5d;
        }

        /* Botón de login */
        .login-button {
            margin-top: 1.5rem;
            padding: 1.2rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .login-button::before {
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

        .login-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .login-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
        }

        .login-button:active {
            transform: translateY(-1px);
        }

        .login-button:disabled {
            background: rgba(90, 124, 122, 0.3);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Separador */
        .divider {
            display: flex;
            align-items: center;
            margin: 1.8rem 0;
            color: #5a7c7a;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(77, 184, 168, 0.2);
        }

        .divider-text {
            padding: 0 1rem;
            font-size: 0.9rem;
        }

        /* Botón de login social */
        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-button {
            flex: 1;
            padding: 0.9rem;
            border: 2px solid rgba(77, 184, 168, 0.2);
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            font-weight: 500;
            color: #2c5f5d;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #4db8a8;
        }

        .social-button.google {
            color: #DB4437;
        }


        .social-button i {
            font-size: 1.2rem;
        }

        /* Enlace a registro */
        .register-link-container {
            text-align: center;
            margin-top: 1.5rem;
        }

        .register-text {
            color: #5a7c7a;
            margin-bottom: 0.5rem;
        }

        .register-button {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.8rem 2rem;
            background: transparent;
            color: #4db8a8;
            border: 2px solid #4db8a8;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .register-button:hover {
            background: rgba(77, 184, 168, 0.1);
            transform: translateY(-2px);
        }

        /* Animaciones de entrada */
        .login-card,
        .image-panel {
            opacity: 0;
            transform: translateX(-30px);
            animation: slideInLeft 0.8s ease 0.2s forwards;
        }

        .image-panel {
            transform: translateX(30px);
            animation: slideInRight 0.8s ease 0.2s forwards;
        }

        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Efecto de éxito */
        .success-animation {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.98);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 0 24px 24px 0;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease;
            z-index: 10;
        }

        .success-animation.active {
            opacity: 1;
            pointer-events: all;
        }

        .success-icon {
            font-size: 4rem;
            color: #4db8a8;
            margin-bottom: 1.5rem;
            animation: successScale 0.6s ease 0.3s both;
        }

        @keyframes successScale {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .success-message {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            color: #2c5f5d;
            margin-bottom: 1rem;
            text-align: center;
        }

        .success-text {
            color: #5a7c7a;
            text-align: center;
            margin-bottom: 2rem;
            max-width: 80%;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .login-container {
                max-width: 900px;
            }

            .login-card,
            .image-panel {
                min-width: 400px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                padding: 1rem;
                max-width: 500px;
                border-radius: 20px;
            }

            .login-card,
            .image-panel {
                min-width: 100%;
                width: 100%;
                border-radius: 20px;
            }

            .image-panel {
                height: 400px;
                order: -1;
                border-radius: 20px 20px 0 0;
            }

            .login-card {
                padding: 2rem;
                border-radius: 0 0 20px 20px;
            }

            .login-logo {
                font-size: 2.2rem;
            }

            .login-logo i {
                font-size: 1.8rem;
            }

            .image-title {
                font-size: 1.8rem;
            }

            .image-subtitle {
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            .social-login {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem;
            }

            .image-panel {
                height: 350px;
            }

            .login-logo {
                font-size: 2rem;
                flex-direction: column;
                gap: 0.5rem;
            }

            .form-input {
                padding: 0.9rem 0.9rem 0.9rem 2.5rem;
            }

            .input-icon {
                left: 0.8rem;
            }

            .login-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .register-button {
                width: 100%;
                justify-content: center;
            }

            .image-title {
                font-size: 1.6rem;
                margin-bottom: 0.8rem;
            }

            .image-subtitle {
                font-size: 0.95rem;
                max-width: 95%;
            }

            .image-features {
                flex-direction: column;
                align-items: center;
            }

            .feature-tag {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- Partículas flotantes -->
    <div class="floating-particle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="floating-particle" style="top: 60%; right: 15%; animation-delay: 2s;"></div>
    <div class="floating-particle" style="bottom: 30%; left: 20%; animation-delay: 4s;"></div>

    <!-- Contenedor principal horizontal -->
    <div class="login-container">
        <!-- Panel de imagen decorativo -->
        <div class="image-panel">
            <!-- Corazones flotantes -->
            <div class="floating-hearts" id="floatingHearts"></div>

            <!-- Marco de la imagen -->
            <div class="image-frame">
                <div class="image-placeholder">
                    <i class="fas fa-heart image-icon"></i>
                    <h2 class="image-title">Bienvenido de Nuevo</h2>
                    <p class="image-subtitle">Únete a nuestra comunidad y continua tu viaje hacia el equilibrio
                        emocional</p>

                    <div class="image-features">
                        <div class="feature-tag">
                            <i class="fas fa-heartbeat"></i> Bienestar Emocional
                        </div>
                        <div class="feature-tag">
                            <i class="fas fa-users"></i> Comunidad de Apoyo
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta de login -->
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-brain"></i>
                    Mentally
                </div>
                <p class="login-subtitle">Continúa tu camino hacia el bienestar emocional</p>
            </div>

            @if ($errors->any())
                <div
                    style="background:#ffe5e5;border:1px solid #ff9b9b;padding:12px;border-radius:10px;margin-bottom:15px;color:#8a1f1f;">
                    <strong>Hay errores en el login:</strong>
                    <ul style="margin:8px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Formulario -->
            <form class="login-form" id="loginForm" method="POST" action="{{ route('login.post') }}">
                @csrf
                <input type="hidden" name="redirect" id="redirectInput" value="{{ request('redirect') }}">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>
                        Correo electrónico
                    </label>
                    <div class="input-container">
                        <input type="email" class="form-input" id="email" name="email"
                            placeholder="ejemplo@correo.com" value="{{ old('email') }}">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    <div class="error-message" id="emailError">Por favor ingresa un correo válido</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-key"></i>
                        Contraseña
                    </label>
                    <div class="input-container">
                        <input type="password" class="form-input" id="password" name="password"
                            placeholder="Ingresa tu contraseña">
                        <i class="fas fa-key input-icon"></i>
                    </div>
                    <div class="error-message" id="passwordError">Por favor ingresa tu contraseña</div>
                </div>

                <div class="login-options">
                    <label class="remember-me">
                        <input type="checkbox" class="remember-checkbox" id="remember" name="remember" value="1"
                            {{ old('remember') ? 'checked' : '' }}>
                        Recordarme
                    </label>
                    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="login-button" id="submitButton">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </button>
            </form>

            <!-- Separador -->
            <div class="divider">
                <div class="divider-text">O continúa con</div>
            </div>

            <!-- Login social -->
            <div class="social-login">
                <button type="button" class="social-button google" id="googleLogin">
                    <i class="fab fa-google"></i>
                    Google
                </button>

            </div>

            <!-- Separador -->
            <div class="divider">
                <div class="divider-text">¿No tienes una cuenta?</div>
            </div>

            <!-- Enlace a registro -->
            <div class="register-link-container">
                <p class="register-text">Crea una cuenta para comenzar tu viaje</p>
                <a href="#" class="register-button" id="registerButton">
                    <i class="fas fa-user-plus"></i>
                    Crear Cuenta
                </a>
            </div>

            <!-- Animación de éxito -->
            <div class="success-animation" id="successAnimation">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="success-message">¡Bienvenido de Vuelta!</h2>
                <p class="success-text">Te redireccionaremos a tu dashboard en unos segundos...</p>
                <div class="spinner">
                    <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #4db8a8;"></i>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Crear corazones flotantes
        function createFloatingHearts() {
            const container = document.getElementById('floatingHearts');
            for (let i = 0; i < 15; i++) {
                const heart = document.createElement('div');
                heart.className = 'floating-heart';
                heart.innerHTML = '❤';
                heart.style.left = `${Math.random() * 100}%`;
                heart.style.animationDelay = `${Math.random() * 5}s`;
                heart.style.fontSize = `${Math.random() * 1 + 1}rem`;
                container.appendChild(heart);
            }
        }

        // ===== Redirect after login (from ?redirect=... or sessionStorage) =====
        (function setRedirectField() {
            const input = document.getElementById('redirectInput');
            if (!input) return;

            const params = new URLSearchParams(window.location.search);
            const fromQuery = params.get('redirect');
            const fromStorage = sessionStorage.getItem('redirectAfterLogin');

            const redirect = fromQuery || fromStorage || '';

            // Seguridad: solo rutas internas
            if (redirect && redirect.startsWith('/')) {
                input.value = redirect;
                sessionStorage.setItem('redirectAfterLogin', redirect);
            } else {
                input.value = '';
            }
        })();


        // Validación del formulario
        document.addEventListener('DOMContentLoaded', function() {
            createFloatingHearts();

            const form = document.getElementById('loginForm');
            const inputs = {
                email: document.getElementById('email'),
                password: document.getElementById('password'),
                remember: document.getElementById('remember')
            };

            const errors = {
                email: document.getElementById('emailError'),
                password: document.getElementById('passwordError')
            };

            const submitButton = document.getElementById('submitButton');
            const successAnimation = document.getElementById('successAnimation');
            const registerButton = document.getElementById('registerButton');
            const googleLogin = document.getElementById('googleLogin');

            const forgotPassword = document.querySelector('.forgot-password');

            // Validación en tiempo real
            Object.keys(inputs).forEach(key => {
                if (inputs[key].type !== 'checkbox') {
                    inputs[key].addEventListener('input', function() {
                        validateField(key);
                        updateSubmitButton();
                    });

                    inputs[key].addEventListener('blur', function() {
                        validateField(key);
                    });
                }
            });

            // Validación específica por campo
            function validateField(fieldName) {
                const input = inputs[fieldName];
                const error = errors[fieldName];
                let isValid = false;
                let message = '';

                switch (fieldName) {
                    case 'email':
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        isValid = emailRegex.test(input.value.trim());
                        message = 'Por favor ingresa un correo válido';
                        break;

                    case 'password':
                        isValid = input.value.length >= 6;
                        message = 'La contraseña debe tener al menos 6 caracteres';
                        break;
                }

                if (isValid) {
                    input.classList.remove('error');
                    input.classList.add('valid');
                    error.style.display = 'none';
                } else {
                    input.classList.remove('valid');
                    input.classList.add('error');
                    error.textContent = message;
                    error.style.display = 'block';
                }

                return isValid;
            }

            // Actualizar estado del botón
            function updateSubmitButton() {
                const isFormValid =
                    validateField('email') &&
                    validateField('password');

                submitButton.disabled = !isFormValid;
            }

            // Envío del formulario
            form.addEventListener('submit', function(e) {
                const isValid =
                    validateField('email') &&
                    validateField('password');

                if (!isValid) {
                    e.preventDefault();
                    return;
                }

                // Mostrar animación de éxito, pero dejar que el form se envíe a Laravel
                showSuccessAnimation();
                submitButton.disabled = true;
            });


            // Login con Google
            googleLogin.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Conectando...';
                this.disabled = true;

                setTimeout(() => {
                    // Simular éxito de login con Google
                    showSuccessAnimation('Google');
                }, 1500);
            });



            // Animación de éxito
            function showSuccessAnimation(provider = '') {
                // Animación de confeti
                createConfetti();

                // Mostrar overlay de éxito
                successAnimation.classList.add('active');

                // Cambiar mensaje si es login social
                if (provider) {
                    document.querySelector('.success-message').textContent = `¡Conectado con ${provider}!`;
                }

                // Deshabilitar formulario
                form.style.opacity = '0.5';
                form.style.pointerEvents = 'none';

                // Restaurar botones sociales
                setTimeout(() => {
                    googleLogin.innerHTML = '<i class="fab fa-google"></i> Google';
                    googleLogin.disabled = false;
                }, 3000);
            }

            // Efecto de confeti
            function createConfetti() {
                const colors = ['#4db8a8', '#5bc4b3', '#2c5f5d', '#5a7c7a'];

                for (let i = 0; i < 40; i++) {
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

                // Añadir keyframes para caída
                const style = document.createElement('style');
                style.textContent = `
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
            }

            // Redirección a registro
            registerButton.addEventListener('click', function(e) {
                e.preventDefault();

                // Animación de transición
                document.querySelector('.login-card').style.animation = 'fadeOut 0.6s ease forwards';
                document.querySelector('.image-panel').style.animation = 'fadeOut 0.6s ease forwards';

                setTimeout(() => {
                    // Redirigir a registro
                    window.location.href = '/registro';
                }, 600);
            });

            // Recuperación de contraseña
            forgotPassword.addEventListener('click', function(e) {
                e.preventDefault();

                // Mostrar mensaje de recuperación
                const email = inputs.email.value.trim();
                if (email && validateField('email')) {
                    alert(`Se ha enviado un enlace de recuperación a: ${email}`);
                } else {
                    inputs.email.classList.add('error');
                    errors.email.textContent = 'Ingresa tu correo para recuperar la contraseña';
                    errors.email.style.display = 'block';
                    inputs.email.focus();
                }
            });

            // Añadir keyframes para fadeOut
            const fadeOutStyle = document.createElement('style');
            fadeOutStyle.textContent = `
                @keyframes fadeOut {
                    to {
                        opacity: 0;
                        transform: translateY(-30px);
                    }
                }
            `;
            document.head.appendChild(fadeOutStyle);

            // Efecto de focus en inputs
            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Interactividad para la imagen
            const imageFrame = document.querySelector('.image-frame');
            imageFrame.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.35)';
            });

            imageFrame.addEventListener('mouseleave', function() {
                this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.25)';
            });

            // Efecto de parpadeo suave en el icono del corazón
            const heartIcon = document.querySelector('.image-icon');
            setInterval(() => {
                heartIcon.style.opacity = Math.random() * 0.3 + 0.7;
            }, 2000);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hidden = document.querySelector('input[name="redirect"]');
            if (!hidden) return;

            if (!hidden.value) {
                const s = sessionStorage.getItem('redirectAfterLogin');
                if (s && s.startsWith('/')) hidden.value = s;
            }

            // Limpieza al enviar
            const form = document.getElementById('loginForm');
            if (form) {
                form.addEventListener('submit', () => {
                    sessionStorage.removeItem('redirectAfterLogin');
                });
            }
        });
    </script>
</body>

</html>
