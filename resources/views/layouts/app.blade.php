<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Bouton Scroll to Top -->
        <button id="scrollToTop" class="scroll-to-top-btn" aria-label="Remonter en haut de la page">
            <i class="fas fa-arrow-up"></i>
            <div class="progress-circle">
                <svg class="progress-ring" width="50" height="50">
                    <circle class="progress-ring-circle"
                            cx="25" cy="25" r="20"
                            fill="transparent"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-dasharray="125.66"
                            stroke-dashoffset="125.66"/>
                </svg>
            </div>
        </button>

        <style>
        /* Variables CSS pour la cohérence avec votre thème */
        :root {
            --primary-color: #059669;
            --secondary-color: #F59E0B;
            --accent-color: #10B981;
            --text-dark: #1F2937;
        }

        /* Bouton Scroll to Top */
        .scroll-to-top-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(5, 150, 105, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(100px) scale(0.8);
            font-size: 1.2rem;
        }

        .scroll-to-top-btn.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .scroll-to-top-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 30px rgba(5, 150, 105, 0.4);
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        }

        .scroll-to-top-btn:active {
            transform: translateY(-3px) scale(1.05);
        }

        /* Cercle de progression */
        .progress-circle {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .progress-ring {
            position: absolute;
            top: 0;
            left: 0;
            transform: rotate(-90deg);
            width: 100%;
            height: 100%;
        }

        .progress-ring-circle {
            transition: stroke-dashoffset 0.1s linear;
            stroke: rgba(255, 255, 255, 0.3);
        }

        /* Animation de pulsation */
        .scroll-to-top-btn::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            opacity: 0;
            z-index: -1;
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 0.3;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.1;
            }
            100% {
                transform: scale(1.4);
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .scroll-to-top-btn {
                width: 45px;
                height: 45px;
                bottom: 20px;
                right: 20px;
                font-size: 1.1rem;
            }

            .progress-ring {
                width: 45px;
                height: 45px;
            }

            .progress-ring-circle {
                cx: 22.5;
                cy: 22.5;
                r: 18;
                stroke-dasharray: 113.1;
                stroke-dashoffset: 113.1;
            }
        }

        @media (max-width: 480px) {
            .scroll-to-top-btn {
                width: 40px;
                height: 40px;
                bottom: 15px;
                right: 15px;
                font-size: 1rem;
            }
        }

        /* Mode sombre (optionnel) */
        @media (prefers-color-scheme: dark) {
            .scroll-to-top-btn {
                box-shadow: 0 4px 20px rgba(5, 150, 105, 0.5);
            }

            .scroll-to-top-btn:hover {
                box-shadow: 0 8px 30px rgba(5, 150, 105, 0.6);
            }
        }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollToTopBtn = document.getElementById('scrollToTop');

            // Vérifier si le bouton existe avant de continuer
            if (!scrollToTopBtn) return;

            const progressCircle = scrollToTopBtn.querySelector('.progress-ring-circle');
            const circumference = 2 * Math.PI * 20; // rayon de 20px

            // Configuration du cercle de progression
            if (progressCircle) {
                progressCircle.style.strokeDasharray = circumference;
                progressCircle.style.strokeDashoffset = circumference;
            }

            // Fonction pour mettre à jour la progression
            function updateProgress() {
                if (!progressCircle) return;

                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollPercent = scrollTop / scrollHeight;
                const offset = circumference - (scrollPercent * circumference);

                progressCircle.style.strokeDashoffset = offset;
            }

            // Fonction pour afficher/masquer le bouton
            function toggleButton() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 300) {
                    scrollToTopBtn.classList.add('show');
                } else {
                    scrollToTopBtn.classList.remove('show');
                }
            }

            // Fonction de défilement fluide vers le haut
            function scrollToTop() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 0) {
                    window.requestAnimationFrame(scrollToTop);
                    window.scrollTo(0, scrollTop - scrollTop / 8);
                }
            }

            // Écouteurs d'événements
            window.addEventListener('scroll', function() {
                toggleButton();
                updateProgress();
            });

            scrollToTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                scrollToTop();
            });

            // Animation d'entrée après le chargement de la page
            setTimeout(() => {
                toggleButton();
                updateProgress();
            }, 1000);
        });
        </script>
    </body>
</html>
