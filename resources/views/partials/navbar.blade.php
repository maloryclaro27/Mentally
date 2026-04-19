<nav>
    <div class="logo-section">
        <div class="logo-placeholder">
            <img src="{{ asset('logo_pg.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <span class="brand-name">Mentally</span>
    </div>

    <ul class="nav-links">
        @auth
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">Inicio</a>
            </li>
        @endauth

        <li class="nav-item">
            <a href="#" class="nav-link">Servicios</a>
            <div class="dropdown-menu nav-dropdown services-dropdown">
                <a href="#" class="dropdown-item require-auth" data-url="/chequeos">
                    Mis chequeos
                </a>
                <a href="{{ route('diario.emocional') }}" class="dropdown-item require-auth"
                    data-url="/diario_emocional">Diario Emocional</a>
                <a href="#" class="dropdown-item require-auth" data-url="/chatbot">
                    Chatbot: Habla con Cereon 🧠
                </a>
                <a href="#" class="dropdown-item require-auth" data-url="/adherencia">
                    Recordatorios
                </a>
                <div class="dropdown-submenu">
                    <a href="#" class="dropdown-item dropdown-toggle">Blog</a>
                    <div class="dropdown-menu">
                        <a href="/blog" class="dropdown-item">Artículos</a>
                        <a href="/blog/postear" class="dropdown-item">Postea tu Historia</a>
                    </div>
                </div>
            </div>
        </li>

        @php
            $testAvailability = $testAvailability ?? [
                'bienestar' => ['available' => true, 'next_date' => null, 'remaining_days' => 0],
                'depresion' => ['available' => true, 'next_date' => null, 'remaining_days' => 0],
                'ansiedad' => ['available' => true, 'next_date' => null, 'remaining_days' => 0],
            ];
        @endphp


        <li class="nav-item">
            <a href="#" class="nav-link">Tests</a>
            <div class="dropdown-menu nav-dropdown">

                <a href="{{ route('test.bienestar') }}" class="dropdown-item require-auth" data-test-link="1"
                    data-test-type="bienestar"
                    data-available="{{ data_get($testAvailability ?? [], 'bienestar.available', true) ? 1 : 0 }}"
                    data-next-date="{{ data_get($testAvailability ?? [], 'bienestar.next_date', '') }}"
                    data-remaining-days="{{ data_get($testAvailability ?? [], 'bienestar.remaining_days', 0) }}">
                    Test de Bienestar
                </a>

                <a href="{{ route('test.depresion') }}" class="dropdown-item require-auth" data-test-link="1"
                    data-test-type="depresion"
                    data-available="{{ data_get($testAvailability ?? [], 'depresion.available', true) ? 1 : 0 }}"
                    data-next-date="{{ data_get($testAvailability ?? [], 'depresion.next_date', '') }}"
                    data-remaining-days="{{ data_get($testAvailability ?? [], 'depresion.remaining_days', 0) }}">
                    Test de Depresión
                </a>

                <a href="{{ route('test.ansiedad') }}" class="dropdown-item require-auth" data-test-link="1"
                    data-test-type="ansiedad" data-available="{{ $testAvailability['ansiedad']['available'] ? 1 : 0 }}"
                    data-available="{{ data_get($testAvailability ?? [], 'ansiedad.available', true) ? 1 : 0 }}"
                    data-next-date="{{ data_get($testAvailability ?? [], 'ansiedad.next_date', '') }}"
                    data-remaining-days="{{ data_get($testAvailability ?? [], 'ansiedad.remaining_days', 0) }}">
                    Test de Ansiedad
                </a>

            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link require-auth" data-url="/listado_psiquiatras">
                Especialistas
            </a>
        </li>

        @auth
            <li class="nav-item">
                <a href="{{ route('dashboard.paciente') }}" class="nav-link">Mi proceso🌻</a>
            </li>
        @endauth
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
                @if (auth()->user()->avatar)
                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar"
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                @else
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                @endif
            </div>

            <div class="user-info">
                @php
                    $firstName = auth()->user()->first_name ?? '';
                    $lastName = auth()->user()->last_name ?? '';

                    $lastNameParts = explode(' ', trim($lastName));
                    $lastNameParts = array_values(array_filter($lastNameParts)); // limpia espacios dobles

                    if (count($lastNameParts) === 3) {
                        $shortLastName = $lastNameParts[1]; // segunda palabra
                    } elseif (count($lastNameParts) === 2) {
                        $shortLastName = $lastNameParts[0]; // primera palabra
                    } else {
                        $shortLastName = $lastNameParts[0] ?? '';
                    }
                @endphp
                <div class="user-name">
                    {{ trim($firstName . ' ' . $shortLastName) ?: auth()->user()->name ?? 'Usuario' }}
                </div>
                <div class="user-role">
                    {{ auth()->user()->role ?? 'Paciente' }}
                </div>
            </div>

            <div class="dropdown-menu user-dropdown">
                <a href="{{ route('profile.show') }}" class="dropdown-item">
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

                <a href="{{ route('auth0.logout') }}" class="dropdown-item dropdown-button">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar Sesión
                </a>
            </div>
        </div>
    @endauth
</nav>
