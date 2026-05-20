<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

$pdo = Database::connect();

$migrationFiles = glob(__DIR__ . '/migrations/*.php');
sort($migrationFiles);

foreach ($migrationFiles as $file) {
    echo 'Applying migration: ' . basename($file) . PHP_EOL;

    $migration = require $file;

    if (is_callable($migration)) {
        $migration($pdo);
    }
}

echo 'Migrations complete.' . PHP_EOL;
