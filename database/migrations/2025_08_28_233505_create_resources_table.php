<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();

            // Informations sur le fichier
            $table->string('file_path')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('file_type')->nullable(); // MIME type
            $table->bigInteger('file_size')->nullable(); // Taille en bytes
            $table->string('thumbnail')->nullable(); // Chemin vers l'image de prévisualisation

            // Relations
            $table->foreignId('category_id')->constrained('resource_categories')->onDelete('cascade');

            // Métadonnées
            $table->text('tags')->nullable(); // Tags séparés par des virgules
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('download_count')->default(0);
            $table->integer('sort_order')->default(0);

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();

            // Index pour les performances
            $table->index(['is_published', 'created_at']);
            $table->index(['category_id', 'is_published']);
            $table->index(['is_featured', 'is_published']);
            $table->index(['sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
