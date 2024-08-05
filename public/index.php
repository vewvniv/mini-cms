<?php
declare(strict_types=1);

session_name('SESSID');
session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);

session_start();
session_regenerate_id();

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once __DIR__ . '/../config/routes.php';
$request_uri = $_SERVER['REQUEST_URI'];
$path_info = parse_url($request_uri, PHP_URL_PATH) ?? '/';
$http_method = $_SERVER['REQUEST_METHOD'];
$key = "$http_method|$path_info";

$isEntryRoute = $path_info === '/login' || $path_info === '/register';
if (!array_key_exists('logedin', $_SESSION) && !$isEntryRoute) {
    header('Location: /login');
    return;
}

if (array_key_exists($key, $routes)) {
    list($controllerClass, $method) = $routes[$key];

    $controller = new $controllerClass();

    if (method_exists($controller, $method)) {
        $controller->$method();
    }
} else {
    http_response_code(404);
    return;
}
