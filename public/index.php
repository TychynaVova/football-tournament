<?php
// Настройка CORS (если нужно)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Подключаем конфиги
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

// Автозагрузка классов (пока простой вариант)
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/core/',
        __DIR__ . '/../app/controllers/',
        __DIR__ . '/../app/models/',
    ];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Роутинг через GET-параметр ?action=
$action = $_GET['action'] ?? 'home';

// Мапинг действий на контроллеры
$routes = [
    'home' => 'HomeController@index',
    'teams' => 'TeamController@list',
    // ... другие маршруты
];

if (isset($routes[$action])) {
    [$controllerName, $method] = explode('@', $routes[$action]);
    $controller = new $controllerName();
    $controller->$method();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
}