@extends('layouts.app')

@section('title', 'Dashboard - Especialista | Mentally')

@push('styles')
    <style>
        :root {
            --primary: #4db8a8;
            --primary-dark: #2c5f5d;
            --primary-light: #5bc4b3;
            --secondary: #5a7c7a;
            --background: linear-gradient(135deg, #f0f9f8 0%, #e6f4f7 50%, #f2f9f8 100%);
            --card-bg: rgba(255, 255, 255, 0.96);
            --shadow: 0 10px 30px rgba(77, 184, 168, 0.10);
            --shadow-hover: 0 20px 40px rgba(77, 184, 168, 0.15);
            --border-soft: 1px solid rgba(77, 184, 168, 0.12);
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

        .specialist-dashboard {
            max-width: 1440px;
            margin: 110px auto 3rem;
            padding: 0 1.5rem 3rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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

        .dashboard-card,
        .welcome-header,
        .priority-section,
        .notes-section,
        .calendar-section,
        .reports-section,
        .chart-card,
        .alert-card,
        .metric-card {
            background: var(--card-bg);
            border-radius: 22px;
            border: var(--border-soft);
            box-shadow: var(--shadow);
        }

        .welcome-header,
        .priority-section,
        .notes-section,
        .calendar-section,
        .reports-section {
            padding: 2rem;
            animation: slideInUp 0.7s ease;
        }

        .welcome-header {
            margin-top: 2rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(246, 252, 251, 0.98));
        }

        .welcome-title {
            font-family: 'Quicksand', sans-serif;
            font-size: clamp(1.8rem, 2.6vw, 2.4rem);
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: .5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            line-height: 1.2;
        }

        .welcome-title i {
            color: var(--primary);
            animation: pulse 3s infinite;
        }

        .welcome-subtitle {
            color: var(--secondary);
            font-size: 1.02rem;
            margin-bottom: 1.25rem;
            max-width: 900px;
            line-height: 1.65;
        }

        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            background: rgba(77, 184, 168, 0.10);
            padding: .7rem 1.3rem;
            border-radius: 999px;
            color: var(--primary);
            font-weight: 600;
            border: 1px solid rgba(77, 184, 168, 0.18);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .section-title i {
            color: var(--primary);
        }

        .view-all-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .25s ease;
        }

        .view-all-link:hover {
            color: var(--primary-dark);
            gap: .75rem;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .metric-card {
            padding: 1.4rem;
            position: relative;
            overflow: hidden;
            transition: all .3s ease;
        }

        .metric-card::before {
            content: "";
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s ease;
        }

        .metric-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .metric-card:hover::before {
            transform: scaleX(1);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .metric-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(77, 184, 168, .10), rgba(91, 196, 179, .18));
            color: var(--primary);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .metric-value {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .metric-label {
            color: var(--secondary);
            font-size: .95rem;
        }

        .metric-change {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .28rem .8rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            margin-top: .8rem;
        }

        .change-positive {
            background: rgba(76, 175, 80, 0.10);
            color: #3d9f44;
        }

        .change-negative {
            background: rgba(244, 67, 54, 0.10);
            color: #d94135;
        }

        .link-patient-card {
            padding: 1.5rem;
        }

        .link-patient-form {
            display: flex;
            gap: 1rem;
            align-items: end;
            flex-wrap: wrap;
        }

        .link-patient-form .field-grow {
            min-width: 240px;
            flex: 1;
        }

        .priority-list {
            display: grid;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .priority-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem;
            background: rgba(255, 255, 255, .72);
            border-radius: 18px;
            border-left: 4px solid transparent;
            transition: all .28s ease;
            flex-wrap: wrap;
        }

        .priority-item:hover {
            background: white;
            transform: translateX(4px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .05);
        }

        .priority-item.severe {
            border-left-color: #f44336;
        }

        .priority-item.moderate {
            border-left-color: #ff9800;
        }

        .priority-avatar,
        .alert-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            flex-shrink: 0;
        }

        .priority-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
        }

        .priority-info {
            flex: 1;
            min-width: 240px;
        }

        .priority-name {
            display: flex;
            align-items: center;
            gap: .6rem;
            flex-wrap: wrap;
            color: var(--primary-dark);
            font-weight: 700;
            margin-bottom: .35rem;
        }

        .priority-badge {
            padding: .25rem .75rem;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 700;
            background: rgba(244, 67, 54, 0.10);
            color: #f44336;
        }

        .priority-details {
            display: flex;
            flex-wrap: wrap;
            gap: .9rem 1.2rem;
            color: var(--secondary);
            font-size: .92rem;
            line-height: 1.5;
        }

        .priority-details span {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .priority-actions {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .priority-btn,
        .report-btn {
            border: none;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            transition: all .25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            text-decoration: none;
        }

        .priority-btn {
            padding: .75rem 1.15rem;
            font-size: .85rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(77, 184, 168, .25);
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

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .chart-card {
            padding: 1.5rem;
            min-width: 0;
            transition: all .28s ease;
        }

        .chart-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
        }

        .chart-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: .55rem;
        }

        .chart-period {
            background: rgba(77, 184, 168, .10);
            color: var(--primary);
            padding: .35rem .9rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .chart-container {
            height: 320px;
            position: relative;
        }

        .alerts-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
        }

        .alert-card {
            padding: 1.5rem;
            transition: all .28s ease;
            min-width: 0;
        }

        .alert-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .alert-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .alert-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .alert-icon.danger {
            background: linear-gradient(135deg, rgba(244, 67, 54, .10), rgba(244, 67, 54, .18));
            color: #f44336;
        }

        .alert-icon.success {
            background: linear-gradient(135deg, rgba(76, 175, 80, .10), rgba(76, 175, 80, .18));
            color: #4caf50;
        }

        .alert-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .alert-count {
            font-size: .85rem;
            color: var(--secondary);
            margin-top: .2rem;
        }

        .alert-list {
            display: grid;
            gap: .9rem;
        }

        .alert-item {
            display: flex;
            align-items: flex-start;
            gap: .9rem;
            padding: 1rem;
            background: rgba(255, 255, 255, .72);
            border-radius: 14px;
            transition: all .25s ease;
        }

        .alert-item:hover {
            background: #fff;
            transform: translateX(4px);
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
            width: 42px;
            height: 42px;
            border-radius: 50%;
            font-size: .9rem;
        }

        .alert-info {
            flex: 1;
            min-width: 0;
        }

        .alert-name {
            color: var(--primary-dark);
            font-weight: 700;
            margin-bottom: .2rem;
        }

        .alert-message {
            color: var(--secondary);
            font-size: .88rem;
            line-height: 1.5;
        }

        .alert-time {
            margin-top: .3rem;
            font-size: .76rem;
            color: rgba(90, 124, 122, .68);
        }

        .notes-container,
        .report-generator {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(320px, 430px);
            gap: 1.5rem;
            align-items: start;
        }

        .notes-list {
            max-height: 480px;
            overflow-y: auto;
            padding-right: .4rem;
        }

        .notes-list::-webkit-scrollbar {
            width: 6px;
        }

        .notes-list::-webkit-scrollbar-thumb {
            background: rgba(77, 184, 168, .35);
            border-radius: 999px;
        }

        .note-item,
        .note-form,
        .report-options,
        .report-preview {
            background: white;
            border-radius: 18px;
            border: 1px solid rgba(77, 184, 168, .10);
        }

        .note-item {
            padding: 1.35rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .02);
            transition: all .25s ease;
        }

        .note-item:hover {
            transform: translateX(4px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, .05);
            border-left: 4px solid var(--primary);
        }

        .note-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: .75rem;
            margin-bottom: .8rem;
            flex-wrap: wrap;
        }

        .note-patient {
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .note-date {
            font-size: .82rem;
            color: var(--secondary);
        }

        .note-content {
            color: var(--secondary);
            font-size: .94rem;
            line-height: 1.7;
            margin-bottom: .8rem;
        }

        .note-author {
            font-size: .82rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: .5rem;
            font-weight: 600;
        }

        .note-form,
        .report-options,
        .report-preview {
            padding: 1.5rem;
            box-shadow: 0 8px 22px rgba(0, 0, 0, .03);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: .55rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: .9rem 1rem;
            border: 2px solid rgba(77, 184, 168, .18);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: .95rem;
            color: var(--primary-dark);
            background: #fff;
            transition: all .25s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(77, 184, 168, .10);
        }

        .form-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: .85rem;
        }

        .calendar-month {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            min-width: 150px;
            text-align: center;
        }

        .calendar-nav-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid rgba(77, 184, 168, .18);
            background: transparent;
            color: var(--primary);
            cursor: pointer;
            transition: all .25s ease;
        }

        .calendar-nav-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.06);
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: .5rem;
            text-align: center;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: .8rem;
            padding: .8rem;
            background: rgba(77, 184, 168, .06);
            border-radius: 14px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: .55rem;
        }

        .calendar-day {
            min-height: 64px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 14px;
            border: 2px solid rgba(77, 184, 168, .12);
            cursor: pointer;
            transition: all .25s ease;
            position: relative;
        }

        .calendar-day:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            z-index: 2;
        }

        .calendar-day.empty {
            background: transparent;
            border: none;
            cursor: default;
            pointer-events: none;
            min-height: 64px;
        }

        .calendar-day.has-event {
            background: rgba(77, 184, 168, .05);
            border-color: rgba(77, 184, 168, .28);
        }

        .calendar-day-number {
            font-weight: 700;
            color: var(--primary-dark);
        }

        .calendar-day-indicator {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-top: .35rem;
            background: var(--primary);
        }

        .calendar-day.missed .calendar-day-indicator {
            background: #f44336;
        }

        .calendar-day.completed .calendar-day-indicator {
            background: #4caf50;
        }

        .calendar-day.partial .calendar-day-indicator {
            background: #ff9800;
        }

        .calendar-legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem 1.5rem;
            margin-top: 1.5rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: .55rem;
            font-size: .9rem;
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

        .report-preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(77, 184, 168, .08);
        }

        .report-preview-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: 22px;
            border: 1px solid rgba(77, 184, 168, 0.12);
            box-shadow: var(--shadow);
        }

        .link-patient-card {
            padding: 1.5rem;
        }

        .link-patient-form {
            display: flex;
            gap: 1rem;
            align-items: end;
            flex-wrap: wrap;
        }

        .link-patient-form .field-grow {
            min-width: 240px;
            flex: 1;
        }

        .report-actions {
            display: flex;
            gap: .75rem;
        }

        .report-btn {
            padding: .78rem 1.2rem;
        }

        .btn-generate {
            width: 100%;
            margin-top: .5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }

        .btn-generate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(77, 184, 168, .28);
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
            background: #1f4b48;
        }

        .report-preview-body {
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 16px;
        }

        .report-summary-grid {
            display: grid;
            gap: 1rem;
        }

        .report-summary-box {
            background: white;
            padding: 1rem;
            border-radius: 12px;
        }

        @media (max-width: 1200px) {

            .metrics-grid,
            .charts-grid,
            .alerts-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .notes-container,
            .report-generator {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .specialist-dashboard {
                padding: 0 1rem 2rem;
                gap: 1.5rem;
            }

            .metrics-grid,
            .charts-grid,
            .alerts-grid {
                grid-template-columns: 1fr;
            }

            .calendar-grid,
            .calendar-weekdays {
                gap: .35rem;
            }
        }

        @media (max-width: 768px) {

            .welcome-header,
            .priority-section,
            .notes-section,
            .calendar-section,
            .reports-section {
                padding: 1.4rem;
            }

            .welcome-title {
                font-size: 1.7rem;
                gap: .75rem;
            }

            .priority-item {
                align-items: flex-start;
            }

            .priority-actions {
                width: 100%;
            }

            .priority-actions .priority-btn {
                width: 100%;
            }

            .calendar-month {
                min-width: auto;
            }
        }

        @media (max-width: 540px) {

            .metric-header,
            .calendar-header,
            .report-preview-header,
            .section-header {
                align-items: flex-start;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
            }

            .calendar-day {
                min-height: 54px;
            }

            .calendar-day-number {
                font-size: .82rem;
            }

            .calendar-legend {
                flex-direction: column;
                align-items: flex-start;
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

        @if (session('success'))
            <div style="background:#d1fae5; color:#065f46; padding:10px 14px; border-radius:12px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#fee2e2; color:#991b1b; padding:10px 14px; border-radius:12px; margin-bottom:20px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="dashboard-card link-patient-card">
            <h3 style="font-family:'Quicksand',sans-serif;color:var(--primary-dark);margin-bottom:1rem;">
                <i class="fas fa-link" style="color: var(--primary);"></i>
                Vincular paciente manualmente
            </h3>

            <form method="POST" action="{{ route('especialista.pacientes.vincular') }}" class="link-patient-form">
                @csrf

                <div class="field-grow">
                    <label for="paciente_id" class="form-label">ID del paciente</label>
                    <input type="number" name="paciente_id" id="paciente_id" class="form-input" required
                        placeholder="Ej: 15">
                </div>

                <div>
                    <button type="submit" class="priority-btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Vincular paciente
                    </button>
                </div>
            </form>
        </div>

        <!-- Panel de métricas clave -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="metric-value">{{ $totalPacientes ?? 0 }}</div>
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
                    <div class="metric-value">{{ $alertasActivas ?? 0 }}</div>
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
                    <div class="metric-value">{{ $prescripcionesActivas ?? 0 }}</div>
                </div>
                <div class="metric-label">Prescripciones Activas</div>
                <div class="metric-change change-positive">
                    <i class="fas fa-check-circle"></i>
                    {{ $adherenciaGlobal ?? 0 }}% adherencia
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="metric-value">{{ $testsEsteMes ?? 0 }}</div>
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
                @forelse($pacientesPrioritarios as $paciente)
                    <div class="priority-item {{ $paciente->nivel_alerta === 'alto' ? 'severe' : 'moderate' }}">
                        <div class="priority-avatar">
                            {{ strtoupper(substr($paciente->name, 0, 1)) }}
                        </div>

                        <div class="priority-info">
                            <div class="priority-name">
                                {{ $paciente->name }}

                                @if ($paciente->nivel_alerta === 'alto')
                                    <span class="priority-badge">Riesgo alto</span>
                                @else
                                    <span class="priority-badge" style="background: rgba(255,152,0,0.1); color:#ff9800;">
                                        Atención prioritaria
                                    </span>
                                @endif
                            </div>

                            <div class="priority-details">
                                <span><i class="fas fa-exclamation-circle"></i> {{ $paciente->motivo_alerta }}</span>
                                <span><i class="fas fa-user"></i> ID: {{ $paciente->id }}</span>
                                <span><i class="fas fa-envelope"></i> {{ $paciente->email }}</span>
                            </div>
                        </div>

                        <div class="priority-actions">
                            <a href="{{ route('especialista.pacientes.chequeos', $paciente->id) }}"
                                class="priority-btn btn-primary">
                                <i class="fas fa-eye"></i>
                                Ver
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="priority-item">
                        <div class="priority-info">
                            <div class="priority-name">No hay pacientes con alertas activas</div>
                            <div class="priority-details">
                                <span><i class="fas fa-check-circle"></i> No se detectaron pacientes prioritarios por
                                    ahora</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Gráficos de evolución -->
            <div class="charts-grid">
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
        </div> {{-- CIERRE REAL de .priority-section --}}

        <!-- Sistema de alertas tempranas -->
        <div class="alerts-grid">
            <div class="alert-card">
                <div class="alert-header">
                    <div class="alert-icon danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h3 class="alert-title">Alertas de Deterioro</h3>
                        <div class="alert-count">{{ count($alertasDeterioro ?? []) }} pacientes requieren atención</div>
                    </div>
                </div>

                <div class="alert-list">
                    @forelse($alertasDeterioro as $alerta)
                        <div class="alert-item {{ $alerta->tipo }}">
                            <div class="alert-avatar">
                                {{ strtoupper(substr($alerta->paciente->name, 0, 1)) }}
                            </div>
                            <div class="alert-info">
                                <div class="alert-name">{{ $alerta->paciente->name }}</div>
                                <div class="alert-message">{{ $alerta->mensaje }} — {{ $alerta->detalle }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="alert-item info">
                            <div class="alert-avatar">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="alert-info">
                                <div class="alert-name">Sin alertas de deterioro</div>
                                <div class="alert-message">
                                    No se detectaron empeoramientos clínicos significativos por ahora.
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="alert-card">
                <div class="alert-header">
                    <div class="alert-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h3 class="alert-title">Alertas de Adherencia</h3>
                        <div class="alert-count">{{ count($alertasAdherencia ?? []) }} pacientes con baja adherencia</div>
                    </div>
                </div>

                <div class="alert-list">
                    @forelse($alertasAdherencia as $alerta)
                        <div class="alert-item {{ $alerta->tipo }}"
                            style="justify-content: space-between; align-items: center;">
                            <div style="display:flex; align-items:flex-start; gap:.9rem; flex:1; min-width:0;">
                                <div class="alert-avatar">
                                    {{ strtoupper(substr($alerta->paciente->name ?? 'P', 0, 1)) }}
                                </div>

                                <div class="alert-info">
                                    <div class="alert-name">{{ $alerta->paciente->name ?? 'Paciente' }}</div>
                                    <div class="alert-message">{{ $alerta->mensaje }}</div>
                                    <div class="alert-time" style="color:#ff9800; font-weight:600;">
                                        {{ $alerta->detalle }}
                                    </div>
                                </div>
                            </div>

                            @if (!empty($alerta->paciente?->id))
                                <a href="{{ route('especialista.pacientes.chequeos', $alerta->paciente->id) }}"
                                    class="priority-btn btn-outline"
                                    style="padding:.55rem .95rem; font-size:.8rem; white-space:nowrap;">
                                    <i class="fas fa-eye"></i>
                                    Ver
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="alert-item info">
                            <div class="alert-avatar">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="alert-info">
                                <div class="alert-name">Sin alertas de adherencia</div>
                                <div class="alert-message">
                                    No se detectaron pacientes con baja adherencia por ahora.
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sistema de notas clínicas -->
        <div class="notes-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-notes-medical"></i>
                    Notas Clínicas
                </h2>
            </div>

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
                    <h3 style="font-family:'Quicksand',sans-serif;color:var(--primary-dark);margin-bottom:1.5rem;">
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

            <div class="calendar-grid" id="calendarGrid"></div>

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
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-file-pdf"></i>
                    Generador de Informes
                </h2>
            </div>

            <div class="report-generator">
                <div class="report-options">
                    <h3 style="font-family:'Quicksand',sans-serif;color:var(--primary-dark);margin-bottom:1.5rem;">
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
                        <div style="display:flex;flex-direction:column;gap:.65rem;margin-top:.65rem;">
                            <label style="display:flex;align-items:center;gap:.55rem;">
                                <input type="checkbox" checked> Resultados de tests
                            </label>
                            <label style="display:flex;align-items:center;gap:.55rem;">
                                <input type="checkbox" checked> Registro de adherencia
                            </label>
                            <label style="display:flex;align-items:center;gap:.55rem;">
                                <input type="checkbox" checked> Notas clínicas
                            </label>
                            <label style="display:flex;align-items:center;gap:.55rem;">
                                <input type="checkbox"> Diario emocional (resumen)
                            </label>
                            <label style="display:flex;align-items:center;gap:.55rem;">
                                <input type="checkbox"> Gráficos de evolución
                            </label>
                        </div>
                    </div>

                    <button class="report-btn btn-generate" onclick="generateReport(event)">
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

                    <div class="report-preview-body">
                        <div style="text-align:center; margin-bottom:1.5rem;">
                            <h2 style="font-family:'Quicksand',sans-serif;color:var(--primary-dark);">Mentally</h2>
                            <h3 style="color:var(--primary);margin:.5rem 0;">Informe de Evolución Clínica</h3>
                            <p style="color:var(--secondary);">
                                Paciente: María González | Periodo: 15/01/2024 - 15/02/2024
                            </p>
                        </div>

                        <div class="report-summary-grid">
                            <div>
                                <h4 style="color:var(--primary-dark);margin-bottom:.5rem;">Resumen de Tests</h4>
                                <div class="report-summary-box">
                                    <p>PHQ-9: 22 → 12 (mejoría del 45%)</p>
                                    <p>GAD-7: 18 → 10 (mejoría del 44%)</p>
                                    <p>Adherencia: 40% → 78% (incremento del 95%)</p>
                                </div>
                            </div>

                            <div>
                                <h4 style="color:var(--primary-dark);margin-bottom:.5rem;">Notas Clínicas</h4>
                                <div class="report-summary-box">
                                    <p><strong>15/02/2024</strong> - Ajuste de dosis: Sertralina de 50mg a 100mg...</p>
                                    <p><strong>01/02/2024</strong> - Paciente reporta mejoría en calidad de sueño...</p>
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
                        labels: {!! json_encode($chartLabels ?? []) !!},
                        datasets: [{
                            label: 'PHQ-9 (Promedio)',
                            data: {!! json_encode($phq9Data ?? []) !!},
                            spanGaps: true,
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
                        labels: {!! json_encode($chartLabels ?? []) !!},
                        datasets: [{
                            label: 'GAD-7 (Promedio)',
                            data: {!! json_encode($gad7Data ?? []) !!},
                            spanGaps: true,
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
                const daysInMonth = 29;

                let html = '';

                for (let i = 0; i < 3; i++) {
                    html += '<div class="calendar-day empty"></div>';
                }

                for (let day = 1; day <= daysInMonth; day++) {
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

            function generateReport(event) {
                const btn = event.currentTarget;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando...';
                btn.disabled = true;

                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-file-pdf"></i> Generar Informe';
                    btn.disabled = false;
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
