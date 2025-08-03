<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Authentification') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Connexion à l\'espace administrateur d\'Act for Communities')">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Auth Styles -->
    <style>
        /* Variables CSS */
        :root {
            --primary-color: #059669;
            --secondary-color: #F59E0B;
            --accent-color: #10B981;
            --text-dark: #1F2937;
            --text-light: #6B7280;
            --border-color: #E5E7EB;
            --bg-light: #F9FAFB;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --error-color: #DC2626;
            --success-color: #059669;
            --warning-color: #D97706;
            --info-color: #0284C7;
        }

        /* Reset et base */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg,
                rgba(5, 150, 105, 0.9) 0%,
                rgba(16, 185, 129, 0.8) 50%,
                rgba(245, 158, 11, 0.9) 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Container principal */
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        /* Éléments de fond décoratifs */
        .auth-bg-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            z-index: 1;
        }

        .bg-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape-4 {
            width: 80px;
            height: 80px;
            top: 30%;
            right: 30%;
            animation-delay: 1s;
        }

        .shape-5 {
            width: 120px;
            height: 120px;
            bottom: 40%;
            right: 10%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        /* Particules flottantes */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatParticles 10s linear infinite;
        }

        @keyframes floatParticles {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Carte d'authentification */
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 3rem;
            width: 100%;
            max-width: 600px;
            position: relative;
            z-index: 2;
            animation: slideInUp 0.8s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* En-tête */
        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-logo {
            margin-bottom: 1.5rem;
            position: relative;
             display: flex;
            justify-content: center;
             align-items: center;
        }

        .logo-image {
            height: 60px;
            width: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease;
            display: block;
             margin: 0 auto;
        }

        .logo-image:hover {
            transform: scale(1.05);
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .auth-subtitle {
            color: var(--text-light);
            font-size: 1rem;
            margin: 0;
            font-weight: 500;
        }

        /* Messages de statut */
        .status-message {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 500;
            text-align: center;
            border: 1px solid;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .status-success {
            background: rgba(5, 150, 105, 0.1);
            border-color: rgba(5, 150, 105, 0.2);
            color: var(--success-color);
        }

        .status-error {
            background: rgba(220, 38, 38, 0.1);
            border-color: rgba(220, 38, 38, 0.2);
            color: var(--error-color);
        }

        .status-warning {
            background: rgba(217, 119, 6, 0.1);
            border-color: rgba(217, 119, 6, 0.2);
            color: var(--warning-color);
        }

        .status-info {
            background: rgba(2, 132, 199, 0.1);
            border-color: rgba(2, 132, 199, 0.2);
            color: var(--info-color);
        }

        /* Formulaire */
        .auth-form {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        /* Conteneur d'input */
        .input-container {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            z-index: 3;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            font-weight: 500;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
            background: rgba(255, 255, 255, 0.95);
        }

        .form-input:focus + .input-icon,
        .form-input:focus ~ .input-icon {
            color: var(--primary-color);
        }

        .form-input::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }

        /* Toggle mot de passe */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease;
            z-index: 3;
            padding: 0.25rem;
            border-radius: 4px;
        }

        .password-toggle:hover {
            color: var(--primary-color);
            background: rgba(5, 150, 105, 0.1);
        }

        /* Erreurs */
        .input-error {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .input-error::before {
            content: '⚠';
            font-size: 1rem;
        }

        /* Checkbox personnalisée */
        .form-group-checkbox {
            margin-bottom: 2rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            gap: 0.75rem;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .checkbox-label:hover {
            background: rgba(5, 150, 105, 0.05);
        }

        .checkbox-input {
            display: none;
        }

        .checkbox-custom {
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-radius: 6px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
            flex-shrink: 0;
        }

        .checkbox-custom i {
            color: white;
            font-size: 0.75rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .checkbox-input:checked + .checkbox-custom {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: scale(1.1);
        }

        .checkbox-input:checked + .checkbox-custom i {
            opacity: 1;
        }

        .checkbox-text {
            color: var(--text-dark);
            font-size: 0.9rem;
            font-weight: 500;
            user-select: none;
        }

        /* Boutons */
        .btn-auth {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.4);
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: rgba(107, 114, 128, 0.1);
            color: var(--text-dark);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: rgba(5, 150, 105, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-1px);
        }

        .btn-auth:active {
            transform: translateY(0);
        }

        .btn-auth:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.2);
        }

        /* Liens */
        .auth-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .auth-link:hover {
            color: var(--accent-color);
            text-decoration: underline;
            transform: translateX(2px);
        }

        .auth-link i {
            transition: transform 0.3s ease;
        }

        .auth-link:hover i {
            transform: scale(1.1);
        }

        /* Séparateur */
        .auth-divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .auth-divider span {
            padding: 0 1rem;
            background: rgba(255, 255, 255, 0.95);
        }

        /* Pied de page */
        .auth-footer {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .footer-text {
            color: var(--text-light);
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .footer-link {
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .footer-link:hover {
            color: var(--primary-color);
        }

        /* États de chargement */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 640px) {
            .auth-container {
                padding: 1rem;
            }

            .auth-card {
                padding: 2rem 1.5rem;
                border-radius: 16px;
            }

            .auth-title {
                font-size: 1.75rem;
            }

            .form-input {
                padding: 0.875rem 0.875rem 0.875rem 2.75rem;
            }

            .input-icon {
                left: 0.875rem;
                font-size: 0.9rem;
            }

            .password-toggle {
                right: 0.875rem;
                font-size: 0.9rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 1.5rem 1rem;
            }

            .auth-title {
                font-size: 1.5rem;
            }

            .btn-auth {
                padding: 0.875rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .auth-card {
                background: rgba(31, 41, 55, 0.95);
                color: white;
            }

            .auth-title {
                color: white;
            }

            .form-label,
            .checkbox-text {
                color: #E5E7EB;
            }

            .form-input {
                background: rgba(55, 65, 81, 0.8);
                border-color: #374151;
                color: white;
            }

            .form-input::placeholder {
                color: #9CA3AF;
            }

            .checkbox-custom {
                background: #374151;
                border-color: #4B5563;
            }

            .btn-secondary {
                background: rgba(55, 65, 81, 0.8);
                border-color: #4B5563;
                color: #E5E7EB;
            }
        }

        /* Focus visible pour l'accessibilité */
        .auth-card *:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Animation des particules */
        .create-particles {
            animation: createParticles 0.1s linear infinite;
        }

        @keyframes createParticles {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 1;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="auth-container">
        <!-- Éléments de fond décoratifs -->
        <div class="auth-bg-elements">
            <div class="bg-shape shape-1"></div>
            <div class="bg-shape shape-2"></div>
            <div class="bg-shape shape-3"></div>
            <div class="bg-shape shape-4"></div>
            <div class="bg-shape shape-5"></div>
        </div>

        <!-- Particules flottantes -->
        <div class="particles" id="particles"></div>

        <!-- Carte d'authentification -->
        <div class="auth-card">
            <!-- En-tête -->
            <div class="auth-header">
                <div class="auth-logo">
                    <img src="{{ asset('images/act-logo.png') }}" alt="Act for Communities" class="logo-image">
                </div>
                <h1 class="auth-title">@yield('page-title', 'Authentification')</h1>
                <p class="auth-subtitle">@yield('page-subtitle', 'Accédez à votre espace')</p>
            </div>

            <!-- Contenu principal -->
            <main>
                @yield('content')
            </main>

            <!-- Pied de page -->
            <div class="auth-footer">
                <p class="footer-text">
                    {{ __('© 2024 Act for Communities. Tous droits réservés.') }}
                </p>
                <div class="footer-links">
                    <a href="{{ route('home') }}" class="footer-link">
                        <i class="fas fa-home"></i>{{ __('Retour au site') }}
                    </a>
                    <a href="{{ route('about') }}" class="footer-link">
                        <i class="fas fa-info-circle"></i>{{ __('À propos') }}
                    </a>
                    <a href="{{ route('contact.index') }}" class="footer-link">
                        <i class="fas fa-envelope"></i>{{ __('Contact') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Création des particules flottantes
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;

            for (let i = 0; i < particleCount; i++) {
                setTimeout(() => {
                    const particle = document.createElement('div');
                    particle.className = 'particle';

                    // Taille aléatoire
                    const size = Math.random() * 4 + 2;
                    particle.style.width = size + 'px';
                    particle.style.height = size + 'px';

                    // Position horizontale aléatoire
                    particle.style.left = Math.random() * 100 + '%';

                    // Durée d'animation aléatoire
                    particle.style.animationDuration = (Math.random() * 3 + 7) + 's';
                    particle.style.animationDelay = Math.random() * 2 + 's';

                    particlesContainer.appendChild(particle);

                    // Supprimer la particule après l'animation
                    setTimeout(() => {
                        if (particle.parentNode) {
                            particle.parentNode.removeChild(particle);
                        }
                    }, 12000);
                }, i * 200);
            }
        }

        // Toggle affichage mot de passe
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = passwordInput.parentElement.querySelector('.password-toggle i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Animation au chargement
        document.addEventListener('DOMContentLoaded', function() {
            // Créer les particules
            createParticles();

            // Recréer les particules périodiquement
            setInterval(createParticles, 3000);

            const form = document.querySelector('.auth-form');
            if (form) {
                const inputs = form.querySelectorAll('.form-input');

                // Animation d'entrée pour les champs
                inputs.forEach((input, index) => {
                    input.style.opacity = '0';
                    input.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        input.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                        input.style.opacity = '1';
                        input.style.transform = 'translateY(0)';
                    }, 200 + (index * 100));
                });

                // Effet de focus enhanced
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.style.transform = 'scale(1.02)';
                        this.parentElement.style.transition = 'transform 0.3s ease';
                    });

                    input.addEventListener('blur', function() {
                        this.parentElement.style.transform = 'scale(1)';
                    });
                });

                // Validation en temps réel
                inputs.forEach(input => {
                    input.addEventListener('input', function() {
                        const errorElement = this.parentElement.parentElement.querySelector('.input-error');
                        if (errorElement && this.value.trim() !== '') {
                            errorElement.style.opacity = '0';
                            setTimeout(() => {
                                if (errorElement.style.opacity === '0') {
                                    errorElement.style.display = 'none';
                                }
                            }, 300);
                        }
                    });
                });
            }

            // Effet de clic sur les boutons
            const buttons = document.querySelectorAll('.btn-auth');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!this.disabled) {
                        // Effet de ripple
                        const ripple = document.createElement('span');
                        const rect = this.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;

                        ripple.style.cssText = `
                            position: absolute;
                            border-radius: 50%;
                            background: rgba(255, 255, 255, 0.3);
                            transform: scale(0);
                            animation: ripple 0.6s linear;
                            width: ${size}px;
                            height: ${size}px;
                            left: ${x}px;
                            top: ${y}px;
                        `;

                        this.appendChild(ripple);

                        setTimeout(() => {
                            ripple.remove();
                        }, 600);
                    }
                });
            });

            // Animation CSS pour le ripple
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });

        // Gestion des erreurs AJAX
        window.addEventListener('error', function(e) {
            console.error('Erreur détectée:', e.error);
        });

        // Animation des messages de statut
        function showStatusMessage(message, type = 'info') {
            const existingMessage = document.querySelector('.status-message');
            if (existingMessage) {
                existingMessage.remove();
            }

            const messageElement = document.createElement('div');
            messageElement.className = `status-message status-${type}`;
            messageElement.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                ${message}
            `;

            const form = document.querySelector('.auth-form');
            if (form) {
                form.insertBefore(messageElement, form.firstChild);

                // Auto-hide après 5 secondes
                setTimeout(() => {
                    messageElement.style.opacity = '0';
                    setTimeout(() => {
                        if (messageElement.parentNode) {
                            messageElement.parentNode.removeChild(messageElement);
                        }
                    }, 300);
                }, 5000);
            }
        }

        // Fonction pour afficher un loader sur les boutons
        function showButtonLoader(button) {
            const originalContent = button.innerHTML;
            button.innerHTML = `
                <span class="spinner"></span>
                ${button.textContent.includes('connecter') ? 'Connexion...' : 'Chargement...'}
            `;
            button.disabled = true;
            button.classList.add('loading');

            return function() {
                button.innerHTML = originalContent;
                button.disabled = false;
                button.classList.remove('loading');
            };
        }

        // Validation côté client
        function validateForm(form) {
            const inputs = form.querySelectorAll('input[required]');
            let isValid = true;

            inputs.forEach(input => {
                const value = input.value.trim();
                const errorElement = input.parentElement.parentElement.querySelector('.input-error');

                if (!value) {
                    if (!errorElement) {
                        const error = document.createElement('div');
                        error.className = 'input-error';
                        error.innerHTML = `⚠ Ce champ est requis`;
                        input.parentElement.parentElement.appendChild(error);
                    }
                    isValid = false;
                } else if (input.type === 'email' && !isValidEmail(value)) {
                    if (!errorElement) {
                        const error = document.createElement('div');
                        error.className = 'input-error';
                        error.innerHTML = `⚠ Adresse email invalide`;
                        input.parentElement.parentElement.appendChild(error);
                    }
                    isValid = false;
                } else if (errorElement) {
                    errorElement.remove();
                }
            });

            return isValid;
        }

        // Validation email
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Amélioration de l'accessibilité
        document.addEventListener('keydown', function(e) {
            // Navigation au clavier dans les formulaires
            if (e.key === 'Enter') {
                const form = e.target.closest('form');
                if (form && e.target.tagName === 'INPUT') {
                    e.preventDefault();
                    const inputs = Array.from(form.querySelectorAll('input, button'));
                    const currentIndex = inputs.indexOf(e.target);
                    const nextInput = inputs[currentIndex + 1];

                    if (nextInput) {
                        nextInput.focus();
                    } else {
                        form.submit();
                    }
                }
            }
        });

        // Gestion du redimensionnement
        window.addEventListener('resize', function() {
            // Ajuster la hauteur des particules
            const particles = document.getElementById('particles');
            if (particles) {
                particles.style.height = window.innerHeight + 'px';
            }
        });

        // Préloader pour les images
        function preloadImages() {
            const images = [
                '{{ asset("images/act-logo.png") }}'
            ];

            images.forEach(src => {
                const img = new Image();
                img.src = src;
            });
        }

        // Initialiser le préloader
        preloadImages();
    </script>

    @stack('scripts')
</body>
</html>
