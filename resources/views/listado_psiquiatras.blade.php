<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentally - Directorio de Psiquiatras Especializados</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Mantenemos todos los estilos base de tu diseño */
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
            padding-top: 100px; /* Para el navbar fijo */
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

        /* Botón de regreso */
        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            background: transparent;
            color: #4db8a8;
            border: 2px solid #4db8a8;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #4db8a8;
            color: white;
            transform: translateX(-5px);
        }

        /* Encabezado de la página */
        .page-header {
            text-align: center;
            padding: 4rem 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .page-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 2px;
        }

        .page-subtitle {
            font-size: 1.3rem;
            color: #5a7c7a;
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        /* Sección de filtros */
        .filters-section {
            padding: 2rem 3rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            margin: 0 3rem 3rem;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease;
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

        .filters-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filters-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            color: #2c5f5d;
            font-weight: 600;
        }

        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid rgba(77, 184, 168, 0.3);
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #4db8a8;
            box-shadow: 0 0 0 3px rgba(77, 184, 168, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #4db8a8;
        }

        /* Filtros especialidades */
        .specialty-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .specialty-tag {
            padding: 0.8rem 1.5rem;
            background: rgba(77, 184, 168, 0.1);
            border: 2px solid transparent;
            border-radius: 25px;
            color: #4db8a8;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .specialty-tag:hover {
            background: rgba(77, 184, 168, 0.2);
            transform: translateY(-2px);
        }

        .specialty-tag.active {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border-color: #4db8a8;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
        }

        /* Filtros adicionales */
        .additional-filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-label {
            font-weight: 600;
            color: #2c5f5d;
            font-size: 0.9rem;
        }

        .filter-select {
            padding: 0.8rem 1rem;
            border: 2px solid rgba(77, 184, 168, 0.3);
            border-radius: 12px;
            background: white;
            font-family: 'Poppins', sans-serif;
            color: #2c5f5d;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: #4db8a8;
            box-shadow: 0 0 0 3px rgba(77, 184, 168, 0.1);
        }

        /* Contador de resultados */
        .results-count {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-top: 1px solid rgba(77, 184, 168, 0.2);
            color: #5a7c7a;
            font-size: 0.9rem;
        }

        /* Grid de especialistas */
        .specialists-grid {
            padding: 0 3rem 4rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            position: relative;
        }

        .specialist-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 252, 251, 0.98) 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(30px);
        }

        .specialist-card.visible {
            opacity: 1;
            transform: translateY(0);
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

        /* Badge de disponibilidad */
        .availability-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.4rem 1rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }

        .availability-badge.available {
            background: rgba(76, 175, 80, 0.15);
            color: #4CAF50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .availability-badge.busy {
            background: rgba(244, 67, 54, 0.15);
            color: #F44336;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .availability-badge.soon {
            background: rgba(255, 152, 0, 0.15);
            color: #FF9800;
            border: 1px solid rgba(255, 152, 0, 0.3);
        }

        /* Imagen del especialista */
        .specialist-image-container {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
            border: 4px solid white;
        }

        .specialist-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .specialist-card:hover .specialist-image {
            transform: scale(1.05);
        }

        /* Información del especialista */
        .specialist-info {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .specialist-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
        }

        .specialist-title {
            color: #4db8a8;
            font-weight: 600;
            margin-bottom: 0.8rem;
            font-size: 1rem;
        }

        .specialist-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            margin-bottom: 1rem;
        }

        .rating-stars {
            color: #FFC107;
        }

        .rating-value {
            color: #5a7c7a;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        /* Especialidades */
        .specialist-specialties {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .specialty-chip {
            background: rgba(77, 184, 168, 0.1);
            color: #4db8a8;
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .specialist-card:hover .specialty-chip {
            transform: translateY(-2px);
            background: rgba(77, 184, 168, 0.2);
        }

        /* Detalles adicionales */
        .specialist-details {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(77, 184, 168, 0.05);
            border-radius: 12px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #5a7c7a;
            font-size: 0.9rem;
        }

        .detail-item i {
            color: #4db8a8;
            width: 20px;
            text-align: center;
        }

        /* Acciones */
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-contact:hover {
            background: #4db8a8;
            color: white;
            transform: translateY(-2px);
        }

        /* Paginación */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            padding: 2rem 3rem 4rem;
        }

        .pagination-button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 2px solid rgba(77, 184, 168, 0.3);
            color: #4db8a8;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-button:hover {
            background: #4db8a8;
            color: white;
            border-color: #4db8a8;
            transform: translateY(-2px);
        }

        .pagination-button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-button.disabled:hover {
            background: white;
            color: #4db8a8;
            transform: none;
        }

        .pagination-numbers {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-number {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(77, 184, 168, 0.1);
            color: #4db8a8;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-number.active {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
        }

        .pagination-number:hover:not(.active) {
            background: rgba(77, 184, 168, 0.2);
            transform: translateY(-2px);
        }

        /* Elementos decorativos */
        .floating-element {
            position: fixed;
            pointer-events: none;
            z-index: 0;
            opacity: 0.1;
        }

        .brain-icon {
            font-size: 8rem;
            color: #4db8a8;
            animation: gentleFloat 15s ease-in-out infinite;
        }

        .brain-1 {
            top: 20%;
            left: 5%;
        }

        .brain-2 {
            top: 60%;
            right: 5%;
            animation-delay: 2s;
        }

        .brain-3 {
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(20px, -15px) rotate(5deg); }
            50% { transform: translate(-5px, 20px) rotate(-3deg); }
            75% { transform: translate(15px, 5px) rotate(2deg); }
        }

        /* Modal de detalles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 252, 251, 0.99) 100%);
            border-radius: 25px;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideInUp 0.5s ease;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(77, 184, 168, 0.2);
        }

        .modal-header {
            padding: 2rem 2rem 1rem;
            border-bottom: 2px solid rgba(77, 184, 168, 0.1);
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(77, 184, 168, 0.1);
            border: none;
            color: #4db8a8;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #4db8a8;
            color: white;
            transform: rotate(90deg);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .specialists-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 80px;
            }

            nav {
                padding: 1rem 1.5rem;
            }

            .page-header {
                padding: 3rem 1.5rem 1.5rem;
            }

            .page-title {
                font-size: 2.5rem;
            }

            .filters-section,
            .specialists-grid {
                margin-left: 1.5rem;
                margin-right: 1.5rem;
            }

            .filters-section {
                padding: 1.5rem;
            }

            .specialists-grid {
                padding: 0 1.5rem 3rem;
            }

            .additional-filters {
                grid-template-columns: 1fr;
            }

            .specialist-actions {
                flex-direction: column;
            }

            .pagination {
                padding: 1.5rem 1.5rem 3rem;
            }
        }

        @media (max-width: 480px) {
            .specialists-grid {
                grid-template-columns: 1fr;
            }

            .specialty-filters {
                justify-content: center;
            }

            .pagination-numbers {
                display: none;
            }

            .filters-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container {
                max-width: none;
            }
        }

        /* Animaciones de entrada escalonada */
        .stagger-animation {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Efectos de carga */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(77, 184, 168, 0.1);
            border-top-color: #4db8a8;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Elementos decorativos flotantes -->
    <div class="floating-element brain-1 brain-icon">
        <i class="fas fa-brain"></i>
    </div>
    <div class="floating-element brain-2 brain-icon">
        <i class="fas fa-brain"></i>
    </div>
    <div class="floating-element brain-3 brain-icon">
        <i class="fas fa-brain"></i>
    </div>

    <!-- Navbar -->
    <nav>
        <div class="logo-section">
            <div class="logo-placeholder">
                <img src="{{ asset('logo_pg.png') }}" alt="Logo Mentally">
            </div>
            <span class="brand-name">Mentally</span>
        </div>
        
        <a href="index.html" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Volver al Inicio
        </a>
    </nav>

    <!-- Encabezado de página -->
    <section class="page-header">
        <h1 class="page-title">Encuentra a tu Psiquiatra Especializado</h1>
        <p class="page-subtitle">
            Conecta con profesionales certificados en diferentes especialidades de salud mental. 
            Filtra por experiencia, ubicación y tipo de terapia para encontrar el especialista ideal para ti.
        </p>
    </section>

    <!-- Sección de filtros -->
    <section class="filters-section" id="filters">
        <div class="filters-header">
            <h2 class="filters-title">Filtra tu búsqueda</h2>
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Buscar psiquiatra por nombre o especialidad...">
            </div>
        </div>

        <!-- Filtros por especialidad -->
        <div class="specialty-filters">
            <div class="specialty-tag active" data-specialty="all">
                <i class="fas fa-star"></i>
                Todos los especialistas
            </div>
            <div class="specialty-tag" data-specialty="anxiety">
                <i class="fas fa-wind"></i>
                Ansiedad
            </div>
            <div class="specialty-tag" data-specialty="depression">
                <i class="fas fa-cloud-rain"></i>
                Depresión
            </div>
            <div class="specialty-tag" data-specialty="adhd">
                <i class="fas fa-bolt"></i>
                TDAH
            </div>
            <div class="specialty-tag" data-specialty="schizophrenia">
                <i class="fas fa-brain"></i>
                Esquizofrenia
            </div>
            <div class="specialty-tag" data-specialty="bipolar">
                <i class="fas fa-sun"></i>
                Trastorno Bipolar
            </div>
            <div class="specialty-tag" data-specialty="ocd">
                <i class="fas fa-redo"></i>
                TOC
            </div>
            <div class="specialty-tag" data-specialty="ptsd">
                <i class="fas fa-shield-alt"></i>
                TEPT
            </div>
        </div>

        <!-- Filtros adicionales -->
        <div class="additional-filters">
            <div class="filter-group">
                <label class="filter-label">Ubicación</label>
                <select class="filter-select" id="locationFilter">
                    <option value="all">Todas las ubicaciones</option>
                    <option value="bogota">Bogotá</option>
                    <option value="medellin">Medellín</option>
                    <option value="cali">Cali</option>
                    <option value="barranquilla">Barranquilla</option>
                    <option value="virtual">Consulta Virtual</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Modalidad</label>
                <select class="filter-select" id="modalityFilter">
                    <option value="all">Cualquier modalidad</option>
                    <option value="presencial">Presencial</option>
                    <option value="virtual">Virtual</option>
                    <option value="both">Ambas</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Precio por sesión</label>
                <select class="filter-select" id="priceFilter">
                    <option value="all">Cualquier precio</option>
                    <option value="low">Menos de $150.000</option>
                    <option value="medium">$150.000 - $300.000</option>
                    <option value="high">Más de $300.000</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Idiomas</label>
                <select class="filter-select" id="languageFilter">
                    <option value="all">Todos los idiomas</option>
                    <option value="español">Español</option>
                    <option value="ingles">Inglés</option>
                    <option value="portugues">Portugués</option>
                </select>
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="results-count">
            <span id="totalResults">Mostrando 12 especialistas</span>
            <button class="btn-contact" id="resetFilters">
                <i class="fas fa-redo"></i>
                Restablecer filtros
            </button>
        </div>
    </section>

    <!-- Grid de especialistas -->
    <section class="specialists-grid" id="specialistsGrid">
        <!-- Los especialistas se cargarán aquí dinámicamente -->
    </section>

    <!-- Paginación -->
    <div class="pagination">
        <button class="pagination-button" id="prevPage" disabled>
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="pagination-numbers" id="pageNumbers">
            <!-- Los números de página se generarán dinámicamente -->
        </div>
        
        <button class="pagination-button" id="nextPage">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <!-- Modal de detalles -->
    <div class="modal-overlay" id="specialistModal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="modal-close" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
                <div id="modalContent">
                    <!-- Contenido del modal se cargará dinámicamente -->
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay de carga -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        // Datos de ejemplo de especialistas
        const specialistsData = [
            {
                id: 1,
                name: "Dra. Sofia Ramirez",
                title: "Psiquiatra Especializada en Ansiedad y Depresión",
                image: "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.9,
                reviews: 127,
                specialties: ["Ansiedad", "Depresión", "Trastornos del Estado de Ánimo"],
                experience: "12 años",
                location: "Bogotá",
                modality: "Presencial y Virtual",
                languages: ["Español", "Inglés"],
                price: "$280.000",
                availability: "available",
                description: "Especialista en terapia cognitivo-conductual para el manejo de ansiedad y depresión. Enfoque integral combinando psicoterapia y farmacoterapia cuando es necesario.",
                education: "MD Psiquiatría - Universidad Nacional de Colombia",
                approach: "Terapia Cognitivo-Conductual, Mindfulness, Psicofarmacología"
            },
            {
                id: 2,
                name: "Dr. Carlos Mendoza",
                title: "Especialista en TDAH y Trastornos del Neurodesarrollo",
                image: "https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.8,
                reviews: 89,
                specialties: ["TDAH", "Trastornos del Neurodesarrollo", "Ansiedad"],
                experience: "8 años",
                location: "Medellín",
                modality: "Virtual",
                languages: ["Español"],
                price: "$250.000",
                availability: "busy",
                description: "Especializado en diagnóstico y tratamiento del TDAH en adultos y adolescentes. Enfoque multimodal que incluye terapia y estrategias de organización.",
                education: "MD Psiquiatría - Universidad de Antioquia",
                approach: "Terapia Conductual, Coaching, Estrategias de Organización"
            },
            {
                id: 3,
                name: "Dra. Elena Torres",
                title: "Neuropsiquiatra - Especialista en Esquizofrenia",
                image: "https://images.unsplash.com/photo-1594824947933-d0501ba2fe65?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.9,
                reviews: 156,
                specialties: ["Esquizofrenia", "Trastornos Psicóticos", "Neuropsiquiatría"],
                experience: "15 años",
                location: "Cali",
                modality: "Presencial",
                languages: ["Español", "Portugués"],
                price: "$320.000",
                availability: "available",
                description: "Neuropsiquiatra con amplia experiencia en el manejo de trastornos psicóticos. Investigadora en tratamientos innovadores para la esquizofrenia.",
                education: "MD Neuropsiquiatría - Universidad del Valle",
                approach: "Terapia Psicoeducativa, Intervenciones Familiares, Psicofarmacología Avanzada"
            },
            {
                id: 4,
                name: "Dr. Andrés López",
                title: "Psiquiatra Especializado en Trastorno Bipolar",
                image: "https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.7,
                reviews: 94,
                specialties: ["Trastorno Bipolar", "Depresión Mayor", "Estabilización del Estado de Ánimo"],
                experience: "10 años",
                location: "Barranquilla",
                modality: "Presencial y Virtual",
                languages: ["Español", "Inglés"],
                price: "$270.000",
                availability: "soon",
                description: "Especialista en el manejo integral del trastorno bipolar. Enfoque en la estabilización del estado de ánimo y prevención de recaídas.",
                education: "MD Psiquiatría - Universidad del Norte",
                approach: "Terapia Interpersonal, Psicoeducación, Manejo Farmacológico Especializado"
            },
            {
                id: 5,
                name: "Dra. María Fernández",
                title: "Especialista en TOC y Trastornos de Ansiedad",
                image: "https://images.unsplash.com/photo-1594824477047-6a5d5c526346?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.9,
                reviews: 112,
                specialties: ["TOC", "Ansiedad", "Trastornos Relacionados con el Estrés"],
                experience: "9 años",
                location: "Bogotá",
                modality: "Virtual",
                languages: ["Español"],
                price: "$260.000",
                availability: "available",
                description: "Especializada en el tratamiento del TOC y trastornos de ansiedad mediante terapia de exposición y prevención de respuesta.",
                education: "MD Psiquiatría - Universidad Javeriana",
                approach: "ERP (Terapia de Exposición y Prevención de Respuesta), ACT, Mindfulness"
            },
            {
                id: 6,
                name: "Dr. Roberto Silva",
                title: "Psiquiatra de Trauma y TEPT",
                image: "https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.8,
                reviews: 76,
                specialties: ["TEPT", "Trastornos de Trauma", "Ansiedad"],
                experience: "7 años",
                location: "Medellín",
                modality: "Presencial",
                languages: ["Español", "Inglés"],
                price: "$240.000",
                availability: "available",
                description: "Especialista en el tratamiento de trauma y TEPT. Terapia enfocada en el procesamiento del trauma y desarrollo de resiliencia.",
                education: "MD Psiquiatría - Universidad CES",
                approach: "EMDR, Terapia Cognitiva Procesal, Somatic Experiencing"
            },
            {
                id: 7,
                name: "Dra. Carolina Rojas",
                title: "Psiquiatra Infantil y del Adolescente",
                image: "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.9,
                reviews: 142,
                specialties: ["Psiquiatría Infantil", "TDAH", "Ansiedad en Niños"],
                experience: "11 años",
                location: "Cali",
                modality: "Presencial y Virtual",
                languages: ["Español"],
                price: "$290.000",
                availability: "busy",
                description: "Especialista en salud mental infantil y adolescente. Enfoque familiar e integral para el desarrollo emocional saludable.",
                education: "MD Psiquiatría Infantil - Universidad del Valle",
                approach: "Terapia Familiar, Terapia de Juego, Intervenciones Escolares"
            },
            {
                id: 8,
                name: "Dr. Javier Morales",
                title: "Especialista en Adicciones y Psiquiatría",
                image: "https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                rating: 4.7,
                reviews: 88,
                specialties: ["Adicciones", "Depresión", "Ansiedad"],
                experience: "13 años",
                location: "Bogotá",
                modality: "Presencial",
                languages: ["Español", "Inglés", "Portugués"],
                price: "$300.000",
                availability: "available",
                description: "Especialista en el tratamiento de adicciones y comorbilidades psiquiátricas. Enfoque integral de rehabilitación y prevención de recaídas.",
                education: "MD Psiquiatría - Universidad Nacional",
                approach: "Terapia Motivacional, Prevención de Recaídas, Intervenciones Grupales"
            }
        ];

        // Variables globales
        let currentPage = 1;
        let itemsPerPage = 6;
        let filteredSpecialists = [...specialistsData];
        let currentSpecialty = 'all';

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            renderSpecialists();
            setupFilters();
            setupPagination();
            setupModal();
        });

        // Renderizar especialistas
        function renderSpecialists() {
            const grid = document.getElementById('specialistsGrid');
            grid.innerHTML = '';
            
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageSpecialists = filteredSpecialists.slice(startIndex, endIndex);
            
            pageSpecialists.forEach((specialist, index) => {
                const card = createSpecialistCard(specialist, index);
                grid.appendChild(card);
            });
            
            updateResultsCount();
            updatePagination();
            
            // Animación escalonada
            const cards = document.querySelectorAll('.specialist-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('visible');
                }, index * 100);
            });
        }

        // Crear tarjeta de especialista
        function createSpecialistCard(specialist, delayIndex) {
            const card = document.createElement('div');
            card.className = 'specialist-card stagger-animation';
            card.style.animationDelay = `${delayIndex * 0.1}s`;
            
            // Mapear disponibilidad a clases CSS
            const availabilityClasses = {
                'available': 'available',
                'busy': 'busy',
                'soon': 'soon'
            };
            
            card.innerHTML = `
                <div class="availability-badge ${availabilityClasses[specialist.availability]}">
                    ${specialist.availability === 'available' ? 'Disponible' : 
                      specialist.availability === 'busy' ? 'Ocupado' : 'Próximamente'}
                </div>
                
                <div class="specialist-image-container">
                    <img src="${specialist.image}" alt="${specialist.name}" class="specialist-image">
                </div>
                
                <div class="specialist-info">
                    <h3 class="specialist-name">${specialist.name}</h3>
                    <p class="specialist-title">${specialist.title}</p>
                    
                    <div class="specialist-rating">
                        <div class="rating-stars">
                            ${'<i class="fas fa-star"></i>'.repeat(Math.floor(specialist.rating))}
                            ${specialist.rating % 1 !== 0 ? '<i class="fas fa-star-half-alt"></i>' : ''}
                        </div>
                        <span class="rating-value">${specialist.rating}</span>
                        <span>(${specialist.reviews} reseñas)</span>
                    </div>
                </div>
                
                <div class="specialist-specialties">
                    ${specialist.specialties.map(spec => 
                        `<span class="specialty-chip">${spec}</span>`
                    ).join('')}
                </div>
                
                <div class="specialist-details">
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>${specialist.location} • ${specialist.modality}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>${specialist.experience} de experiencia</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-language"></i>
                        <span>${specialist.languages.join(', ')}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>${specialist.price} por sesión</span>
                    </div>
                </div>
                
                <div class="specialist-actions">
                    <a href="#" class="btn-profile view-profile" data-id="${specialist.id}">
                        <i class="fas fa-user-md"></i>
                        Ver perfil completo
                    </a>
                    <a href="#" class="btn-contact schedule-appointment" data-id="${specialist.id}">
                        <i class="fas fa-calendar-check"></i>
                        Agendar cita
                    </a>
                </div>
            `;
            
            // Event listeners para los botones
            card.querySelector('.view-profile').addEventListener('click', function(e) {
                e.preventDefault();
                showSpecialistModal(specialist.id);
            });
            
            card.querySelector('.schedule-appointment').addEventListener('click', function(e) {
                e.preventDefault();
                scheduleAppointment(specialist.id);
            });
            
            return card;
        }

        // Configurar filtros
        function setupFilters() {
            // Filtros por especialidad
            document.querySelectorAll('.specialty-tag').forEach(tag => {
                tag.addEventListener('click', function() {
                    // Remover clase active de todos los tags
                    document.querySelectorAll('.specialty-tag').forEach(t => t.classList.remove('active'));
                    
                    // Agregar clase active al tag clickeado
                    this.classList.add('active');
                    
                    // Filtrar especialistas
                    currentSpecialty = this.dataset.specialty;
                    applyFilters();
                });
            });
            
            // Filtros adicionales
            document.querySelectorAll('.filter-select').forEach(select => {
                select.addEventListener('change', applyFilters);
            });
            
            // Búsqueda
            const searchInput = document.querySelector('.search-input');
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });
            
            // Restablecer filtros
            document.getElementById('resetFilters').addEventListener('click', resetFilters);
        }

        // Aplicar filtros
        function applyFilters() {
            showLoading(true);
            
            setTimeout(() => {
                const searchTerm = document.querySelector('.search-input').value.toLowerCase();
                const location = document.getElementById('locationFilter').value;
                const modality = document.getElementById('modalityFilter').value;
                const price = document.getElementById('priceFilter').value;
                const language = document.getElementById('languageFilter').value;
                
                filteredSpecialists = specialistsData.filter(specialist => {
                    // Filtro por especialidad
                    if (currentSpecialty !== 'all') {
                        if (!specialist.specialties.some(s => s.toLowerCase().includes(currentSpecialty))) {
                            return false;
                        }
                    }
                    
                    // Filtro por búsqueda
                    if (searchTerm) {
                        const matchesSearch = 
                            specialist.name.toLowerCase().includes(searchTerm) ||
                            specialist.title.toLowerCase().includes(searchTerm) ||
                            specialist.specialties.some(s => s.toLowerCase().includes(searchTerm)) ||
                            specialist.description.toLowerCase().includes(searchTerm);
                        
                        if (!matchesSearch) return false;
                    }
                    
                    // Filtro por ubicación
                    if (location !== 'all') {
                        if (location === 'virtual') {
                            if (specialist.modality !== 'Virtual' && specialist.modality !== 'Presencial y Virtual') {
                                return false;
                            }
                        } else if (specialist.location.toLowerCase() !== location.toLowerCase()) {
                            return false;
                        }
                    }
                    
                    // Filtro por modalidad
                    if (modality !== 'all') {
                        if (modality === 'presencial' && specialist.modality === 'Virtual') return false;
                        if (modality === 'virtual' && specialist.modality === 'Presencial') return false;
                    }
                    
                    // Filtro por precio
                    if (price !== 'all') {
                        const priceNum = parseInt(specialist.price.replace(/\D/g, ''));
                        if (price === 'low' && priceNum >= 150000) return false;
                        if (price === 'medium' && (priceNum < 150000 || priceNum > 300000)) return false;
                        if (price === 'high' && priceNum <= 300000) return false;
                    }
                    
                    // Filtro por idioma
                    if (language !== 'all') {
                        if (!specialist.languages.some(l => l.toLowerCase() === language)) {
                            return false;
                        }
                    }
                    
                    return true;
                });
                
                currentPage = 1;
                renderSpecialists();
                showLoading(false);
            }, 500);
        }

        // Restablecer filtros
        function resetFilters() {
            document.querySelectorAll('.specialty-tag').forEach(tag => {
                tag.classList.remove('active');
                if (tag.dataset.specialty === 'all') {
                    tag.classList.add('active');
                }
            });
            
            document.querySelectorAll('.filter-select').forEach(select => {
                select.value = 'all';
            });
            
            document.querySelector('.search-input').value = '';
            
            currentSpecialty = 'all';
            applyFilters();
        }

        // Actualizar contador de resultados
        function updateResultsCount() {
            const countElement = document.getElementById('totalResults');
            const total = filteredSpecialists.length;
            const start = (currentPage - 1) * itemsPerPage + 1;
            const end = Math.min(currentPage * itemsPerPage, total);
            
            countElement.textContent = `Mostrando ${start}-${end} de ${total} especialistas`;
        }

        // Configurar paginación
        function setupPagination() {
            document.getElementById('prevPage').addEventListener('click', goToPrevPage);
            document.getElementById('nextPage').addEventListener('click', goToNextPage);
        }

        // Actualizar paginación
        function updatePagination() {
            const totalPages = Math.ceil(filteredSpecialists.length / itemsPerPage);
            const pageNumbers = document.getElementById('pageNumbers');
            const prevButton = document.getElementById('prevPage');
            const nextButton = document.getElementById('nextPage');
            
            // Actualizar botones
            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages || totalPages === 0;
            
            // Actualizar números de página
            pageNumbers.innerHTML = '';
            
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('div');
                pageButton.className = `pagination-number ${i === currentPage ? 'active' : ''}`;
                pageButton.textContent = i;
                pageButton.addEventListener('click', () => goToPage(i));
                pageNumbers.appendChild(pageButton);
            }
        }

        // Navegación de páginas
        function goToPage(page) {
            if (page < 1 || page > Math.ceil(filteredSpecialists.length / itemsPerPage)) return;
            
            currentPage = page;
            renderSpecialists();
            window.scrollTo({ top: document.getElementById('specialistsGrid').offsetTop - 100, behavior: 'smooth' });
        }

        function goToPrevPage() {
            goToPage(currentPage - 1);
        }

        function goToNextPage() {
            goToPage(currentPage + 1);
        }

        // Configurar modal
        function setupModal() {
            const modal = document.getElementById('specialistModal');
            const closeButton = document.getElementById('closeModal');
            
            closeButton.addEventListener('click', () => {
                modal.style.display = 'none';
            });
            
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }

        // Mostrar modal con detalles del especialista
        function showSpecialistModal(specialistId) {
            const specialist = specialistsData.find(s => s.id === specialistId);
            if (!specialist) return;
            
            const modal = document.getElementById('specialistModal');
            const modalContent = document.getElementById('modalContent');
            
            modalContent.innerHTML = `
                <div style="padding: 2rem;">
                    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 2rem; margin-bottom: 2rem;">
                        <div>
                            <img src="${specialist.image}" alt="${specialist.name}" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; border: 4px solid #4db8a8;">
                        </div>
                        <div>
                            <h2 style="font-family: 'Quicksand', sans-serif; color: #2c5f5d; margin-bottom: 0.5rem;">${specialist.name}</h2>
                            <p style="color: #4db8a8; font-weight: 600; margin-bottom: 1rem;">${specialist.title}</p>
                            
                            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                                <div style="background: rgba(77, 184, 168, 0.1); padding: 0.5rem 1rem; border-radius: 15px; color: #4db8a8;">
                                    <i class="fas fa-star"></i> ${specialist.rating} (${specialist.reviews} reseñas)
                                </div>
                                <div style="background: rgba(77, 184, 168, 0.1); padding: 0.5rem 1rem; border-radius: 15px; color: #4db8a8;">
                                    <i class="fas fa-clock"></i> ${specialist.experience}
                                </div>
                            </div>
                            
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                                ${specialist.specialties.map(spec => 
                                    `<span style="background: linear-gradient(135deg, #4db8a8, #5bc4b3); color: white; padding: 0.4rem 1rem; border-radius: 15px; font-size: 0.9rem;">${spec}</span>`
                                ).join('')}
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                        <div style="background: rgba(77, 184, 168, 0.05); padding: 1.5rem; border-radius: 15px;">
                            <h3 style="font-family: 'Quicksand', sans-serif; color: #2c5f5d; margin-bottom: 1rem;">Información de contacto</h3>
                            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                <div style="display: flex; align-items: center; gap: 0.8rem; color: #5a7c7a;">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>${specialist.location}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.8rem; color: #5a7c7a;">
                                    <i class="fas fa-video"></i>
                                    <span>Modalidad: ${specialist.modality}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.8rem; color: #5a7c7a;">
                                    <i class="fas fa-language"></i>
                                    <span>Idiomas: ${specialist.languages.join(', ')}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.8rem; color: #5a7c7a;">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>Precio por sesión: ${specialist.price}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div style="background: rgba(77, 184, 168, 0.05); padding: 1.5rem; border-radius: 15px;">
                            <h3 style="font-family: 'Quicksand', sans-serif; color: #2c5f5d; margin-bottom: 1rem;">Formación</h3>
                            <p style="color: #5a7c7a; line-height: 1.6;">${specialist.education}</p>
                        </div>
                        
                        <div style="background: rgba(77, 184, 168, 0.05); padding: 1.5rem; border-radius: 15px;">
                            <h3 style="font-family: 'Quicksand', sans-serif; color: #2c5f5d; margin-bottom: 1rem;">Enfoque Terapéutico</h3>
                            <p style="color: #5a7c7a; line-height: 1.6;">${specialist.approach}</p>
                        </div>
                    </div>
                    
                    <div style="background: rgba(77, 184, 168, 0.05); padding: 1.5rem; border-radius: 15px; margin-bottom: 2rem;">
                        <h3 style="font-family: 'Quicksand', sans-serif; color: #2c5f5d; margin-bottom: 1rem;">Sobre ${specialist.name.split(' ')[0]}</h3>
                        <p style="color: #5a7c7a; line-height: 1.8;">${specialist.description}</p>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; justify-content: center;">
                        <button id="modalSchedule" style="padding: 1rem 2rem; background: linear-gradient(135deg, #4db8a8, #5bc4b3); color: white; border: none; border-radius: 25px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-calendar-check"></i>
                            Agendar cita con ${specialist.name.split(' ')[0]}
                        </button>
                    </div>
                </div>
            `;
            
            // Event listener para el botón de agendar en el modal
            modalContent.querySelector('#modalSchedule').addEventListener('click', () => {
                scheduleAppointment(specialistId);
                modal.style.display = 'none';
            });
            
            modal.style.display = 'flex';
        }

        // Simular agendamiento de cita
        function scheduleAppointment(specialistId) {
            const specialist = specialistsData.find(s => s.id === specialistId);
            
            showLoading(true);
            
            setTimeout(() => {
                showLoading(false);
                
                // Mostrar mensaje de confirmación
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 30px;
                    background: linear-gradient(135deg, #4db8a8, #5bc4b3);
                    color: white;
                    padding: 1.5rem 2rem;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(77, 184, 168, 0.4);
                    z-index: 4000;
                    animation: slideInRight 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    max-width: 400px;
                `;
                
                notification.innerHTML = `
                    <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>
                    <div>
                        <strong style="display: block; margin-bottom: 0.3rem;">¡Cita agendada!</strong>
                        <span>Te contactaremos pronto para coordinar tu cita con ${specialist.name}.</span>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.animation = 'slideOutRight 0.3s ease forwards';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 4000);
            }, 1500);
        }

        // Mostrar/ocultar loading
        function showLoading(show) {
            const overlay = document.getElementById('loadingOverlay');
            if (show) {
                overlay.classList.add('active');
            } else {
                overlay.classList.remove('active');
            }
        }

        // Animación para notificaciones
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
    </script>
</body>
</html>