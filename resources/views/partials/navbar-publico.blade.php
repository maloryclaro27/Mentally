<nav>
    <div class="logo-section">
        <div class="logo-placeholder">
            <img src="{{ asset('logo_pg.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <span class="brand-name">Mentally</span>
    </div>

    <ul class="nav-links">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>

        <li class="nav-item">
            <a href="#" class="nav-link">Servicios</a>
            <div class="dropdown-menu nav-dropdown">
                <a href="{{ route('login', ['redirect' => '/diario_emocional']) }}" class="dropdown-item">Diario Emocional</a>
                <a href="{{ route('login', ['redirect' => '/chatbot']) }}" class="dropdown-item">Chatbot</a>
            </div>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">Tests</a>
            <div class="dropdown-menu nav-dropdown">
                <a href="{{ route('login', ['redirect' => route('test.bienestar', absolute:false)]) }}" class="dropdown-item">Test de Bienestar</a>
                <a href="{{ route('login', ['redirect' => route('test.depresion', absolute:false)]) }}" class="dropdown-item">Test de Depresión</a>
                <a href="{{ route('login', ['redirect' => route('test.ansiedad', absolute:false)]) }}" class="dropdown-item">Test de Ansiedad</a>
            </div>
        </li>

        <li class="nav-item"><a href="/blog" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="{{ route('login', ['redirect' => '/listado_psiquiatras']) }}" class="nav-link">Especialistas</a></li>
    </ul>

    <div class="auth-buttons">
        <a href="{{ route('login') }}" class="btn btn-login">Iniciar sesión</a>
        <a href="{{ route('registro') }}" class="btn btn-signup">Crear cuenta</a>
    </div>
</nav>
