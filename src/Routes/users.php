<?php

use App\Core\Database;

return [

    '/users' => function () {

        $pdo = Database::connect();

        $stmt = $pdo->query('SELECT * FROM users');

        $users = $stmt->fetchAll();

        echo json_encode($users);
    },

    '/test-database' => function () {

        $pdo = Database::connect();

        $stmt = $pdo->query('SELECT 1');

        echo json_encode([
            'success' => true,
            'message' => 'Banco conectado'
        ]);
    }
];