<nav class="specialist-nav">
    <div class="logo-section">
        <div class="logo-placeholder">
            <img src="{{ asset('logo_pg.png') }}" alt="Logo Mentally" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <span class="brand-name">Mentally</span>
        <span class="specialist-badge">Especialistas</span>
    </div>

    <ul class="nav-links">
        <li class="nav-item">
            <a href="{{ route('especialista.dashboard') }}"
                class="nav-link {{ request()->routeIs('especialista.dashboard') ? 'active' : '' }}">
                Vista General
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('especialista.pacientes.index') }}"
                class="nav-link {{ request()->routeIs('especialista.pacientes.*') ? 'active' : '' }}">
                Mis Pacientes
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                Seguimiento Farmacológico
            </a>
            <div class="dropdown-menu nav-dropdown">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-prescription"></i>
                    Prescripciones Activas
                </a>
                <a href="{{ route('especialista.adherencia') }}" class="dropdown-item {{ request()->routeIs('especialista.adherencia') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i>
                    Análisis de Adherencia
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-exclamation-triangle"></i>
                    Alertas de Medicación
                    <span class="dropdown-badge">5</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-history"></i>
                    Historial de Ajustes
                </a>
            </div>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                Reportes
            </a>
            <div class="dropdown-menu nav-dropdown">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-chart-bar"></i>
                    Reportes Clínicos
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-download"></i>
                    Generar Informe
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-calendar-alt"></i>
                    Reportes por Periodo
                </a>
            </div>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                Recursos
            </a>
            <div class="dropdown-menu nav-dropdown">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-graduation-cap"></i>
                    Guías Clínicas
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-newspaper"></i>
                    Artículos Científicos
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-hand-holding-heart"></i>
                    Material para Pacientes
                </a>
            </div>
        </li>
    </ul>

    @auth
        <div class="user-profile specialist-profile">
            <div class="user-avatar specialist-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'DR', 0, 2)) }}
            </div>

            <div class="user-info">
                <div class="user-name">
                    {{ auth()->user()->name ?? 'Dr. Especialista' }}
                </div>
                <div class="user-role specialist-role">
                    <i class="fas fa-star"></i>
                    Psiquiatra
                </div>
            </div>

            <div class="dropdown-menu user-dropdown">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-id-card"></i>
                    Mi Perfil Profesional
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-calendar-check"></i>
                    Mi Agenda
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    Configuración
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-question-circle"></i>
                    Ayuda y Soporte
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item dropdown-button">
                        <i class="fas fa-sign-out-alt"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    @endauth
</nav>

<style>
    /* Estilos específicos para navbar de especialista */
    .specialist-badge {
        background: rgba(77, 184, 168, 0.1);
        color: #4db8a8;
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 0.5rem;
        border: 1px solid rgba(77, 184, 168, 0.3);
    }

    .nav-link.active {
        color: #4db8a8;
    }

    .nav-link.active::after {
        width: 100%;
    }

    .nav-badge {
        background: #4db8a8;
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 12px;
        font-size: 0.7rem;
        margin-left: 0.5rem;
    }

    .dropdown-badge {
        background: rgba(244, 67, 54, 0.9);
        color: white;
        padding: 0.1rem 0.4rem;
        border-radius: 10px;
        font-size: 0.7rem;
        margin-left: 0.5rem;
    }

    .specialist-avatar {
        background: linear-gradient(135deg, #4db8a8, #5bc4b3);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .specialist-role {
        color: #5a7c7a;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    .specialist-role i {
        font-size: 0.8rem;
        color: #4db8a8;
    }

    .dropdown-divider {
        height: 1px;
        background: rgba(77, 184, 168, 0.2);
        margin: 0.5rem 0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .specialist-badge {
            display: none;
        }
    }
</style>
