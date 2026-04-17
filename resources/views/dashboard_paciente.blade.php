@extends('layouts.app')
@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f9f8 0%, #e6f4f7 50%, #f2f9f8 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar actualizado */
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
            transition: all 0.3s ease;
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
            overflow: hidden;
        }

        .logo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: contain;
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

        /* Perfil del usuario */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            cursor: pointer;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.4);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #2c5f5d;
        }

        .user-role {
            font-size: 0.9rem;
            color: #5a7c7a;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            min-width: 200px;
            padding: 1rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
            z-index: 1000;
        }

        /* Dropdowns del navbar (Servicios/Tests/Blog) */
        .nav-item:hover .nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Ubicación del dropdown debajo del link */
        .nav-dropdown {
            left: 0;
            right: auto;
        }


        .user-profile:hover .dropdown-menu {
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

        /* Contenido principal */
        .main-content {
            margin-top: 100px;
            padding: 2rem 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Encabezado de bienvenida */
        .welcome-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 252, 251, 0.95));
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease;
        }

        .welcome-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            color: #5a7c7a;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .current-date {
            display: inline-block;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            color: #4db8a8;
            font-weight: 500;
        }

        /* Banner de paquetes */
        .package-banner {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.8s ease 0.2s backwards;
        }

        .package-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            opacity: 0.3;
        }

        .package-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .package-text {
            flex: 1;
            min-width: 300px;
        }

        .package-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .package-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .package-button {
            padding: 1rem 2rem;
            background: white;
            color: #4db8a8;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .package-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Carrusel interactivo */
        .carousel-section {
            margin-bottom: 3rem;
            position: relative;
            animation: slideInUp 0.8s ease 0.4s backwards;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.15);
        }

        .carousel-track {
            display: flex;
            transition: transform 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        .carousel-slide {
            min-width: 100%;
            padding: 3rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 251, 0.98));
            position: relative;
            overflow: hidden;
        }

        .slide-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .slide-text {
            position: relative;
            z-index: 2;
        }

        .slide-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .slide-description {
            color: #5a7c7a;
            line-height: 1.6;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .slide-button {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(77, 184, 168, 0.3);
        }

        .slide-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(77, 184, 168, 0.4);
        }

        .slide-image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slide-visual {
            width: 100%;
            max-width: 400px;
            aspect-ratio: 1;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #e0f7f4, #d4f1f9);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .slide-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Navegación del carrusel */
        .carousel-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-top: 2rem;
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

        /* Accesos rápidos */
        .quick-access {
            margin-bottom: 3rem;
            animation: slideInUp 0.8s ease 0.6s backwards;
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 2px;
        }

        .quick-access-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .access-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 251, 0.98));
            border-radius: 20px;
            padding: 1.5rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(77, 184, 168, 0.1);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.1);
            position: relative;
            overflow: hidden;
        }

        .access-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .access-card:hover::before {
            transform: scaleX(1);
        }

        .access-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(77, 184, 168, 0.2);
        }

        .access-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #4db8a8;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .access-card:hover .access-icon {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.2), rgba(91, 196, 179, 0.3));
        }

        .access-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
        }

        .access-description {
            color: #5a7c7a;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        /* ========== SECCIÓN DE LA MASCOTA ========== */
        .adherence-pet {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 251, 0.98));
            border-radius: 30px;
            padding: 2.5rem;
            margin-bottom: 3rem;
            box-shadow: 0 20px 50px rgba(77, 184, 168, 0.2);
            border: 1px solid rgba(77, 184, 168, 0.15);
            animation: slideInUp 0.8s ease 0.2s backwards;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .adherence-pet::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(77, 184, 168, 0.05) 0%, transparent 70%);
            animation: shimmer 15s infinite linear;
        }

        .pet-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .pet-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
        }

        .pet-subtitle {
            color: #5a7c7a;
            font-size: 1.1rem;
        }

        .pet-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        /* ========== MASCOTA INTERACTIVA ========== */
        .pet-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .pet-character {
            width: 350px;
            height: 350px;
            position: relative;
            margin-bottom: 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pet-character:hover {
            transform: scale(1.02);
        }

        .pet-body {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            position: relative;
            overflow: hidden;
            animation: gentleFloat 6s ease-in-out infinite;
            transition: all 0.5s ease;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }

        .pet-character[data-energy="high"] .pet-body {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3, #6dd0c0);
            animation: gentleFloat 4s ease-in-out infinite, glowPulse 3s ease-in-out infinite;
        }

        .pet-character[data-energy="medium"] .pet-body {
            background: linear-gradient(135deg, #8a9ba8, #9fb0bd, #b5c6d2);
            animation: gentleFloat 8s ease-in-out infinite;
            opacity: 0.9;
        }

        .pet-character[data-energy="low"] .pet-body {
            background: linear-gradient(135deg, #b8c5d0, #cbd5e0, #dee5ed);
            animation: gentleFloat 12s ease-in-out infinite;
            opacity: 0.7;
            filter: grayscale(0.3);
        }

        .pet-eyes {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 3.5rem;
            z-index: 3;
        }

        .eye {
            width: 35px;
            height: 45px;
            background: white;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .eye::after {
            content: '';
            position: absolute;
            top: 12px;
            left: 12px;
            width: 18px;
            height: 18px;
            background: #253138;
            border-radius: 50%;
            animation: blink 5s infinite;
            transition: all 0.3s ease;
        }

        .pet-mouth {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 35px;
            border-bottom: 6px solid #253138;
            border-radius: 0 0 35px 35px;
            transition: all 0.3s ease;
        }

        .sparkles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 215, 0, 0.5);
            animation: sparkle 3s ease-in-out infinite;
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 70%;
            right: 15%;
            animation-delay: 1s;
        }

        .sparkle:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 2s;
        }

        .sparkle:nth-child(4) {
            top: 30%;
            right: 25%;
            animation-delay: 1.5s;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .pet-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 1rem;
            background: rgba(255, 255, 255, 0.5);
            padding: 1.5rem 2rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .stat {
            text-align: center;
            position: relative;
        }

        .stat-value {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #4db8a8;
            display: block;
            line-height: 1.2;
            transition: all 0.3s ease;
        }

        .stat-label {
            color: #5a7c7a;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .pet-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .streak-info {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9));
            padding: 2rem;
            border-radius: 20px;
            border-left: 6px solid #4db8a8;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .streak-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(77, 184, 168, 0.15);
        }

        .streak-title {
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .streak-description {
            color: #5a7c7a;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .streak-progress {
            height: 12px;
            background: rgba(77, 184, 168, 0.15);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 0.8rem;
            position: relative;
        }

        .streak-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3, #6dd0c0);
            border-radius: 20px;
            width: 0%;
            transition: width 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .streak-progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        .streak-message {
            font-size: 0.9rem;
            color: #5a7c7a;
            font-style: italic;
        }

        /* Artículos y blog */
        .articles-section {
            margin-bottom: 3rem;
            animation: slideInUp 0.8s ease 1s backwards;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .article-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 251, 0.98));
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.1);
        }

        .article-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(77, 184, 168, 0.2);
        }

        .article-image {
            height: 200px;
            overflow: hidden;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .article-image img {
            transform: scale(1.05);
        }

        .article-content {
            padding: 1.5rem;
        }

        .article-category {
            display: inline-block;
            background: rgba(77, 184, 168, 0.1);
            color: #4db8a8;
            padding: 0.3rem 1rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
        }

        .article-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 0.8rem;
            line-height: 1.3;
        }

        .article-excerpt {
            color: #5a7c7a;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .article-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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

        .article-button:hover {
            background: #4db8a8;
            color: white;
            transform: translateY(-2px);
        }

        /* Elementos decorativos */
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

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, 30px);
            }
        }

        @keyframes gentleFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        @keyframes blink {

            0%,
            90%,
            100% {
                transform: scaleY(1);
            }

            95% {
                transform: scaleY(0.1);
            }
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

        /* Responsive */
        @media (max-width: 1024px) {
            .slide-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .slide-image {
                order: -1;
            }

            .pet-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            nav {
                padding: 1rem 1.5rem;
            }

            .nav-links {
                display: none;
            }

            .main-content {
                padding: 1.5rem;
                margin-top: 80px;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .carousel-slide {
                padding: 2rem;
            }

            .slide-title {
                font-size: 1.8rem;
            }

            .pet-character {
                width: 250px;
                height: 250px;
            }

            .articles-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .brand-name {
                font-size: 1.5rem;
            }

            .user-info {
                display: none;
            }

            .quick-access-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .package-content {
                flex-direction: column;
                text-align: center;
            }

            .pet-character {
                width: 200px;
                height: 200px;
            }

            .pet-eyes {
                gap: 2rem;
            }

            .eye {
                width: 25px;
                height: 35px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Elementos decorativos flotantes -->

    @php
        $evolutionStage = $evolutionStage ?? 1;
        $companionEnergyLevel = $companionEnergyLevel ?? 'low';
        $companionEnergy = $companionEnergy ?? 0;
        $streakDays = $streakDays ?? 0;
        $adherenceRate = $adherenceRate ?? 0;

        $petColors =
            $petColors ??
            (object) [
                'primary' => '#4db8a8',
                'secondary' => '#5bc4b3',
            ];

        $motivationalMessage =
            $motivationalMessage ??
            (object) [
                'title' => '¡Vamos paso a paso!',
                'description' => 'Tu compañero reflejará tu progreso real a medida que registres tus tomas.',
            ];

        $progressToNextAchievement = $progressToNextAchievement ?? 0;

        $dailyAffirmation = $dailyAffirmation ?? 'Cada paso que das hacia tu bienestar es un acto de amor propio.';

        $allAchievements = $allAchievements ?? collect();

        $nextAchievement = $nextAchievement ?? null;

        $user = $usuario ?? Auth::user();
    @endphp


    <div class="floating-circle circle-1"></div>
    <div class="floating-circle circle-2"></div>

    <!-- Navbar actualizado -->
    <!-- Navigation -->
    @include('partials.navbar')


    <!-- Contenido principal -->
    <main class="main-content">
        <!-- Encabezado de bienvenida -->
        <section class="welcome-header">
            <h1 class="welcome-title">¡Hola, {{ Auth::user()->first_name }}!</h1>
            <p class="welcome-subtitle">Nos alegra que estés aquí. Hoy es un buen día para cuidar de tu salud mental.
            </p>
            <div class="current-date">
                <i class="fas fa-calendar-alt"></i>
                <span id="currentDate"></span>
            </div>
        </section>

        <!-- Accesos rápidos -->
        <section class="quick-access">
            <h2 class="section-title">Accesos rápidos</h2>
            <div class="quick-access-grid">

                <a href="{{ route('chequeos') }}" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3 class="access-name">Mis chequeos</h3>
                    <p class="access-description">Resultados de tus evaluaciones recientes</p>
                </a>

                <a href="{{ route('diario.emocional') }}" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="access-name">Diario emocional</h3>
                    <p class="access-description">Continúa tu registro personal</p>
                </a>

                <a href="{{ route('chatbot.index') }}" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="access-name">Chatea con Cereon</h3>
                    <p class="access-description">Asistente virtual disponible 24/7</p>
                </a>


                <a href="{{ route('adherencia') }}" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="access-name">Recordatorios</h3>
                    <p class="access-description">Configura alertas personalizadas</p>
                </a>
            </div>
        </section>



        <!-- Sección de la Mascota -->
        <section class="adherence-pet">
            <div class="pet-header">
                <h2 class="pet-title">✨ Tu Compañero de Bienestar ✨</h2>
                <p class="pet-subtitle">Él refleja tu compromiso y crece contigo. Cada medicamento tomado es un paso juntos.
                </p>
            </div>

            <div class="pet-container">
                <div class="pet-visual">
                    <div class="pet-character" id="petCharacter" data-energy="{{ $companionEnergyLevel }}"
                        data-evolution="{{ $evolutionStage }}">
                        <div class="sparkles">
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                        </div>

                        <div class="pet-body"
                            style="background: linear-gradient(135deg, {{ $petColors->primary }} 0%, {{ $petColors->secondary }} 100%);">
                        </div>

                        <div class="pet-eyes">
                            <div class="eye"></div>
                            <div class="eye"></div>
                        </div>

                        <div class="pet-mouth"></div>

                        @if ($evolutionStage >= 2)
                            <div style="position: absolute; top: 15%; right: 20%; font-size: 1.5rem;">👑</div>
                        @endif
                        @if ($evolutionStage >= 3)
                            <div style="position: absolute; bottom: 20%; left: 15%; font-size: 1.5rem;">⭐</div>
                        @endif
                    </div>

                    <div class="pet-stats">
                        <div class="stat">
                            <span class="stat-value" id="streakDays">{{ $streakDays }}</span>
                            <span class="stat-label">Días de racha</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value" id="companionEnergy">{{ $companionEnergy }}%</span>
                            <span class="stat-label">Energía</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value" id="adherenceRate">{{ $adherenceRate }}%</span>
                            <span class="stat-label">Adherencia</span>
                        </div>
                    </div>
                </div>

                <div class="pet-info">
                    <div class="streak-info">
                        <h3 class="streak-title">
                            <i class="fas fa-heart" style="color: #4db8a8; margin-right: 0.5rem;"></i>
                            {{ $motivationalMessage->title }}
                        </h3>
                        <p class="streak-description">
                            {{ $motivationalMessage->description }}
                        </p>

                        <div class="streak-progress">
                            <div class="streak-progress-bar" id="streakProgressBar"
                                style="width: {{ $progressToNextAchievement }}%;"></div>
                        </div>

                        <p class="streak-message">
                            <i class="fas fa-star" style="color: #ffc107; margin-right: 0.5rem;"></i>
                            <span id="nextAchievementMessage">
                                @if ($nextAchievement)
                                    ¡A {{ $nextAchievement->days_remaining }} días de "{{ $nextAchievement->name }}"!
                                @else
                                    ¡Has alcanzado todos los logros! Eres increíble.
                                @endif
                            </span>
                        </p>
                    </div>

                    <div
                        style="background: rgba(255, 255, 255, 0.7); border-radius: 15px; padding: 1rem; border-left: 4px solid #4db8a8;">
                        <p style="color: #2c5f5d; font-style: italic; margin: 0;">
                            <i class="fas fa-quote-left" style="color: #4db8a8; margin-right: 0.5rem;"></i>
                            {{ $dailyAffirmation }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('adherencia') }}"
                    style="
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        margin-top: 1rem;
        padding: 0.95rem 1.4rem;
        background: linear-gradient(135deg, #4db8a8, #5bc4b3);
        color: white;
        text-decoration: none;
        border-radius: 14px;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(77, 184, 168, 0.25);
        transition: all 0.3s ease;
   "
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 24px rgba(77, 184, 168, 0.35)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(77, 184, 168, 0.25)';">
                    <i class="fas fa-pills"></i>
                    Registrar toma de hoy
                </a>
            </div>
        </section>

        <section class="carousel-section">
            <div class="carousel-container">
                <div class="carousel-track" id="carouselTrack">
                    <!-- Slide 1: Diario emocional -->
                    <div class="carousel-slide">
                        <div class="slide-content">
                            <div class="slide-text">
                                <h2 class="slide-title">Diario Emocional Inteligente</h2>
                                <p class="slide-description">
                                    Registra tus pensamientos y emociones diariamente con nuestra herramienta guiada.
                                    Identifica patrones, celebra tus progresos y desarrolla mayor consciencia emocional
                                    con análisis automáticos y reflexiones personalizadas.
                                </p>
                                <a href="{{ route('diario.emocional') }}" class="slide-button">
                                    <i class="fas fa-book-open"></i>
                                    Abrir mi diario
                                </a>
                            </div>
                            <div class="slide-image">
                                <div class="slide-visual">
                                    <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                        alt="Diario Emocional">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: Chatbot Cereon -->
                    <div class="carousel-slide">
                        <div class="slide-content">
                            <div class="slide-text">
                                <h2 class="slide-title">Habla con Cereon 🧠</h2>
                                <p class="slide-description">
                                    Nuestro asistente virtual está disponible 24/7 para escucharte,
                                    ofrecerte recursos personalizados y guiarte en ejercicios de mindfulness.
                                    Cereon aprende de tus conversaciones para brindarte apoyo cada vez más relevante.
                                </p>
                                <a href="{{ route('chatbot.index') }}" class="slide-button">
                                    <i class="fas fa-comments"></i>
                                    Conversar con Cereon
                                </a>
                            </div>
                            <div class="slide-image">
                                <div class="slide-visual">
                                    <img src="https://images.unsplash.com/photo-1531746790731-6c087fecd65a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                        alt="Chatbot Cereon">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4: Gestión de medicación -->
                    <div class="carousel-slide">
                        <div class="slide-content">
                            <div class="slide-text">
                                <h2 class="slide-title">Adherencia a Tratamiento</h2>
                                <p class="slide-description">
                                    Mantén tu racha de medicación y celebra cada logro. Nuestro sistema
                                    de recordatorios inteligentes y seguimiento de adherencia te ayuda a
                                    mantener la consistencia en tu tratamiento médico.
                                </p>
                                <a href="{{ route('adherencia') }}" class="slide-button">
                                    <i class="fas fa-pills"></i>
                                    Gestionar medicación
                                </a>
                            </div>
                            <div class="slide-image">
                                <div class="slide-visual">
                                    <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                        alt="Gestión de medicación">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 5: Artículos y blog -->
                    <div class="carousel-slide">
                        <div class="slide-content">
                            <div class="slide-text">
                                <h2 class="slide-title">Comunidad y Recursos</h2>
                                <p class="slide-description">
                                    Accede a artículos basados en evidencia científica, historias inspiradoras
                                    de nuestra comunidad y herramientas prácticas para tu bienestar emocional.
                                    Aprende y crece junto a otros en su camino de salud mental.
                                </p>
                                <a href="#" class="slide-button">
                                    <i class="fas fa-newspaper"></i>
                                    Explorar recursos
                                </a>
                            </div>
                            <div class="slide-image">
                                <div class="slide-visual">
                                    <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                        alt="Comunidad y recursos">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navegación del carrusel -->
            <div class="carousel-nav">
                <button class="carousel-arrow" id="prevSlide">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="carousel-dots" id="carouselDots">
                    <!-- Los puntos se generarán dinámicamente -->
                </div>

                <button class="carousel-arrow" id="nextSlide">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>

        <!-- Artículos y blog -->
        <section class="articles-section">
            <h2 class="section-title">Artículos y recursos para ti</h2>
            <div class="articles-grid">
                <!-- Artículo 1 -->
                <div class="article-card">
                    <div class="article-image">
                        <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Estrategias de afrontamiento">
                    </div>
                    <div class="article-content">
                        <span class="article-category">Estrategias</span>
                        <h3 class="article-title">5 Estrategias para Manejar la Ansiedad en el Día a Día</h3>
                        <p class="article-excerpt">
                            Técnicas prácticas basadas en terapia cognitivo-conductual que puedes
                            aplicar inmediatamente para reducir los síntomas de ansiedad.
                        </p>
                        <a href="#" class="article-button">
                            Leer artículo
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Artículo 2 -->
                <div class="article-card">
                    <div class="article-image">
                        <img src="https://images.unsplash.com/photo-1593115057322-e94b77572f20?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Mindfulness">
                    </div>
                    <div class="article-content">
                        <span class="article-category">Mindfulness</span>
                        <h3 class="article-title">Introducción a la Meditación Mindfulness para Principiantes</h3>
                        <p class="article-excerpt">
                            Una guía paso a paso para comenzar tu práctica de meditación,
                            con ejercicios de 5 minutos que puedes hacer en cualquier lugar.
                        </p>
                        <a href="#" class="article-button">
                            Leer artículo
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Artículo 3 -->
                <div class="article-card">
                    <div class="article-image">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Comunidad">
                    </div>
                    <div class="article-content">
                        <span class="article-category">Comunidad</span>
                        <h3 class="article-title">Historias de Recuperación: Cómo Superé la Depresión</h3>
                        <p class="article-excerpt">
                            Testimonio anónimo de un miembro de nuestra comunidad sobre su
                            camino hacia la recuperación y las herramientas que le ayudaron.
                        </p>
                        <a href="#" class="article-button">
                            Leer artículo
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        // Configuración inicial
        document.addEventListener('DOMContentLoaded', function() {
            // Establecer fecha actual
            const currentDateElement = document.getElementById('currentDate');
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            currentDateElement.textContent = now.toLocaleDateString('es-ES', options);

            // Inicializar carrusel
            initCarousel();

            // Inicializar mascota de adherencia
            initAdherencePet();

            // Configurar interacciones
            setupInteractions();
        });

        // Carrusel interactivo
        function initCarousel() {
            const track = document.getElementById('carouselTrack');
            const slides = document.querySelectorAll('.carousel-slide');
            const dotsContainer = document.getElementById('carouselDots');
            const prevButton = document.getElementById('prevSlide');
            const nextButton = document.getElementById('nextSlide');

            let currentSlide = 0;
            const totalSlides = slides.length;
            let autoSlideInterval;

            // Crear puntos de navegación
            slides.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = `carousel-dot ${index === 0 ? 'active' : ''}`;
                dot.dataset.index = index;
                dot.addEventListener('click', () => goToSlide(index));
                dotsContainer.appendChild(dot);
            });

            // Función para ir a un slide específico
            function goToSlide(index) {
                currentSlide = index;
                track.style.transform = `translateX(-${currentSlide * 100}%)`;

                // Actualizar puntos activos
                document.querySelectorAll('.carousel-dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });

                // Reiniciar intervalo
                restartAutoSlide();
            }

            // Navegación
            prevButton.addEventListener('click', () => {
                goToSlide((currentSlide - 1 + totalSlides) % totalSlides);
            });

            nextButton.addEventListener('click', () => {
                goToSlide((currentSlide + 1) % totalSlides);
            });

            // Auto-avance
            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    goToSlide((currentSlide + 1) % totalSlides);
                }, 5000); // Cambia cada 5 segundos
            }

            function restartAutoSlide() {
                clearInterval(autoSlideInterval);
                startAutoSlide();
            }

            // Iniciar auto-avance
            startAutoSlide();

            // Pausar al interactuar
            track.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });

            track.addEventListener('mouseleave', () => {
                startAutoSlide();
            });

            // Soporte para touch (móviles)
            let startX = 0;
            let endX = 0;

            track.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });

            track.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = startX - endX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swipe izquierda - siguiente
                        goToSlide((currentSlide + 1) % totalSlides);
                    } else {
                        // Swipe derecha - anterior
                        goToSlide((currentSlide - 1 + totalSlides) % totalSlides);
                    }
                }
            }
        }

        // Mascota de adherencia
        function initAdherencePet() {
            const petCharacter = document.getElementById('petCharacter');
            const streakDaysElement = document.getElementById('streakDays');
            const companionEnergyElement = document.getElementById('companionEnergy');
            const adherenceRateElement = document.getElementById('adherenceRate');
            const streakProgressBar = document.getElementById('streakProgressBar');

            if (!petCharacter || !streakDaysElement || !companionEnergyElement || !adherenceRateElement) {
                return;
            }

            const petBody = document.querySelector('.pet-body');
            const eyes = document.querySelectorAll('.eye');
            const mouth = document.querySelector('.pet-mouth');

            const streakDays = parseInt(streakDaysElement.textContent) || 0;
            const companionEnergy = parseInt(companionEnergyElement.textContent.replace('%', '')) || 0;
            const adherenceRate = parseInt(adherenceRateElement.textContent.replace('%', '')) || 0;

            if (streakProgressBar) {
                const currentWidth = parseInt(streakProgressBar.style.width) || 0;
                streakProgressBar.style.width = `${currentWidth}%`;
            }

            if (companionEnergy >= 80) {
                petCharacter.setAttribute('data-energy', 'high');
                if (mouth) {
                    mouth.style.borderBottom = '8px solid #253138';
                    mouth.style.borderRadius = '0 0 40px 40px';
                }
            } else if (companionEnergy >= 40) {
                petCharacter.setAttribute('data-energy', 'medium');
                if (mouth) {
                    mouth.style.borderBottom = '6px solid #253138';
                    mouth.style.borderRadius = '0 0 30px 30px';
                }
            } else {
                petCharacter.setAttribute('data-energy', 'low');
                if (mouth) {
                    mouth.style.borderBottom = '4px solid #253138';
                    mouth.style.borderRadius = '0 0 20px 20px';
                }
            }

            petCharacter.addEventListener('mouseenter', function() {
                if (petBody) {
                    petBody.style.transform = 'scale(1.03)';
                }
                eyes.forEach(eye => {
                    eye.style.transform = 'scale(1.05)';
                });
            });

            petCharacter.addEventListener('mouseleave', function() {
                if (petBody) {
                    petBody.style.transform = '';
                }
                eyes.forEach(eye => {
                    eye.style.transform = '';
                });
            });
        }

        // Configurar otras interacciones
        function setupInteractions() {
            // Notificaciones
            window.showNotification = function(message, type) {
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 30px;
                    background: ${type === 'success' ? 'linear-gradient(135deg, #4db8a8, #5bc4b3)' : 'linear-gradient(135deg, #ff9800, #ff5722)'};
                    color: white;
                    padding: 1.2rem 2rem;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                    z-index: 2000;
                    animation: slideInRight 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    max-width: 350px;
                `;

                const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
                notification.innerHTML = `
                    <i class="fas ${icon}" style="font-size: 1.3rem;"></i>
                    <div>
                        <strong style="display: block; margin-bottom: 0.2rem;">${type === 'success' ? '¡Éxito!' : 'Atención'}</strong>
                        <span>${message}</span>
                    </div>
                `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOutRight 0.3s ease forwards';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 4000);
            };

            // Agregar estilos para animaciones de notificación
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideInRight {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                @keyframes slideOutRight {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);

            // Efectos hover para tarjetas de acceso rápido
            const accessCards = document.querySelectorAll('.access-card');
            accessCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('.access-icon');
                    icon.style.transform = 'scale(1.1) rotate(5deg)';
                });

                card.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('.access-icon');
                    icon.style.transform = '';
                });
            });

            // Efectos hover para artículos
            const articleCards = document.querySelectorAll('.article-card');
            articleCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const image = this.querySelector('.article-image img');
                    image.style.transform = 'scale(1.05)';
                });

                card.addEventListener('mouseleave', function() {
                    const image = this.querySelector('.article-image img');
                    image.style.transform = '';
                });
            });

            // Interacción con el perfil de usuario
            const userAvatar = document.querySelector('.user-avatar');
            userAvatar.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        }
    </script>
@endpush
