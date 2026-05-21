<?php

use App\Core\Router;
use App\Core\Database;

$router = new Router();


$router->group('/api/v1', function($router) {
    $router->add('GET', '/', function() {
        echo json_encode(['message' => 'API funcionando']);
    });
    $router->add('GET', '/users', function() {
        $pdo = Database::connect();
        $stmt = $pdo->query('SELECT * FROM users');
        $users = $stmt->fetchAll();
        echo json_encode($users);
    });
});

return $router;
