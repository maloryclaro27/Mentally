@extends('layouts.app')

@push('styles')
    <style>
        /* ========== VARIABLES Y ESTILOS BASE ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f9f8 0%, #e6f4f7 50%, #f2f9f8 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar */
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

        /* ========== ELEMENTOS DECORATIVOS ========== */
        .floating-circle {
            position: fixed;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.1));
            pointer-events: none;
            z-index: 0;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            right: 10%;
            animation: float 6s ease-in-out infinite;
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
            top: 40%;
            left: 20%;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.05), rgba(255, 193, 7, 0.1));
            animation: float 10s ease-in-out infinite;
        }

        /* ========== ANIMACIONES ========== */
        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, 30px);
            }
        }

        @keyframes gentleFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        @keyframes blink {

            0%,
            90%,
            100% {
                transform: scaleY(1);
            }

            95% {
                transform: scaleY(0.1);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
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

        @keyframes glowPulse {

            0%,
            100% {
                filter: drop-shadow(0 0 5px rgba(77, 184, 168, 0.3));
            }

            50% {
                filter: drop-shadow(0 0 20px rgba(77, 184, 168, 0.6));
            }
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-top: 100px;
            padding: 2rem 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 2;
        }

        /* ========== HEADER DE BIENVENIDA ========== */
        .welcome-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 252, 251, 0.95));
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.1);
            animation: slideInUp 0.8s ease;
            backdrop-filter: blur(10px);
        }

        .welcome-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #2c5f5d, #4db8a8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-subtitle {
            color: #5a7c7a;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .current-date {
            display: inline-block;
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.1), rgba(91, 196, 179, 0.2));
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            color: #4db8a8;
            font-weight: 500;
            backdrop-filter: blur(5px);
        }

        /* ========== SECCIÓN DE LA MASCOTA ========== */
        .adherence-pet {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 251, 0.98));
            border-radius: 30px;
            padding: 2.5rem;
            margin-bottom: 3rem;
            box-shadow: 0 20px 50px rgba(77, 184, 168, 0.2);
            border: 1px solid rgba(77, 184, 168, 0.15);
            animation: slideInUp 0.8s ease 0.2s backwards;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .adherence-pet::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(77, 184, 168, 0.05) 0%, transparent 70%);
            animation: shimmer 15s infinite linear;
        }

        .pet-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .pet-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
        }

        .pet-subtitle {
            color: #5a7c7a;
            font-size: 1.1rem;
        }

        .pet-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        /* ========== MASCOTA INTERACTIVA ========== */
        .pet-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .pet-character {
            width: 350px;
            height: 350px;
            position: relative;
            margin-bottom: 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pet-character:hover {
            transform: scale(1.02);
        }

        .pet-body {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            position: relative;
            overflow: hidden;
            animation: gentleFloat 6s ease-in-out infinite;
            transition: all 0.5s ease;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }

        .pet-character[data-energy="high"] .pet-body {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3, #6dd0c0);
            animation: gentleFloat 4s ease-in-out infinite, glowPulse 3s ease-in-out infinite;
        }

        .pet-character[data-energy="medium"] .pet-body {
            background: linear-gradient(135deg, #8a9ba8, #9fb0bd, #b5c6d2);
            animation: gentleFloat 8s ease-in-out infinite;
            opacity: 0.9;
        }

        .pet-character[data-energy="low"] .pet-body {
            background: linear-gradient(135deg, #b8c5d0, #cbd5e0, #dee5ed);
            animation: gentleFloat 12s ease-in-out infinite;
            opacity: 0.7;
            filter: grayscale(0.3);
        }

        .pet-eyes {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 3.5rem;
            z-index: 3;
        }

        .eye {
            width: 35px;
            height: 45px;
            background: white;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .eye::after {
            content: '';
            position: absolute;
            top: 12px;
            left: 12px;
            width: 18px;
            height: 18px;
            background: #253138;
            border-radius: 50%;
            animation: blink 5s infinite;
            transition: all 0.3s ease;
        }

        .pet-mouth {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 35px;
            border-bottom: 6px solid #253138;
            border-radius: 0 0 35px 35px;
            transition: all 0.3s ease;
        }

        .sparkles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 215, 0, 0.5);
            animation: sparkle 3s ease-in-out infinite;
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 70%;
            right: 15%;
            animation-delay: 1s;
        }

        .sparkle:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 2s;
        }

        .sparkle:nth-child(4) {
            top: 30%;
            right: 25%;
            animation-delay: 1.5s;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .pet-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 1rem;
            background: rgba(255, 255, 255, 0.5);
            padding: 1.5rem 2rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .stat {
            text-align: center;
            position: relative;
        }

        .stat-value {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #4db8a8;
            display: block;
            line-height: 1.2;
            transition: all 0.3s ease;
        }

        .stat-label {
            color: #5a7c7a;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .pet-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .streak-info {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9));
            padding: 2rem;
            border-radius: 20px;
            border-left: 6px solid #4db8a8;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .streak-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(77, 184, 168, 0.15);
        }

        .streak-title {
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .streak-description {
            color: #5a7c7a;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .streak-progress {
            height: 12px;
            background: rgba(77, 184, 168, 0.15);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 0.8rem;
            position: relative;
        }

        .streak-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3, #6dd0c0);
            border-radius: 20px;
            width: 0%;
            transition: width 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .streak-progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        .streak-message {
            font-size: 0.9rem;
            color: #5a7c7a;
            font-style: italic;
        }

        /* ========== SECCIÓN DE MEDICAMENTOS ========== */
        .medications-section {
            margin-bottom: 3rem;
            animation: slideInUp 0.8s ease 0.4s backwards;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #2c5f5d;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 2px;
        }

        .add-medication-btn {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.3);
            border: 2px solid transparent;
        }

        .add-medication-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.4);
        }

        .medication-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.8rem;
        }

        .medication-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.98));
            border-radius: 20px;
            padding: 1.8rem;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.1);
            border: 1px solid rgba(77, 184, 168, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .medication-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .medication-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(77, 184, 168, 0.2);
        }

        .medication-card:hover::before {
            transform: scaleX(1);
        }

        .medication-card.taken {
            background: linear-gradient(135deg, rgba(77, 184, 168, 0.05), rgba(91, 196, 179, 0.1));
            border-left: 4px solid #4db8a8;
        }

        .medication-card.pending {
            border-left: 4px solid #ffc107;
        }

        .medication-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .medication-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c5f5d;
        }

        .medication-dose {
            background: rgba(77, 184, 168, 0.1);
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #4db8a8;
            font-weight: 600;
            border: 1px solid rgba(77, 184, 168, 0.3);
        }

        .medication-time {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #5a7c7a;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            background: rgba(77, 184, 168, 0.05);
            padding: 0.8rem;
            border-radius: 15px;
        }

        .medication-time i {
            color: #4db8a8;
            font-size: 1.1rem;
        }

        .medication-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-take {
            flex: 1;
            padding: 1rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            box-shadow: 0 5px 15px rgba(77, 184, 168, 0.2);
        }

        .btn-take:not(:disabled):hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.4);
        }

        .btn-take:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            background: linear-gradient(135deg, #a0d6d0, #b0e0da);
        }

        .btn-edit {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: rgba(77, 184, 168, 0.1);
            border: 2px solid rgba(77, 184, 168, 0.3);
            color: #4db8a8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .btn-edit:hover {
            background: #4db8a8;
            color: white;
            transform: rotate(15deg);
        }

        .btn-delete {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: rgba(220, 53, 69, 0.1);
            border: 2px solid rgba(220, 53, 69, 0.3);
            color: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .btn-delete:hover {
            background: #dc3545;
            color: white;
            transform: rotate(15deg);
        }

        .empty-medications {
            grid-column: 1/-1;
            text-align: center;
            padding: 4rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 30px;
            color: #5a7c7a;
            font-size: 1.1rem;
            backdrop-filter: blur(10px);
            border: 2px dashed rgba(77, 184, 168, 0.3);
        }

        .empty-medications i {
            font-size: 3rem;
            color: #4db8a8;
            margin-bottom: 1rem;
            display: block;
        }

        /* ========== SECCIÓN DE LOGROS ========== */
        .achievements-section {
            margin-bottom: 3rem;
            animation: slideInUp 0.8s ease 0.6s backwards;
        }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .achievement-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 1.5rem 1rem;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent;
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .achievement-card.unlocked {
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            transform: scale(1);
            border-color: #4db8a8;
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.3);
        }

        .achievement-card.unlocked:hover {
            transform: scale(1.08) rotate(2deg);
            box-shadow: 0 15px 35px rgba(77, 184, 168, 0.4);
        }

        .achievement-card.locked {
            opacity: 0.6;
            filter: grayscale(0.8);
            background: rgba(255, 255, 255, 0.5);
            border: 2px dashed rgba(77, 184, 168, 0.3);
        }

        .achievement-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .achievement-name {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .next-achievement {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9));
            border-radius: 20px;
            padding: 1.5rem;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(77, 184, 168, 0.2);
        }

        .next-achievement-info {
            flex: 1;
        }

        .next-achievement-title {
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .next-achievement-name {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.5rem;
            color: #4db8a8;
            margin-bottom: 1rem;
        }

        .next-achievement-progress {
            height: 8px;
            background: rgba(77, 184, 168, 0.2);
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
        }

        .next-achievement-bar {
            height: 100%;
            background: linear-gradient(90deg, #4db8a8, #5bc4b3);
            border-radius: 10px;
            width: 0%;
            transition: width 1s ease;
        }

        /* ========== MODAL ========== */
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
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(135deg, #ffffff, #f8fcfb);
            border-radius: 30px;
            padding: 2.5rem;
            max-width: 550px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(77, 184, 168, 0.3);
            animation: slideInModal 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid rgba(77, 184, 168, 0.2);
        }

        @keyframes slideInModal {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .modal-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c5f5d;
        }

        .modal-close {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(77, 184, 168, 0.1);
            border: none;
            color: #4db8a8;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            background: #4db8a8;
            color: white;
            transform: rotate(90deg);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #2c5f5d;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid rgba(77, 184, 168, 0.2);
            border-radius: 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #4db8a8;
            box-shadow: 0 0 0 4px rgba(77, 184, 168, 0.1);
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .btn-primary {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(77, 184, 168, 0.4);
        }

        .btn-secondary {
            padding: 1rem 2rem;
            background: transparent;
            color: #5a7c7a;
            border: 2px solid rgba(77, 184, 168, 0.3);
            border-radius: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(77, 184, 168, 0.1);
            border-color: #4db8a8;
            color: #4db8a8;
        }

        /* ========== NOTIFICACIONES ========== */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #4db8a8, #5bc4b3);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(77, 184, 168, 0.3);
            display: flex;
            align-items: center;
            gap: 1rem;
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

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .pet-container {
                grid-template-columns: 1fr;
            }

            .pet-visual {
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem;
            }

            .pet-character {
                width: 280px;
                height: 280px;
            }

            .pet-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    @php
        // ===== VALORES POR DEFECTO PARA DESARROLLO =====
        // Estos valores te permitirán visualizar la vista mientras construyes el backend

        // Datos de la mascota
        $evolutionStage = $evolutionStage ?? 1;
        $companionEnergyLevel = $companionEnergyLevel ?? 'high';
        $companionEnergy = $companionEnergy ?? 85;
        $streakDays = $streakDays ?? 7;
        $adherenceRate = $adherenceRate ?? 92;

        // Colores de la mascota
        $petColors = (object) [
            'primary' =>
                $petColors->primary ??
                ($evolutionStage == 1 ? '#4db8a8' : ($evolutionStage == 2 ? '#9370DB' : '#FF6B6B')),
            'secondary' =>
                $petColors->secondary ??
                ($evolutionStage == 1 ? '#5bc4b3' : ($evolutionStage == 2 ? '#BA55D3' : '#FF8E8E')),
        ];

        // Mensaje motivacional
        $motivationalMessage = (object) [
            'title' => $motivationalMessage->title ?? '¡Vamos por un gran día!',
            'description' =>
                $motivationalMessage->description ??
                'Tu compañero se siente lleno de energía gracias a tu compromiso. Sigue así, cada día cuenta.',
        ];

        // Progreso
        $progressToNextAchievement = $progressToNextAchievement ?? 70;
        $dailyAffirmation =
            $dailyAffirmation ??
            'Cada paso que das hacia tu bienestar es un acto de amor propio. Hoy es un buen día para cuidarte.';

        // Logros de ejemplo
        $allAchievements =
            $allAchievements ??
            collect([
                (object) [
                    'id' => 1,
                    'name' => 'Principiante',
                    'description' => '7 días de racha',
                    'days_required' => 7,
                    'icon_html' => '🌱',
                    'unlocked' => true,
                ],
                (object) [
                    'id' => 2,
                    'name' => 'Explorador',
                    'description' => '15 días de racha',
                    'days_required' => 15,
                    'icon_html' => '🔍',
                    'unlocked' => $streakDays >= 15,
                ],
                (object) [
                    'id' => 3,
                    'name' => 'Comprometido',
                    'description' => '30 días de racha',
                    'days_required' => 30,
                    'icon_html' => '🤝',
                    'unlocked' => $streakDays >= 30,
                ],
                (object) [
                    'id' => 4,
                    'name' => 'Dedicado',
                    'description' => '60 días de racha',
                    'days_required' => 60,
                    'icon_html' => '⭐',
                    'unlocked' => $streakDays >= 60,
                ],
                (object) [
                    'id' => 5,
                    'name' => 'Experto',
                    'description' => '90 días de racha',
                    'days_required' => 90,
                    'icon_html' => '🏆',
                    'unlocked' => $streakDays >= 90,
                ],
                (object) [
                    'id' => 6,
                    'name' => 'Maestro',
                    'description' => '180 días de racha',
                    'days_required' => 180,
                    'icon_html' => '👑',
                    'unlocked' => $streakDays >= 180,
                ],
                (object) [
                    'id' => 7,
                    'name' => 'Leyenda',
                    'description' => '365 días de racha',
                    'days_required' => 365,
                    'icon_html' => '🌟',
                    'unlocked' => $streakDays >= 365,
                ],
            ]);

        // Medicamentos de ejemplo (SIN usar métodos de Eloquent)
        $activeMedications =
            $medicamentos ??
            ($activeMedications ??
                collect([
                    (object) [
                        'id' => 1,
                        'name' => 'Sertralina',
                        'dosage' => '50mg',
                        'dose_time' => '08:00',
                        'taken_today' => false,
                    ],
                    (object) [
                        'id' => 2,
                        'name' => 'Escitalopram',
                        'dosage' => '10mg',
                        'dose_time' => '20:00',
                        'taken_today' => false,
                    ],
                    (object) [
                        'id' => 3,
                        'name' => 'Bupropion',
                        'dosage' => '150mg',
                        'dose_time' => '14:00',
                        'taken_today' => false,
                    ],
                ]));

        // Próximo logro
        $nextAchievement =
            $nextAchievement ??
            (object) [
                'name' => 'Explorador',
                'description' => '15 días de compromiso constante',
                'days_required' => 15,
                'icon_html' => '🔍',
                'days_remaining' => 15 - $streakDays,
            ];

        // Usuario
        $user =
            $usuario ??
            (Auth::user() ??
                (object) [
                    'first_name' => 'Usuario',
                    'achievements' => $allAchievements->filter(function ($a) {
                        return $a->unlocked ?? false;
                    }),
                ]);
    @endphp

    <!-- Elementos decorativos -->
    <div class="floating-circle circle-1"></div>
    <div class="floating-circle circle-2"></div>
    <div class="floating-circle circle-3"></div>

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Contenido principal -->
    <main class="main-content">
        @if (session('success'))
            <div
                style="margin-bottom: 1.5rem; background: rgba(77, 184, 168, 0.12); border: 1px solid rgba(77, 184, 168, 0.25); color: #2c5f5d; padding: 1rem 1.25rem; border-radius: 16px;">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div
                style="margin-bottom: 1.5rem; background: rgba(220, 53, 69, 0.10); border: 1px solid rgba(220, 53, 69, 0.20); color: #842029; padding: 1rem 1.25rem; border-radius: 16px;">
                <ul style="margin: 0; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Encabezado de bienvenida -->
        <section class="welcome-header">
            <h1 class="welcome-title">🌸 Hola, {{ $user->first_name }}</h1>
            <p class="welcome-subtitle">Tu compañero de bienestar está aquí para apoyarte en cada paso de tu camino hacia
                una
                mejor salud mental. Cada pequeño esfuerzo cuenta.</p>
            <div class="current-date">
                <i class="fas fa-calendar-alt"></i>
                <span id="currentDate"></span>
            </div>
        </section>

        <!-- Sección de la Mascota -->
        <section class="adherence-pet">
            <div class="pet-header">
                <h2 class="pet-title">✨ Tu Compañero de Bienestar ✨</h2>
                <p class="pet-subtitle">Él refleja tu compromiso y crece contigo. Cada medicamento tomado es un paso juntos.
                </p>
            </div>

            <div class="pet-container">
                <div class="pet-visual">
                    <div class="pet-character" id="petCharacter" data-energy="{{ $companionEnergyLevel }}"
                        data-evolution="{{ $evolutionStage }}">
                        <div class="sparkles">
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                            <div class="sparkle"></div>
                        </div>

                        <div class="pet-body"
                            style="background: linear-gradient(135deg, {{ $petColors->primary }} 0%, {{ $petColors->secondary }} 100%);">
                        </div>

                        <div class="pet-eyes">
                            <div class="eye"></div>
                            <div class="eye"></div>
                        </div>

                        <div class="pet-mouth"></div>

                        @if ($evolutionStage >= 2)
                            <div style="position: absolute; top: 15%; right: 20%; font-size: 1.5rem;">👑</div>
                        @endif
                        @if ($evolutionStage >= 3)
                            <div style="position: absolute; bottom: 20%; left: 15%; font-size: 1.5rem;">⭐</div>
                        @endif
                    </div>

                    <div class="pet-stats">
                        <div class="stat">
                            <span class="stat-value" id="streakDays">{{ $streakDays }}</span>
                            <span class="stat-label">Días de racha</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value" id="companionEnergy">{{ $companionEnergy }}%</span>
                            <span class="stat-label">Energía</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value" id="adherenceRate">{{ $adherenceRate }}%</span>
                            <span class="stat-label">Adherencia</span>
                        </div>
                    </div>
                </div>

                <div class="pet-info">
                    <div class="streak-info">
                        <h3 class="streak-title">
                            <i class="fas fa-heart" style="color: #4db8a8; margin-right: 0.5rem;"></i>
                            {{ $motivationalMessage->title }}
                        </h3>
                        <p class="streak-description">
                            {{ $motivationalMessage->description }}
                        </p>

                        <div class="streak-progress">
                            <div class="streak-progress-bar" id="streakProgressBar"
                                style="width: {{ $progressToNextAchievement }}%;"></div>
                        </div>

                        <p class="streak-message">
                            <i class="fas fa-star" style="color: #ffc107; margin-right: 0.5rem;"></i>
                            <span id="nextAchievementMessage">
                                @if ($nextAchievement)
                                    ¡A {{ $nextAchievement->days_remaining }} días de "{{ $nextAchievement->name }}"!
                                @else
                                    ¡Has alcanzado todos los logros! Eres increíble.
                                @endif
                            </span>
                        </p>
                    </div>

                    <div
                        style="background: rgba(255, 255, 255, 0.7); border-radius: 15px; padding: 1rem; border-left: 4px solid #4db8a8;">
                        <p style="color: #2c5f5d; font-style: italic; margin: 0;">
                            <i class="fas fa-quote-left" style="color: #4db8a8; margin-right: 0.5rem;"></i>
                            {{ $dailyAffirmation }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Medicamentos -->
        <section class="medications-section">
            <div class="section-header">
                <h2 class="section-title">💊 Mis Medicamentos de Hoy</h2>
                <button type="button" class="add-medication-btn" onclick="openAddMedicationModal()">
                    <i class="fas fa-plus-circle"></i>
                    Añadir Medicamento
                </button>
            </div>

            <div class="medication-grid" id="medicationsGrid">
                @forelse($activeMedications as $medication)
                    @php
                        $takenToday = $medication->tomado_hoy ?? false;
                        $nextDose = isset($medication->hora_toma)
                            ? date('g:i A', strtotime($medication->hora_toma))
                            : 'No especificada';
                    @endphp

                    <div class="medication-card {{ $takenToday ? 'taken' : 'pending' }}"
                        id="med-card-{{ $medication->id }}" data-med-id="{{ $medication->id }}">
                        <div class="medication-header">
                            <span class="medication-name">{{ $medication->nombre }}</span>
                            <span class="medication-dose">{{ $medication->dosis }}</span>
                        </div>

                        <div class="medication-time">
                            <i class="fas fa-clock"></i>
                            <span>{{ $nextDose }}</span>
                        </div>

                        <div class="medication-actions">
                            @if ($takenToday)
                                <button class="btn-take" disabled>
                                    <i class="fas fa-check-circle"></i>
                                    Tomada hoy ✓
                                </button>
                            @else
                                <button class="btn-take" onclick="marcarToma({{ $medication->id }})">
                                    <i class="fas fa-pills"></i>
                                    Marcar como tomada
                                </button>
                            @endif

                            <button class="btn-edit"
                                onclick="openEditMedicationModal({{ $medication->id }}, '{{ addslashes($medication->nombre) }}', '{{ addslashes($medication->dosis) }}', '{{ $medication->hora_toma }}')"
                                title="Editar medicamento">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn-delete" onclick="eliminarMedicamento({{ $medication->id }})"
                                title="Eliminar medicamento">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="empty-medications">
                        <i class="fas fa-pills"></i>
                        <p>Aún no has añadido ningún medicamento.</p>
                        <p style="font-size: 0.9rem; margin-top: 0.5rem;">Comienza añadiendo tu tratamiento para que
                            podamos
                            ayudarte con los recordatorios.</p>
                        <button type="button" class="add-medication-btn" onclick="openAddMedicationModal()"
                            style="margin-top: 1rem;">
                            <i class="fas fa-plus-circle"></i>
                            Añadir mi primer medicamento
                        </button>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Sección de Logros -->
        <section class="achievements-section">
            <h2 class="section-title">🏆 Tus Logros</h2>

            <div class="achievements-grid">
                @foreach ($allAchievements as $achievement)
                    <div class="achievement-card {{ $achievement->unlocked ?? false ? 'unlocked' : 'locked' }}"
                        title="{{ $achievement->description }}">
                        <div class="achievement-icon">{{ $achievement->icon_html }}</div>
                        <div class="achievement-name">{{ $achievement->name }}</div>
                    </div>
                @endforeach
            </div>

            @if ($nextAchievement)
                <div class="next-achievement">
                    <div style="font-size: 2.5rem;">{{ $nextAchievement->icon_html }}</div>
                    <div class="next-achievement-info">
                        <div class="next-achievement-title">🎯 Próximo logro a alcanzar</div>
                        <div class="next-achievement-name">{{ $nextAchievement->name }}</div>
                        <div class="next-achievement-progress">
                            <div class="next-achievement-bar"
                                style="width: {{ min(($streakDays / $nextAchievement->days_required) * 100, 100) }}%;">
                            </div>
                        </div>
                        <p style="color: #5a7c7a; margin-top: 0.5rem; font-size: 0.9rem;">
                            <i class="fas fa-hourglass-half"></i>
                            Te faltan {{ $nextAchievement->days_remaining }} días de racha
                        </p>
                    </div>
                </div>
            @endif
        </section>
    </main>

    <!-- Modal para Añadir/Editar Medicamento -->
    <div class="modal" id="medicationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">➕ Añadir Medicamento</h3>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="medicationForm" method="POST" action="{{ route('adherencia.guardarMedicamento') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" id="medicationId" name="medicationId">

                <div class="form-group">
                    <label class="form-label">Nombre del medicamento</label>
                    <input type="text" class="form-input" id="medName" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ej. Sertralina" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Dosis</label>
                    <input type="text" class="form-input" id="medDosage" name="dosis" value="{{ old('dosis') }}"
                        placeholder="Ej. 50mg" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Hora de toma (para recordatorios)</label>
                    <input type="time" class="form-input" id="medTime" name="hora_toma"
                        value="{{ old('hora_toma') }}" required>
                    <small style="color: #5a7c7a; display: block; margin-top: 0.3rem;">
                        <i class="fas fa-info-circle"></i>
                        Recibirás un recordatorio a esta hora
                    </small>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal()">
                        Cancelar
                    </button>
                    <button type="submit" class="btn-primary" id="saveMedicationBtn">
                        <i class="fas fa-save"></i>
                        Guardar Medicamento
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notificación flotante -->
    <div class="toast-notification" id="toastNotification">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Medicamento registrado correctamente</span>
    </div>

    <form id="formEliminarMedicamento" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="formMarcarToma" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

@push('scripts')
    <script>
        // Actualizar fecha actual
        document.addEventListener('DOMContentLoaded', function() {
            const dateElement = document.getElementById('currentDate');
            if (dateElement) {
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const today = new Date().toLocaleDateString('es-ES', options);
                dateElement.innerText = today.charAt(0).toUpperCase() + today.slice(1);
            }
        });

        // Funciones del modal
        const modal = document.getElementById('medicationModal');
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('medicationForm');
        const formMethod = document.getElementById('formMethod');
        const medId = document.getElementById('medicationId');
        const medName = document.getElementById('medName');
        const medDosage = document.getElementById('medDosage');
        const medTime = document.getElementById('medTime');

        function openAddMedicationModal(limpiar = true) {
            modalTitle.innerHTML = '➕ Añadir Medicamento';
            form.action = `{{ route('adherencia.guardarMedicamento') }}`;
            formMethod.value = 'POST';
            medId.value = '';

            if (limpiar) {
                medName.value = '';
                medDosage.value = '';
                medTime.value = '';
            }

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function openEditMedicationModal(id, nombre, dosis, hora) {
            modalTitle.innerHTML = '✏️ Editar Medicamento';
            medId.value = id;
            form.action = `/adherencia/medicamentos/${id}`;
            formMethod.value = 'PUT';
            medName.value = nombre;
            medDosage.value = dosis;
            medTime.value = hora;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }


        function eliminarMedicamento(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este medicamento?')) {
                const form = document.getElementById('formEliminarMedicamento');
                form.action = `/adherencia/medicamentos/${id}`;
                form.submit();
            }
        }

        function marcarToma(id) {
            const form = document.getElementById('formMarcarToma');
            form.action = `/adherencia/medicamentos/${id}/marcar-toma`;
            form.submit();
        }

        function showToast(message, icon = '✅', duration = 3000) {
            const toast = document.getElementById('toastNotification');
            const toastMessage = document.getElementById('toastMessage');

            toastMessage.innerHTML = `${icon} ${message}`;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, duration);
        }

        // Cerrar modal con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
            }
        });

        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            if (event.target === modal) {
                closeModal();
            }
        }
        @if ($errors->any())
            openAddMedicationModal(false);
        @endif
        console.log('script de adherencia cargado');
    </script>
@endpush
