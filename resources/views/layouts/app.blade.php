<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mentally')</title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>

<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    <script>
        window.MENTALLY_AUTH = {
            isAuthenticated: @json(auth()->check()),
            loginUrl: @json(route('login')),
        };
    </script>

    <script src="{{ asset('js/navbar.js') }}"></script>

    @stack('scripts')
</body>
</html>
