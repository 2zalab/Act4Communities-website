<?php

use App\Support\Media;

if (!function_exists('media_url')) {
    /**
     * URL publique d'une image téléversée (public/images/...).
     */
    function media_url(?string $path, ?string $default = null): ?string
    {
        return Media::url($path, $default);
    }
}
