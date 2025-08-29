{{-- resources/views/frontend/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Accueil') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Action pour le Développement Communautaire - ONG camerounaise défendant les droits des communautés locales')">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #059669;
            --secondary-color: #F59E0B;
            --accent-color: #10B981;
            --text-dark: #1F2937;
            --text-light: #6B7280;
        }

        body {
            font-family: 'Figtree', sans-serif;
            line-height: 1.5;
            color: var(--text-dark);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 50px 0;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .footer {
            background-color: #1F2937;
            color: white;
            padding: 20px 0 20px;
        }

        .section-title {
            position: relative;
            margin-bottom: 40px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            margin: 0 10px;
        }

        .language-switcher {
            border-left: 1px solid #dee2e6;
            padding-left: 15px;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container-fluid px-5">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('images/act-logo.png') }}" alt="Act for Communities" height="45">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            {{ __('Accueil') }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('about*') ? 'active' : '' }}" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown">
                            {{ __('À propos') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('about') }}">{{ __('Notre organisation') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('team') }}">{{ __('Notre équipe') }}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('projects*') ? 'active' : '' }}" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown">
                            {{ __('Projets') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('projects.index') }}">{{ __('Tous les projets') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('projects.ongoing') }}">{{ __('Projets en cours') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('projects.completed') }}">{{ __('Projets réalisés') }}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts*') ? 'active' : '' }}" href="{{ route('posts.index') }}">
                            {{ __('Actualités') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('resources*') ? 'active' : '' }}" href="{{ route('resources.index') }}">
                            {{ __('Resources') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontend.acd-lab') ? 'active' : '' }}" href="{{ route('frontend.acd-lab') }}">
                            {{ __('ACD Lab') }}
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('contact*') ? 'active' : '' }}" href="#" id="contactDropdown" role="button" data-bs-toggle="dropdown">
                            {{ __('Contact') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('contact.index') }}">{{ __('Nous contacter') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('contact.volunteer') }}">{{ __('Devenir bénévole') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('contact.partnership') }}">{{ __('Partenariat') }}</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Language Switcher -->
                <div class="language-switcher">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-globe me-1"></i>
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'fr') }}">Français</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container-fluid px-5">
            <div class="row">
                <div class="col-lg-5 mb-4 px-4">
                    <h5 class="fw-bold mb-3">Action for Community Development</h5>
                    <p class="text-light">
                        Action pour le Développement Communautaire (ADC) est une OSC camerounaise défendant les droits des communautés locales et autochtones.
                    </p>
                    <div class="social-links">
                        <a href="{{ $contactInfo['social']['facebook'] }}" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $contactInfo['social']['linkedin'] }}" class="text-light me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="{{ $contactInfo['social']['twitter'] }}" class="text-light"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">{{ __('Liens rapides') }}</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-light text-decoration-none">{{ __('Accueil') }}</a></li>
                        <li><a href="{{ route('about') }}" class="text-light text-decoration-none">{{ __('À propos') }}</a></li>
                        <li><a href="{{ route('projects.index') }}" class="text-light text-decoration-none">{{ __('Projets') }}</a></li>
                        <li><a href="{{ route('posts.index') }}" class="text-light text-decoration-none">{{ __('Actualités') }}</a></li>
                    </ul>
                </div>

                <!--div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">{{ __('Nos domaines') }}</h6>
                    <ul class="list-unstyled">
                        <li class="text-light">Agriculture durable</li>
                        <li class="text-light">Autonomisation femme/jeunesse</li>
                        <li class="text-light">Protection environnement</li>
                        <li class="text-light">Gouvernance</li>
                    </ul>
                </div-->

                <div class="col-lg-4 mb-4">
                    <h6 class="fw-bold mb-3">{{ __('Contact') }}</h6>
                    <div class="contact-info text-light">
                        <div class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            {{ implode(' / ', $contactInfo['phones']) }}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-phone-alt me-2"></i>
                            {{ $contactInfo['office'] }}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            {{ $contactInfo['email'] }}
                        </div>
                        <div>
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $contactInfo['address'] }}
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-secondary">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-light mb-0">
                        &copy; {{ date('Y') }} Action for Community Development. {{ __('Tous droits réservés.') }}
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-light">
                        {{ __('Notre vision : "Un Cameroun où le développement est centré sur la personne humaine"') }}
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Flash message auto-hide
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('alert-success')) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
