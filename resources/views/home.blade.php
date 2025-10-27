<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentally - Tu espacio digital de bienestar emocional</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        nav:hover {
            background: rgba(255, 255, 255, 0.85);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #128674d5;
            letter-spacing: 0.5px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            align-items: center;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: #2c5f5d;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #4db8a8;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            min-width: 220px;
            padding: 0.8rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        .nav-item:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            padding: 0.8rem 1.5rem;
            color: #2c5f5d;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.1));
            color: #4db8a8;
            padding-left: 2rem;
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
            cursor: pointer;
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
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
        }

        .btn-signup {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            box-shadow: 0 4px 15px rgba(77, 184, 168, 0.3);
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(77, 184, 168, 0.4);
        }

        /* Hero Section */
        .hero-section {
            margin-top: 100px;
            padding: 4rem 3rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            min-height: calc(100vh - 100px);
        }

        .hero-image {
            position: relative;
            animation: floatImage 3s ease-in-out infinite;
        }

        @keyframes floatImage {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .image-placeholder {
            width: 100%;
            max-width: 500px;
            aspect-ratio: 1;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4db8a8;
            font-size: 1.2rem;
            box-shadow: 0 20px 60px rgba(77, 184, 168, 0.2);
        }

        .hero-content {
            position: relative;
            overflow: visible;
        }

        .hero-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 4rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
            animation: fadeInUp 0.8s ease;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #5a7c7a;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.8s ease 0.2s backwards;
        }

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

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 2.5rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.3);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease 0.4s backwards;
        }

        .cta-button::before {
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

        .cta-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.4);
        }

        /* Brain Animation */
        .brain {
            width: 44px;
            height: 44px;
            position: absolute;
            top: 40px;
            left: 22px;
            opacity: 0;
            animation: flyToCTA 2s cubic-bezier(0.4, 0, 0.2, 1) 0.8s forwards;
            z-index: 10;
        }

        @keyframes flyToCTA {
            0% {
                opacity: 0;
                transform: translate(0, 0) scale(0.3);
            }
            20% {
                opacity: 1;
            }
            100% {
                opacity: 1;
                transform: translate(var(--bx, 0), var(--by, 0)) scale(1);
            }
        }

        .brain.wink .eye {
            animation: winkEye 0.6s ease 0.3s;
        }

        @keyframes winkEye {
            0%, 100% { transform: scaleY(1); }
            45%, 55% { transform: scaleY(0.1); }
        }

        /* Pequeña animación de flotación después del guiño */
        .brain.wink {
            animation: flyToCTA 2s cubic-bezier(0.4, 0, 0.2, 1) 0.8s forwards,
                       gentleFloat 3s ease-in-out 3s infinite;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translate(var(--bx, 0), var(--by, 0)) translateY(0px); }
            50% { transform: translate(var(--bx, 0), var(--by, 0)) translateY(-5px); }
        }

        /* Decorative Elements */
        .floating-circle {
            position: fixed;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.1));
            pointer-events: none;
            z-index: 0;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            right: 10%;
            animation: float 6s ease-in-out infinite;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: 15%;
            left: 5%;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 30px); }
        }

        /* Responsive */
        @media (max-width: 968px) {
            nav {
                padding: 1rem 1.5rem;
            }

            .nav-links {
                gap: 1.5rem;
            }

            .hero-section {
                grid-template-columns: 1fr;
                gap: 3rem;
                padding: 3rem 1.5rem;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-image {
                order: -1;
            }

            .image-placeholder {
                margin: 0 auto;
            }
        }

        @media (max-width: 640px) {
            .nav-links {
                display: none;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Decorative Circles -->
    <div class="floating-circle circle-1"></div>
    <div class="floating-circle circle-2"></div>

    <!-- Navigation -->
    <nav>
        <div class="logo-section">
            <div class="logo-placeholder">
                <!-- Espacio para el logo en miniatura -->
                <img src="{{ asset('logo_pg.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <span class="brand-name">Mentally</span>
        </div>

        <ul class="nav-links">
            <li class="nav-item">
                <a class="nav-link">Servicios</a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Diario Emocional</a>
                    <a href="#" class="dropdown-item">Predictor de Crisis</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link">Tests</a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Test de Depresión</a>
                    <a href="#" class="dropdown-item">Test de Ansiedad</a>
                    <a href="#" class="dropdown-item">Test de Esquizofrenia</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link">Blog</a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Artículos</a>
                    <a href="#" class="dropdown-item">Postea tu Historia</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Directorio de especialistas</a>
            </li>
        </ul>

        <div class="auth-buttons">
            <a href="#" class="btn btn-login">Iniciar sesión</a>
            <a href="#" class="btn btn-signup">Crear cuenta</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-image">
            <div class="image-placeholder">
                <!-- Espacio para la imagen del mockup -->
                <img src="{{ asset('rompecabezas.png') }}" alt="Mentally Ilustración" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
        </div>

        <div class="hero-content">
            <!-- CEREBRO ANIMADO -->
            <svg class="brain" id="brainMascot" viewBox="0 0 64 64" fill="none" role="img" aria-label="Cerebro animado">
                <defs>
                    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="#ffc7d8"/>
                        <stop offset="1" stop-color="#ff9fc0"/>
                    </linearGradient>
                </defs>
                <!-- cerebro -->
                <path d="M20 18c0-6 6-10 12-10s12 4 12 10c4 0 8 4 8 9s-2 9-8 9H20c-6 0-10-4-10-9s4-9 10-9Z"
                      fill="url(#g)" stroke="#e68aa8" stroke-width="2" />
                <!-- surcos -->
                <path d="M18 23c3-3 8-3 11 0M35 18c4 1 7 4 8 8" stroke="#e68aa8" stroke-width="2" stroke-linecap="round" />
                <!-- ojos -->
                <circle id="eye-left" class="eye" cx="26" cy="30" r="3" fill="#253138"/>
                <circle id="eye-right" class="eye" cx="38" cy="30" r="3" fill="#253138"/>
                <!-- pequeña sonrisa -->
                <path d="M28 36c2 2 6 2 8 0" stroke="#253138" stroke-width="2" stroke-linecap="round"/>
            </svg>

            <h1 class="hero-title">Mentally</h1>
            <p class="hero-subtitle">Un espacio digital para comprenderte, cuidarte y fortalecer tu bienestar emocional.</p>
            <a href="#" class="cta-button" id="ctaBtn">
                Habla con Cereon
            </a>
        </div>
    </section>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar scroll effect
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                nav.style.padding = '0.7rem 3rem';
            } else {
                nav.style.padding = '1rem 3rem';
            }

            lastScroll = currentScroll;
        });

        // Add hover effect to CTA button
        const ctaButton = document.querySelector('.cta-button');
        ctaButton.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        ctaButton.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });

        // Animación del cerebro: volar hasta el botón y "guiñar"
        window.addEventListener('load', () => {
            const brain = document.getElementById('brainMascot');
            const btn = document.getElementById('ctaBtn');
            const hero = document.querySelector('.hero-section');
            
            if (!brain || !btn || !hero) return;
            
            // Pequeño delay para asegurar que todo esté renderizado
            setTimeout(() => {
                // origen: cerca del título
                const content = hero.querySelector('.hero-content').getBoundingClientRect();
                const target = btn.getBoundingClientRect();
                
                // Calcular posición relativa al contenedor
                const bx = (target.left + target.width * 0.5) - (content.left + 22) - 22;
                const by = (target.top + target.height * 0.5) - (content.top + 40) - 22;
                
                brain.style.setProperty('--bx', bx + 'px');
                brain.style.setProperty('--by', by + 'px');
                
                // Cuando termine el viaje -> guiño
                brain.addEventListener('animationend', (e) => {
                    if (e.animationName === 'flyToCTA') {
                        brain.classList.add('wink');
                        // Leve vibración divertida y profesional
                        btn.animate([
                            { transform: 'translateY(0)' },
                            { transform: 'translateY(-2px)' },
                            { transform: 'translateY(0)' }
                        ], { duration: 300, iterations: 2 });
                    }
                }, { once: true });
            }, 100);
        });
    </script>
</body>
</html>