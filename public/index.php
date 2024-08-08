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
$permissions = require_once __DIR__ . '/../config/permissions.php';
$request_uri = $_SERVER['REQUEST_URI'];
$path_info = parse_url($request_uri, PHP_URL_PATH) ?? '/';
$http_method = $_SERVER['REQUEST_METHOD'];
$key = "$http_method|$path_info";

$isEntryRoute = $path_info === '/login' || $path_info === '/register';

//TODO: Centralize path and role verification to authorize or decline

if (isset($_SESSION['role'])) {

    if ($permissions[$_SESSION['role']]) {
        if (array_search($path_info === '/' ? '' : $path_info, $permissions[$_SESSION['role']], true) !== false) {
            var_dump($permissions);
            echo PHP_EOL . 'Você é: ' . $_SESSION['role'] . PHP_EOL;
            echo 'O caminho é: [ ' . $path_info . ' ], e você pode acessá-lo';            
        } else {
            var_dump($permissions);
            echo PHP_EOL  . 'Você é: ' . $_SESSION['role'] . PHP_EOL;
            echo 'O caminho é: [ ' . $path_info . ' ], e você NÃO pode acessá-lo';     
        }

        // Constraint working, but if user try to access a path that doesn't exist
        // it's going to verify in the array and will not find it, rejecting the access
        // instead of returning a 404.

        // Another problem is: if admin tries to access '/', it will can not,
        // need to verify ONLY if user is accessing a path that is in their list of constraints
        // if not, return to '/' or '/login' if $_SESSION is unset.
    }
    
    // exit();    
}

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