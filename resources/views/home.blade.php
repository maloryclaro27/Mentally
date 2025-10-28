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

        /* Ventajas Section */
        .advantages-section {
            padding: 6rem 3rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(240, 250, 249, 0.9) 100%);
            position: relative;
            overflow: hidden;
        }

        .section-title {
            text-align: center;
            font-family: 'Quicksand', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 4rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 2px;
        }

        .advantages-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .advantage-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 252, 251, 0.9) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(50px);
            border: 1px solid rgba(77, 184, 168, 0.1);
        }

        .advantage-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .advantage-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            transform: scaleX(0);
            transition: transform 0.5s ease;
        }

        .advantage-card:hover {
            transform: translateY(-15px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 25px 50px rgba(77, 184, 168, 0.2);
        }

        .advantage-card:hover::before {
            transform: scaleX(1);
        }

        .card-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            border-radius: 50%;
            position: relative;
            animation: breathe 4s ease-in-out infinite;
        }

        @keyframes breathe {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .card-icon i {
            font-size: 2.5rem;
            color: #4db8a8;
            transition: all 0.3s ease;
        }

        .advantage-card:hover .card-icon i {
            transform: scale(1.1);
            color: #3a9c8c;
        }

        .card-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1rem;
            text-align: center;
        }

        .card-description {
            color: #5a7c7a;
            line-height: 1.7;
            text-align: center;
            font-size: 1rem;
        }

        /* Parallax Brain Icons */
        .parallax-brain {
            position: absolute;
            width: 60px;
            height: 60px;
            opacity: 0.1;
            z-index: 0;
        }

        .brain-1 {
            top: 10%;
            left: 5%;
            animation: floatBrain 15s ease-in-out infinite;
        }

        .brain-2 {
            top: 20%;
            right: 8%;
            animation: floatBrain 18s ease-in-out infinite reverse;
        }

        .brain-3 {
            bottom: 15%;
            left: 10%;
            animation: floatBrain 20s ease-in-out infinite;
        }

        @keyframes floatBrain {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(20px, -15px) rotate(90deg); }
            50% { transform: translate(10px, 20px) rotate(180deg); }
            75% { transform: translate(-15px, 10px) rotate(270deg); }
        }

        /* Connecting Lines */
        .connecting-line {
            position: absolute;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(77, 184, 168, 0.3), transparent);
            z-index: 1;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .advantages-container:hover .connecting-line {
            opacity: 1;
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

            .advantages-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .section-title {
                font-size: 2.5rem;
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

            .advantages-section {
                padding: 4rem 1.5rem;
            }

            .advantage-card {
                padding: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

                /* Tests Section */
        .tests-section {
            padding: 6rem 3rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(240, 250, 249, 0.95) 100%);
            position: relative;
            overflow: hidden;
        }

        .tests-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .tests-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .tests-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1rem;
        }

        .tests-subtitle {
            font-size: 1.2rem;
            color: #5a7c7a;
            max-width: 600px;
            margin: 0 auto;
        }

        .carousel {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        .test-card {
            min-width: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 252, 251, 0.98) 100%);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.15);
            text-align: center;
            position: relative;
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
        }

        .test-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 20px 20px 0 0;
        }

        .test-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            border-radius: 50%;
            position: relative;
            animation: breathe 4s ease-in-out infinite;
        }

        .test-icon i {
            font-size: 3rem;
            color: #4db8a8;
        }

        .test-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1rem;
        }

        .test-acronym {
            display: inline-block;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .test-description {
            color: #5a7c7a;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            font-size: 1rem;
        }

        .test-button {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem 2.5rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 8px 25px rgba(77, 184, 168, 0.3);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .test-button::before {
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

        .test-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .test-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(77, 184, 168, 0.4);
        }

        .carousel-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-top: 3rem;
        }

        .carousel-dots {
            display: flex;
            gap: 0.8rem;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(77, 184, 168, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: #4db8a8;
            transform: scale(1.2);
        }

        .carousel-arrow {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #4db8a8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #4db8a8;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.2);
        }

        .carousel-arrow:hover {
            background: #4db8a8;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.3);
        }

        .carousel-arrow:active {
            transform: translateY(0);
        }

        /* Animación de entrada para el carrusel */
        .tests-section {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .tests-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Efectos de partículas flotantes */
        .floating-particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(77, 184, 168, 0.3);
            border-radius: 50%;
            animation: floatParticle 8s ease-in-out infinite;
        }

        @keyframes floatParticle {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(20px, -15px); }
            50% { transform: translate(10px, 20px); }
            75% { transform: translate(-15px, 10px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .tests-section {
                padding: 4rem 1.5rem;
            }

            .test-card {
                padding: 2rem;
            }

            .tests-title {
                font-size: 2rem;
            }

            .test-name {
                font-size: 1.5rem;
            }

            .test-icon {
                width: 80px;
                height: 80px;
            }

            .test-icon i {
                font-size: 2.5rem;
            }
        }

                /* Diary Section */
        .diary-section {
            padding: 6rem 3rem;
            background: linear-gradient(135deg, #e0f7f4 0%, #d4f1f9 50%, #e8f5f3 100%);
            position: relative;
            overflow: hidden;
        }

        .diary-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .diary-content {
            position: relative;
            z-index: 2;
        }

        .diary-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .diary-description {
            font-size: 1.2rem;
            color: #5a7c7a;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .diary-button {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 2.8rem;
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
        }

        .diary-button::before {
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

        .diary-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .diary-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.4);
        }

        .diary-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .diary-image-placeholder {
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
            border: 1px solid rgba(77, 184, 168, 0.1);
            position: relative;
            overflow: hidden;
        }

        /* Elementos decorativos animados */
        .floating-note {
            position: absolute;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: floatNote 6s ease-in-out infinite;
            z-index: 1;
        }

        .floating-note::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 8px;
            right: 8px;
            height: 2px;
            background: rgba(77, 184, 168, 0.3);
            border-radius: 1px;
        }

        .floating-note::after {
            content: '';
            position: absolute;
            top: 14px;
            left: 8px;
            right: 8px;
            height: 2px;
            background: rgba(77, 184, 168, 0.3);
            border-radius: 1px;
        }

        .note-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .note-2 {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .note-3 {
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes floatNote {
            0%, 100% { 
                transform: translate(0, 0) rotate(0deg); 
            }
            25% { 
                transform: translate(10px, -15px) rotate(5deg); 
            }
            50% { 
                transform: translate(-5px, 10px) rotate(-3deg); 
            }
            75% { 
                transform: translate(15px, 5px) rotate(2deg); 
            }
        }

        /* Olas decorativas */
        .wave-decoration {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="%234db8a8"/></svg>');
            background-size: cover;
            opacity: 0.1;
            z-index: 1;
        }

        /* Animación de entrada */
        .diary-section {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .diary-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .diary-content {
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.8s ease 0.3s;
        }

        .diary-visual {
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.8s ease 0.6s;
        }

        .diary-section.visible .diary-content,
        .diary-section.visible .diary-visual {
            opacity: 1;
            transform: translateX(0);
        }

        /* Responsive */
        @media (max-width: 968px) {
            .diary-container {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .diary-title {
                font-size: 2.5rem;
            }

            .diary-visual {
                order: -1;
            }

            .diary-image-placeholder {
                margin: 0 auto;
            }

            .diary-content {
                transform: translateY(30px);
            }

            .diary-section.visible .diary-content {
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .diary-section {
                padding: 4rem 1.5rem;
            }

            .diary-title {
                font-size: 2rem;
            }

            .diary-description {
                font-size: 1rem;
            }

            .diary-button {
                padding: 1rem 2rem;
                font-size: 1rem;
            }
        }

                /* Specialists Section */
        .specialists-section {
            padding: 6rem 3rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(240, 250, 249, 0.95) 100%);
            position: relative;
            overflow: hidden;
        }

        .specialists-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .specialists-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .specialists-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1rem;
        }

        .specialists-subtitle {
            font-size: 1.3rem;
            color: #5a7c7a;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .specialists-carousel {
            position: relative;
            margin-bottom: 4rem;
        }

        .specialists-track {
            display: flex;
            gap: 2rem;
            transition: transform 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
            padding: 1rem;
        }

        .specialist-card {
            min-width: 350px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 252, 251, 0.98) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.4s ease;
            position: relative;
        }

        .specialist-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 20px 20px 0 0;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .specialist-card:hover::before {
            transform: scaleX(1);
        }

        .specialist-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(77, 184, 168, 0.2);
        }

        .specialist-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
            overflow: hidden;
        }

        .specialist-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .specialist-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .specialist-title {
            color: #4db8a8;
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: center;
            font-size: 1rem;
        }

        .specialist-specialties {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .specialty-tag {
            background: rgba(77, 184, 168, 0.1);
            color: #4db8a8;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .specialist-description {
            color: #5a7c7a;
            line-height: 1.6;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 0.95rem;
        }

        .specialist-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn-profile {
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
        }

        .btn-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.4);
        }

        .btn-contact {
            padding: 0.8rem 1.5rem;
            background: transparent;
            color: #4db8a8;
            border: 2px solid #4db8a8;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-contact:hover {
            background: #4db8a8;
            color: white;
            transform: translateY(-2px);
        }

        .specialists-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Join Section */
        .join-section {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            padding: 4rem 3rem;
            border-radius: 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .join-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }

        .join-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .join-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .join-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        .join-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .join-feature {
            text-align: center;
        }

        .join-feature i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .join-feature h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .join-button {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 3rem;
            background: white;
            color: #4db8a8;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .join-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        /* Animaciones */
        .specialists-section {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .specialists-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .specialists-section {
                padding: 4rem 1.5rem;
            }

            .specialists-title {
                font-size: 2.2rem;
            }

            .specialist-card {
                min-width: 300px;
                padding: 2rem;
            }

            .join-section {
                padding: 3rem 1.5rem;
            }

            .join-title {
                font-size: 2rem;
            }

            .specialist-actions {
                flex-direction: column;
            }
        }

                /* App Download Section */
        .app-section {
            padding: 6rem 3rem;
            background: linear-gradient(135deg, #e0f7f4 0%, #d4f1f9 50%, #e8f5f3 100%);
            position: relative;
            overflow: hidden;
        }

        .app-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .app-phone {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .phone-frame {
            width: 300px;
            height: 600px;
            background: #1a1a1a;
            border-radius: 40px;
            padding: 15px;
            position: relative;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.3),
                inset 0 0 0 2px rgba(255, 255, 255, 0.1);
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 30px;
            overflow: hidden;
            position: relative;
        }

        /* Animación del contenido de la app */
        .app-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: all 0.8s ease;
        }

        .app-content.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Pantalla 1: Dashboard */
        .app-dashboard {
            padding: 2rem 1.5rem;
            color: white;
        }

        .app-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .app-logo {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .app-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .app-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 1rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Pantalla 2: Diario Emocional */
        .app-diary {
            padding: 2rem 1.5rem;
            color: white;
        }

        .diary-entry {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
            animation: slideInUp 0.5s ease;
        }

        .diary-date {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .diary-text {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .mood-selector {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
        }

        .mood-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mood-option.active {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.2);
        }

        /* Pantalla 3: Tests */
        .app-tests {
            padding: 2rem 1.5rem;
            color: white;
        }

        .test-card-app {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
            animation: slideInRight 0.5s ease;
        }

        .test-progress {
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            margin: 1rem 0;
            overflow: hidden;
        }

        .test-progress-bar {
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 3px;
            width: 65%;
            animation: progressFill 2s ease-in-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes progressFill {
            from {
                width: 0%;
            }
            to {
                width: 65%;
            }
        }

        /* Contenido de descarga */
        .app-content-text {
            position: relative;
            z-index: 2;
        }

        .app-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .app-description {
            font-size: 1.2rem;
            color: #5a7c7a;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .download-button {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 2.5rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.3);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .download-button::before {
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

        .download-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .download-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.4);
        }

        .app-features-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }

        .app-feature {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #5a7c7a;
            font-weight: 500;
        }

        .app-feature i {
            color: #4db8a8;
            font-size: 1.2rem;
        }

        /* Animación de entrada */
        .app-section {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .app-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 968px) {
            .app-container {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .app-phone {
                order: -1;
            }

            .phone-frame {
                width: 280px;
                height: 560px;
            }

            .app-title {
                font-size: 2.5rem;
            }

            .app-features-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .app-section {
                padding: 4rem 1.5rem;
            }

            .app-title {
                font-size: 2rem;
            }

            .app-description {
                font-size: 1rem;
            }

            .phone-frame {
                width: 250px;
                height: 500px;
            }
        }

                /* Footer Section */
        .footer-section {
            background: linear-gradient(135deg, #2c5f5d 0%, #1e4a47 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 3rem 2rem;
        }

        /* Carrusel de Emergencias */
        .emergency-section {
            margin-bottom: 3rem;
        }

        .emergency-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .emergency-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }

        .emergency-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            color: #a8d5d0;
        }

        .emergency-carousel {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .emergency-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        .emergency-slide {
            min-width: 100%;
            padding: 1rem;
        }

        .emergency-city {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .city-flag {
            font-size: 2rem;
        }

        .city-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .emergency-lines {
            display: grid;
            gap: 1rem;
        }

        .emergency-line {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.2rem;
            border-radius: 12px;
            border-left: 4px solid #4db8a8;
            transition: all 0.3s ease;
        }

        .emergency-line:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .line-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #4db8a8;
        }

        .line-numbers {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .line-number {
            background: rgba(77, 184, 168, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-family: monospace;
            font-size: 0.9rem;
            border: 1px solid rgba(77, 184, 168, 0.3);
        }

        .emergency-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .emergency-dots {
            display: flex;
            gap: 0.8rem;
        }

        .emergency-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .emergency-dot.active {
            background: #4db8a8;
            transform: scale(1.2);
        }

        .emergency-arrow {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
        }

        .emergency-arrow:hover {
            background: #4db8a8;
            border-color: #4db8a8;
            transform: translateY(-2px);
        }

        /* Información del Footer */
        .footer-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            padding: 3rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-column h3 {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: #4db8a8;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: #4db8a8;
            transform: translateX(5px);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .contact-item i {
            color: #4db8a8;
            width: 20px;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }

        .social-link:hover {
            background: #4db8a8;
            transform: translateY(-3px);
        }

        /* Copyright */
        .footer-bottom {
            padding: 2rem 0 1rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .footer-logo {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        /* Elementos decorativos */
        .footer-wave {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: cover;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .footer-container {
                padding: 3rem 1.5rem 1rem;
            }

            .emergency-title {
                font-size: 1.8rem;
            }

            .emergency-carousel {
                padding: 1.5rem;
            }

            .line-numbers {
                flex-direction: column;
                gap: 0.5rem;
            }

            .footer-info {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .emergency-city {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    <!-- Ventajas Section -->
    <section class="advantages-section" id="advantages">
        <div class="parallax-brain brain-1">
            <i class="fas fa-brain"></i>
        </div>
        <div class="parallax-brain brain-2">
            <i class="fas fa-brain"></i>
        </div>
        <div class="parallax-brain brain-3">
            <i class="fas fa-brain"></i>
        </div>
        
        <h2 class="section-title">Ventajas de Mentally</h2>
        
        <div class="advantages-container">
            <!-- Evaluaciones confiables -->
            <div class="advantage-card">
                <div class="card-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="card-title">Evaluaciones confiables</h3>
                <p class="card-description">
                    Evalúa la presencia y la severidad de los síntomas depresivos durante las últimas dos semanas con herramientas validadas científicamente.
                </p>
            </div>
            
            <!-- Seguimiento visible -->
            <div class="advantage-card">
                <div class="card-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h3 class="card-title">Seguimiento visible</h3>
                <p class="card-description">
                    Analiza la evolución de tu estado emocional para ofrecerte acompañamiento personalizado en momentos de mayor vulnerabilidad.
                </p>
            </div>
            
            <!-- Diario emocional -->
            <div class="advantage-card">
                <div class="card-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="card-title">Diario emocional</h3>
                <p class="card-description">
                    Registra tus pensamientos y emociones cada día. Observa tu progreso y aprende a comprenderte mejor con herramientas de autoconocimiento.
                </p>
            </div>
        </div>
    </section>

        <!-- Tests Section -->
    <section class="tests-section" id="tests">
        <!-- Partículas flotantes decorativas -->
        <div class="floating-particle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="floating-particle" style="top: 60%; right: 15%; animation-delay: 1s;"></div>
        <div class="floating-particle" style="bottom: 30%; left: 20%; animation-delay: 2s;"></div>
        
        <div class="tests-container">
            <div class="tests-header">
                <h2 class="tests-title">Explora nuestros tests</h2>
                <p class="tests-subtitle">Descubre qué test es ideal para ti y comienza tu camino hacia el bienestar emocional</p>
            </div>

            <div class="carousel">
                <div class="carousel-track">
                    <!-- Test 1: PHQ-9 -->
                    <div class="test-card">
                        <div class="test-icon">
                            <i class="fas fa-cloud-rain"></i>
                        </div>
                        <h3 class="test-name">Depresión</h3>
                        <span class="test-acronym">PHQ-9</span>
                        <p class="test-description">
                            Evalúa la presencia y severidad de síntomas depresivos durante las últimas dos semanas. 
                            Este test validado científicamente te ayuda a comprender mejor tu estado emocional.
                        </p>
                        <a href="#" class="test-button">
                            <i class="fas fa-play-circle"></i>
                            Empezar test
                        </a>
                    </div>

                    <!-- Test 2: GAD-7 -->
                    <div class="test-card">
                        <div class="test-icon">
                            <i class="fas fa-wind"></i>
                        </div>
                        <h3 class="test-name">Ansiedad</h3>
                        <span class="test-acronym">GAD-7</span>
                        <p class="test-description">
                            Identifica patrones de ansiedad y preocupación excesiva. Obtén insights valiosos 
                            sobre tu bienestar mental y recibe recomendaciones personalizadas.
                        </p>
                        <a href="#" class="test-button">
                            <i class="fas fa-play-circle"></i>
                            Empezar test
                        </a>
                    </div>

                    <!-- Test 3: PSS -->
                    <div class="test-card">
                        <div class="test-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="test-name">Estrés Percibido</h3>
                        <span class="test-acronym">PSS</span>
                        <p class="test-description">
                            Mide tu nivel de estrés percibido y cómo afecta tu vida diaria. Descubre herramientas 
                            efectivas para manejar situaciones estresantes de manera saludable.
                        </p>
                        <a href="#" class="test-button">
                            <i class="fas fa-play-circle"></i>
                            Empezar test
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navegación del carrusel -->
            <div class="carousel-nav">
                <button class="carousel-arrow prev-arrow">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <div class="carousel-dots">
                    <div class="carousel-dot active" data-index="0"></div>
                    <div class="carousel-dot" data-index="1"></div>
                    <div class="carousel-dot" data-index="2"></div>
                </div>
                
                <button class="carousel-arrow next-arrow">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

        <!-- Diary Section -->
    <section class="diary-section" id="diary">
        <!-- Olas decorativas -->
        <div class="wave-decoration"></div>
        
        <!-- Notas flotantes decorativas -->
        <div class="floating-note note-1"></div>
        <div class="floating-note note-2"></div>
        <div class="floating-note note-3"></div>
        
        <div class="diary-container">
            <div class="diary-content">
                <h2 class="diary-title">Lleva tu diario emocional</h2>
                <p class="diary-description">
                    Escribe libremente tus pensamientos cada día y observa cómo evoluciona 
                    tu bienestar emocional con el tiempo. Reflexiona sobre tus emociones, 
                    identifica patrones y celebra tu progreso en el camino del autoconocimiento.
                </p>
                <a href="#" class="diary-button">
                    <i class="fas fa-book-open"></i>
                    Abrir diario emocional
                </a>
            </div>
            
            <div class="diary-visual">
                <div class="diary-image-placeholder">
                    <!-- Espacio para la imagen del diario -->
                    <img src="{{ asset('diario_emocional.png') }}" alt="Diario Emocional" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                </div>
            </div>
        </div>
    </section>

        <!-- Specialists Section -->
    <section class="specialists-section" id="specialists">
        <div class="specialists-container">
            <div class="specialists-header">
                <h2 class="specialists-title">Directorio de especialistas</h2>
                <p class="specialists-subtitle">Contacta con el especialista más capacitado en tu zona</p>
            </div>

            <div class="specialists-carousel">
                <div class="specialists-track" id="specialistsTrack">
                    <!-- Especialista 1 -->
                    <div class="specialist-card">
                        <div class="specialist-image">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Dra. Sofia Ramirez">
                        </div>
                        <h3 class="specialist-name">Dra. Sofia Ramirez</h3>
                        <p class="specialist-title">Psiquiatra y Psicoterapeuta</p>
                        <div class="specialist-specialties">
                            <span class="specialty-tag">Terapia Cognitivo-Conductual</span>
                            <span class="specialty-tag">Manejo de Ansiedad</span>
                            <span class="specialty-tag">Psicofarmacología</span>
                        </div>
                        <p class="specialist-description">
                            Especializada en el tratamiento integral de trastornos del estado de ánimo. 
                            Más de 10 años de experiencia acompañando procesos de cambio y crecimiento personal.
                        </p>
                        <div class="specialist-actions">
                            <a href="#" class="btn-profile">Ver Perfil</a>
                            <a href="#" class="btn-contact">Contactar</a>
                        </div>
                    </div>

                    <!-- Especialista 2 -->
                    <div class="specialist-card">
                        <div class="specialist-image">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Dr. Carlos Mendoza">
                        </div>
                        <h3 class="specialist-name">Dr. Carlos Mendoza</h3>
                        <p class="specialist-title">Psicólogo Clínico</p>
                        <div class="specialist-specialties">
                            <span class="specialty-tag">Terapia de Pareja</span>
                            <span class="specialty-tag">Intervención en Crisis</span>
                            <span class="specialty-tag">Mindfulness</span>
                        </div>
                        <p class="specialist-description">
                            Experto en terapia sistémica y familiar. Enfoque humanista con amplia experiencia 
                            en intervención en crisis y desarrollo de resiliencia emocional.
                        </p>
                        <div class="specialist-actions">
                            <a href="#" class="btn-profile">Ver Perfil</a>
                            <a href="#" class="btn-contact">Contactar</a>
                        </div>
                    </div>

                    <!-- Especialista 3 -->
                    <div class="specialist-card">
                        <div class="specialist-image">
                            <img src="https://images.unsplash.com/photo-1594824947933-d0501ba2fe65?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" alt="Dra. Elena Torres">
                        </div>
                        <h3 class="specialist-name">Dra. Elena Torres</h3>
                        <p class="specialist-title">Neuropsicóloga</p>
                        <div class="specialist-specialties">
                            <span class="specialty-tag">Evaluación Neuropsicológica</span>
                            <span class="specialty-tag">Rehabilitación Cognitiva</span>
                            <span class="specialty-tag">Demencias</span>
                        </div>
                        <p class="specialist-description">
                            Especialista en evaluación y rehabilitación neuropsicológica. 
                            Investigadora en procesos cognitivos y desarrollo de intervenciones 
                            personalizadas para trastornos neurológicos.
                        </p>
                        <div class="specialist-actions">
                            <a href="#" class="btn-profile">Ver Perfil</a>
                            <a href="#" class="btn-contact">Contactar</a>
                        </div>
                    </div>
                </div>

                <div class="specialists-nav">
                    <button class="carousel-arrow specialists-prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="carousel-dots specialists-dots">
                        <div class="carousel-dot active" data-index="0"></div>
                        <div class="carousel-dot" data-index="1"></div>
                        <div class="carousel-dot" data-index="2"></div>
                    </div>
                    <button class="carousel-arrow specialists-next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Sección Unirse -->
            <div class="join-section">
                <div class="join-content">
                    <h2 class="join-title">¿Eres psiquiatra o psicoterapeuta?</h2>
                    <p class="join-subtitle">Únete a Mentally y forma parte de nuestra red de especialistas en salud mental</p>
                    
                    <div class="join-features">
                        <div class="join-feature">
                            <i class="fas fa-users"></i>
                            <h4>Amplía tu Consulta</h4>
                            <p>Conecta con pacientes que buscan tu especialización</p>
                        </div>
                        <div class="join-feature">
                            <i class="fas fa-chart-line"></i>
                            <h4>Seguimiento Integral</h4>
                            <p>Herramientas para monitorear el progreso de tus pacientes</p>
                        </div>
                        <div class="join-feature">
                            <i class="fas fa-graduation-cap"></i>
                            <h4>Desarrollo Profesional</h4>
                            <p>Acceso a recursos y comunidad de especialistas</p>
                        </div>
                    </div>

                    <a href="#" class="join-button">
                        <i class="fas fa-user-plus"></i>
                        Unirse como Especialista
                    </a>
                </div>
            </div>
        </div>
    </section>

        <!-- App Download Section -->
    <section class="app-section" id="app">
        <div class="app-container">
            <div class="app-phone">
                <div class="phone-frame">
                    <div class="phone-screen">
                        <!-- Pantalla 1: Dashboard -->
                        <div class="app-content app-dashboard active" id="screen1">
                            <div class="app-header">
                                <div class="app-logo">Mentally</div>
                                <div class="app-time">14:30</div>
                            </div>
                            
                            <div class="app-stats">
                                <div class="stat-card">
                                    <div class="stat-value">7d</div>
                                    <div class="stat-label">Racha actual</div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">85%</div>
                                    <div class="stat-label">Bienestar</div>
                                </div>
                            </div>
                            
                            <div class="app-features">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div>
                                        <div class="feature-name">Diario Emocional</div>
                                        <div class="feature-desc">Registra tu día</div>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div>
                                        <div class="feature-name">Tests</div>
                                        <div class="feature-desc">Evalúa tu estado</div>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div>
                                        <div class="feature-name">Progreso</div>
                                        <div class="feature-desc">Ve tu evolución</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pantalla 2: Diario -->
                        <div class="app-content app-diary" id="screen2">
                            <div class="app-header">
                                <div class="app-logo">Diario</div>
                                <div class="app-time">14:32</div>
                            </div>
                            
                            <div class="diary-entry">
                                <div class="diary-date">Hoy, 14:30</div>
                                <div class="diary-text">
                                    Hoy me siento más tranquilo después de la sesión de meditación...
                                </div>
                                <div class="mood-selector">
                                    <div class="mood-option">😔</div>
                                    <div class="mood-option">😐</div>
                                    <div class="mood-option active">😊</div>
                                    <div class="mood-option">😄</div>
                                </div>
                            </div>
                            
                            <div class="diary-entry">
                                <div class="diary-date">Ayer, 20:15</div>
                                <div class="diary-text">
                                    Día productivo en el trabajo, aunque con algo de estrés...
                                </div>
                                <div class="mood-selector">
                                    <div class="mood-option">😔</div>
                                    <div class="mood-option active">😐</div>
                                    <div class="mood-option">😊</div>
                                    <div class="mood-option">😄</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pantalla 3: Tests -->
                        <div class="app-content app-tests" id="screen3">
                            <div class="app-header">
                                <div class="app-logo">Tests</div>
                                <div class="app-time">14:35</div>
                            </div>
                            
                            <div class="test-card-app">
                                <h4>Test de Ansiedad (GAD-7)</h4>
                                <p>Evalúa tu nivel de ansiedad</p>
                                <div class="test-progress">
                                    <div class="test-progress-bar"></div>
                                </div>
                                <div>Completado: 65%</div>
                            </div>
                            
                            <div class="test-card-app">
                                <h4>Test de Depresión (PHQ-9)</h4>
                                <p>Analiza tu estado de ánimo</p>
                                <div class="test-progress">
                                    <div class="test-progress-bar" style="width: 30%"></div>
                                </div>
                                <div>Completado: 30%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="app-content-text">
                <h2 class="app-title">Tu bienestar emocional en tu bolsillo</h2>
                <p class="app-description">
                    Lleva el poder de Mentally contigo a todas partes. Accede a tu diario emocional, 
                    realiza tests de bienestar y conecta con especialistas desde la palma de tu mano.
                </p>
                
                <a href="#" class="download-button">
                    <i class="fab fa-google-play"></i>
                    Descárgala desde Play Store
                </a>
                
                <div class="app-features-list">
                    <div class="app-feature">
                        <i class="fas fa-sync-alt"></i>
                        <span>Sincronización en tiempo real</span>
                    </div>
                    <div class="app-feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Datos 100% seguros</span>
                    </div>
                    <div class="app-feature">
                        <i class="fas fa-bell"></i>
                        <span>Recordatorios personalizados</span>
                    </div>
                    <div class="app-feature">
                        <i class="fas fa-chart-bar"></i>
                        <span>Estadísticas de progreso</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Footer Section -->
    <footer class="footer-section">
        <div class="footer-wave"></div>
        <div class="footer-container">
            <!-- Carrusel de Emergencias -->
            <div class="emergency-section">
                <div class="emergency-header">
                    <h2 class="emergency-title">Líneas de emergencia de salud mental</h2>
                    <p class="emergency-subtitle">Ayuda inmediata cuando más la necesitas</p>
                </div>

                <div class="emergency-carousel">
                    <div class="emergency-track" id="emergencyTrack">
                        <!-- Slide 1: Bogotá -->
                        <div class="emergency-slide">
                            <div class="emergency-city">
                                <div class="city-flag">🇨🇴</div>
                                <h3 class="city-name">Bogotá</h3>
                            </div>
                            <div class="emergency-lines">
                                <div class="emergency-line">
                                    <div class="line-name">Línea de Emergencias</div>
                                    <div class="line-numbers">
                                        <span class="line-number">106</span>
                                        <span class="line-number">123</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Línea Psicoactiva Distrital</div>
                                    <div class="line-numbers">
                                        <span class="line-number">01 8000 112 439</span>
                                        <span class="line-number">WhatsApp: 301 276 1197</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Línea Púrpura (Mujeres)</div>
                                    <div class="line-numbers">
                                        <span class="line-number">01 8000 112 137</span>
                                        <span class="line-number">WhatsApp: 300 755 1846</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Línea Calma (Hombres)</div>
                                    <div class="line-numbers">
                                        <span class="line-number">01 8000 423 614</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2: Medellín y Cali -->
                        <div class="emergency-slide">
                            <div class="emergency-city">
                                <div class="city-flag">🇨🇴</div>
                                <h3 class="city-name">Medellín & Cali</h3>
                            </div>
                            <div class="emergency-lines">
                                <div class="emergency-line">
                                    <div class="line-name">Medellín - Línea Amiga Saludable</div>
                                    <div class="line-numbers">
                                        <span class="line-number">(604) 444 44 48</span>
                                        <span class="line-number">WhatsApp: 300 723 1123</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Emergencias Nacional</div>
                                    <div class="line-numbers">
                                        <span class="line-number">106</span>
                                        <span class="line-number">192</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Atención EPS</div>
                                    <div class="line-numbers">
                                        <span class="line-number">Contacta tu EPS</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3: Otras Ciudades -->
                        <div class="emergency-slide">
                            <div class="emergency-city">
                                <div class="city-flag">🇨🇴</div>
                                <h3 class="city-name">Otras Ciudades</h3>
                            </div>
                            <div class="emergency-lines">
                                <div class="emergency-line">
                                    <div class="line-name">Barranquilla - Línea de la Vida</div>
                                    <div class="line-numbers">
                                        <span class="line-number">(5) 339 99 99</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Cartagena - Línea de la Vida</div>
                                    <div class="line-numbers">
                                        <span class="line-number">(605) 3399999</span>
                                        <span class="line-number">WhatsApp: 310 442 0195</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Bucaramanga - Hospital Psiquiátrico</div>
                                    <div class="line-numbers">
                                        <span class="line-number">6978111</span>
                                        <span class="line-number">314 482 5847</span>
                                    </div>
                                </div>
                                <div class="emergency-line">
                                    <div class="line-name">Emergencias Generales</div>
                                    <div class="line-numbers">
                                        <span class="line-number">123</span>
                                        <span class="line-number">125 (CRUE)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="emergency-nav">
                        <button class="emergency-arrow emergency-prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="emergency-dots">
                            <div class="emergency-dot active" data-index="0"></div>
                            <div class="emergency-dot" data-index="1"></div>
                            <div class="emergency-dot" data-index="2"></div>
                        </div>
                        <button class="emergency-arrow emergency-next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Información del Footer -->
            <div class="footer-info">
                <div class="footer-column">
                    <h3>Mentally</h3>
                    <p style="color: rgba(255,255,255,0.8); line-height: 1.6;">
                        Tu espacio digital para comprenderte, cuidarte y fortalecer 
                        tu bienestar emocional. Juntos en el camino hacia una mejor 
                        salud mental.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Enlaces Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Inicio</a></li>
                        <li><a href="#tests"><i class="fas fa-chevron-right"></i> Tests</a></li>
                        <li><a href="#diary"><i class="fas fa-chevron-right"></i> Diario Emocional</a></li>
                        <li><a href="#specialists"><i class="fas fa-chevron-right"></i> Especialistas</a></li>
                        <li><a href="#app"><i class="fas fa-chevron-right"></i> Descargar App</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contacto</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>hola@mentally.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+57 1 234 5678</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bogotá, Colombia</span>
                        </div>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Recursos</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Blog de Salud Mental</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Preguntas Frecuentes</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Política de Privacidad</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Términos de Servicio</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Para Especialistas</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom">
                <div class="footer-logo">Mentally</div>
                <p>&copy; 2024 Mentally. Todos los derechos reservados. | Cuidando tu bienestar emocional</p>
            </div>
        </div>
    </footer>

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

        // Animación de entrada para las tarjetas de ventajas
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const cards = document.querySelectorAll('.advantage-card');
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('visible');
                        }, index * 200);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        observer.observe(document.getElementById('advantages'));

        // Efecto parallax para los iconos de cerebro
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxBrains = document.querySelectorAll('.parallax-brain');
            
            parallaxBrains.forEach(brain => {
                const speed = 0.5;
                const yPos = -(scrolled * speed);
                brain.style.transform = `translateY(${yPos}px)`;
            });
        });

                // Carrusel de tests
        const carouselTrack = document.querySelector('.carousel-track');
        const carouselDots = document.querySelectorAll('.carousel-dot');
        const prevArrow = document.querySelector('.prev-arrow');
        const nextArrow = document.querySelector('.next-arrow');
        const testCards = document.querySelectorAll('.test-card');
        
        let currentIndex = 0;
        const totalSlides = testCards.length;

        // Función para actualizar el carrusel
        function updateCarousel() {
            const translateX = -currentIndex * 100;
            carouselTrack.style.transform = `translateX(${translateX}%)`;
            
            // Actualizar dots
            carouselDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
            
            // Animación de entrada para la tarjeta actual
            testCards.forEach((card, index) => {
                if (index === currentIndex) {
                    card.style.opacity = '0';
                    card.style.transform = 'translateX(30px)';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateX(0)';
                        card.style.transition = 'all 0.5s ease';
                    }, 50);
                }
            });
        }

        // Event listeners para las flechas
        prevArrow.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateCarousel();
        });

        nextArrow.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        });

        // Event listeners para los dots
        carouselDots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentIndex = parseInt(dot.getAttribute('data-index'));
                updateCarousel();
            });
        });

        // Auto-avance cada 8 segundos
        let autoSlide = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        }, 8000);

        // Pausar auto-avance al interactuar
        const carouselContainer = document.querySelector('.carousel');
        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(autoSlide);
        });

        carouselContainer.addEventListener('mouseleave', () => {
            autoSlide = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel();
            }, 8000);
        });

        // Animación de entrada al hacer scroll
        const testsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    testsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        testsObserver.observe(document.getElementById('tests'));

        // Swipe para móviles
        let startX = 0;
        let endX = 0;

        carouselContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        carouselContainer.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = startX - endX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe izquierda - siguiente
                    currentIndex = (currentIndex + 1) % totalSlides;
                } else {
                    // Swipe derecha - anterior
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                }
                updateCarousel();
            }
        }
                // Animación de entrada para la sección del diario
        const diaryObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    diaryObserver.unobserve(entry.target);
                    
                    // Animación adicional para las notas flotantes
                    const notes = document.querySelectorAll('.floating-note');
                    notes.forEach((note, index) => {
                        note.style.animationDelay = `${index * 0.5}s`;
                    });
                }
            });
        }, { threshold: 0.3 });

        diaryObserver.observe(document.getElementById('diary'));

        // Efecto de escritura para el título (opcional)
        function typeWriterEffect() {
            const title = document.querySelector('.diary-title');
            const text = title.textContent;
            title.textContent = '';
            
            let i = 0;
            const typeInterval = setInterval(() => {
                if (i < text.length) {
                    title.textContent += text.charAt(i);
                    i++;
                } else {
                    clearInterval(typeInterval);
                }
            }, 50);
        }

        // Activar efecto de escritura cuando la sección sea visible
        const diarySection = document.getElementById('diary');
        const diaryTitleObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // typeWriterEffect(); // Descomenta si quieres el efecto de escritura
                    diaryTitleObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        diaryTitleObserver.observe(diarySection);

                // Carrusel de especialistas
        const specialistsTrack = document.getElementById('specialistsTrack');
        const specialistsDots = document.querySelectorAll('.specialists-dots .carousel-dot');
        const specialistsPrev = document.querySelector('.specialists-prev');
        const specialistsNext = document.querySelector('.specialists-next');
        
        let currentSpecialistIndex = 0;
        const cardsPerView = Math.floor(window.innerWidth / 400); // Ajuste responsivo

        function updateSpecialistsCarousel() {
            const cardWidth = 350 + 32; // ancho + gap
            const translateX = -currentSpecialistIndex * cardWidth;
            specialistsTrack.style.transform = `translateX(${translateX}px)`;
            
            // Actualizar dots
            specialistsDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSpecialistIndex);
            });
        }

        specialistsPrev.addEventListener('click', () => {
            currentSpecialistIndex = Math.max(0, currentSpecialistIndex - 1);
            updateSpecialistsCarousel();
        });

        specialistsNext.addEventListener('click', () => {
            const maxIndex = 3 - cardsPerView;
            currentSpecialistIndex = Math.min(maxIndex, currentSpecialistIndex + 1);
            updateSpecialistsCarousel();
        });

        specialistsDots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentSpecialistIndex = parseInt(dot.getAttribute('data-index'));
                updateSpecialistsCarousel();
            });
        });

        // Animación de entrada
        const specialistsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    specialistsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        specialistsObserver.observe(document.getElementById('specialists'));

        // Ajuste responsivo
        window.addEventListener('resize', () => {
            const newCardsPerView = Math.floor(window.innerWidth / 400);
            if (newCardsPerView !== cardsPerView) {
                updateSpecialistsCarousel();
            }
        });

                // Animación del teléfono con la app
        function initPhoneAnimation() {
            const screens = document.querySelectorAll('.app-content');
            let currentScreen = 0;
            
            function showNextScreen() {
                // Ocultar pantalla actual
                screens[currentScreen].classList.remove('active');
                
                // Avanzar a la siguiente pantalla
                currentScreen = (currentScreen + 1) % screens.length;
                
                // Mostrar nueva pantalla
                screens[currentScreen].classList.add('active');
            }
            
            // Cambiar pantalla cada 4 segundos
            setInterval(showNextScreen, 4000);
            
            // Efectos de interacción en las pantallas
            const moodOptions = document.querySelectorAll('.mood-option');
            moodOptions.forEach(option => {
                option.addEventListener('click', function() {
                    moodOptions.forEach(m => m.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        }

        // Animación de entrada
        const appObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    initPhoneAnimation();
                    appObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        appObserver.observe(document.getElementById('app'));

        // Efecto de descarga del botón
        const downloadButton = document.querySelector('.download-button');
        downloadButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Efecto de descarga
            this.innerHTML = '<i class="fas fa-download"></i> Descargando...';
            this.style.background = 'linear-gradient(135deg, #3a9c8c, #4db8a8)';
            
            setTimeout(() => {
                this.innerHTML = '<i class="fab fa-google-play"></i> ¡Descargada!';
                setTimeout(() => {
                    this.innerHTML = '<i class="fab fa-google-play"></i> Descárgala desde Play Store';
                    this.style.background = 'linear-gradient(135deg, #4db8a8, #5bc4b3)';
                }, 2000);
            }, 1500);
        });

                // Carrusel de líneas de emergencia
        const emergencyTrack = document.getElementById('emergencyTrack');
        const emergencyDots = document.querySelectorAll('.emergency-dot');
        const emergencyPrev = document.querySelector('.emergency-prev');
        const emergencyNext = document.querySelector('.emergency-next');
        
        let currentEmergencyIndex = 0;
        const totalEmergencySlides = 3;

        function updateEmergencyCarousel() {
            const translateX = -currentEmergencyIndex * 100;
            emergencyTrack.style.transform = `translateX(${translateX}%)`;
            
            // Actualizar dots
            emergencyDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentEmergencyIndex);
            });
        }

        emergencyPrev.addEventListener('click', () => {
            currentEmergencyIndex = (currentEmergencyIndex - 1 + totalEmergencySlides) % totalEmergencySlides;
            updateEmergencyCarousel();
        });

        emergencyNext.addEventListener('click', () => {
            currentEmergencyIndex = (currentEmergencyIndex + 1) % totalEmergencySlides;
            updateEmergencyCarousel();
        });

        emergencyDots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentEmergencyIndex = parseInt(dot.getAttribute('data-index'));
                updateEmergencyCarousel();
            });
        });

        // Auto-avance cada 8 segundos
        setInterval(() => {
            currentEmergencyIndex = (currentEmergencyIndex + 1) % totalEmergencySlides;
            updateEmergencyCarousel();
        }, 8000);

        // Efecto de copiar número al hacer clic
        const lineNumbers = document.querySelectorAll('.line-number');
        lineNumbers.forEach(number => {
            number.addEventListener('click', function() {
                const textToCopy = this.textContent;
                navigator.clipboard.writeText(textToCopy).then(() => {
                    const originalText = this.textContent;
                    this.textContent = '¡Copiado!';
                    this.style.background = 'rgba(77, 184, 168, 0.4)';
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.background = 'rgba(77, 184, 168, 0.2)';
                    }, 2000);
                });
            });
        });
    </script>
</body>
</html>