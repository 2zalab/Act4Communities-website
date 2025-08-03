{{-- resources/views/frontend/posts/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Actualités')
@section('description', 'Découvrez les dernières actualités et articles d\'Act for Communities sur le développement communautaire')

@section('content')
<!-- Hero Section -->
<section class="hero-news-section position-relative overflow-hidden">
    <!-- Background overlay -->
    <div class="hero-overlay"></div>

    <!-- Content -->
    <div class="container position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 py-3 mx-auto text-center text-white">
                <!-- Breadcrumb -->
                <!--nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb justify-content-center bg-transparent">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-home me-1"></i>{{ __('Accueil') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">
                            {{ __('Actualités') }}
                        </li>
                    </ol>
                </nav-->

                <!-- Main title -->
                <h1 class="display-3 fw-bold mb-4 text-shadow">
                    {{ __('Actualités & Blog') }}
                </h1>

                <!-- Subtitle -->
                <p class="lead mb-4 fs-4 text-shadow">
                    {{ __('Suivez nos activités, nos réflexions et les nouvelles du développement communautaire au Cameroun') }}
                </p>

                <!-- Statistics -->
                <div class="row justify-content-center mt-5">
                    <div class="col-md-4 col-6 mb-3">
                        <div class="stat-item">
                            <h3 class="display-6 fw-bold text-warning mb-1">{{ $posts->total() }}</h3>
                            <p class="mb-0 text-white-75">{{ __('Articles publiés') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-6 mb-3">
                        <div class="stat-item">
                            <h3 class="display-6 fw-bold text-warning mb-1">{{ $categories->count() }}</h3>
                            <p class="mb-0 text-white-75">{{ __('Catégories') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-6 mb-3">
                        <div class="stat-item">
                            <h3 class="display-6 fw-bold text-warning mb-1">{{ date('Y') - 2020 }}+</h3>
                            <p class="mb-0 text-white-75">{{ __('Années d\'expérience') }}</p>
                        </div>
                    </div>
                    <!--div class="col-md-3 col-6 mb-3">
                        <div class="stat-item">
                            <h3 class="display-6 fw-bold text-warning mb-1">15+</h3>
                            <p class="mb-0 text-white-75">{{ __('Projets réalisés') }}</p>
                        </div>
                    </div-->
                </div>

                <!-- CTA Button -->
                <!--div class="mt-5">
                    <a href="#articles" class="btn btn-warning btn-lg px-4 py-3 rounded-pill smooth-scroll">
                        <i class="fas fa-arrow-down me-2"></i>{{ __('Découvrir nos articles') }}
                    </a>
                </div-->
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="scroll-indicator position-absolute bottom-0 start-50 translate-middle-x mb-4">
        <div class="scroll-arrow">
            <i class="fas fa-chevron-down text-white"></i>
        </div>
    </div>
</section>

<!-- Search and Filters -->
<section id="articles" class="py-4 bg-white shadow-sm">
    <div class="container-fluid px-5">
        <form method="GET" action="{{ route('posts.index') }}" class="row align-items-end">
            <div class=" col-md-6 mb-3">
                <label for="search" class="form-label">{{ __('Rechercher') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ request('search') }}" placeholder="{{ __('Titre, contenu...') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label for="category" class="form-label">{{ __('Catégorie') }}</label>
                <select class="form-select" id="category" name="category">
                    <option value="all">{{ __('Toutes les catégories') }}</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                        {{ $category->name }} ({{ $category->posts_count }})
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <label for="type" class="form-label">{{ __('Type') }}</label>
                <select class="form-select" id="type" name="type">
                    <option value="all">{{ __('Tous les types') }}</option>
                    <option value="article" {{ request('type') == 'article' ? 'selected' : '' }}>{{ __('Article') }}</option>
                    <option value="news" {{ request('type') == 'news' ? 'selected' : '' }}>{{ __('Actualité') }}</option>
                    <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>{{ __('Événement') }}</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-6 mb-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter me-1"></i>{{ __('Filtrer') }}
                </button>
            </div>
        </form>
    </div>
</section>

<div class="-fluid px-5 py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Featured Posts -->
            @if($featuredPosts->count() > 0 && !request()->hasAny(['search', 'category', 'type']))
            <section class="mb-5">
                <h2 class="section-title fw-bold mb-4">{{ __('À la une') }}</h2>
                <div class="row">
                    @foreach($featuredPosts as $post)
                    <div class="col-md-8 mb-4">
                        <article class="card h-100 border-0 shadow">
                            @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                 class="card-img-top" alt="{{ $post->title }}"
                                 style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary d-block text-truncate" style="width: 80%;" id="categoryBadge">{{ $post->category->name }}</span>
                                    <small class="text-muted">{{ $post->published_at->format('d/m/Y') }}</small>
                                </div>
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="card-text flex-grow-1">{{ $post->excerpt }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <!--small class="text-muted">
                                        <i class="fas fa-user me-1"></i>{{ $post->user->name }}
                                    </small-->
                                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">
                                        {{ __('Lire la suite') }}
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- All Posts -->
            <section>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">
                        @if(request()->hasAny(['search', 'category', 'type']))
                            {{ __('Résultats de recherche') }}
                        @else
                            {{ __('Toutes les actualités') }}
                        @endif
                    </h2>
                    <span class="text-muted">{{ $posts->total() }} {{ __('article(s)') }}</span>
                </div>

                @if($posts->count() > 0)
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-6 mb-4">
                        <article class="card h-100 border-0 shadow-sm">
                            @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                 class="card-img-top" alt="{{ $post->title }}"
                                 style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary">{{ \Illuminate\Support\Str::limit($post->category->name, 25) }}</span>
                                    <span class="badge
                                        @if($post->type == 'news') bg-info
                                        @elseif($post->type == 'event') bg-warning
                                        @else bg-success @endif">
                                        @if($post->type == 'news') {{ __('Actualité') }}
                                        @elseif($post->type == 'event') {{ __('Événement') }}
                                        @else {{ __('Article') }} @endif
                                    </span>
                                </div>
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="card-text flex-grow-1">{{ $post->excerpt }}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>{{ $post->user->name }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>{{ $post->published_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>{{ $post->views_count }} {{ __('vues') }}
                                        </small>
                                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">
                                            {{ __('Lire la suite') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
                @else
                <!-- No Posts -->
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">{{ __('Aucun article trouvé') }}</h4>
                    <p class="text-muted">{{ __('Essayez de modifier vos critères de recherche') }}</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">
                        {{ __('Voir tous les articles') }}
                    </a>
                </div>
                @endif
            </section>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Posts -->
            @if($recentPosts->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>{{ __('Articles récents') }}</h5>
                </div>
                <div class="card-body">
                    @foreach($recentPosts as $recent)
                    <div class="d-flex mb-3 {{ !$loop->last ? 'pb-3 border-bottom' : '' }}">
                        @if($recent->featured_image)
                        <img src="{{ asset('storage/' . $recent->featured_image) }}"
                             class="me-3 rounded" alt="{{ $recent->title }}"
                             style="width: 60px; height: 60px; object-fit: cover;">
                        @endif
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                <a href="{{ route('posts.show', $recent->slug) }}" class="text-decoration-none">
                                    {{ Str::limit($recent->title, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $recent->published_at->format('d/m/Y') }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Categories -->
            @if($categories->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-tags me-2"></i>{{ __('Catégories') }}</h5>
                </div>
                <div class="card-body">
                    @foreach($categories as $category)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <a href="{{ route('posts.index', ['category' => $category->slug]) }}"
                           class="text-decoration-none">
                            {{ $category->name }}
                        </a>
                        <span class="badge bg-light text-dark">{{ $category->posts_count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Newsletter -->
            <div class="card shadow mb-4 bg-primary text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-envelope me-2"></i>{{ __('Newsletter') }}</h5>
                    <p class="mb-3">{{ __('Recevez nos dernières actualités') }}</p>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="general">
                        <input type="hidden" name="subject" value="Inscription Newsletter">
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email"
                                   placeholder="{{ __('Votre email') }}" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name"
                                   placeholder="{{ __('Votre nom') }}" required>
                        </div>
                        <input type="hidden" name="message" value="Demande d'inscription à la newsletter">
                        <button type="submit" class="btn btn-light w-100">
                            {{ __('S\'inscrire') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Social Links -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-share-alt me-2"></i>{{ __('Suivez-nous') }}</h5>
                </div>
                <div class="card-body text-center">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-dark btn-sm">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajoutez ces styles CSS dans votre section <style> du layout principal -->
<style>
.hero-news-section {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.7)),
                url('{{ asset("images/news-hero-bg.webp") }}') center/cover no-repeat;
    min-height: 80vh;
    display: flex;
    align-items: center;
    position: relative;
}

.hero-news-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.hero-news-section .container {
    z-index: 2;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg,
        rgba(0, 0, 0, 0.85) 0%,
        rgba(0, 185, 129, 0.75) 50%,
        rgba(245, 158, 11, 0.8) 100%);
    z-index: 1;
}

.min-vh-50 {
    min-height: 50vh;
}

.text-shadow {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.85) !important;
}

.text-white-50 {
    color: rgba(255, 255, 255, 0.7) !important;
}

.stat-item {
    padding: 1rem;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease, background 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.7);
}

.scroll-indicator {
    z-index: 2;
}

.scroll-arrow {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.smooth-scroll {
    scroll-behavior: smooth;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-news-section {
        min-height: 70vh;
    }

    .display-3 {
        font-size: 2.5rem !important;
    }

    .stat-item {
        margin-bottom: 1rem;
    }
}

@media (max-width: 576px) {
    .hero-news-section {
        min-height: 60vh;
    }

    .display-3 {
        font-size: 2rem !important;
    }

    .lead {
        font-size: 1.1rem !important;
    }
}
</style>

<!-- Script pour le smooth scroll (à ajouter dans votre section scripts) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll pour les liens avec la classe smooth-scroll
    document.querySelectorAll('.smooth-scroll').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection
