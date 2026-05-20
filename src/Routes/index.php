<?php

$usersRoutes = require __DIR__ . '/users.php';

return [

    'GET' => array_merge(

        [

            '/' => function () {

                echo json_encode([
                    'message' => 'API funcionando'
                ]);
            }

        ],

        $usersRoutes
    )
];