<?php

namespace App\Core;

class Router {
    public function run() {
        $uri = $_GET['route'] ?? 'home';

        switch ($uri) {
            case 'home':
                require_once __DIR__ . '/../views/home.php';
                break;

            default:
                http_response_code(404);
                echo "404 - Страница не найдена";
                break;
        }
    }
}
