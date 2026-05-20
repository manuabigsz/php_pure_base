<?php

use App\Core\Database;

return [

    'GET' => [

        '/' => function () {

            echo json_encode([
                'message' => 'API funcionando'
            ]);
        },

        '/test-database' => function () {

            try {

                $pdo = Database::connect();

                $stmt = $pdo->query('SELECT 1');

                echo json_encode([
                    'success' => true,
                    'message' => 'Banco conectado com sucesso'
                ]);

            } catch (Exception $e) {

                http_response_code(500);

                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        }
    ]
];