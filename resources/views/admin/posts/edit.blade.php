{{-- resources/views/admin/posts/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Modifier l\'article')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifier l'article</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="excerpt" class="form-label">Extrait</label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="featured_image" class="form-label">Image mise en avant</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image">
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" class="mt-2" style="max-width: 200px;">
                @endif
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="article" {{ $post->type == 'article' ? 'selected' : '' }}>Article</option>
                    <option value="news" {{ $post->type == 'news' ? 'selected' : '' }}>Actualité</option>
                    <option value="event" {{ $post->type == 'event' ? 'selected' : '' }}>Événement</option>
                </select>
            </div>
             <div class="mb-3 form-check">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ $post->is_featured ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">À la une</label>
            </div>

            <div class="mb-3 form-check">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ $post->is_published ? 'checked' : '' }}>
                <label class="form-check-label" for="is_published">Publié</label>
            </div>
            <div class="mb-3">
                <label for="published_at" class="form-label">Date de publication</label>
                <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
