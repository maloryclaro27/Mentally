<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentally - Dashboard de Paciente</title>
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

        /* Mascota de adherencia */
        .adherence-pet {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 251, 0.98));
            border-radius: 25px;
            padding: 2.5rem;
            margin-bottom: 3rem;
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.15);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease 0.8s backwards;
        }

        .pet-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .pet-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
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
        }

        .pet-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .pet-character {
            width: 300px;
            height: 300px;
            position: relative;
            margin-bottom: 2rem;
        }

        .pet-body {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            animation: gentleFloat 6s ease-in-out infinite;
        }

        .pet-eyes {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 3rem;
        }

        .eye {
            width: 30px;
            height: 40px;
            background: white;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
        }

        .eye::after {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            width: 15px;
            height: 15px;
            background: #253138;
            border-radius: 50%;
            animation: blink 5s infinite;
        }

        .pet-mouth {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 30px;
            border-bottom: 6px solid #253138;
            border-radius: 0 0 30px 30px;
        }

        .pet-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #4db8a8;
            display: block;
        }

        .stat-label {
            color: #5a7c7a;
            font-size: 0.9rem;
        }

        .pet-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .streak-info {
            background: rgba(77, 184, 168, 0.1);
            padding: 1.5rem;
            border-radius: 15px;
            border-left: 4px solid #4db8a8;
        }

        .streak-title {
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
        }

        .streak-description {
            color: #5a7c7a;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .streak-progress {
            height: 10px;
            background: rgba(77, 184, 168, 0.2);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .streak-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 5px;
            width: 70%;
        }

        .medication-form {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            border: 2px solid rgba(77, 184, 168, 0.2);
        }

        .form-title {
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            color: #5a7c7a;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid rgba(77, 184, 168, 0.3);
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            color: #2c5f5d;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: #4db8a8;
            box-shadow: 0 0 0 3px rgba(77, 184, 168, 0.1);
        }

        .form-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .form-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.3);
        }

        .form-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
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

        /* Modal bloqueo de tests */
        .test-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(44, 95, 93, 0.35);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3000;
        }

        .test-modal {
            background: linear-gradient(135deg, #ffffff, #f8fcfb);
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 420px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 50px rgba(77, 184, 168, 0.3);
            border: 1px solid rgba(77, 184, 168, 0.15);
            animation: modalPop 0.3s ease;
        }

        .test-modal-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.4);
        }

        .test-modal-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1rem;
        }

        .test-modal-text {
            color: #5a7c7a;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .test-modal-button {
            padding: 0.9rem 2rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border: none;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .test-modal-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.4);
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Elementos decorativos flotantes -->
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

                <a href="#" class="access-card">
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

                <a href="#" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="access-name">Mi registro diario</h3>
                    <p class="access-description">Seguimiento de síntomas y estado de ánimo</p>
                </a>

                <a href="{{ route('chatbot') }}" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="access-name">Chatea con Cereon</h3>
                    <p class="access-description">Asistente virtual disponible 24/7</p>
                </a>


                <a href="#" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="access-name">Recordatorios</h3>
                    <p class="access-description">Configura alertas personalizadas</p>
                </a>

                <a href="#" class="access-card">
                    <div class="access-icon">
                        <i class="fas fa-capsules"></i>
                    </div>
                    <h3 class="access-name">Medicación</h3>
                    <p class="access-description">Control de tratamiento farmacológico</p>
                </a>
            </div>
        </section>

        <!-- Mascota de adherencia -->
        <section class="adherence-pet">
            <div class="pet-header">
                <h2 class="pet-title">¡Empieza la racha para cuidar tu salud mental!</h2>
                <p class="pet-subtitle">Tu compañero de bienestar necesita tu compromiso diario</p>
            </div>

            <div class="pet-container">
                <div class="pet-visual">
                    <div class="pet-character">
                        <div class="pet-body"></div>
                        <div class="pet-eyes">
                            <div class="eye"></div>
                            <div class="eye"></div>
                        </div>
                        <div class="pet-mouth"></div>
                    </div>

                    <div class="pet-stats">
                        <div class="stat">
                            <span class="stat-value" id="streakDays">7</span>
                            <span class="stat-label">Días de racha</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value" id="petMood">85%</span>
                            <span class="stat-label">Estado del compañero</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value" id="adherenceRate">92%</span>
                            <span class="stat-label">Adherencia</span>
                        </div>
                    </div>
                </div>

                <div class="pet-info">
                    <div class="streak-info">
                        <h3 class="streak-title">Tu compromiso hace la diferencia</h3>
                        <p class="streak-description">
                            Cada día que registras tu medicación, tu compañero de bienestar se fortalece.
                            Mantén la racha para verlo crecer y desarrollarse, reflejando tu propio progreso
                            en el camino hacia una mejor salud mental.
                        </p>
                        <div class="streak-progress">
                            <div class="streak-progress-bar" id="streakProgress"></div>
                        </div>
                        <small>Progreso hacia el siguiente nivel: 7/10 días</small>
                    </div>

                    <div class="medication-form">
                        <h3 class="form-title">Registrar medicación de hoy</h3>
                        <div class="form-group">
                            <label class="form-label">Medicamento</label>
                            <select class="form-select" id="medicationSelect">
                                <option value="">Selecciona un medicamento</option>
                                <option value="sertraline">Sertralina 50mg</option>
                                <option value="escitalopram">Escitalopram 10mg</option>
                                <option value="bupropion">Bupropion 150mg</option>
                                <option value="other">Otro medicamento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Hora de toma</label>
                            <select class="form-select" id="timeSelect">
                                <option value="">Selecciona la hora</option>
                                <option value="morning">Mañana (8:00 AM)</option>
                                <option value="afternoon">Tarde (2:00 PM)</option>
                                <option value="evening">Noche (8:00 PM)</option>
                                <option value="custom">Hora personalizada</option>
                            </select>
                        </div>
                        <button class="form-button" id="registerMedication">
                            <i class="fas fa-check-circle"></i>
                            Confirmar toma
                        </button>
                    </div>
                </div>
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
                                <a href="#" class="slide-button">
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

                    <!-- Slide 2: Registro de sintomatología -->
                    <div class="carousel-slide">
                        <div class="slide-content">
                            <div class="slide-text">
                                <h2 class="slide-title">Registro de Sintomatología</h2>
                                <p class="slide-description">
                                    Monitorea tu bienestar con nuestro sistema de seguimiento diario.
                                    Visualiza tu progreso, identifica desencadenantes y comparte informes
                                    detallados con tu especialista para un tratamiento más personalizado.
                                </p>
                                <a href="#" class="slide-button">
                                    <i class="fas fa-chart-line"></i>
                                    Registrar síntomas
                                </a>
                            </div>
                            <div class="slide-image">
                                <div class="slide-visual">
                                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                        alt="Registro de síntomas">
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
                                <a href="#" class="slide-button">
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
                                <a href="#" class="slide-button">
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
            const medicationButton = document.getElementById('registerMedication');
            const streakDaysElement = document.getElementById('streakDays');
            const petMoodElement = document.getElementById('petMood');
            const adherenceRateElement = document.getElementById('adherenceRate');
            const streakProgressElement = document.getElementById('streakProgress');

            // Estado inicial
            let streakDays = 7;
            let petMood = 85;
            let adherenceRate = 92;
            let progress = 70;

            // Actualizar visualización
            function updatePetStats() {
                streakDaysElement.textContent = streakDays;
                petMoodElement.textContent = `${petMood}%`;
                adherenceRateElement.textContent = `${adherenceRate}%`;
                streakProgressElement.style.width = `${progress}%`;
            }

            // Registrar medicación
            medicationButton.addEventListener('click', function() {
                const medicationSelect = document.getElementById('medicationSelect');
                const timeSelect = document.getElementById('timeSelect');

                // Validación
                if (!medicationSelect.value || !timeSelect.value) {
                    showNotification('Por favor, completa todos los campos', 'warning');
                    return;
                }

                // Simular carga
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registrando...';

                setTimeout(() => {
                    // Actualizar estadísticas
                    streakDays++;
                    petMood = Math.min(100, petMood + 3);
                    adherenceRate = Math.min(100, adherenceRate + 2);
                    progress = Math.min(100, progress + 10);

                    // Si la racha llega a un hito
                    if (streakDays % 10 === 0) {
                        showNotification(`¡Felicidades! Has alcanzado ${streakDays} días de racha`,
                            'success');
                        animatePetCelebration();
                    } else {
                        showNotification('Medicación registrada exitosamente', 'success');
                        animatePetHappiness();
                    }

                    // Actualizar interfaz
                    updatePetStats();

                    // Restaurar botón
                    this.disabled = false;
                    this.innerHTML = '<i class="fas fa-check-circle"></i> Confirmar toma';

                    // Resetear formulario
                    medicationSelect.value = '';
                    timeSelect.value = '';

                }, 1500);
            });

            // Animaciones de la mascota
            function animatePetHappiness() {
                const petBody = document.querySelector('.pet-body');
                const eyes = document.querySelectorAll('.eye');
                const mouth = document.querySelector('.pet-mouth');

                // Efecto de felicidad
                petBody.style.animation = 'none';
                petBody.style.transform = 'scale(1.05)';

                // Ojos felices
                eyes.forEach(eye => {
                    eye.style.borderRadius = '50% 50% 50% 50%';
                });

                // Sonrisa
                mouth.style.borderBottom = '8px solid #253138';
                mouth.style.borderRadius = '0 0 40px 40px';

                setTimeout(() => {
                    petBody.style.animation = 'gentleFloat 6s ease-in-out infinite';
                    petBody.style.transform = '';

                    eyes.forEach(eye => {
                        eye.style.borderRadius = '';
                    });

                    mouth.style.borderBottom = '6px solid #253138';
                    mouth.style.borderRadius = '0 0 30px 30px';
                }, 1000);
            }

            function animatePetCelebration() {
                const petBody = document.querySelector('.pet-body');

                // Efecto especial de celebración
                petBody.style.animation = 'none';
                petBody.style.background = 'linear-gradient(135deg, #FFD700, #FFA500)';

                // Crear partículas de celebración
                for (let i = 0; i < 20; i++) {
                    createCelebrationParticle();
                }

                setTimeout(() => {
                    petBody.style.animation = 'gentleFloat 6s ease-in-out infinite';
                    petBody.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                }, 2000);
            }

            function createCelebrationParticle() {
                const particle = document.createElement('div');
                particle.style.cssText = `
                    position: absolute;
                    width: 8px;
                    height: 8px;
                    background: linear-gradient(135deg, #FFD700, #FFA500);
                    border-radius: 50%;
                    top: 150px;
                    left: 150px;
                    pointer-events: none;
                    z-index: 10;
                `;

                document.querySelector('.pet-character').appendChild(particle);

                // Animación de partícula
                const angle = Math.random() * Math.PI * 2;
                const velocity = 2 + Math.random() * 3;
                const vx = Math.cos(angle) * velocity;
                const vy = Math.sin(angle) * velocity;

                let x = 150;
                let y = 150;
                let opacity = 1;

                function animateParticle() {
                    x += vx;
                    y += vy;
                    opacity -= 0.02;

                    particle.style.transform = `translate(${x - 150}px, ${y - 150}px)`;
                    particle.style.opacity = opacity;

                    if (opacity > 0) {
                        requestAnimationFrame(animateParticle);
                    } else {
                        particle.remove();
                    }
                }

                animateParticle();
            }

            // Inicializar estadísticas
            updatePetStats();
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

        // Interceptar acceso a tests con cooldown
        document.querySelectorAll('[data-test-link]').forEach(link => {
            link.addEventListener('click', function(e) {
                const available = this.dataset.available === '1';

                if (!available) {
                    e.preventDefault();

                    const nextDate = this.dataset.nextDate;
                    const remaining = this.dataset.remainingDays;

                    const message = `
                Ya realizaste este test recientemente.<br><br>
                Podrás volver a realizarlo el <strong>${nextDate}</strong>
                (${remaining} día${remaining == 1 ? '' : 's'} restantes).
            `;

                    document.getElementById('testModalMessage').innerHTML = message;
                    document.getElementById('testCooldownModal').style.display = 'flex';
                }
                // si está disponible → deja navegar normal
            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            // Interceptar acceso a tests con cooldown
            document.querySelectorAll('[data-test-link]').forEach(link => {
                link.addEventListener('click', function(e) {
                    const available = this.dataset.available === '1';

                    if (!available) {
                        e.preventDefault();

                        const nextDate = this.dataset.nextDate;
                        const remaining = this.dataset.remainingDays;

                        const message = `
                    Ya realizaste este test recientemente.<br><br>
                    Podrás volver a realizarlo el <strong>${nextDate}</strong>
                    (${remaining} día${remaining == 1 ? '' : 's'} restantes).
                `;

                        document.getElementById('testModalMessage').innerHTML = message;
                        document.getElementById('testCooldownModal').style.display = 'flex';
                    }
                });
            });

            // Cerrar modal
            const closeBtn = document.getElementById('closeTestModal');
            const modal = document.getElementById('testCooldownModal');

            if (closeBtn && modal) {
                closeBtn.addEventListener('click', () => {
                    modal.style.display = 'none';
                });
            }

        });
    </script>
    <!-- Modal bloqueo de test -->
    <div id="testCooldownModal" class="test-modal-overlay" style="display:none;">
        <div class="test-modal">
            <div class="test-modal-icon">
                <i class="fas fa-lock"></i>
            </div>

            <h3 class="test-modal-title">Test no disponible aún</h3>

            <p class="test-modal-text" id="testModalMessage">
                <!-- Texto dinámico -->
            </p>

            <button class="test-modal-button" id="closeTestModal">
                Entendido
            </button>
        </div>
    </div>
</body>

</html>
