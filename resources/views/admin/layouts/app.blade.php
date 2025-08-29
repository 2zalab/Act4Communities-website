{{-- resources/views/admin/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - Administration {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-color: #059669;
            --primary-dark: #047857;
            --primary-light: #10b981;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 54px 0 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, .1);
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 54px);
            padding-top: 1rem;
            overflow-x: hidden;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) transparent;
        }

        .sidebar-sticky::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-sticky::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-sticky::-webkit-scrollbar-thumb {
            background-color: var(--primary-color);
            border-radius: 3px;
        }

        .sidebar-sticky::-webkit-scrollbar-thumb:hover {
            background-color: var(--primary-dark);
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #374151;
            padding: 0.875rem 1rem;
            border-radius: 0.5rem;
            margin: 0.25rem 1rem;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .sidebar .nav-link:hover {
            background-color: #f3f4f6;
            color: var(--primary-color);
            transform: translateX(4px);
            border-color: #e5e7eb;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
            border-color: var(--primary-color);
        }

        .sidebar .nav-link.active:hover {
            transform: translateX(2px);
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        /* Top Navigation */
        .top-navbar {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-bottom: 3px solid var(--primary-color);
            padding: 2rem;
            margin-bottom: 20px;
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 600;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.5rem 1.5rem;
        }

        .navbar-brand:hover {
            color: var(--primary-light) !important;
        }

        /* User Info Section */
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0 1.5rem;
        }

        .user-details {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #e5e7eb;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-name {
            font-weight: 500;
            color: white;
        }

        .user-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: var(--primary-light);
            color: var(--primary-light);
            transform: translateY(-1px);
        }

        .action-btn.logout {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.3);
        }

        .action-btn.logout:hover {
            background: rgba(239, 68, 68, 0.3);
            border-color: #ef4444;
            color: #fecaca;
        }

        .card-stats {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
        }

        .table-responsive {
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
           .sidebar {
        margin-left: -240px;
        transition: margin-left 0.3s ease;
    }

    .sidebar.show {
        margin-left: 0;
        background: white;
        z-index: 1050;
    }

    .main-content {
        margin-left: 0;
    }

    /* Force les liens à être visibles en mobile */
    .sidebar.show .nav-link {
        color: #374151 !important;
        background-color: transparent !important;
    }

    .sidebar.show .nav-link:hover {
        background-color: #f3f4f6 !important;
        color: var(--primary-color) !important;
    }

    .sidebar.show .nav-link.active {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light)) !important;
        color: white !important;
    }


            .user-actions {
                flex-direction: column;
                gap: 0.25rem;
            }

            .action-btn {
                font-size: 0.8rem;
                padding: 0.375rem 0.5rem;
            }
        }

        /* Alert improvements */
        .alert {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-dark sticky-top top-navbar flex-md-nowrap p-2 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>
                <span>Administration</span>
            </a>

            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="user-info">
                <div class="user-details">
                    <div class="user-avatar">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span class="user-name">{{ auth()->user()->name }}</span>
                </div>

                <div class="user-actions">
                    <a href="{{ route('home') }}" target="_blank" class="action-btn">
                        <i class="fas fa-external-link-alt"></i>
                        <span class="d-none d-lg-inline">Site</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="action-btn">
                        <i class="fas fa-user-edit"></i>
                        <span class="d-none d-lg-inline">Profil</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="action-btn logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="d-none d-lg-inline">Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                 <div class="sidebar-sticky">
                    <ul class="nav flex-column pb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.projects*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
                                <i class="fas fa-project-diagram me-2"></i>Projets
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.posts*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                                <i class="fas fa-newspaper me-2"></i>Actualités
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-tags me-2"></i>Catégories
                            </a>
                        </li>

                                                 <!-- NOUVEAU : Section Ressources -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.resources*') ? 'active' : '' }}" href="{{ route('admin.resources.index') }}">
                                <i class="fas fa-folder-open me-2"></i>Ressources
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.resource-categories*') ? 'active' : '' }}" href="{{ route('admin.resource-categories.index') }}">
                                <i class="fas fa-tags me-2"></i>Catégories Ressources
                            </a>
                        </li>
                        <!-- FIN NOUVEAU -->

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                                <i class="fas fa-envelope me-2"></i>Contacts
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.partners*') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                                <i class="fas fa-handshake me-2"></i>Partenaires
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.volunteer*') ? 'active' : '' }}" href="{{ route('admin.volunteers.index') }}">
                                <i class="fas fa-file-alt me-2"></i>Volontaires
                            </a>
                        </li>

                        @can('manage-users')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users me-2"></i>Utilisateurs
                            </a>
                        </li>
                        @endcan

                        <!--li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.media*') ? 'active' : '' }}" href="{{ route('admin.media.index') }}">
                                <i class="fas fa-images me-2"></i>Médias
                            </a>
                        </li-->

                        @can('manage-settings')
                        <!--li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                                <i class="fas fa-cog me-2"></i>Paramètres
                            </a>
                        </li-->
                        @endcan
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Erreurs détectées :</h6>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Auto-hide alerts
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

        // Confirm delete actions
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                    e.preventDefault();
                }
            });
        });

        // Sidebar toggle for mobile
        const sidebarToggle = document.querySelector('.navbar-toggler');
        const sidebar = document.querySelector('#sidebarMenu');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
