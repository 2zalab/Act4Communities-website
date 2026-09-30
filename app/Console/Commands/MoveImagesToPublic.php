<?php

namespace App\Console\Commands;

use App\Models\MediaFile;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Project;
use App\Models\Resource;
use App\Support\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Copie les images déjà téléversées (storage/app/public) vers public/images
 * et met à jour les chemins enregistrés en base de données.
 *
 * Utilisation : php artisan images:move-to-public
 */
class MoveImagesToPublic extends Command
{
    protected $signature = 'images:move-to-public {--dry-run : Affiche les opérations sans rien modifier}';

    protected $description = 'Déplace les images téléversées de storage/app/public vers public/images';

    private int $moved = 0;
    private int $missing = 0;

    public function handle(): int
    {
        $this->migrateColumn(Project::query(), 'featured_image');
        $this->migrateArrayColumn(Project::query(), 'gallery');
        $this->migrateColumn(Post::query(), 'featured_image');
        $this->migrateArrayColumn(Post::query(), 'gallery');
        $this->migrateColumn(Partner::query(), 'logo');
        $this->migrateColumn(Resource::query(), 'thumbnail');
        $this->migrateColumn(MediaFile::query()->where('mime_type', 'like', 'image/%'), 'path');

        $this->info("Images déplacées : {$this->moved}");
        if ($this->missing) {
            $this->warn("Images introuvables (déjà déplacées ou supprimées) : {$this->missing}");
        }

        return self::SUCCESS;
    }

    private function migrateColumn($query, string $column): void
    {
        $query->whereNotNull($column)->each(function ($model) use ($column) {
            $newPath = $this->moveFile($model->{$column});

            if ($newPath && $newPath !== $model->{$column}) {
                $this->line("  {$model->{$column}} → {$newPath}");
                if (!$this->option('dry-run')) {
                    $model->forceFill([$column => $newPath])->saveQuietly();
                }
            }
        });
    }

    private function migrateArrayColumn($query, string $column): void
    {
        $query->whereNotNull($column)->each(function ($model) use ($column) {
            $paths = (array) $model->{$column};
            $newPaths = array_map(fn ($path) => $this->moveFile($path) ?: $path, $paths);

            if ($newPaths !== $paths && !$this->option('dry-run')) {
                $model->forceFill([$column => $newPaths])->saveQuietly();
            }
        });
    }

    /**
     * Copie un fichier du disque "public" vers public/images et retourne son nouveau chemin.
     */
    private function moveFile(?string $path): ?string
    {
        if (!$path || str_starts_with($path, 'http')) {
            return null;
        }

        $path = ltrim($path, '/');
        $target = Media::publicPathFor($path);

        // Déjà présent dans public/
        if (is_file(public_path($target))) {
            return $target;
        }

        $disk = Storage::disk('public');
        if (!$disk->exists($path)) {
            $this->missing++;
            $this->warn("  Introuvable : {$path}");
            return null;
        }

        if (!$this->option('dry-run')) {
            File::ensureDirectoryExists(dirname(public_path($target)));
            File::copy($disk->path($path), public_path($target));
        }

        $this->moved++;

        return $target;
    }
}
