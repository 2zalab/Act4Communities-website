<?php

/**
 * Script ponctuel pour hébergement sans accès SSH (LWS) :
 * applique les mises à jour de la base de données (php artisan migrate).
 *
 * Ouvrir une seule fois https://votre-domaine/run_migrations.php
 * puis SUPPRIMER ce fichier du serveur.
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<pre>";

try {
    echo "État avant :\n";
    \Artisan::call('migrate:status');
    echo htmlspecialchars(\Artisan::output()) . "\n";

    \Artisan::call('migrate', ['--force' => true]);
    echo "✅ Commande exécutée : php artisan migrate --force\n\n";
    echo htmlspecialchars(\Artisan::output());
} catch (\Throwable $e) {
    echo "❌ Erreur : " . htmlspecialchars($e->getMessage()) . "\n\n";
    echo htmlspecialchars($e->getFile() . ':' . $e->getLine());
}

echo "\n\n⚠️ Pensez à supprimer ce fichier (public/run_migrations.php) du serveur.";
echo "</pre>";
