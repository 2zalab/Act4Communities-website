<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// On lance le Kernel de Laravel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Important : boot Laravel
$kernel->bootstrap();

// Maintenant Artisan fonctionne
\Artisan::call('cache:clear');
\Artisan::call('config:clear');
\Artisan::call('route:clear');
\Artisan::call('view:clear');
\Artisan::call('optimize:clear');

echo "<pre>";
echo "✅ Caches nettoyés :\n";
echo \Artisan::output();
echo "</pre>";
