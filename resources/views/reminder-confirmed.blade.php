<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentally | Toma confirmada</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #4db8a8;
            --primary-dark: #2c5f5d;
            --primary-light: #8bd3c7;
            --primary-soft: #dff5f1;
            --secondary: #7c6ee6;
            --accent: #ffd166;
            --success: #22c55e;
            --success-soft: #dcfce7;
            --text: #244240;
            --text-soft: #5f7d7b;
            --white: #ffffff;
            --shadow-lg: 0 24px 60px rgba(77, 184, 168, 0.18);
            --shadow-md: 0 12px 30px rgba(77, 184, 168, 0.12);
            --border-soft: rgba(255, 255, 255, 0.45);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(139, 211, 199, 0.45), transparent 32%),
                radial-gradient(circle at bottom right, rgba(124, 110, 230, 0.18), transparent 28%),
                linear-gradient(135deg, #ecfbf8 0%, #e8f7f4 45%, #f5fbff 100%);
            overflow-x: hidden;
            position: relative;
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 18px;
            position: relative;
            isolation: isolate;
        }

        .bg-orb {
            position: absolute;
            border-radius: 999px;
            filter: blur(8px);
            opacity: 0.55;
            z-index: -1;
            animation: floatOrb 9s ease-in-out infinite;
        }

        .orb-1 {
            width: 220px;
            height: 220px;
            background: rgba(77, 184, 168, 0.24);
            top: 8%;
            left: 8%;
        }

        .orb-2 {
            width: 280px;
            height: 280px;
            background: rgba(124, 110, 230, 0.14);
            right: 6%;
            bottom: 10%;
            animation-delay: 1.5s;
        }

        .orb-3 {
            width: 130px;
            height: 130px;
            background: rgba(255, 209, 102, 0.22);
            bottom: 18%;
            left: 14%;
            animation-delay: 2.5s;
        }

        .confirmation-card {
            width: 100%;
            max-width: 760px;
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid var(--border-soft);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 30px;
            box-shadow: var(--shadow-lg);
            padding: 34px 30px 28px;
            position: relative;
            overflow: hidden;
            animation: fadeUp 0.8s ease-out;
        }

        .confirmation-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.35), transparent 35%),
                radial-gradient(circle at top right, rgba(77, 184, 168, 0.12), transparent 25%);
            pointer-events: none;
        }

        .top-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(77, 184, 168, 0.1);
            color: var(--primary-dark);
            border: 1px solid rgba(77, 184, 168, 0.15);
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 0.92rem;
            font-weight: 600;
            margin-bottom: 22px;
            animation: fadeIn 1s ease;
        }

        .hero {
            display: grid;
            grid-template-columns: 116px 1fr;
            gap: 24px;
            align-items: center;
        }

        .icon-wrap {
            width: 116px;
            height: 116px;
            border-radius: 28px;
            background:
                radial-gradient(circle at 30% 30%, #ffffff, #dff8f2 60%, #c3f0e7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.8),
                0 16px 30px rgba(34, 197, 94, 0.14);
            position: relative;
            animation: pulseSoft 2.8s ease-in-out infinite;
        }

        .icon-wrap::after {
            content: '';
            position: absolute;
            inset: 10px;
            border-radius: 22px;
            border: 1px dashed rgba(77, 184, 168, 0.25);
        }

        .checkmark {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--success), #34d399);
            position: relative;
            box-shadow: 0 10px 24px rgba(34, 197, 94, 0.28);
        }

        .checkmark::before {
            content: '';
            position: absolute;
            left: 17px;
            top: 15px;
            width: 11px;
            height: 22px;
            border: solid white;
            border-width: 0 4px 4px 0;
            transform: rotate(45deg);
        }

        .headline {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .headline h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.08;
            color: var(--primary-dark);
            letter-spacing: -0.03em;
        }

        .headline p {
            font-size: 1.04rem;
            line-height: 1.8;
            color: var(--text-soft);
            max-width: 520px;
        }

        .emphasis {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 18px;
            margin-top: 28px;
        }

        .message-box,
        .status-box {
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid rgba(77, 184, 168, 0.12);
            border-radius: 24px;
            box-shadow: var(--shadow-md);
            padding: 22px 20px;
        }

        .message-box h2,
        .status-box h3 {
            font-family: 'Quicksand', sans-serif;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .message-box p,
        .status-box p {
            color: var(--text-soft);
            line-height: 1.75;
            font-size: 0.98rem;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--success-soft);
            color: #15803d;
            border-radius: 999px;
            padding: 9px 14px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 14px;
        }

        .status-pill::before {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.12);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 28px;
        }

        .btn {
            appearance: none;
            border: none;
            text-decoration: none;
            border-radius: 16px;
            padding: 15px 22px;
            font-weight: 600;
            font-size: 0.97rem;
            transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 190px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #65cdbf);
            color: white;
            box-shadow: 0 14px 26px rgba(77, 184, 168, 0.28);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-dark);
            border: 1px solid rgba(77, 184, 168, 0.18);
            box-shadow: 0 10px 22px rgba(77, 184, 168, 0.12);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary:hover {
            box-shadow: 0 18px 30px rgba(77, 184, 168, 0.34);
        }

        .btn-secondary:hover {
            background: white;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #7a9593;
        }

        .sparkles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .sparkles span {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: rgba(77, 184, 168, 0.35);
            animation: twinkle 4s linear infinite;
        }

        .sparkles span:nth-child(1) {
            top: 12%;
            right: 18%;
            animation-delay: .2s;
        }

        .sparkles span:nth-child(2) {
            top: 22%;
            right: 10%;
            width: 6px;
            height: 6px;
            animation-delay: 1.2s;
        }

        .sparkles span:nth-child(3) {
            bottom: 18%;
            right: 22%;
            animation-delay: 2.1s;
        }

        .sparkles span:nth-child(4) {
            bottom: 28%;
            left: 10%;
            width: 5px;
            height: 5px;
            animation-delay: 1.8s;
        }

        .sparkles span:nth-child(5) {
            top: 14%;
            left: 20%;
            width: 7px;
            height: 7px;
            animation-delay: 2.6s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px) scale(0.985);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseSoft {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }
        }

        @keyframes floatOrb {

            0%,
            100% {
                transform: translateY(0px) translateX(0px);
            }

            50% {
                transform: translateY(-10px) translateX(6px);
            }
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.15;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.25);
            }
        }

        @media (max-width: 780px) {
            .confirmation-card {
                padding: 24px 18px 22px;
                border-radius: 24px;
            }

            .hero,
            .content-grid {
                grid-template-columns: 1fr;
            }

            .icon-wrap {
                width: 94px;
                height: 94px;
                border-radius: 24px;
            }

            .checkmark {
                width: 52px;
                height: 52px;
            }

            .checkmark::before {
                left: 15px;
                top: 13px;
                width: 10px;
                height: 20px;
            }

            .headline h1 {
                font-size: 2rem;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="page">
        <div class="bg-orb orb-1"></div>
        <div class="bg-orb orb-2"></div>
        <div class="bg-orb orb-3"></div>

        <section class="confirmation-card">
            <div class="sparkles">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="top-badge">
                ✨ Registro exitoso en Mentally
            </div>

            <div class="hero">
                <div class="icon-wrap">
                    <div class="checkmark"></div>
                </div>

                <div class="headline">
                    <h1>¡Toma confirmada!</h1>
                    <p>
                        Hemos registrado correctamente tu toma de medicamento.
                        Tu avance de hoy ya quedó guardado y se tendrá en cuenta
                        para tu <span class="emphasis">adherencia</span> y tu
                        <span class="emphasis">racha de constancia</span>.
                    </p>
                </div>
            </div>

            <div class="content-grid">
                <div class="message-box">
                    <h2>Buen trabajo</h2>
                    <p>
                        Cada confirmación suma a tu proceso de bienestar. Mantener este hábito
                        te ayuda a construir una rutina más estable, consciente y sostenible.
                    </p>
                </div>

            </div>

            <div class="actions">
                <a href="{{ url('/adherencia') }}" class="btn btn-primary">
                    Ver mi adherencia
                </a>

                <a href="{{ url('/') }}" class="btn btn-secondary">
                    Volver al inicio
                </a>
            </div>

        </section>
    </main>
</body>

</html>