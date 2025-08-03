{{-- resources/views/frontend/posts/show.blade.php --}}
@extends('frontend.layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt)

@push('styles')
<style>
    .article-header {
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                    url('{{ $post->featured_image ? asset("storage/" . $post->featured_image) : asset("images/default-article.jpg") }}');
        background-size: cover;
        background-position: center;
        min-height: 400px;
        color: white;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .article-content h2,
    .article-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }

    .share-buttons a {
        transition: transform 0.2s;
    }

    .share-buttons a:hover {
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<!-- Article Header -->
<section class="article-header d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!--nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">{{ __('Accueil') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}" class="text-white">{{ __('Actualités') }}</a></li>
                        <li class="breadcrumb-item active text-white">{{ Str::limit($post->title, 50) }}</li>
                    </ol>
                </nav-->

                <div class="mb-3">
                    <span class="badge bg-primary me-2">{{ $post->category->name }}</span>
                    <span class="badge
                        @if($post->type == 'news') bg-info
                        @elseif($post->type == 'event') bg-warning
                        @else bg-success @endif">
                        @if($post->type == 'news') {{ __('Actualité') }}
                        @elseif($post->type == 'event') {{ __('Événement') }}
                        @else {{ __('Article') }} @endif
                    </span>
                </div>

                <h1 class="display-4 fw-bold mb-4">{{ $post->title }}</h1>

                <div class="d-flex align-items-center text-white-50">
                    <div class="me-4">
                        <i class="fas fa-user me-1"></i>{{ $post->user->name }}
                    </div>
                    <div class="me-4">
                        <i class="fas fa-calendar me-1"></i>{{ $post->published_at->format('d F Y') }}
                    </div>
                    <div>
                        <i class="fas fa-eye me-1"></i>{{ $post->views_count }} {{ __('vues') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="mb-5">
                    <!-- Excerpt -->
                    <div class="lead mb-4 p-4 bg-light rounded">
                        {{ $post->excerpt }}
                    </div>

                    <!-- Content -->
                    <div class="article-content">
                        {!! $post->content !!}
                    </div>

                    <!-- Gallery -->
                    @if($post->gallery && count($post->gallery) > 0)
                    <div class="mt-5">
                        <h3 class="fw-bold mb-4">{{ __('Galerie photos') }}</h3>
                        <div class="row">
                            @foreach($post->gallery as $image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $image) }}"
                                     class="img-fluid rounded shadow"
                                     alt="Galerie {{ $post->title }}"
                                     data-bs-toggle="modal"
                                     data-bs-target="#imageModal{{ $loop->index }}"
                                     style="cursor: pointer;">

                                <!-- Modal for image -->
                                <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                     class="img-fluid w-100"
                                                     alt="Galerie {{ $post->title }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Meta Information -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $post->user->name }}</h6>
                                        <small class="text-muted">{{ __('Publié le') }} {{ $post->published_at->format('d F Y') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <div class="share-buttons">
                                    <span class="me-2">{{ __('Partager :') }}</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                       target="_blank" class="btn btn-outline-primary btn-sm me-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                                       target="_blank" class="btn btn-outline-info btn-sm me-1">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                                       target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <section class="mb-5">
                    <h2 class="section-title fw-bold mb-4">{{ __('Articles similaires') }}</h2>
                    <div class="row">
                        @foreach($relatedPosts as $related)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}"
                                     class="card-img-top" alt="{{ $related->title }}"
                                     style="height: 150px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <a href="{{ route('posts.show', $related->slug) }}" class="text-decoration-none">
                                            {{ Str::limit($related->title, 60) }}
                                        </a>
                                    </h6>
                                    <p class="card-text small text-muted">
                                        {{ Str::limit($related->excerpt, 80) }}
                                    </p>
                                    <small class="text-muted">
                                        {{ $related->published_at->format('d/m/Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Article Info -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>{{ __('Informations') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>{{ __('Catégorie :') }}</strong><br>
                            <span class="badge bg-secondary"> {{ Str::limit($post->category->name, 40) }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>{{ __('Type :') }}</strong><br>
                            <span class="badge
                                @if($post->type == 'news') bg-info
                                @elseif($post->type == 'event') bg-warning
                                @else bg-success @endif">
                                @if($post->type == 'news') {{ __('Actualité') }}
                                @elseif($post->type == 'event') {{ __('Événement') }}
                                @else {{ __('Article') }} @endif
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong>{{ __('Publié le :') }}</strong><br>
                            {{ $post->published_at->format('d F Y à H:i') }}
                        </div>
                        <div>
                            <strong>{{ __('Vues :') }}</strong><br>
                            <i class="fas fa-eye me-1"></i>{{ $post->views_count }}
                        </div>
                    </div>
                </div>

                <!-- Recent Posts -->
                @if($recentPosts->count() > 0)
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-newspaper me-2"></i>{{ __('Articles récents') }}</h5>
                    </div>
                    <div class="card-body">
                        @foreach($recentPosts as $recent)
                        <div class="d-flex mb-3 {{ !$loop->last ? 'pb-3 border-bottom' : '' }}">
                            @if($recent->featured_image)
                            <img src="{{ asset('storage/' . $recent->featured_image) }}"
                                 class="me-3 rounded" alt="{{ $recent->title }}"
                                 style="width: 50px; height: 50px; object-fit: cover;">
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-1 small">
                                    <a href="{{ route('posts.show', $recent->slug) }}" class="text-decoration-none">
                                        {{ Str::limit($recent->title, 50) }}
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    {{ $recent->published_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Contact -->
                <div class="card shadow bg-light">
                    <div class="card-body text-center">
                        <h5>{{ __('Une question ?') }}</h5>
                        <p class="small text-muted">{{ __('Contactez-nous pour plus d\'informations') }}</p>
                        <a href="{{ route('contact.index') }}" class="btn btn-primary">
                            <i class="fas fa-envelope me-2"></i>{{ __('Nous contacter') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Navigation -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-6">
                @if($prevPost = \App\Models\Post::published()->where('id', '<', $post->id)->orderBy('id', 'desc')->first())
                <a href="{{ route('posts.show', $prevPost->slug) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>{{ __('Article précédent') }}
                </a>
                @endif
            </div>
            <div class="col-6 text-end">
                @if($nextPost = \App\Models\Post::published()->where('id', '>', $post->id)->orderBy('id', 'asc')->first())
                <a href="{{ route('posts.show', $nextPost->slug) }}" class="btn btn-outline-secondary">
                    {{ __('Article suivant') }}<i class="fas fa-arrow-right ms-2"></i>
                </a>
                @endif
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">
                <i class="fas fa-list me-2"></i>{{ __('Tous les articles') }}
            </a>
        </div>
    </div>
</section>
@endsection
