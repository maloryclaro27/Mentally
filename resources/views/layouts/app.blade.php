<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mentally')</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/test-modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>

<body>
    {{-- Navbar condicional según el rol del usuario --}}

    @auth
        @php
            $isEspecialista = auth()->user()->role === 'especialista';

            $isEspecialistaVerificado = false;
            if ($isEspecialista) {
                $esp = \App\Models\Especialista::where('user_id', auth()->id())->first();
                $isEspecialistaVerificado = $esp ? (bool) $esp->is_verified : false;
            }
        @endphp

        @if ($isEspecialista && $isEspecialistaVerificado)
            @include('partials.navbar-especialista')
        @elseif ($isEspecialista && !$isEspecialistaVerificado)
            @include('partials.navbar-publico')
        @else
            @include('partials.navbar') {{-- paciente logueado normal --}}
        @endif
    @else
        @include('partials.navbar-publico')
    @endauth



    <main>
        @yield('content')
    </main>

    @php
        $isAuth = auth()->check();
        $role = $isAuth ? auth()->user()->role : null;

        $isEspecialista = $role === 'especialista';
        $isEspecialistaVerificado = false;

        if ($isAuth && $isEspecialista) {
            $esp = \App\Models\Especialista::where('user_id', auth()->id())->first();
            $isEspecialistaVerificado = $esp ? (bool) $esp->is_verified : false;
        }

        // “modo público” si es especialista no verificado
        $uiAuthenticated = $isAuth && !($isEspecialista && !$isEspecialistaVerificado);
    @endphp

    <script>
        window.MENTALLY_AUTH = {
            isAuthenticated: @json($uiAuthenticated),
            loginUrl: @json(route('login')),
            userRole: @json($uiAuthenticated ? $role : null)
        };
    </script>

    @stack('scripts')

    <!-- Modal bloqueo de test -->
    <div id="testCooldownModal" class="test-modal-overlay" style="display:none;">
        <div class="test-modal">
            <div class="test-modal-icon">
                <i class="fas fa-lock"></i>
            </div>

            <h3 class="test-modal-title">Test no disponible aún</h3>

            <p class="test-modal-text" id="testModalMessage"></p>

            <button class="test-modal-button" id="closeTestModal">
                Entendido
            </button>
        </div>
    </div>
    <script src="{{ secure_asset('js/navbar.js') }}"></script>
    <script src="{{ secure_asset('js/test-availability-guard.js') }}"></script>
</body>

</html>
