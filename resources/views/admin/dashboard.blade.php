{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Tableau de bord')
@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }
    .dashboard-header {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .dashboard-header h1 {
        color: #343a40;
        margin: 0;
    }
    .stat-card {
        background: linear-gradient(135deg, #6e8efb, #a777e3);
        color: white;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 100%;
    }
    .stat-card i {
        font-size: 1.5rem;
        opacity: 0.8;
    }
    .stat-card .stat-value {
        font-size: 1.25rem;
        font-weight: bold;
    }
    .recent-card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .recent-card .card-header {
        border-bottom: 1px solid #eeeeee;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .recent-card .card-header h6 {
        color: #343a40;
        margin: 0;
    }
    .recent-item {
        padding: 8px;
        border-bottom: 1px solid #eeeeee;
    }
    .recent-item:last-child {
        border-bottom: none;
    }
    .quick-actions {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .quick-actions .btn {
        border-radius: 50px;
        margin-bottom: 10px;
        font-size: 0.875rem;
    }
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #ffffff;
    }
</style>

<div class="dashboard-header d-flex justify-content-between align-items-center">
    <h1 class="h4">Tableau de bord</h1>
    <div class="btn-toolbar">
        <div class="btn-group me-2">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i> Voir le site
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-3">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase mb-1">Projets Total</div>
                    <div class="stat-value">{{ $stats['projects'] }}</div>
                </div>
                <div>
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #42e695, #3bb2b8);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase mb-1">Projets Actifs</div>
                    <div class="stat-value">{{ $stats['active_projects'] }}</div>
                </div>
                <div>
                    <i class="fas fa-cogs"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #ff9ff3, #feca57);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase mb-1">Articles Publiés</div>
                    <div class="stat-value">{{ $stats['published_posts'] }}</div>
                </div>
                <div>
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #ff758c, #ff7eb3);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="small text-uppercase mb-1">Messages Non Lus</div>
                    <div class="stat-value">{{ $stats['contacts'] }}</div>
                </div>
                <div>
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Contacts -->
    <div class="col-lg-6 mb-4">
        <div class="recent-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="small">Messages Récents</h6>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-primary">Voir tout</a>
            </div>
            <div class="card-body p-0">
                @forelse($recent_contacts as $contact)
                <div class="recent-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold small">{{ $contact->name }}</div>
                            <div class="small text-muted">{{ $contact->subject }}</div>
                            <div class="small text-muted">{{ $contact->created_at->diffForHumans() }}</div>
                        </div>
                        <div>
                            @if(!$contact->is_read)
                            <span class="badge bg-warning">Non lu</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted small p-2">Aucun message récent</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Recent Posts -->
    <div class="col-lg-6 mb-4">
        <div class="recent-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="small">Articles Récents</h6>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-primary">Voir tout</a>
            </div>
            <div class="card-body p-0">
                @forelse($recent_posts as $post)
                <div class="recent-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold small">{{ $post->title }}</div>
                            <div class="small text-muted">{{ $post->category->name }} • {{ $post->user->name }}</div>
                            <div class="small text-muted">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                        <div>
                            @if($post->is_published)
                            <span class="badge bg-success">Publié</span>
                            @else
                            <span class="badge bg-secondary">Brouillon</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted small p-2">Aucun article récent</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row pb-4">
    <div class="col-12">
        <div class="quick-actions">
            <div class="card-header mb-3">
                <h6 class="small">Actions Rapides</h6>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary w-100">
                        <i class="fas fa-plus me-2"></i> Nouveau Projet
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-success w-100">
                        <i class="fas fa-plus me-2"></i> Nouvel Article
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-info w-100">
                        <i class="fas fa-plus me-2"></i> Nouvelle Catégorie
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.media.index') }}" class="btn btn-warning w-100">
                        <i class="fas fa-upload me-2"></i> Gérer Médias
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
