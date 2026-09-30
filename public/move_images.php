<?php

/**
 * Script ponctuel pour hébergement sans accès SSH (LWS) :
 * copie les images de storage/app/public vers public/images
 * et met à jour la base de données.
 *
 * Ouvrir une seule fois https://votre-domaine/move_images.php
 * puis SUPPRIMER ce fichier du serveur.
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Artisan::call('images:move-to-public');

echo "<pre>";
echo "✅ Commande exécutée : php artisan images:move-to-public\n\n";
echo htmlspecialchars(\Artisan::output());
echo "\n⚠️ Pensez à supprimer ce fichier (public/move_images.php) du serveur.";
echo "</pre>";
