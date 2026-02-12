<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\DB;

try {
    $dbName = DB::connection()->getDatabaseName();
    $users = User::all();
    echo "CONNECTED TO DATABASE: " . $dbName . PHP_EOL;
    echo "USER COUNT: " . $users->count() . PHP_EOL;
    foreach ($users as $user) {
        echo " - " . $user->email . PHP_EOL;
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}
