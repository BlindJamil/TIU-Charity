<?php

use App\Models\Achievement;

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$fixed = 0;

foreach (Achievement::all() as $a) {
    if (is_array($a->detailed_description)) {
        $a->detailed_description = implode(' ', $a->detailed_description);
        $a->save();
        $fixed++;
    }
}

echo "Fixed $fixed achievements with array detailed_description.\n"; 