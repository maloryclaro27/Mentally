@extends('layouts.app')

@section('title', 'Análisis de Adherencia - Especialista | Mentally')

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
            --shadow-hover: 0 15px 35px rgba(44, 95, 93, 0.12);
        }

        body {
            background: var(--background);
        }

        .specialist-dashboard {
            max-width: 1400px;
            margin: 100px auto 4rem;
            padding: 0 2rem;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        .header-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: slideInUp 0.8s ease;
        }

        .header-title {
            color: var(--primary-dark);
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-subtitle {
            color: var(--secondary);
            font-size: 1.1rem;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            animation: slideInUp 0.8s ease 0.1s backwards;
        }

        .kpi-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .kpi-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary);
        }

        .kpi-icon.warning {
            color: #ff9800;
            background: linear-gradient(135deg, rgba(255, 152, 0, 0.1), rgba(255, 152, 0, 0.2));
        }

        .kpi-icon.danger {
            color: #f44336;
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.1), rgba(244, 67, 54, 0.2));
        }

        .kpi-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .kpi-label {
            color: var(--secondary);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2.5rem;
            animation: slideInUp 0.8s ease 0.2s backwards;
        }

        .chart-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .chart-card h3 {
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            font-family: 'Quicksand', sans-serif;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .patients-list-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: slideInUp 0.8s ease 0.3s backwards;
        }

        .patient-row {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border-radius: 15px;
            background: white;
            margin-bottom: 1rem;
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .patient-row:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .patient-avatar {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(77, 184, 168, 0.2);
        }

        .patient-info {
            flex: 1;
        }

        .patient-name {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .progress-wrapper {
            width: 100%;
            height: 8px;
            background: #eef8f9;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-bar {
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease-out;
        }

        .bg-optimo { background: #4caf50; }
        .bg-regular { background: #ff9800; }
        .bg-peligro { background: #f44336; }

        .text-optimo { color: #4caf50; }
        .text-regular { color: #ff9800; }
        .text-peligro { color: #f44336; }

        .badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .badge-optimo { background: rgba(76, 175, 80, 0.1); color: #4caf50; }
        .badge-regular { background: rgba(255, 152, 0, 0.1); color: #ff9800; }
        .badge-peligro { background: rgba(244, 67, 54, 0.1); color: #f44336; }

        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    @include('partials.navbar-especialista')

    <div class="specialist-dashboard">
        <!-- Header -->
        <div class="header-card">
            <h1 class="header-title">
                <i class="fas fa-chart-pie"></i>
                Análisis Estadístico de Adherencia
            </h1>
            <p class="header-subtitle">
                Monitoreo consolidado del cumplimiento farmacológico de tus pacientes durante los últimos 30 días.
            </p>
        </div>

        <!-- KPIs -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-icon {{ $adherenciaGlobal < 60 ? 'danger' : ($adherenciaGlobal < 85 ? 'warning' : '') }}">
                    <i class="fas fa-pills"></i>
                </div>
                <div>
                    <div class="kpi-value">{{ $adherenciaGlobal }}%</div>
                    <div class="kpi-label">Adherencia Global (Últimos 30 días)</div>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="kpi-value">{{ count($pacientesData) }}</div>
                    <div class="kpi-label">Pacientes en Seguimiento</div>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-icon {{ $estadoCount['peligro'] > 0 ? 'danger' : 'warning' }}">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <div class="kpi-value">{{ $estadoCount['peligro'] }}</div>
                    <div class="kpi-label">Pacientes en Peligro (< 60%)</div>
                </div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="charts-grid">
            <div class="chart-card">
                <h3><i class="fas fa-chart-line"></i> Tendencia de Adherencia (Últimos 14 días)</h3>
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3><i class="fas fa-chart-pie"></i> Distribución de Pacientes</h3>
                <div class="chart-container">
                    <canvas id="distributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Lista Individual -->
        <div class="patients-list-card">
            <h3 style="color: var(--primary-dark); font-family: 'Quicksand', sans-serif; margin-bottom: 2rem;">
                <i class="fas fa-list-ul"></i> Seguimiento Individual
            </h3>

            @forelse($pacientesData as $paciente)
                <div class="patient-row">
                    <div class="patient-avatar">
                        {{ strtoupper(substr($paciente->name, 0, 1)) }}
                    </div>
                    
                    <div class="patient-info">
                        <div class="patient-name">{{ $paciente->name }}</div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: var(--secondary); margin-bottom: 0.2rem;">
                            <span>Nivel de cumplimiento</span>
                            <span class="text-{{ $paciente->estado }}" style="font-weight: 700;">{{ $paciente->adherencia }}%</span>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress-bar bg-{{ $paciente->estado }}" style="width: {{ $paciente->adherencia }}%;"></div>
                        </div>
                    </div>

                    <div style="text-align: right; min-width: 150px;">
                        <span class="badge badge-{{ $paciente->estado }}">
                            {{ ucfirst($paciente->estado) }}
                        </span>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem; color: var(--secondary);">
                    <i class="fas fa-user-md" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aún no hay pacientes vinculados para mostrar estadísticas.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trend Chart (Line)
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            const trendGradient = trendCtx.createLinearGradient(0, 0, 0, 400);
            trendGradient.addColorStop(0, 'rgba(77, 184, 168, 0.4)');
            trendGradient.addColorStop(1, 'rgba(77, 184, 168, 0.0)');

            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($trendLabels) !!},
                    datasets: [{
                        label: 'Adherencia (%)',
                        data: {!! json_encode($trendData) !!},
                        borderColor: '#4db8a8',
                        backgroundColor: trendGradient,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4db8a8',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: { stepSize: 20 }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#2c5f5d',
                            bodyColor: '#5a7c7a',
                            borderColor: 'rgba(77, 184, 168, 0.2)',
                            borderWidth: 1,
                            padding: 10,
                            boxPadding: 4,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.parsed.y + '% de tomas';
                                }
                            }
                        }
                    }
                }
            });

            // Distribution Chart (Doughnut)
            const distCtx = document.getElementById('distributionChart').getContext('2d');
            new Chart(distCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Óptimo (>85%)', 'Regular (60-84%)', 'Peligro (<60%)'],
                    datasets: [{
                        data: [
                            {{ $estadoCount['optimo'] }}, 
                            {{ $estadoCount['regular'] }}, 
                            {{ $estadoCount['peligro'] }}
                        ],
                        backgroundColor: [
                            '#4caf50',
                            '#ff9800',
                            '#f44336'
                        ],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: { family: "'Poppins', sans-serif", size: 12 },
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
