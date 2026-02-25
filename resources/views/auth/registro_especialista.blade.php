<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Especialistas - Mentally</title>
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

        /* Partículas flotantes profesionales */
        .floating-element {
            position: fixed;
            z-index: 0;
            pointer-events: none;
            opacity: 0.1;
        }

        .brain-float {
            font-size: 8rem;
            color: #4db8a8;
            animation: gentleFloat 15s ease-in-out infinite;
        }

        .brain-1 {
            top: 10%;
            left: 5%;
        }

        .brain-2 {
            bottom: 15%;
            right: 8%;
            animation-delay: 3s;
            animation-direction: reverse;
        }

        .stethoscope-float {
            font-size: 6rem;
            color: #5bc4b3;
            animation: gentleFloat 12s ease-in-out infinite;
        }

        .stethoscope-1 {
            top: 20%;
            right: 10%;
            animation-delay: 1s;
        }

        @keyframes gentleFloat {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(15px, -10px) rotate(3deg);
            }

            50% {
                transform: translate(8px, 15px) rotate(-2deg);
            }

            75% {
                transform: translate(-12px, 8px) rotate(1deg);
            }
        }

        /* Contenedor principal */
        .specialist-container {
            width: 100%;
            max-width: 1200px;
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(44, 95, 93, 0.2);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(5px);
        }

        /* Panel de información */
        .info-panel {
            background: linear-gradient(145deg, #1a4a47 0%, #2c5f5d 50%, #3a7c78 100%);
            padding: 4rem 3rem;
            color: white;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: cover;
        }

        .info-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .info-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: pulseGlow 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }

        @keyframes pulseGlow {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.9;
            }
        }

        .info-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .info-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* Beneficios */
        .benefits-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .benefit-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .benefit-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .benefit-item:hover .benefit-icon {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(10deg) scale(1.1);
        }

        .benefit-content h4 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .benefit-content p {
            font-size: 0.95rem;
            opacity: 0.8;
            line-height: 1.5;
        }

        /* Estadísticas */
        .stats-bar {
            display: flex;
            justify-content: space-around;
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            margin-top: auto;
        }

        .stat-item {
            flex: 1;
        }

        .stat-value {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
            background: linear-gradient(135deg, #4db8a8, #7effd4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Panel de registro */
        .register-panel {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 4rem 3rem;
            position: relative;
            overflow: hidden;
        }

        .register-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
        }

        /* Header del registro */
        .register-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .register-logo {
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

        .register-logo i {
            font-size: 2.5rem;
            animation: gentleFloat 3s ease-in-out infinite;
        }

        .register-subtitle {
            color: #5a7c7a;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .professional-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            color: #4db8a8;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            border: 1px solid rgba(77, 184, 168, 0.2);
        }

        /* Formulario */
        .register-form {
            display: flex;
            flex-direction: column;
            gap: 1.8rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: span 2;
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
            padding: 1.1rem 1.1rem 1.1rem 3.2rem;
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
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #5a7c7a;
            font-size: 1.2rem;
            transition: all 0.3s ease;
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

        /* Select personalizado */
        .custom-select {
            position: relative;
        }

        .select-arrow {
            position: absolute;
            right: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #5a7c7a;
            pointer-events: none;
            transition: transform 0.3s ease;
        }

        .form-input:focus~.select-arrow {
            transform: translateY(-50%) rotate(180deg);
            color: #4db8a8;
        }

        /* Campo de especialidades */
        .specialties-field {
            position: relative;
        }

        .specialties-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .specialty-tag {
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #4db8a8;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(77, 184, 168, 0.2);
        }

        .specialty-tag:hover {
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.2), rgba(91, 196, 179, 0.3));
            transform: translateY(-2px);
        }

        .specialty-tag.selected {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border-color: #4db8a8;
        }

        .specialty-tag i {
            font-size: 0.8rem;
        }

        /* Checkbox de términos */
        .terms-group {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .terms-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 6px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            flex-shrink: 0;
            margin-top: 0.2rem;
        }

        .terms-checkbox:checked {
            background: #4db8a8;
            border-color: #4db8a8;
        }

        .terms-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 0.9rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .terms-label {
            color: #5a7c7a;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .terms-link {
            color: #4db8a8;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .terms-link:hover {
            text-decoration: underline;
            color: #2c5f5d;
        }

        /* Botón de registro */
        .register-button {
            margin-top: 2rem;
            padding: 1.3rem;
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

        .register-button::before {
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

        .register-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .register-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
        }

        .register-button:active {
            transform: translateY(-1px);
        }

        .register-button:disabled {
            background: rgba(90, 124, 122, 0.3);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Separador */
        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
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

        /* Enlace a login */
        .login-link-container {
            text-align: center;
            margin-top: 1.5rem;
        }

        .login-text {
            color: #5a7c7a;
            margin-bottom: 0.5rem;
        }

        .login-button {
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

        .login-button:hover {
            background: rgba(77, 184, 168, 0.1);
            transform: translateY(-2px);
        }

        /* Animaciones de entrada */
        .info-panel {
            opacity: 0;
            transform: translateX(-30px);
            animation: slideInLeft 0.8s ease 0.2s forwards;
        }

        .register-panel {
            opacity: 0;
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

        /* Responsive */
        @media (max-width: 1024px) {
            .specialist-container {
                max-width: 900px;
            }
        }

        @media (max-width: 768px) {
            .specialist-container {
                grid-template-columns: 1fr;
                max-width: 600px;
                border-radius: 20px;
            }

            .info-panel {
                padding: 3rem 2rem;
                border-radius: 20px 20px 0 0;
            }

            .register-panel {
                padding: 3rem 2rem;
                border-radius: 0 0 20px 20px;
            }

            .info-title {
                font-size: 2.2rem;
            }

            .register-logo {
                font-size: 2.2rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .info-panel,
            .register-panel {
                padding: 2rem 1.5rem;
            }

            .info-title {
                font-size: 1.8rem;
            }

            .register-logo {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 0.5rem;
            }

            .benefit-item {
                padding: 1rem;
            }

            .form-input {
                padding: 1rem 1rem 1rem 2.8rem;
            }

            .register-button,
            .login-button {
                width: 100%;
                justify-content: center;
            }

            .stats-bar {
                flex-direction: column;
                gap: 1.5rem;
            }
        }
        
    </style>
</head>

<body>
    <!-- Elementos decorativos -->
    <div class="floating-element brain-float brain-1">
        <i class="fas fa-brain"></i>
    </div>
    <div class="floating-element brain-float brain-2">
        <i class="fas fa-brain"></i>
    </div>
    <div class="floating-element stethoscope-float stethoscope-1">
        <i class="fas fa-stethoscope"></i>
    </div>

    <!-- Contenedor principal -->
    <div class="specialist-container">
        <!-- Panel de información -->
        <div class="info-panel">
            <div class="info-header">
                <div class="info-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h1 class="info-title">Únete a Nuestra Red de Especialistas</h1>
                <p class="info-subtitle">Conecta con pacientes que buscan tu experiencia y amplía tu consulta con
                    herramientas digitales especializadas.</p>
            </div>

            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Amplía tu Consulta</h4>
                        <p>Conecta con pacientes que buscan específicamente tu especialización en salud mental.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Seguimiento Integral</h4>
                        <p>Accede a herramientas digitales para monitorear el progreso de tus pacientes entre sesiones.
                        </p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Gestión de Agenda</h4>
                        <p>Sistema inteligente de citas con recordatorios automáticos y confirmación de asistencia.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Desarrollo Profesional</h4>
                        <p>Acceso a webinars, investigaciones y comunidad de especialistas en salud mental.</p>
                    </div>
                </div>
            </div>

            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-value">200+</div>
                    <div class="stat-label">Especialistas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">5,000+</div>
                    <div class="stat-label">Pacientes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">98%</div>
                    <div class="stat-label">Satisfacción</div>
                </div>
            </div>
        </div>

        <!-- Panel de registro -->
        <div class="register-panel">
            <div class="register-header">
                <div class="register-logo">
                    <i class="fas fa-user-md"></i>
                    Mentally Pro
                </div>
                <p class="register-subtitle">Registro para Profesionales de la Salud Mental</p>
                <div class="professional-badge">
                    <i class="fas fa-shield-alt"></i>
                    Registro Verificado
                </div>
            </div>

            @if ($errors->any())
                <div
                    style="background:#ffe5e5;border:1px solid #ff9b9b;padding:12px;border-radius:10px;margin-bottom:15px;color:#8a1f1f;">
                    <strong>Hay errores en el formulario:</strong>
                    <ul style="margin:8px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="register-form" id="registerForm" method="POST"
                action="{{ route('registro.especialista.post') }}">
                @csrf

                <div class="form-grid">
                    <!-- Información personal -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user-md"></i>
                            Nombres
                        </label>
                        <div class="input-container">
                            <input type="text" class="form-input" id="firstName" name="first_name"
                                placeholder="Ingresa tus nombres" value="{{ old('first_name') }}" required>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                        <div class="error-message" id="firstNameError">Por favor ingresa tus nombres</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user-friends"></i>
                            Apellidos
                        </label>
                        <div class="input-container">
                            <input type="text" class="form-input" id="lastName" name="last_name"
                                placeholder="Ingresa tus apellidos" value="{{ old('last_name') }}" required>
                            <i class="fas fa-user-friends input-icon"></i>
                        </div>
                        <div class="error-message" id="lastNameError">Por favor ingresa tus apellidos</div>
                    </div>

                    <div class="error-message" id="psychiatryLicenseNumberError">Ingresa tu registro médico</div>
                    <div class="error-message" id="medicalSchoolError">Ingresa tu universidad</div>

                    <!-- Información profesional -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-id-card"></i>
                            Registro Médico Psiquiatría
                        </label>
                        <div class="input-container">
                            <input type="text" class="form-input" id="psychiatryLicenseNumber"
                                name="psychiatry_license_number" placeholder="Ej: RM 123456 - Ministerio de Salud"
                                value="{{ old('psychiatry_license_number') }}" required>
                            <i class="fas fa-id-card input-icon"></i>
                        </div>
                        <div class="error-message">
                            Ingresa tu número de registro médico como psiquiatra
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-university"></i>
                            Universidad donde estudió Medicina
                        </label>
                        <div class="input-container">
                            <input type="text" class="form-input" id="medicalSchool" name="medical_school"
                                placeholder="Ej: Universidad Nacional de Colombia" value="{{ old('medical_school') }}"
                                required>
                            <i class="fas fa-university input-icon"></i>
                        </div>
                        <div class="error-message">
                            Ingresa tu universidad
                        </div>
                    </div>


                    <!-- Información de contacto -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>
                            Correo Profesional
                        </label>
                        <div class="input-container">
                            <input type="email" class="form-input" id="email" name="email"
                                placeholder="ejemplo@consultorio.com" value="{{ old('email') }}" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        <div class="error-message" id="emailError">Por favor ingresa un correo válido</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i>
                            Teléfono de Consulta
                        </label>
                        <div class="input-container">
                            <input type="tel" class="form-input" id="phone" name="phone"
                                placeholder="+57 300 123 4567" value="{{ old('phone') }}" required>
                            <i class="fas fa-phone input-icon"></i>
                        </div>
                        <div class="error-message" id="phoneError">Por favor ingresa tu teléfono</div>
                    </div>

                    <!-- Ubicación -->
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Ciudad de Práctica
                        </label>
                        <div class="input-container">
                            <select class="form-input" id="city" name="city" required>
                                <option value="">Selecciona tu ciudad</option>
                                <option value="Bogotá" {{ old('city') == 'Bogotá' ? 'selected' : '' }}>Bogotá</option>
                                <option value="Medellín" {{ old('city') == 'Medellín' ? 'selected' : '' }}>Medellín
                                </option>
                                <option value="Cali" {{ old('city') == 'Cali' ? 'selected' : '' }}>Cali</option>
                                <option value="Barranquilla" {{ old('city') == 'Barranquilla' ? 'selected' : '' }}>
                                    Barranquilla</option>
                                <option value="Cartagena" {{ old('city') == 'Cartagena' ? 'selected' : '' }}>Cartagena
                                </option>
                                <option value="Bucaramanga" {{ old('city') == 'Bucaramanga' ? 'selected' : '' }}>
                                    Bucaramanga</option>
                                <option value="Otra" {{ old('city') == 'Otra' ? 'selected' : '' }}>Otra ciudad
                                </option>
                            </select>
                            <i class="fas fa-map-marker-alt input-icon"></i>
                            <div class="select-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="error-message" id="cityError">Por favor selecciona tu ciudad</div>
                    </div>

                    <!-- Especialidades -->
                    <div class="form-group full-width specialties-field">
                        <label class="form-label">
                            <i class="fas fa-stethoscope"></i>
                            Especialidades
                        </label>
                        <div class="input-container">
                            <input type="text" class="form-input" id="specialtiesInput"
                                placeholder="Escribe para buscar o selecciona de la lista">
                            <i class="fas fa-stethoscope input-icon"></i>
                        </div>
                        <div class="specialties-tags" id="specialtiesTags">
                            <!-- Las etiquetas se generan con JavaScript -->
                        </div>
                        <input type="hidden" name="specialties" id="specialtiesHidden">
                        <div class="error-message" id="specialtiesError">Por favor selecciona al menos una
                            especialidad</div>
                    </div>

                    <!-- Contraseña -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-key"></i>
                            Contraseña
                        </label>
                        <div class="input-container">
                            <input type="password" class="form-input" id="password" name="password"
                                placeholder="Mínimo 8 caracteres" required>
                            <i class="fas fa-key input-icon"></i>
                        </div>
                        <div class="error-message" id="passwordError">La contraseña debe tener al menos 8 caracteres
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-key"></i>
                            Confirmar Contraseña
                        </label>
                        <div class="input-container">
                            <input type="password" class="form-input" id="password_confirmation"
                                name="password_confirmation" placeholder="Repite tu contraseña" required>
                            <i class="fas fa-key input-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Términos y condiciones -->
                <div class="terms-group">
                    <input type="checkbox" class="terms-checkbox" id="terms" name="terms" value="1"
                        {{ old('terms') ? 'checked' : '' }} required>
                    <label class="terms-label">
                        Acepto los <a href="#" class="terms-link">Términos de Servicio para Especialistas</a>,
                        la
                        <a href="#" class="terms-link">Política de Privacidad</a> y confirmo que poseo las
                        credenciales
                        necesarias para ejercer como profesional de la salud mental.
                    </label>
                </div>

                <button type="submit" class="register-button" id="submitButton">
                    <i class="fas fa-user-plus"></i>
                    Registrar como Especialista
                </button>
            </form>

            <!-- Separador -->
            <div class="divider">
                <div class="divider-text">¿Ya tienes una cuenta?</div>
            </div>

            <!-- Enlace a login -->
            <div class="login-link-container">
                <p class="login-text">Inicia sesión en tu cuenta de especialista</p>
                <a href="{{ route('login') }}" class="login-button" id="loginButton">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </a>
            </div>
        </div>
    </div>

    <script>
        // Datos de especialidades
        const specialties = [
            "Ansiedad", "Depresión", "Estrés Postraumático", "Trastornos Alimenticios",
            "Terapia de Pareja", "Terapia Familiar", "Neuropsicología", "Psicología Infantil",
            "Trastornos del Sueño", "Adicciones", "TOC", "Bipolaridad", "Esquizofrenia",
            "Autismo", "TDAH", "Duelo", "Autoestima", "Mindfulness", "Terapia Cognitivo-Conductual",
            "Psicoanálisis", "Terapia Sistémica", "Sexología", "Gerontología"
        ];

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const specialtiesTags = document.getElementById('specialtiesTags');
            const specialtiesHidden = document.getElementById('specialtiesHidden');
            const specialtiesInput = document.getElementById('specialtiesInput');
            const submitButton = document.getElementById('submitButton');
            let selectedSpecialties = [];

            // Inicializar especialidades
            initializeSpecialties();
            initializeFormValidation();

            // Inicializar etiquetas de especialidades
            function initializeSpecialties() {
                specialties.forEach(specialty => {
                    const tag = document.createElement('div');
                    tag.className = 'specialty-tag';
                    tag.innerHTML = `
                        <i class="fas fa-plus"></i>
                        <span>${specialty}</span>
                    `;

                    tag.addEventListener('click', function() {
                        this.classList.toggle('selected');
                        const icon = this.querySelector('i');
                        icon.className = this.classList.contains('selected') ?
                            'fas fa-check' :
                            'fas fa-plus';

                        // Actualizar array de especialidades seleccionadas
                        if (this.classList.contains('selected')) {
                            selectedSpecialties.push(specialty);
                        } else {
                            selectedSpecialties = selectedSpecialties.filter(s => s !== specialty);
                        }

                        // Actualizar input hidden
                        specialtiesHidden.value = JSON.stringify(selectedSpecialties);
                        specialtiesHidden.dispatchEvent(new Event('change'));

                        // Efecto visual
                        this.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);
                    });

                    specialtiesTags.appendChild(tag);
                });

                // Búsqueda de especialidades
                specialtiesInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const allTags = document.querySelectorAll('.specialty-tag');

                    allTags.forEach(tag => {
                        const text = tag.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            tag.style.display = 'flex';
                            tag.style.animation = 'slideInRight 0.3s ease';
                        } else {
                            tag.style.display = 'none';
                        }
                    });
                });

                // Limpiar búsqueda al hacer clic fuera
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.specialties-field')) {
                        specialtiesInput.value = '';
                        document.querySelectorAll('.specialty-tag').forEach(tag => {
                            tag.style.display = 'flex';
                        });
                    }
                });
            }

            // Inicializar validación del formulario
            function initializeFormValidation() {
                const inputs = {
                    firstName: document.getElementById('firstName'),
                    lastName: document.getElementById('lastName'),
                    psychiatryLicenseNumber: document.getElementById('psychiatryLicenseNumber'),
                    medicalSchool: document.getElementById('medicalSchool'),
                    email: document.getElementById('email'),
                    phone: document.getElementById('phone'),
                    city: document.getElementById('city'),
                    password: document.getElementById('password'),
                    terms: document.getElementById('terms')
                };


                const errors = {
                    firstName: document.getElementById('firstNameError'),
                    lastName: document.getElementById('lastNameError'),
                    psychiatryLicenseNumber: document.getElementById('psychiatryLicenseNumberError'),
                    medicalSchool: document.getElementById('medicalSchoolError'),
                    email: document.getElementById('emailError'),
                    phone: document.getElementById('phoneError'),
                    city: document.getElementById('cityError'),
                    password: document.getElementById('passwordError'),
                    specialties: document.getElementById('specialtiesError')
                };


                // Validación en tiempo real
                Object.keys(inputs).forEach(key => {
                    if (inputs[key].type !== 'checkbox' && inputs[key].tagName !== 'SELECT') {
                        inputs[key].addEventListener('input', function() {
                            validateField(key, inputs, errors);
                            updateSubmitButton(inputs, errors);
                        });

                        inputs[key].addEventListener('blur', function() {
                            validateField(key, inputs, errors);
                        });
                    } else if (inputs[key].tagName === 'SELECT') {
                        inputs[key].addEventListener('change', function() {
                            validateField(key, inputs, errors);
                            updateSubmitButton(inputs, errors);
                        });
                    } else if (inputs[key].type === 'checkbox') {
                        inputs[key].addEventListener('change', function() {
                            updateSubmitButton(inputs, errors);
                        });
                    }
                });

                // Validar especialidades
                specialtiesHidden.addEventListener('change', function() {
                    validateSpecialties(errors);
                    updateSubmitButton(inputs, errors);
                });

                // Efectos de focus en inputs
                document.querySelectorAll('.form-input').forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.style.transform = 'scale(1.02)';
                        this.parentElement.style.boxShadow = '0 5px 20px rgba(77, 184, 168, 0.15)';
                    });

                    input.addEventListener('blur', function() {
                        this.parentElement.style.transform = 'scale(1)';
                        this.parentElement.style.boxShadow = 'none';
                    });
                });
            }

            // Función de validación de campo
            function validateField(fieldName, inputs, errors) {
                const input = inputs[fieldName];
                const error = errors[fieldName];
                let isValid = false;
                let message = '';

                switch (fieldName) {
                    case 'firstName':
                    case 'lastName':
                        isValid = input.value.trim().length >= 2;
                        message = `Por favor ingresa tu ${fieldName === 'firstName' ? 'nombre' : 'apellido'}`;
                        break;

                    case 'psychiatryLicenseNumber':
                        isValid = input.value.trim().length >= 3;
                        message = 'Ingresa tu registro médico como psiquiatra';
                        break;

                    case 'medicalSchool':
                        isValid = input.value.trim().length >= 2;
                        message = 'Ingresa tu universidad';
                        break;

                    case 'email':
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        isValid = emailRegex.test(input.value.trim());
                        message = 'Por favor ingresa un correo válido';
                        break;

                    case 'phone':
                        const phoneRegex = /^[\d\s\+\-\(\)]{10,}$/;
                        isValid = phoneRegex.test(input.value.trim());
                        message = 'Por favor ingresa un teléfono válido';
                        break;

                    case 'city':
                        isValid = input.value !== '';
                        message = 'Por favor selecciona tu ciudad';
                        break;

                    case 'password':
                        isValid = input.value.length >= 8;
                        message = 'La contraseña debe tener al menos 8 caracteres';
                        break;
                }

                if (isValid) {
                    input.classList.remove('error');
                    input.classList.add('valid');
                    if (error) error.style.display = 'none';
                } else {
                    input.classList.remove('valid');
                    input.classList.add('error');
                    if (error) {
                        error.textContent = message;
                        error.style.display = 'block';
                    }
                }

                return isValid;
            }

            // Validar especialidades
            function validateSpecialties(errors) {
                const error = errors.specialties;
                const isValid = selectedSpecialties.length > 0;

                if (isValid) {
                    if (error) error.style.display = 'none';
                } else {
                    if (error) {
                        error.textContent = 'Por favor selecciona al menos una especialidad';
                        error.style.display = 'block';
                    }
                }

                return isValid;
            }

            // Actualizar estado del botón de envío
            function updateSubmitButton(inputs, errors) {
                const isFormValid =
                    validateField('firstName', inputs, errors) &&
                    validateField('lastName', inputs, errors) &&
                    validateField('psychiatryLicenseNumber', inputs, errors) &&
                    validateField('medicalSchool', inputs, errors) &&
                    validateField('email', inputs, errors) &&
                    validateField('phone', inputs, errors) &&
                    validateField('city', inputs, errors) &&
                    validateField('password', inputs, errors) &&
                    validateSpecialties(errors) &&
                    inputs.terms.checked;

                submitButton.disabled = !isFormValid;

                // Efecto visual en el botón
                if (isFormValid) {
                    submitButton.style.background = 'linear-gradient(135deg, #4db8a8, #5bc4b3)';
                    submitButton.style.cursor = 'pointer';
                } else {
                    submitButton.style.background =
                        'linear-gradient(135deg, rgba(90, 124, 122, 0.3), rgba(90, 124, 122, 0.4))';
                    submitButton.style.cursor = 'not-allowed';
                }
            }

            // Animación para el formulario
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observar elementos del formulario
            document.querySelectorAll('.form-group').forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                group.style.transition = `all 0.5s ease ${index * 0.1}s`;
                observer.observe(group);
            });

            // Efecto de envío del formulario
            form.addEventListener('submit', function(e) {
                if (!submitButton.disabled) {
                    // Animación de envío
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
                    submitButton.style.background = 'linear-gradient(135deg, #3a9c8c, #4db8a8)';

                    // Efecto de confeti
                    createConfetti();
                }
            });

            // Efecto de confeti
            function createConfetti() {
                const colors = ['#4db8a8', '#5bc4b3', '#2c5f5d', '#7effd4', '#5a7c7a'];

                for (let i = 0; i < 30; i++) {
                    const confetti = document.createElement('div');
                    confetti.style.cssText = `
                        position: fixed;
                        width: ${Math.random() * 10 + 5}px;
                        height: ${Math.random() * 10 + 5}px;
                        background: ${colors[Math.floor(Math.random() * colors.length)]};
                        border-radius: ${Math.random() > 0.5 ? '50%' : '2px'};
                        top: -20px;
                        left: ${Math.random() * 100}vw;
                        z-index: 1000;
                        animation: confettiFall ${Math.random() * 3 + 2}s linear forwards;
                    `;

                    document.body.appendChild(confetti);

                    setTimeout(() => confetti.remove(), 5000);
                }

                // Añadir keyframes
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes confettiFall {
                        0% {
                            transform: translateY(0) rotate(0deg);
                            opacity: 1;
                        }
                        100% {
                            transform: translateY(100vh) rotate(${Math.random() * 720}deg);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
            }

            // Interactividad para los beneficios
            document.querySelectorAll('.benefit-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('.benefit-icon i');
                    icon.style.transform = 'scale(1.2)';
                });

                item.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('.benefit-icon i');
                    icon.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>

</html>
