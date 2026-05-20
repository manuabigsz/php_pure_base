<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

header('Content-Type: application/json');

$routes = require __DIR__ . '/../src/Routes/index.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = $routes[$method][$uri] ?? null;

if (!$route) {
    http_response_code(404);

    echo json_encode([
        'error' => 'Route not found'
    ]);

    exit;
}

$route();