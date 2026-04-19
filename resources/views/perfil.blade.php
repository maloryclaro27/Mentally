@extends('layouts.app')

@section('title', 'Mi Perfil - Mentally')

@push('styles')
    <style>
        :root {
            --primary: #4db8a8;
            --primary-dark: #2c5f5d;
            --primary-soft: rgba(77, 184, 168, 0.1);
            --primary-gradient: linear-gradient(135deg, #4db8a8, #5bc4b3);
            --text: #2c5f5d;
            --text-soft: #5a7c7a;
            --white: #ffffff;
            --border: rgba(77, 184, 168, 0.2);
            --shadow: 0 20px 40px rgba(77, 184, 168, 0.15);
            --gradient-bg: linear-gradient(135deg, #f0f9f8 0%, #e6f4f7 50%, #f2f9f8 100%);
            --danger: #ff6b6b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gradient-bg);
            min-height: 100vh;
        }

        .floating-circle {
            position: fixed;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.1));
            pointer-events: none;
            z-index: 0;
            animation: float 6s ease-in-out infinite;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            right: 10%;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: 15%;
            left: 5%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            top: 50%;
            right: 20%;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.05), rgba(255, 193, 7, 0.1));
            animation: float 10s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, 30px);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-page {
            margin-top: 80px;
            padding: 30px 24px 50px;
            min-height: calc(100vh - 80px);
            position: relative;
            z-index: 2;
        }

        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            animation: slideInUp 0.8s ease;
        }

        .profile-header {
            margin-bottom: 30px;
        }

        .profile-header h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text);
            background: linear-gradient(135deg, var(--text), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .profile-header p {
            color: var(--text-soft);
            font-size: 1rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 30px;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 30px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            animation: slideInUp 0.8s ease 0.1s backwards;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(77, 184, 168, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .avatar-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 15px;
        }

        .avatar-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary);
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.3);
            transition: all 0.3s ease;
        }

        .avatar-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            color: white;
            border: 4px solid var(--white);
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.3);
            transition: all 0.3s ease;
        }

        .avatar-container:hover .avatar-placeholder,
        .avatar-container:hover .avatar-image {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(77, 184, 168, 0.4);
        }

        .change-photo-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--primary-gradient);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .change-photo-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.4);
        }

        .avatar-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .avatar-email {
            color: var(--text-soft);
            font-size: 0.9rem;
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid var(--border);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: block;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-soft);
        }

        .info-section {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 30px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            animation: slideInUp 0.8s ease 0.2s backwards;
        }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(77, 184, 168, 0.2);
        }

        .section-header,
        .emergency-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border);
        }

        .section-title,
        .emergency-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title {
            color: var(--text);
        }

        .section-title i {
            color: var(--primary);
            font-size: 1.3rem;
        }

        .emergency-title {
            color: var(--danger);
        }

        .edit-btn {
            background: rgba(77, 184, 168, 0.1);
            border: 1px solid var(--border);
            padding: 8px 20px;
            border-radius: 25px;
            color: var(--primary);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .edit-btn:hover {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
        }

        .personal-data-form {
            display: none;
        }

        .personal-data-form.active {
            display: block;
            animation: slideInUp 0.3s ease;
        }

        .personal-data-view {
            display: block;
        }

        .personal-data-view.hide {
            display: none;
        }

        .data-grid,
        .emergency-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .data-field {
            margin-bottom: 5px;
        }

        .data-label,
        .emergency-label {
            font-size: 0.8rem;
            margin-bottom: 5px;
            display: block;
        }

        .data-label {
            color: var(--text-soft);
        }

        .data-value {
            font-size: 1rem;
            color: var(--text);
            font-weight: 500;
            padding: 8px 0;
            border-bottom: 2px dotted var(--border);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: var(--text);
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(77, 184, 168, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .btn-primary {
            padding: 10px 24px;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(77, 184, 168, 0.4);
        }

        .btn-secondary {
            padding: 10px 24px;
            background: transparent;
            color: var(--text-soft);
            border: 2px solid var(--border);
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(77, 184, 168, 0.1);
            border-color: var(--primary);
            color: var(--primary);
        }

        .emergency-contact {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 30px;
            box-shadow: var(--shadow);
            animation: slideInUp 0.8s ease 0.3s backwards;
        }

        .emergency-badge {
            background: rgba(255, 107, 107, 0.1);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            color: var(--danger);
            font-weight: 500;
        }

        .emergency-field {
            background: rgba(255, 107, 107, 0.03);
            padding: 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .emergency-value {
            font-size: 1rem;
            color: var(--text);
            font-weight: 500;
            word-break: break-word;
        }

        .emergency-empty {
            color: var(--text-soft);
            font-style: italic;
            font-size: 0.9rem;
        }

        .add-emergency-btn {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: rgba(255, 107, 107, 0.1);
            border: 2px dashed var(--danger);
            border-radius: 20px;
            color: var(--danger);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 2000;
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(135deg, #ffffff, #f8fcfb);
            border-radius: 30px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            animation: slideInUp 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--danger);
        }

        .modal-close {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            border: none;
            cursor: pointer;
        }

        .toast-notification {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--primary-gradient);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.4);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 3000;
            font-weight: 500;
        }

        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        @media (max-width: 900px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-card {
                max-width: 400px;
                margin: 0 auto;
            }

            .data-grid,
            .emergency-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .profile-page {
                padding: 20px 16px;
                margin-top: 70px;
            }

            .profile-header h1 {
                font-size: 2rem;
            }

            .section-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $profileUser = $user ?? auth()->user();

        $firstName = $profileUser->first_name ?? '';
        $lastName = $profileUser->last_name ?? '';
        $fullName = trim($firstName . ' ' . $lastName);
        $fullName = $fullName !== '' ? $fullName : $profileUser->name ?? 'Usuario';

        $email = $profileUser->email ?? 'correo@ejemplo.com';
        $avatar = $profileUser->avatar ?? null;
        $birthdate = $profileUser->birthdate ?? null;
        $createdAt = $profileUser->created_at ?? now();

        $avatarIsExternal =
            is_string($avatar) && (str_starts_with($avatar, 'http://') || str_starts_with($avatar, 'https://'));
        $avatarUrl = $avatar ? ($avatarIsExternal ? $avatar : Storage::url($avatar)) : null;
    @endphp

    <div class="floating-circle circle-1"></div>
    <div class="floating-circle circle-2"></div>
    <div class="floating-circle circle-3"></div>

    <div class="profile-page">
        <div class="profile-container">
            <div class="profile-header">
                <h1>Mi Perfil</h1>
                <p>Gestiona tu información personal y configuración de cuenta</p>
            </div>

            <div class="profile-grid">
                <div class="profile-card">
                    <div class="avatar-section">
                        <div class="avatar-container">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="Avatar" class="avatar-image">
                            @else
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                            @endif

                            <button class="change-photo-btn" type="button"
                                onclick="document.getElementById('avatarInput').click()">
                                <i class="fas fa-camera"></i>
                            </button>

                            <input type="file" id="avatarInput" style="display: none;" accept="image/*">
                        </div>

                        <h2 class="avatar-name">{{ $fullName }}</h2>
                        <p class="avatar-email">{{ $email }}</p>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number" id="streakDays">7</span>
                            <span class="stat-label">Días activo</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number" id="adherenceRate">92%</span>
                            <span class="stat-label">Adherencia</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number" id="achievementsCount">3</span>
                            <span class="stat-label">Logros</span>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="info-section">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="fas fa-user"></i>
                                Datos personales
                            </h3>
                            <button class="edit-btn" id="editPersonalBtn" type="button">
                                <i class="fas fa-edit"></i>
                                Editar
                            </button>
                        </div>

                        <div class="personal-data-view" id="personalDataView">
                            <div class="data-grid">
                                <div class="data-field">
                                    <span class="data-label">Nombre</span>
                                    <div class="data-value" id="viewName">{{ $fullName }}</div>
                                </div>

                                <div class="data-field">
                                    <span class="data-label">Correo electrónico</span>
                                    <div class="data-value" id="viewEmail">{{ $email }}</div>
                                </div>

                                <div class="data-field">
                                    <span class="data-label">Fecha de nacimiento</span>
                                    <div class="data-value" id="viewBirthdate">
                                        {{ $birthdate ? \Carbon\Carbon::parse($birthdate)->format('d/m/Y') : 'No especificada' }}
                                    </div>
                                </div>

                                <div class="data-field">
                                    <span class="data-label">Miembro desde</span>
                                    <div class="data-value">
                                        {{ \Carbon\Carbon::parse($createdAt)->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form class="personal-data-form" id="personalDataForm">
                            @csrf
                            @method('PUT')

                            <div class="data-grid">
                                <div class="form-group">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-input" name="first_name" value="{{ $firstName }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Apellido</label>
                                    <input type="text" class="form-input" name="last_name" value="{{ $lastName }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-input" name="email" value="{{ $email }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-input" name="birthdate"
                                        value="{{ $birthdate ? \Carbon\Carbon::parse($birthdate)->format('Y-m-d') : '' }}">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-secondary" id="cancelPersonalBtn">Cancelar</button>
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i>
                                    Guardar cambios
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="emergency-contact">
                        <div class="emergency-header">
                            <h3 class="emergency-title">
                                <i class="fas fa-phone-alt"></i>
                                Contacto de emergencia
                            </h3>
                            <span class="emergency-badge">
                                <i class="fas fa-shield-alt"></i>
                                Confidencial
                            </span>
                        </div>

                        <div id="emergencyContent">
                            @if ($emergencyContact)
                                <div class="emergency-grid">
                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-user"></i>
                                            Nombre
                                        </div>
                                        <div class="emergency-value">{{ $emergencyContact->name ?? 'No especificado' }}
                                        </div>
                                    </div>

                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-globe"></i>
                                            Indicativo país
                                        </div>
                                        <div class="emergency-value">+{{ $emergencyContact->country_code ?? '57' }}</div>
                                    </div>

                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-phone"></i>
                                            Número de teléfono
                                        </div>
                                        <div class="emergency-value">{{ $emergencyContact->phone ?? 'No especificado' }}
                                        </div>
                                    </div>

                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-heart"></i>
                                            Relación
                                        </div>
                                        <div class="emergency-value">
                                            {{ $emergencyContact->relationship ?? 'No especificado' }}</div>
                                    </div>
                                </div>

                                <button class="add-emergency-btn" type="button" onclick="openEmergencyModal()">
                                    <i class="fas fa-edit"></i>
                                    Editar contacto de emergencia
                                </button>
                            @else
                                <div class="emergency-grid">
                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-user"></i>
                                            Nombre
                                        </div>
                                        <div class="emergency-value emergency-empty">No especificado</div>
                                    </div>

                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-globe"></i>
                                            Indicativo país
                                        </div>
                                        <div class="emergency-value emergency-empty">No especificado</div>
                                    </div>

                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-phone"></i>
                                            Número de teléfono
                                        </div>
                                        <div class="emergency-value emergency-empty">No especificado</div>
                                    </div>

                                    <div class="emergency-field">
                                        <div class="emergency-label">
                                            <i class="fas fa-heart"></i>
                                            Relación
                                        </div>
                                        <div class="emergency-value emergency-empty">No especificado</div>
                                    </div>
                                </div>

                                <button class="add-emergency-btn" type="button" onclick="openEmergencyModal()">
                                    <i class="fas fa-plus"></i>
                                    Añadir contacto de emergencia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="emergencyModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-phone-alt"></i>
                    Contacto de emergencia
                </h3>
                <button class="modal-close" type="button" onclick="closeEmergencyModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="emergencyForm">
                @csrf

                <div class="form-group">
                    <label class="form-label">Nombre completo</label>
                    <input type="text" class="form-input" name="name" id="emergencyName"
                        placeholder="Ej. María González" value="{{ $emergencyContact->name ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Indicativo país</label>
                    @php $selectedCountryCode = $emergencyContact->country_code ?? '57'; @endphp
                    <select class="form-input" name="country_code" id="emergencyCountryCode" required>
                        <option value="57" {{ $selectedCountryCode == '57' ? 'selected' : '' }}>🇨🇴 +57 (Colombia)
                        </option>
                        <option value="52" {{ $selectedCountryCode == '52' ? 'selected' : '' }}>🇲🇽 +52 (México)
                        </option>
                        <option value="54" {{ $selectedCountryCode == '54' ? 'selected' : '' }}>🇦🇷 +54 (Argentina)
                        </option>
                        <option value="56" {{ $selectedCountryCode == '56' ? 'selected' : '' }}>🇨🇱 +56 (Chile)
                        </option>
                        <option value="51" {{ $selectedCountryCode == '51' ? 'selected' : '' }}>🇵🇪 +51 (Perú)
                        </option>
                        <option value="34" {{ $selectedCountryCode == '34' ? 'selected' : '' }}>🇪🇸 +34 (España)
                        </option>
                        <option value="1" {{ $selectedCountryCode == '1' ? 'selected' : '' }}>🇺🇸 +1 (EE.UU.)
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Número de teléfono</label>
                    <input type="tel" class="form-input" name="phone" id="emergencyPhone"
                        placeholder="Ej. 3001234567" value="{{ $emergencyContact->phone ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Relación</label>
                    @php $selectedRelationship = $emergencyContact->relationship ?? 'Familiar'; @endphp
                    <select class="form-input" name="relationship" id="emergencyRelationship" required>
                        <option value="Familiar" {{ $selectedRelationship == 'Familiar' ? 'selected' : '' }}>👨‍👩‍👧
                            Familia</option>
                        <option value="Amigo" {{ $selectedRelationship == 'Amigo' ? 'selected' : '' }}>👥 Amigo/a
                        </option>
                        <option value="Pareja" {{ $selectedRelationship == 'Pareja' ? 'selected' : '' }}>💑 Pareja
                        </option>
                        <option value="Médico" {{ $selectedRelationship == 'Médico' ? 'selected' : '' }}>👨‍⚕️ Médico
                            tratante</option>
                        <option value="Terapeuta" {{ $selectedRelationship == 'Terapeuta' ? 'selected' : '' }}>🧠
                            Terapeuta</option>
                        <option value="Otro" {{ $selectedRelationship == 'Otro' ? 'selected' : '' }}>📌 Otro</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary" onclick="closeEmergencyModal()">Cancelar</button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i>
                        Guardar contacto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="toast-notification" id="toastNotification">
        <span id="toastMessage"></span>
    </div>
@endsection

@push('scripts')
    <script>
        const editPersonalBtn = document.getElementById('editPersonalBtn');
        const cancelPersonalBtn = document.getElementById('cancelPersonalBtn');
        const personalDataView = document.getElementById('personalDataView');
        const personalDataForm = document.getElementById('personalDataForm');
        const emergencyModal = document.getElementById('emergencyModal');
        const avatarInput = document.getElementById('avatarInput');
        const emergencyForm = document.getElementById('emergencyForm');

        function showToast(message, icon = '✅', duration = 3000) {
            const toast = document.getElementById('toastNotification');
            const toastMessage = document.getElementById('toastMessage');

            toastMessage.innerHTML = `${icon} ${message}`;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, duration);
        }

        if (editPersonalBtn && personalDataView && personalDataForm) {
            editPersonalBtn.addEventListener('click', () => {
                personalDataView.classList.add('hide');
                personalDataForm.classList.add('active');
            });
        }

        if (cancelPersonalBtn && personalDataView && personalDataForm) {
            cancelPersonalBtn.addEventListener('click', () => {
                personalDataView.classList.remove('hide');
                personalDataForm.classList.remove('active');
            });
        }

        if (personalDataForm) {
            personalDataForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData(personalDataForm);

                try {
                    const csrfToken = personalDataForm.querySelector('input[name="_token"]')?.value;

                    const response = await fetch("{{ route('profile.update') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken || "",
                            "Accept": "application/json"
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        const fullName = `${data.user.first_name ?? ''} ${data.user.last_name ?? ''}`.trim();

                        document.getElementById('viewName').innerText = fullName || 'Usuario';
                        document.getElementById('viewEmail').innerText = data.user.email ?? '';
                        document.getElementById('viewBirthdate').innerText = data.user.birthdate ?
                            data.user.birthdate.split('-').reverse().join('/') :
                            'No especificada';

                        document.querySelector('.avatar-name').innerText = fullName || 'Usuario';
                        document.querySelector('.avatar-email').innerText = data.user.email ?? '';

                        personalDataView.classList.remove('hide');
                        personalDataForm.classList.remove('active');

                        showToast('Datos actualizados correctamente', '✅');
                    } else {
                        showToast('Error al actualizar', '❌');
                    }
                } catch (error) {
                    showToast('Error de conexión', '❌');
                }
            });
        }

        if (avatarInput) {
            avatarInput.addEventListener('change', async (e) => {
                const file = e.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('avatar', file);

                try {
                    const csrfToken = document.querySelector('#personalDataForm input[name="_token"]')?.value;

                    const response = await fetch("{{ route('profile.avatar') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken || "",
                            "Accept": "application/json"
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success && data.avatar_url) {
                        const oldImage = document.querySelector('.avatar-image');
                        const oldPlaceholder = document.querySelector('.avatar-placeholder');

                        if (oldImage) {
                            oldImage.src = data.avatar_url;
                        } else if (oldPlaceholder) {
                            oldPlaceholder.outerHTML =
                                `<img src="${data.avatar_url}" alt="Avatar" class="avatar-image">`;
                        }

                        showToast('Foto actualizada correctamente', '📸');
                    } else {
                        showToast('Error al actualizar foto', '❌');
                    }
                } catch (error) {
                    showToast('Error de conexión', '❌');
                }
            });
        }

        function openEmergencyModal() {
            if (!emergencyModal) return;
            emergencyModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeEmergencyModal() {
            if (!emergencyModal) return;
            emergencyModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (emergencyForm) {
            emergencyForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData(emergencyForm);

                try {
                    const csrfToken = emergencyForm.querySelector('input[name="_token"]')?.value;

                    const response = await fetch("{{ route('profile.emergency') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken || "",
                            "Accept": "application/json"
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        const emergencyContent = document.getElementById('emergencyContent');

                        emergencyContent.innerHTML = `
                        <div class="emergency-grid">
                            <div class="emergency-field">
                                <div class="emergency-label"><i class="fas fa-user"></i> Nombre</div>
                                <div class="emergency-value">${data.emergency?.name ?? 'No especificado'}</div>
                            </div>
                            <div class="emergency-field">
                                <div class="emergency-label"><i class="fas fa-globe"></i> Indicativo país</div>
                                <div class="emergency-value">+${data.emergency?.country_code ?? '57'}</div>
                            </div>
                            <div class="emergency-field">
                                <div class="emergency-label"><i class="fas fa-phone"></i> Número de teléfono</div>
                                <div class="emergency-value">${data.emergency?.phone ?? 'No especificado'}</div>
                            </div>
                            <div class="emergency-field">
                                <div class="emergency-label"><i class="fas fa-heart"></i> Relación</div>
                                <div class="emergency-value">${data.emergency?.relationship ?? 'No especificado'}</div>
                            </div>
                        </div>
                        <button class="add-emergency-btn" type="button" onclick="openEmergencyModal()">
                            <i class="fas fa-edit"></i>
                            Editar contacto de emergencia
                        </button>
                    `;

                        closeEmergencyModal();
                        showToast('Contacto de emergencia guardado', '🆘');
                    } else {
                        showToast('Error al guardar', '❌');
                    }
                } catch (error) {
                    showToast('Error de conexión', '❌');
                }
            });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && emergencyModal && emergencyModal.classList.contains('active')) {
                closeEmergencyModal();
            }
        });

        window.addEventListener('click', (event) => {
            if (event.target === emergencyModal) {
                closeEmergencyModal();
            }
        });

        function animateNumber(element, start, end, duration, suffix = '') {
            if (!element) return;

            let startTimestamp = null;

            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.innerText = `${value}${suffix}`;

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };

            window.requestAnimationFrame(step);
        }

        document.addEventListener('DOMContentLoaded', () => {
            animateNumber(document.getElementById('streakDays'), 0, 7, 1000);
            animateNumber(document.getElementById('adherenceRate'), 0, 92, 1000, '%');
            animateNumber(document.getElementById('achievementsCount'), 0, 3, 1000);
        });
    </script>
@endpush
