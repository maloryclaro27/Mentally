@extends('layouts.app')

@section('title', 'Dashboard - Especialista | Mentally')

@push('styles')
    <style>
        /* Variables y estilos base */
        :root {
            --primary: #4db8a8;
            --primary-dark: #2c5f5d;
            --primary-light: #5bc4b3;
            --secondary: #5a7c7a;
            --background: linear-gradient(135deg, #f0f9f8 0%, #e6f4f7 50%, #f2f9f8 100%);
            --card-bg: rgba(255, 255, 255, 0.95);
            --shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
            --shadow-hover: 0 20px 40px rgba(77, 184, 168, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Contenedor principal */
        .specialist-dashboard {
            max-width: 1400px;
            margin: 100px auto 2rem;
            padding: 0 2rem;
        }

        /* Animaciones */
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .welcome-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 251, 0.98));
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            margin-top: 8rem;
            /* ← NUEVA LÍNEA: separa del navbar */
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease;
        }

        .welcome-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .welcome-title i {
            color: var(--primary);
            animation: pulse 3s infinite;
        }

        .welcome-subtitle {
            color: var(--secondary);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .date-badge {
            display: inline-block;
            background: rgba(77, 184, 168, 0.1);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            color: var(--primary);
            font-weight: 500;
            border: 1px solid rgba(77, 184, 168, 0.2);
        }

        /* Panel de métricas clave */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            animation: slideInUp 0.8s ease 0.1s backwards;
        }

        .metric-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .metric-card:hover::before {
            transform: scaleX(1);
        }

        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .metric-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.3rem;
        }

        .metric-value {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .metric-label {
            color: var(--secondary);
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }

        .metric-change {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .change-positive {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
        }

        .change-negative {
            background: rgba(244, 67, 54, 0.1);
            color: #f44336;
        }

        /* Panel de pacientes prioritarios */
        .priority-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease 0.2s backwards;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .section-title i {
            color: var(--primary);
        }

        .view-all-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .view-all-link:hover {
            gap: 0.8rem;
            color: var(--primary-dark);
        }

        .priority-list {
            display: grid;
            gap: 1rem;
        }

        .priority-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.2rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .priority-item:hover {
            background: white;
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .priority-item.severe {
            border-left-color: #f44336;
        }

        .priority-item.moderate {
            border-left-color: #ff9800;
        }

        .priority-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .priority-info {
            flex: 1;
        }

        .priority-name {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .priority-badge {
            background: rgba(244, 67, 54, 0.1);
            color: #f44336;
            padding: 0.2rem 0.8rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .priority-details {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
            color: var(--secondary);
        }

        .priority-details span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .priority-actions {
            display: flex;
            gap: 0.8rem;
        }

        .priority-btn {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Grid de gráficos */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
            animation: slideInUp 0.8s ease 0.3s backwards;
        }

        .chart-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
        }

        .chart-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-period {
            background: rgba(77, 184, 168, 0.1);
            padding: 0.3rem 1rem;
            border-radius: 15px;
            font-size: 0.8rem;
            color: var(--primary);
        }

        .chart-container {
            height: 300px;
            position: relative;
        }


        /* Alertas tempranas */
        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            animation: slideInUp 0.8s ease 0.5s backwards;
        }

        .alert-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
        }

        .alert-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .alert-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.1), rgba(244, 67, 54, 0.2));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f44336;
            font-size: 1.3rem;
        }

        .alert-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .alert-count {
            font-size: 0.8rem;
            color: var(--secondary);
            margin-top: 0.2rem;
        }

        .alert-list {
            display: grid;
            gap: 1rem;
        }

        .alert-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .alert-item:hover {
            background: white;
            transform: translateX(5px);
        }

        .alert-item.warning {
            border-left: 4px solid #ff9800;
        }

        .alert-item.critical {
            border-left: 4px solid #f44336;
        }

        .alert-item.info {
            border-left: 4px solid #2196f3;
        }

        .alert-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .alert-info {
            flex: 1;
        }

        .alert-name {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.2rem;
        }

        .alert-message {
            font-size: 0.85rem;
            color: var(--secondary);
        }

        .alert-time {
            font-size: 0.75rem;
            color: rgba(90, 124, 122, 0.6);
        }

        /* Notas clínicas */
        .notes-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease 0.6s backwards;
        }

        .notes-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .notes-list {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 1rem;
        }

        .notes-list::-webkit-scrollbar {
            width: 4px;
        }

        .notes-list::-webkit-scrollbar-track {
            background: rgba(77, 184, 168, 0.1);
            border-radius: 2px;
        }

        .notes-list::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 2px;
        }

        .note-item {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.3s ease;
        }

        .note-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--primary);
        }

        .note-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .note-patient {
            font-weight: 600;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .note-date {
            font-size: 0.8rem;
            color: var(--secondary);
        }

        .note-content {
            color: var(--secondary);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 0.8rem;
        }

        .note-author {
            font-size: 0.8rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .note-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: var(--primary-dark);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: var(--primary-dark);
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(77, 184, 168, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Calendario de seguimiento */
        .calendar-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease 0.7s backwards;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .calendar-nav {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .calendar-month {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .calendar-nav-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: transparent;
            border: 2px solid rgba(77, 184, 168, 0.2);
            color: var(--primary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .calendar-nav-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: rgba(77, 184, 168, 0.05);
            border-radius: 10px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 10px;
            border: 2px solid rgba(77, 184, 168, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .calendar-day:hover {
            border-color: var(--primary);
            transform: scale(1.05);
            z-index: 2;
        }

        .calendar-day.has-event {
            background: rgba(77, 184, 168, 0.05);
            border-color: var(--primary);
        }

        .calendar-day-number {
            font-weight: 600;
            color: var(--primary-dark);
        }

        .calendar-day-indicator {
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            margin-top: 2px;
        }

        .calendar-day.missed .calendar-day-indicator {
            background: #f44336;
        }

        .calendar-day.completed .calendar-day-indicator {
            background: #4caf50;
        }

        .calendar-legend {
            display: flex;
            gap: 2rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--secondary);
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .legend-color.missed {
            background: #f44336;
        }

        .legend-color.completed {
            background: #4caf50;
        }

        .legend-color.partial {
            background: #ff9800;
        }

        /* Reportes y generador */
        .reports-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease 0.8s backwards;
        }

        .report-generator {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }

        .report-options {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
        }

        .report-preview {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
        }

        .report-preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(77, 184, 168, 0.1);
        }

        .report-preview-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .report-actions {
            display: flex;
            gap: 1rem;
        }

        .report-btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-generate {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
        }

        .btn-generate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.3);
        }

        .btn-download {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-download:hover {
            background: var(--primary);
            color: white;
        }

        .btn-print {
            background: var(--primary-dark);
            color: white;
        }

        .btn-print:hover {
            background: #1e4a47;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .specialist-dashboard {
                padding: 0 1.5rem;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .notes-container {
                grid-template-columns: 1fr;
            }

            .report-generator {
                grid-template-columns: 1fr;
            }

            .timeline-item {
                flex-direction: column !important;
                gap: 1rem;
            }

            .timeline-content {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .specialist-dashboard {
                margin-top: 80px;
                padding: 0 1rem;
            }

            .welcome-title {
                font-size: 1.8rem;
            }

            .metrics-grid {
                grid-template-columns: 1fr 1fr;
            }

            .priority-item {
                flex-direction: column;
                text-align: center;
            }

            .priority-details {
                flex-direction: column;
                gap: 0.5rem;
            }

            .priority-actions {
                width: 100%;
            }

            .calendar-grid {
                gap: 0.2rem;
            }

            .calendar-day-number {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .metrics-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .calendar-weekdays {
                font-size: 0.8rem;
            }

            .calendar-legend {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="specialist-dashboard">
        <!-- Header de bienvenida -->
        <div class="welcome-header">
            <h1 class="welcome-title">
                <i class="fas fa-brain"></i>
                Panel Clínico, Dr. {{ auth()->user()->name ?? 'Especialista' }}
            </h1>
            <p class="welcome-subtitle">
                Monitorea la evolución de tus pacientes, ajusta tratamientos y toma decisiones basadas en datos.
            </p>
            <div class="date-badge">
                <i class="fas fa-calendar-alt"></i>
                <span id="currentDate"></span>
            </div>
        </div>

        <!-- Panel de métricas clave -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="metric-value">42</div>
                </div>
                <div class="metric-label">Pacientes Activos</div>
                <div class="metric-change change-positive">
                    <i class="fas fa-arrow-up"></i>
                    +3 esta semana
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="metric-value">8</div>
                </div>
                <div class="metric-label">Alertas Activas</div>
                <div class="metric-change change-negative">
                    <i class="fas fa-arrow-up"></i>
                    +2 desde ayer
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon">
                        <i class="fas fa-pills"></i>
                    </div>
                    <div class="metric-value">23</div>
                </div>
                <div class="metric-label">Prescripciones Activas</div>
                <div class="metric-change change-positive">
                    <i class="fas fa-check-circle"></i>
                    76% adherencia
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="metric-value">15</div>
                </div>
                <div class="metric-label">Tests este mes</div>
                <div class="metric-change change-positive">
                    <i class="fas fa-chart-line"></i>
                    +5 vs mes anterior
                </div>
            </div>
        </div>

        <!-- Panel de pacientes prioritarios -->
        <div class="priority-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-circle"></i>
                    Pacientes que requieren atención prioritaria
                </h2>
                <a href="#" class="view-all-link">
                    Ver todos los pacientes
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="priority-list">
                <div class="priority-item severe">
                    <div class="priority-avatar">MG</div>
                    <div class="priority-info">
                        <div class="priority-name">
                            María González
                            <span class="priority-badge">Riesgo alto</span>
                        </div>
                        <div class="priority-details">
                            <span><i class="fas fa-chart-line"></i> PHQ-9: 22 (Grave)</span>
                            <span><i class="fas fa-clock"></i> Último test: Hoy</span>
                            <span><i class="fas fa-pills"></i> Adherencia: 40%</span>
                        </div>
                    </div>
                    <div class="priority-actions">
                        <button class="priority-btn btn-primary" onclick="showPatientDetails(1)">
                            <i class="fas fa-eye"></i>
                            Ver
                        </button>
                        <button class="priority-btn btn-outline" onclick="contactPatient(1)">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </div>
                </div>

                <div class="priority-item moderate">
                    <div class="priority-avatar">CR</div>
                    <div class="priority-info">
                        <div class="priority-name">
                            Carlos Rodríguez
                            <span class="priority-badge" style="background: rgba(255,152,0,0.1); color:#ff9800;">Riesgo
                                moderado</span>
                        </div>
                        <div class="priority-details">
                            <span><i class="fas fa-chart-line"></i> GAD-7: 18 (Severo)</span>
                            <span><i class="fas fa-clock"></i> Sin registro: 3 días</span>
                            <span><i class="fas fa-pills"></i> Adherencia: 65%</span>
                        </div>
                    </div>
                    <div class="priority-actions">
                        <button class="priority-btn btn-primary" onclick="showPatientDetails(2)">
                            <i class="fas fa-eye"></i>
                            Ver
                        </button>
                        <button class="priority-btn btn-outline" onclick="contactPatient(2)">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </div>
                </div>

                <div class="priority-item moderate">
                    <div class="priority-avatar">LM</div>
                    <div class="priority-info">
                        <div class="priority-name">
                            Laura Mendoza
                            <span class="priority-badge"
                                style="background: rgba(33,150,243,0.1); color:#2196f3;">Seguimiento</span>
                        </div>
                        <div class="priority-details">
                            <span><i class="fas fa-chart-line"></i> PSS: 25 (Alto estrés)</span>
                            <span><i class="fas fa-clock"></i> Último registro: Ayer</span>
                            <span><i class="fas fa-pills"></i> Adherencia: 82%</span>
                        </div>
                    </div>
                    <div class="priority-actions">
                        <button class="priority-btn btn-primary" onclick="showPatientDetails(3)">
                            <i class="fas fa-eye"></i>
                            Ver
                        </button>
                        <button class="priority-btn btn-outline" onclick="contactPatient(3)">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos de evolución -->
        <div class="charts-grid">
            <!-- Gráfico PHQ-9 -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="fas fa-chart-line"></i>
                        Evolución PHQ-9 (Depresión)
                    </h3>
                    <span class="chart-period">Últimos 30 días</span>
                </div>
                <div class="chart-container">
                    <canvas id="phq9Chart"></canvas>
                </div>
            </div>

            <!-- Gráfico GAD-7 -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="fas fa-chart-line"></i>
                        Evolución GAD-7 (Ansiedad)
                    </h3>
                    <span class="chart-period">Últimos 30 días</span>
                </div>
                <div class="chart-container">
                    <canvas id="gad7Chart"></canvas>
                </div>
            </div>
        </div>

        
        <!-- Sistema de alertas tempranas -->
        <div class="alerts-grid">
            <div class="alert-card">
                <div class="alert-header">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h3 class="alert-title">Alertas de Deterioro</h3>
                        <div class="alert-count">3 pacientes requieren atención</div>
                    </div>
                </div>
                <div class="alert-list">
                    <div class="alert-item critical">
                        <div class="alert-avatar">MG</div>
                        <div class="alert-info">
                            <div class="alert-name">María González</div>
                            <div class="alert-message">Empeoramiento rápido: PHQ-9 aumentó 8 puntos en 7 días</div>
                            <div class="alert-time">Hace 2 horas</div>
                        </div>
                    </div>
                    <div class="alert-item warning">
                        <div class="alert-avatar">CR</div>
                        <div class="alert-info">
                            <div class="alert-name">Carlos Rodríguez</div>
                            <div class="alert-message">3 días sin registrar medicación</div>
                            <div class="alert-time">Hace 5 horas</div>
                        </div>
                    </div>
                    <div class="alert-item info">
                        <div class="alert-avatar">LM</div>
                        <div class="alert-info">
                            <div class="alert-name">Laura Mendoza</div>
                            <div class="alert-message">Patrón de insomnio detectado en diario emocional</div>
                            <div class="alert-time">Ayer</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert-card">
                <div class="alert-header">
                    <div class="alert-icon"
                        style="background: linear-gradient(135deg, rgba(76,175,80,0.1), rgba(76,175,80,0.2)); color:#4caf50;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h3 class="alert-title">Alertas de Adherencia</h3>
                        <div class="alert-count">8 pacientes con baja adherencia</div>
                    </div>
                </div>
                <div class="alert-list">
                    <div class="alert-item warning">
                        <div class="alert-avatar">JP</div>
                        <div class="alert-info">
                            <div class="alert-name">Juan Pérez</div>
                            <div class="alert-message">Adherencia: 45% - Riesgo de abandono</div>
                            <div class="alert-time">Hace 1 día</div>
                        </div>
                    </div>
                    <div class="alert-item warning">
                        <div class="alert-avatar">AS</div>
                        <div class="alert-info">
                            <div class="alert-name">Ana Sánchez</div>
                            <div class="alert-message">Adherencia: 52% - 5 dosis perdidas esta semana</div>
                            <div class="alert-time">Hace 2 días</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sistema de notas clínicas -->
        <div class="notes-section">
            <h2 class="section-title">
                <i class="fas fa-notes-medical"></i>
                Notas Clínicas
            </h2>

            <div class="notes-container">
                <div class="notes-list">
                    <div class="note-item">
                        <div class="note-header">
                            <span class="note-patient">
                                <i class="fas fa-user-circle"></i>
                                María González
                            </span>
                            <span class="note-date">15/02/2024</span>
                        </div>
                        <div class="note-content">
                            Ajuste de dosis: Sertralina de 50mg a 100mg. Paciente reporta mejoría en estado de ánimo y
                            disminución de pensamientos intrusivos.
                        </div>
                        <div class="note-author">
                            <i class="fas fa-stethoscope"></i>
                            Dra. Ana López - Psiquiatra
                        </div>
                    </div>

                    <div class="note-item">
                        <div class="note-header">
                            <span class="note-patient">
                                <i class="fas fa-user-circle"></i>
                                Carlos Rodríguez
                            </span>
                            <span class="note-date">12/02/2024</span>
                        </div>
                        <div class="note-content">
                            Paciente refiere aumento de ansiedad en situaciones sociales. Se recomienda terapia
                            cognitivo-conductual y se ajusta horario de medicación.
                        </div>
                        <div class="note-author">
                            <i class="fas fa-stethoscope"></i>
                            Dra. Ana López - Psiquiatra
                        </div>
                    </div>

                    <div class="note-item">
                        <div class="note-header">
                            <span class="note-patient">
                                <i class="fas fa-user-circle"></i>
                                Laura Mendoza
                            </span>
                            <span class="note-date">10/02/2024</span>
                        </div>
                        <div class="note-content">
                            Buen progreso en adherencia. Reporta mejor calidad de sueño. Continuar con plan actual y próximo
                            control en 3 semanas.
                        </div>
                        <div class="note-author">
                            <i class="fas fa-stethoscope"></i>
                            Dra. Ana López - Psiquiatra
                        </div>
                    </div>
                </div>

                <div class="note-form">
                    <h3 style="font-family: 'Quicksand', sans-serif; color: var(--primary-dark); margin-bottom: 1.5rem;">
                        <i class="fas fa-plus-circle" style="color: var(--primary);"></i>
                        Nueva Nota Clínica
                    </h3>

                    <div class="form-group">
                        <label class="form-label">Paciente</label>
                        <select class="form-select">
                            <option value="">Seleccionar paciente...</option>
                            <option value="1">María González</option>
                            <option value="2">Carlos Rodríguez</option>
                            <option value="3">Laura Mendoza</option>
                            <option value="4">Juan Pérez</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tipo de nota</label>
                        <select class="form-select">
                            <option value="seguimiento">Seguimiento</option>
                            <option value="ajuste">Ajuste de medicación</option>
                            <option value="observacion">Observación</option>
                            <option value="derivacion">Derivación</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nota clínica</label>
                        <textarea class="form-textarea" placeholder="Escribe tus observaciones clínicas..."></textarea>
                    </div>

                    <button class="priority-btn btn-primary" style="width: 100%;">
                        <i class="fas fa-save"></i>
                        Guardar Nota
                    </button>
                </div>
            </div>
        </div>

        <!-- Calendario de seguimiento -->
        <div class="calendar-section">
            <div class="calendar-header">
                <h2 class="section-title">
                    <i class="fas fa-calendar-alt"></i>
                    Calendario de Seguimiento
                </h2>
                <div class="calendar-nav">
                    <button class="calendar-nav-btn" onclick="previousMonth()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="calendar-month" id="currentMonth">Febrero 2024</span>
                    <button class="calendar-nav-btn" onclick="nextMonth()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="calendar-weekdays">
                <div>Lun</div>
                <div>Mar</div>
                <div>Mié</div>
                <div>Jue</div>
                <div>Vie</div>
                <div>Sáb</div>
                <div>Dom</div>
            </div>

            <div class="calendar-grid" id="calendarGrid">
                <!-- Se generará con JavaScript -->
            </div>

            <div class="calendar-legend">
                <div class="legend-item">
                    <span class="legend-color completed"></span>
                    <span>Todos los registros completados</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color partial"></span>
                    <span>Registros parciales</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color missed"></span>
                    <span>Sin registros</span>
                </div>
            </div>
        </div>

        <!-- Generador de informes -->
        <div class="reports-section">
            <h2 class="section-title">
                <i class="fas fa-file-pdf"></i>
                Generador de Informes
            </h2>

            <div class="report-generator">
                <div class="report-options">
                    <h3 style="font-family: 'Quicksand', sans-serif; color: var(--primary-dark); margin-bottom: 1.5rem;">
                        Configurar Informe
                    </h3>

                    <div class="form-group">
                        <label class="form-label">Paciente</label>
                        <select class="form-select">
                            <option value="">Seleccionar paciente...</option>
                            <option value="1">María González</option>
                            <option value="2">Carlos Rodríguez</option>
                            <option value="3">Laura Mendoza</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Periodo</label>
                        <select class="form-select">
                            <option value="7">Últimos 7 días</option>
                            <option value="30">Últimos 30 días</option>
                            <option value="90">Últimos 3 meses</option>
                            <option value="180">Últimos 6 meses</option>
                            <option value="custom">Personalizado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Incluir:</label>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.5rem;">
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" checked> Resultados de tests
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" checked> Registro de adherencia
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" checked> Notas clínicas
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox"> Diario emocional (resumen)
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox"> Gráficos de evolución
                            </label>
                        </div>
                    </div>

                    <button class="report-btn btn-generate" onclick="generateReport()">
                        <i class="fas fa-file-pdf"></i>
                        Generar Informe
                    </button>
                </div>

                <div class="report-preview">
                    <div class="report-preview-header">
                        <h3 class="report-preview-title">Vista Previa del Informe</h3>
                        <div class="report-actions">
                            <button class="report-btn btn-download">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="report-btn btn-print">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </div>

                    <div style="padding: 2rem; background: #f8fafc; border-radius: 10px;">
                        <div style="text-align: center; margin-bottom: 2rem;">
                            <h2 style="font-family: 'Quicksand', sans-serif; color: var(--primary-dark);">Mentally</h2>
                            <h3 style="color: var(--primary); margin: 0.5rem 0;">Informe de Evolución Clínica</h3>
                            <p style="color: var(--secondary);">Paciente: María González | Periodo: 15/01/2024 - 15/02/2024
                            </p>
                        </div>

                        <div style="display: grid; gap: 1.5rem;">
                            <div>
                                <h4 style="color: var(--primary-dark); margin-bottom: 0.5rem;">Resumen de Tests</h4>
                                <div style="background: white; padding: 1rem; border-radius: 10px;">
                                    <p>PHQ-9: 22 → 12 (mejoría del 45%)</p>
                                    <p>GAD-7: 18 → 10 (mejoría del 44%)</p>
                                    <p>Adherencia: 40% → 78% (incremento del 95%)</p>
                                </div>
                            </div>

                            <div>
                                <h4 style="color: var(--primary-dark); margin-bottom: 0.5rem;">Notas Clínicas</h4>
                                <div style="background: white; padding: 1rem; border-radius: 10px;">
                                    <p><strong>15/02/2024</strong> - Ajuste de dosis: Sertralina de 50mg a 100mg...</p>
                                    <p><strong>01/02/2024</strong> - Paciente reporta mejoría en calidad de sueño...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fecha actual
            const dateElement = document.getElementById('currentDate');
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            dateElement.textContent = now.toLocaleDateString('es-ES', options);

            // Inicializar gráficos
            initCharts();

            // Inicializar calendario
            initCalendar();

            // Configurar interacciones
            setupInteractions();
        });

        function initCharts() {
            // Gráfico PHQ-9
            const ctx1 = document.getElementById('phq9Chart').getContext('2d');
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Hoy'],
                    datasets: [{
                        label: 'PHQ-9',
                        data: [22, 19, 15, 12, 10],
                        borderColor: '#4db8a8',
                        backgroundColor: 'rgba(77, 184, 168, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4db8a8',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 27,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Gráfico GAD-7
            const ctx2 = document.getElementById('gad7Chart').getContext('2d');
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Hoy'],
                    datasets: [{
                        label: 'GAD-7',
                        data: [18, 16, 14, 12, 10],
                        borderColor: '#ff9800',
                        backgroundColor: 'rgba(255, 152, 0, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ff9800',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 21,
                            ticks: {
                                stepSize: 3
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        function initCalendar() {
            const calendarGrid = document.getElementById('calendarGrid');
            const daysInMonth = 29; // Febrero 2024 (año bisiesto)

            let html = '';
            // Días vacíos al inicio (Febrero 2024 comienza jueves = 3 días vacíos)
            for (let i = 0; i < 3; i++) {
                html += '<div class="calendar-day" style="opacity: 0.3; cursor: default;"></div>';
            }

            // Días del mes
            for (let day = 1; day <= daysInMonth; day++) {
                const status = Math.random(); // Simulación - en producción vendría de BD
                let statusClass = '';
                if (day < 10) statusClass = 'completed';
                else if (day < 20) statusClass = 'partial';
                else statusClass = 'missed';

                html += `
                <div class="calendar-day has-event ${statusClass}" onclick="showDayDetails(${day})">
                    <span class="calendar-day-number">${day}</span>
                    <div class="calendar-day-indicator"></div>
                </div>
            `;
            }

            calendarGrid.innerHTML = html;
        }

        function showPatientDetails(patientId) {
            // Implementar vista detalle del paciente
            console.log('Mostrar detalles del paciente:', patientId);
        }

        function contactPatient(patientId) {
            // Implementar contacto con paciente
            console.log('Contactar paciente:', patientId);
        }

        function previousMonth() {
            // Implementar navegación meses
            console.log('Mes anterior');
        }

        function nextMonth() {
            // Implementar navegación meses
            console.log('Mes siguiente');
        }

        function showDayDetails(day) {
            console.log('Mostrar detalles del día:', day);
        }

        function generateReport() {
            const btn = event.target.closest('button');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-file-pdf"></i> Generar Informe';
                btn.disabled = false;

                // Simular descarga
                showNotification('Informe generado exitosamente', 'success');
            }, 2000);
        }

        function setupInteractions() {
            // Efectos hover para priority items
            document.querySelectorAll('.priority-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (!e.target.closest('button')) {
                        this.style.transform = 'scale(0.99)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 200);
                    }
                });
            });

            // Sistema de notificaciones
            window.showNotification = function(message, type) {
                const notification = document.createElement('div');
                notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 30px;
                background: ${type === 'success' ? 'linear-gradient(135deg, #4db8a8, #5bc4b3)' : '#f44336'};
                color: white;
                padding: 1rem 2rem;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                z-index: 9999;
                animation: slideInRight 0.3s ease;
            `;
                notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span style="margin-left: 0.5rem;">${message}</span>
            `;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOutRight 0.3s ease forwards';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            };
        }

        // Estilos adicionales para animaciones
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
@endsection
