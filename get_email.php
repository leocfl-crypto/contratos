<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$users = App\Models\User::select('id', 'name', 'email')->get();

foreach ($users as $user) {
    echo $user->email . "\n";
}
