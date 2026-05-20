<?php

namespace App\Controllers;

class UserController
{
    public function index()
    {
        echo json_encode([
            'users' => []
        ]);
    }
}