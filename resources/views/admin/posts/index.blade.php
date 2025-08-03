{{-- resources/views/admin/posts/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Gestion des articles')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Articles</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i>Nouvel Article
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="">Tous les types</option>
                    <option value="article" {{ request('type') == 'article' ? 'selected' : '' }}>Article</option>
                    <option value="news" {{ request('type') == 'news' ? 'selected' : '' }}>Actualité</option>
                    <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Événement</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="category" class="form-label">Catégorie</label>
                <select class="form-select" id="category" name="category">
                    <option value="">Toutes les catégories</option>
                    @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Tous les statuts</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label">Recherche</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ request('search') }}" placeholder="Titre, contenu...">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Posts Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des Articles ({{ $posts->total() }})</h5>
    </div>
    <div class="card-body">
        @if($posts->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Type</th>
                        <th>Catégorie</th>
                        <!--th>Auteur</th-->
                        <th>Statut</th>
                        <th>Publié le</th>
                        <th>Vues</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                     class="me-3 rounded" width="50" height="50" style="object-fit: cover;">
                                @endif
                                <div>
                                    <h6 class="mb-0">{{ $post->title }}</h6>
                                    <small class="text-muted">{{ Str::limit($post->excerpt, 60) }}</small>
                                    @if($post->is_featured)
                                    <span class="badge bg-warning ms-2">À la une</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge
                                @if($post->type == 'news') bg-info
                                @elseif($post->type == 'event') bg-warning
                                @else bg-success @endif">
                                @if($post->type == 'news') Actualité
                                @elseif($post->type == 'event') Événement
                                @else Article @endif
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ \Illuminate\Support\Str::limit($post->category->name, 15) }}</span>
                        </td>
                        <!--td>{{ $post->user->name }}</td-->
                        <td>
                            @if($post->is_published)
                            <span class="badge bg-success">Publié</span>
                            @else
                            <span class="badge bg-secondary">Brouillon</span>
                            @endif
                        </td>
                        <td>
                            @if($post->published_at)
                            {{ $post->published_at->format('d/m/Y H:i') }}
                            @else
                            <span class="text-muted">Non publié</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $post->views_count }}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                   class="btn btn-sm btn-outline-info" title="Voir" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                   class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                      class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucun article trouvé</h5>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Créer le premier article
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
