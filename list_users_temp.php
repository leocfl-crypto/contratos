<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$users = App\Models\User::select('id', 'name', 'email')->get();

echo "Usuários no banco de dados:\n";
echo str_repeat('=', 50) . "\n";

foreach ($users as $user) {
    echo "ID: {$user->id}\n";
    echo "Nome: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo str_repeat('-', 50) . "\n";
}

echo "\nTotal de usuários: " . $users->count() . "\n";
