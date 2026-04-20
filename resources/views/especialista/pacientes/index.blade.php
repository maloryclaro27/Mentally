@extends('layouts.app')

@section('title', 'Mis Pacientes | Mentally')

@push('styles')
    <style>
        :root {
            --primary: #4db8a8;
            --primary-dark: #2c5f5d;
            --primary-light: #5bc4b3;
            --secondary: #5a7c7a;
            --background: linear-gradient(135deg, #f4fbfc 0%, #eef8f9 100%);
            --card-bg: rgba(255, 255, 255, 0.85);
            --shadow: 0 8px 30px rgba(44, 95, 93, 0.08);
            --shadow-hover: 0 15px 35px rgba(44, 95, 93, 0.14);
        }

        body {
            background: var(--background);
        }

        .page-wrapper {
            max-width: 1400px;
            margin: 100px auto 4rem;
            padding: 0 2rem;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
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

        /* ─── Header ─────────────────────────────────────────────── */
        .page-header {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
            animation: slideInUp 0.6s ease both;
            margin-top: 4rem;
        }

        .page-header h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .page-header p {
            color: var(--secondary);
            margin-top: 0.3rem;
        }

        .stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.25);
            color: var(--primary-dark);
            padding: 0.6rem 1.4rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* ─── Grid de pacientes ───────────────────────────────────── */
        .patients-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.8rem;
            animation: slideInUp 0.7s ease 0.1s both;
        }

        .patient-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            overflow: hidden;
        }

        .patient-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .patient-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .patient-card:hover::before {
            transform: scaleX(1);
        }

        .card-top {
            display: flex;
            align-items: flex-start;
            gap: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: 800;
            color: #fff;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            flex-shrink: 0;
            overflow: hidden;
            position: relative;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .patient-name {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--primary-dark);
        }

        .patient-email {
            font-size: 0.85rem;
            color: var(--secondary);
            margin-top: 0.15rem;
            word-break: break-all;
        }

        .card-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.2rem;
        }

        .risk-label {
            width: 100%;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            color: var(--primary-dark);
            margin-bottom: 0.15rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.9rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-crisis {
            background: rgba(239, 68, 68, 0.14);
            color: #b91c1c;
            border: 1px solid rgba(239, 68, 68, 0.22);
        }

        .badge-ok {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.2);
        }

        .badge-warning {
            background: rgba(255, 152, 0, 0.1);
            color: #ff9800;
            border: 1px solid rgba(255, 152, 0, 0.2);
        }

        .badge-neutral {
            background: rgba(90, 124, 122, 0.1);
            color: var(--secondary);
            border: 1px solid rgba(90, 124, 122, 0.2);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.14);
            color: #b45309;
            border: 1px solid rgba(245, 158, 11, 0.22);
        }

        .badge-critical {
            background: rgba(127, 29, 29, 0.16);
            color: #991b1b;
            border: 1px solid rgba(127, 29, 29, 0.28);
        }

        .risk-reason {
            width: 100%;
            margin-top: 6px;
            font-size: 12px;
            line-height: 1.4;
            color: #64748b;
        }

        .risk-note {
            width: 100%;
            margin-top: 4px;
            font-size: 11px;
            line-height: 1.4;
            color: #94a3b8;
        }

        .adherence-bar-wrap {
            margin-top: 0.8rem;
        }

        .adherence-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--secondary);
            margin-bottom: 0.4rem;
        }

        .progress-track {
            height: 7px;
            background: #eef8f9;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease;
        }

        .fill-green {
            background: #4caf50;
        }

        .fill-orange {
            background: #ff9800;
        }

        .fill-red {
            background: #f44336;
        }

        .card-action {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 1.5rem;
            gap: 0.4rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* ─── Empty state ─────────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--secondary);
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .empty-state i {
            font-size: 4rem;
            opacity: 0.35;
            margin-bottom: 1.2rem;
            display: block;
        }

        .empty-state h3 {
            font-family: 'Quicksand', sans-serif;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }
    </style>
@endpush

@section('content')
    @include('partials.navbar-especialista')

    <div class="page-wrapper">
        <!-- Header -->
        <div class="page-header">
            <div>
                <h1><i class="fas fa-users"></i> Mis Pacientes</h1>
                <p>Selecciona un paciente para ver su expediente clínico completo.</p>
            </div>
            <div class="stat-pill">
                <i class="fas fa-user-check"></i>
                {{ count($pacientes) }} pacientes vinculados
            </div>
        </div>

        <!-- Grid -->
        @if ($pacientes->isEmpty())
            <div class="empty-state">
                <i class="fas fa-user-md"></i>
                <h3>Aún no tienes pacientes vinculados</h3>
                <p>Puedes vincularlos desde el Dashboard con su ID de usuario.</p>
            </div>
        @else
            <div class="patients-grid">
                @foreach ($pacientes as $p)
                    @php
                        $adherencia = $p->adherencia;
                        $fillClass =
                            $adherencia === null
                                ? 'fill-orange'
                                : ($adherencia >= 85
                                    ? 'fill-green'
                                    : ($adherencia >= 60
                                        ? 'fill-orange'
                                        : 'fill-red'));
                    @endphp
                    <a href="{{ route('especialista.pacientes.show', $p->id) }}" class="patient-card">
                        <div class="card-top">
                            <div class="avatar">
                                @if (!empty($p->avatar))
                                    <img src="{{ asset('storage/' . $p->avatar) }}" alt="Foto de {{ $p->name }}">
                                @else
                                    {{ strtoupper(substr($p->name, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <div class="patient-name">{{ $p->name }}</div>
                                <div class="patient-email">{{ $p->email }}</div>
                            </div>
                        </div>

                        <div class="card-badges">
                            <div class="risk-label">Indicador de riesgo de crisis</div>
                            @if (($p->crisis_risk_level ?? 'none') === 'critical')
                                <span class="badge badge-critical"><i class="fas fa-radiation"></i> Riesgo crítico</span>
                            @elseif (($p->crisis_risk_level ?? 'none') === 'high')
                                <span class="badge badge-crisis"><i class="fas fa-exclamation-triangle"></i> Riesgo
                                    alto</span>
                            @elseif (($p->crisis_risk_level ?? 'none') === 'moderate')
                                <span class="badge badge-warning"><i class="fas fa-exclamation-circle"></i> Riesgo
                                    moderado</span>
                            @else
                                <span class="badge badge-ok"><i class="fas fa-check-circle"></i> Sin riesgo de crisis</span>
                            @endif

                            @if (!empty($p->crisis_risk_reasons) && count($p->crisis_risk_reasons))
                                <div class="risk-reason">
                                    {{ $p->crisis_risk_reasons[0] }}
                                </div>
                            @else
                                <div class="risk-reason">
                                    Sin señales recientes de deterioro clínico relevante.
                                </div>
                            @endif

                            <div class="risk-note">
                                Este indicador apoya la priorización clínica. No constituye diagnóstico y requiere
                                validación profesional.
                            </div>

                            @if ($p->total_meds > 0)
                                <span class="badge badge-neutral"><i class="fas fa-pills"></i> {{ $p->total_meds }}
                                    medicamento(s)</span>
                            @endif

                            @if ($p->ultimo_test)
                                <span class="badge badge-neutral">
                                    <i class="fas fa-clipboard-check"></i>
                                    Último test: {{ \Carbon\Carbon::parse($p->ultimo_test->taken_at)->diffForHumans() }}
                                </span>
                            @endif
                        </div>

                        @if ($adherencia !== null)
                            <div class="adherence-bar-wrap">
                                <div class="adherence-label">
                                    <span>Adherencia farmacológica</span>
                                    <strong>{{ $adherencia }}%</strong>
                                </div>
                                <div class="progress-track">
                                    <div class="progress-fill {{ $fillClass }}" style="width: {{ $adherencia }}%;">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="card-action">
                            Ver expediente <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
