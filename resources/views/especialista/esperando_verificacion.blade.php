@extends('layouts.app')

@section('title', 'Verificación en Proceso | Mentally')

@push('styles')
<style>
    :root {
        --primary: #4db8a8;
        --primary-dark: #2c5f5d;
        --secondary: #5a7c7a;
        --bg: linear-gradient(135deg, #e0f7f4 0%, #d4f1f9 50%, #e8f5f3 100%);
        --card-bg: rgba(255, 255, 255, 0.95);
        --shadow: 0 20px 40px rgba(77, 184, 168, 0.15);
        --shadow-hover: 0 25px 50px rgba(77, 184, 168, 0.25);
    }

    body {
        background: var(--bg);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    /* Partículas flotantes */
    .floating-particle {
        position: fixed;
        width: 8px;
        height: 8px;
        background: rgba(77, 184, 168, 0.2);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        animation: floatParticle 15s ease-in-out infinite;
    }

    @keyframes floatParticle {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(100px, -50px) rotate(90deg); }
        50% { transform: translate(50px, 100px) rotate(180deg); }
        75% { transform: translate(-80px, 30px) rotate(270deg); }
    }

    /* Contenedor principal */
    .verify-wrap {
        max-width: 800px;
        margin: 140px auto 2rem;
        padding: 0 1.5rem;
        position: relative;
        z-index: 2;
    }

    /* Card principal con efecto 3D */
    .verify-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border-radius: 32px;
        padding: 3rem;
        box-shadow: var(--shadow);
        border: 1px solid rgba(77, 184, 168, 0.15);
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: cardAppear 0.8s ease-out;
    }

    .verify-card:hover {
        transform: translateY(-8px) rotateX(2deg);
        box-shadow: var(--shadow-hover);
    }

    @keyframes cardAppear {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Línea superior con gradiente animado */
    .verify-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            #4db8a8 20%, 
            #5bc4b3 50%, 
            #4db8a8 80%, 
            transparent 100%);
        background-size: 200% 100%;
        animation: gradientMove 3s linear infinite;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 0%; }
        100% { background-position: 200% 0%; }
    }

    /* Iconos decorativos flotantes */
    .decorative-icons {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        z-index: 0;
    }

    .decorative-icon {
        position: absolute;
        color: rgba(77, 184, 168, 0.1);
        font-size: 8rem;
        animation: iconFloat 8s ease-in-out infinite;
    }

    .icon-1 {
        top: -20px;
        right: -20px;
        transform: rotate(15deg);
        animation-delay: 0s;
    }

    .icon-2 {
        bottom: -30px;
        left: -30px;
        transform: rotate(-10deg);
        animation-delay: 2s;
    }

    .icon-3 {
        top: 30%;
        left: -40px;
        font-size: 6rem;
        animation-delay: 4s;
    }

    @keyframes iconFloat {
        0%, 100% { transform: rotate(0deg) translateY(0); }
        50% { transform: rotate(5deg) translateY(-20px); }
    }

    /* Header de verificación */
    .verify-header {
        display: flex;
        gap: 2rem;
        align-items: flex-start;
        margin-bottom: 2.5rem;
        position: relative;
        z-index: 2;
    }

    .icon-badge {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(77, 184, 168, 0.15), rgba(91, 196, 179, 0.25));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 2.5rem;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        animation: badgePulse 3s ease-in-out infinite;
        box-shadow: 0 10px 25px rgba(77, 184, 168, 0.2);
    }

    @keyframes badgePulse {
        0%, 100% { transform: scale(1); box-shadow: 0 10px 25px rgba(77, 184, 168, 0.2); }
        50% { transform: scale(1.05); box-shadow: 0 15px 35px rgba(77, 184, 168, 0.3); }
    }

    .icon-badge::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .icon-badge:hover::after {
        opacity: 1;
        animation: rotate 4s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .verify-title {
        font-family: 'Quicksand', sans-serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin: 0 0 0.5rem 0;
        line-height: 1.3;
        background: linear-gradient(135deg, #2c5f5d, #4db8a8);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .verify-sub {
        color: var(--secondary);
        line-height: 1.7;
        font-size: 1.05rem;
        margin: 0;
        opacity: 0.9;
    }

    /* Pasos de verificación */
    .steps {
        margin-top: 2.5rem;
        display: grid;
        gap: 1.2rem;
        position: relative;
        z-index: 2;
    }

    .step {
        display: flex;
        gap: 1.2rem;
        align-items: flex-start;
        padding: 1.2rem 1.5rem;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(77, 184, 168, 0.15);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(5px);
    }

    .step::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(77, 184, 168, 0.1), transparent);
        transition: left 0.5s;
    }

    .step:hover::before {
        left: 100%;
    }

    .step:hover {
        transform: translateX(8px);
        background: rgba(255, 255, 255, 0.9);
        border-color: var(--primary);
        box-shadow: 0 5px 20px rgba(77, 184, 168, 0.15);
    }

    .step .dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), #5bc4b3);
        margin-top: 0.3rem;
        flex-shrink: 0;
        position: relative;
        animation: dotPulse 2s ease-in-out infinite;
    }

    .step:nth-child(2) .dot { animation-delay: 0.3s; }
    .step:nth-child(3) .dot { animation-delay: 0.6s; }

    @keyframes dotPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0.8; }
    }

    .step p {
        margin: 0;
        color: var(--secondary);
        line-height: 1.6;
        font-size: 1rem;
    }

    .step strong {
        color: var(--primary-dark);
        font-weight: 600;
    }

    /* Acciones */
    .actions {
        margin-top: 3rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        position: relative;
        z-index: 2;
    }

    .btn {
        border: none;
        cursor: pointer;
        border-radius: 50px;
        padding: 1rem 2rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        position: relative;
        overflow: hidden;
        flex: 1 1 auto;
        justify-content: center;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), #5bc4b3);
        color: #fff;
        box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 35px rgba(77, 184, 168, 0.4);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary-dark);
        box-shadow: 0 5px 15px rgba(77, 184, 168, 0.1);
    }

    .btn-outline:hover {
        background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.15));
        transform: translateY(-5px) scale(1.02);
        border-color: #5bc4b3;
        box-shadow: 0 15px 35px rgba(77, 184, 168, 0.2);
    }

    /* Nota pequeña */
    .small-note {
        margin-top: 2.5rem;
        padding: 1.2rem 1.5rem;
        background: rgba(77, 184, 168, 0.05);
        border-radius: 12px;
        color: var(--secondary);
        font-size: 0.95rem;
        line-height: 1.6;
        border-left: 4px solid var(--primary);
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
    }

    .small-note:hover {
        background: rgba(77, 184, 168, 0.1);
        transform: translateY(-2px);
    }

    .small-note code {
        background: rgba(77, 184, 168, 0.2);
        color: var(--primary-dark);
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        border: 1px solid rgba(77, 184, 168, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .verify-wrap {
            margin-top: 120px;
        }

        .verify-card {
            padding: 2rem;
        }

        .verify-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
            align-items: center;
        }

        .icon-badge {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }

        .verify-title {
            font-size: 1.8rem;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

        .step:hover {
            transform: translateX(0) translateY(-3px);
        }
    }

    @media (max-width: 480px) {
        .verify-card {
            padding: 1.5rem;
        }

        .verify-title {
            font-size: 1.5rem;
        }

        .verify-sub {
            font-size: 0.95rem;
        }

        .step {
            padding: 1rem;
        }

        .step .dot {
            width: 12px;
            height: 12px;
        }

        .small-note {
            padding: 1rem;
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Partículas flotantes -->
<div class="floating-particle" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
<div class="floating-particle" style="top: 70%; right: 8%; animation-delay: 2s;"></div>
<div class="floating-particle" style="bottom: 20%; left: 15%; animation-delay: 4s;"></div>
<div class="floating-particle" style="top: 40%; right: 20%; animation-delay: 6s;"></div>
<div class="floating-particle" style="bottom: 30%; right: 30%; animation-delay: 8s;"></div>

<!-- Iconos decorativos -->
<div class="decorative-icons">
    <i class="fas fa-brain decorative-icon icon-1"></i>
    <i class="fas fa-heartbeat decorative-icon icon-2"></i>
    <i class="fas fa-shield-alt decorative-icon icon-3"></i>
</div>

<div class="verify-wrap">
    <div class="verify-card">
        <div class="verify-header">
            <div class="icon-badge">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div>
                <h1 class="verify-title">Tu cuenta está en proceso de verificación</h1>
                <p class="verify-sub">
                    Para proteger a los pacientes y asegurar la calidad clínica en Mentally, verificamos manualmente las credenciales
                    antes de habilitar el acceso completo.
                </p>
            </div>
        </div>

        <div class="steps">
            <div class="step">
                <div class="dot"></div>
                <p><strong>Revisión de credenciales:</strong> validamos tu registro médico y datos profesionales para garantizar la máxima calidad en nuestra plataforma.</p>
            </div>
            <div class="step">
                <div class="dot"></div>
                <p><strong>Activación de cuenta:</strong> una vez aprobado, tendrás acceso inmediato al panel clínico y a la gestión integral de tus pacientes.</p>
            </div>
            <div class="step">
                <div class="dot"></div>
                <p><strong>Notificación personalizada:</strong> te avisaremos por correo electrónico cuando tu cuenta esté verificada y lista para usar.</p>
            </div>
        </div>

        <div class="actions">

            <form method="POST" action="{{ route('logout') }}" style="flex: 1;">
                @csrf
                <button type="submit" class="btn btn-outline">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar sesión
                </button>
            </form>
        </div>

        <div class="small-note">
            <i class="fas fa-info-circle" style="margin-right: 0.5rem; color: var(--primary);"></i>
            <strong>Tip de desarrollo:</strong> si estás en entorno de pruebas, puedes activar tu cuenta cambiando 
            <code>is_verified</code> a <code>true</code> en la tabla <code>especialistas</code>.
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Animación adicional para los pasos
    document.addEventListener('DOMContentLoaded', function() {
        const steps = document.querySelectorAll('.step');
        
        steps.forEach((step, index) => {
            step.style.opacity = '0';
            step.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                step.style.transition = 'all 0.5s ease';
                step.style.opacity = '1';
                step.style.transform = 'translateX(0)';
            }, 300 + (index * 150));
        });

        // Efecto de brillo en el icono al cargar
        const iconBadge = document.querySelector('.icon-badge');
        iconBadge.style.animation = 'badgePulse 3s ease-in-out infinite';
        
        // Animación de partículas al hacer hover
        const card = document.querySelector('.verify-card');
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const icon = document.querySelector('.icon-badge');
            icon.style.transform = `translate(${(x - 40) / 30}px, ${(y - 40) / 30}px)`;
        });

        card.addEventListener('mouseleave', function() {
            const icon = document.querySelector('.icon-badge');
            icon.style.transform = 'translate(0, 0)';
        });
    });
</script>
@endpush
@endsection