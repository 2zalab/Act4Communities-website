<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Gestion des images téléversées.
 *
 * Les images sont enregistrées directement dans public/images/{dossier}
 * (disque "uploads") afin d'être servies sans le lien symbolique
 * public/storage, souvent inutilisable sur les hébergements mutualisés (LWS).
 */
class Media
{
    public const DISK = 'uploads';

    /**
     * Enregistre un fichier téléversé dans public/images/{folder}
     * et retourne son chemin relatif à public/ (ex : images/projects/xxx.jpg).
     */
    public static function store(UploadedFile $file, string $folder, ?string $name = null): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension());
        $name = $name ?: time() . '_' . Str::random(10);

        return $file->storeAs(self::folder($folder), $name . '.' . $extension, self::DISK);
    }

    /**
     * Enregistre un contenu binaire (ex : image redimensionnée) dans public/images/{folder}.
     */
    public static function put(string $contents, string $folder, string $filename): string
    {
        $path = self::folder($folder) . '/' . $filename;
        Storage::disk(self::DISK)->put($path, $contents);

        return $path;
    }

    /**
     * Supprime une image, qu'elle soit dans public/images ou encore dans l'ancien stockage.
     */
    public static function delete(?string $path): void
    {
        if (!$path || Str::startsWith($path, ['http://', 'https://'])) {
            return;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, 'images/') && Storage::disk(self::DISK)->exists($path)) {
            Storage::disk(self::DISK)->delete($path);
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Indique si l'image existe (public/images ou ancien stockage).
     */
    public static function exists(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        $path = self::normalize($path);

        return is_file(public_path($path))
            || is_file(public_path('images/' . $path))
            || Storage::disk('public')->exists($path);
    }

    /**
     * URL publique d'une image enregistrée en base.
     * Compatible avec les anciens chemins (storage/app/public) le temps de la migration.
     */
    public static function url(?string $path, ?string $default = null): ?string
    {
        if (!$path) {
            return $default ? asset($default) : null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        $path = self::normalize($path);

        if (is_file(public_path($path))) {
            return asset($path);
        }

        if (is_file(public_path('images/' . $path))) {
            return asset('images/' . $path);
        }

        // Ancien emplacement (nécessite le lien public/storage)
        return asset('storage/' . $path);
    }

    /**
     * Chemin cible dans public/ pour un ancien chemin du disque "public".
     */
    public static function publicPathFor(string $oldPath): string
    {
        $oldPath = ltrim($oldPath, '/');

        return Str::startsWith($oldPath, 'images/') ? $oldPath : 'images/' . $oldPath;
    }

    private static function normalize(string $path): string
    {
        $path = ltrim($path, '/');

        return Str::startsWith($path, 'storage/') ? Str::after($path, 'storage/') : $path;
    }

    private static function folder(string $folder): string
    {
        return 'images/' . trim($folder, '/');
    }
}
