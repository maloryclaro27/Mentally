<nav>
    <div class="logo-section">
            <div class="logo-placeholder">
                <!-- Espacio para el logo en miniatura -->
                <img src="{{ asset('logo_pg.png') }}" alt="Logo"
                    style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <span class="brand-name">Mentally</span>
        </div>

        <ul class="nav-links">
            <li class="nav-item">
                <a href="#" class="nav-link">Servicios</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item require-auth" data-url="/diario_emocional">Diario Emocional</a>
                    <a class="dropdown-item require-auth" data-url="/chatbot">Chatbot: Habla con Cereon 🧠</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Tests</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item require-auth" data-url="/test_depresion">Test de Depresión</a>
                    <a class="dropdown-item require-auth" data-url="/test_ansiedad">Test de Ansiedad</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Blog</a>
                <div class="dropdown-menu">
                    <a href="/blog" class="dropdown-item">Artículos</a>
                    <a href="/blog/postear" class="dropdown-item">Postea tu Historia</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link require-auth" data-url="/listado_psiquiatras">Directorio de especialistas</a>
            </li>
        </ul>


    {{-- DERECHA: guest -> botones / auth -> perfil --}}
    @guest
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn btn-login">Iniciar sesión</a>
            <a href="{{ route('registro') }}" class="btn btn-signup">Crear cuenta</a>
        </div>
    @endguest

    @auth
        <div class="user-profile">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
            </div>

            <div class="user-info">
                <div class="user-name">
                    {{ auth()->user()->name ?? 'Usuario' }}
                </div>
                <div class="user-role">
                    {{ auth()->user()->role ?? 'Paciente' }}
                </div>
            </div>

            <div class="dropdown-menu">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    Mi Perfil
                </a>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    Configuración
                </a>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-question-circle"></i>
                    Ayuda
                </a>

                {{-- Logout recomendado con POST --}}
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
