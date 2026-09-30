<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Artisan::call('storage:link');

echo "<pre>";
echo "✅ Commande exécutée : php artisan storage:link\n\n";
echo \Artisan::output();
echo "</pre>";
