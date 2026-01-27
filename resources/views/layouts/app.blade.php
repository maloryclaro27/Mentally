<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mentally')</title>

    {{-- Fuentes --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- ===================== --}}
    {{-- ESTILOS DEL NAVBAR --}}
    {{-- ===================== --}}
    <style>
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #128674d5;
            letter-spacing: 0.5px;
        }

        /* LINKS */
        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            align-items: center;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: #2c5f5d;
            cursor: pointer;
            text-decoration: none;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #4db8a8;
        }

        /* DROPDOWNS */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            min-width: 200px;
            padding: 1rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
            z-index: 1000;
        }

        .nav-item:hover .dropdown-menu,
        .user-profile:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            padding: 0.8rem 1.5rem;
            color: #2c5f5d;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.1));
            color: #4db8a8;
            padding-left: 2rem;
        }

        /* BOTONES AUTH */
        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-login,
        .btn-signup {
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
        }

        .btn-login {
            color: #4db8a8;
            border: 2px solid #4db8a8;
        }

        .btn-login:hover {
            background: #4db8a8;
            color: white;
        }

        .btn-signup {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
        }

        /* PERFIL USUARIO */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            cursor: pointer;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.4);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #2c5f5d;
        }

        .user-role {
            font-size: 0.9rem;
            color: #5a7c7a;
        }

        /* ESPACIO PARA NAV FIXED */
        main {
            margin-top: 110px;
        }
    </style>

    {{-- CSS adicional por vista --}}
    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- CONTENIDO --}}
    <main>
        @yield('content')
    </main>

    {{-- JS adicional por vista --}}
    @stack('scripts')

</body>
</html>
