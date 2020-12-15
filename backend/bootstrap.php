<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

$router = new Elias\Framework\Router($method, $path);

$router->get('/', function () {
    return 'Backend PHP';
});

$router->get('/users', 'App\Controllers\UserController::index'); 
$router->post('/users/create', 'App\Controllers\UserController::create');
$router->get('/users/edit', 'App\Controllers\UserController::edit');
$router->post('/users/update', 'App\Controllers\UserController::update');
$router->get('/users/delete', 'App\Controllers\UserController::delete');

$router->get('/clients', 'App\Controllers\ClientController::index');
$router->post('/clients/create', 'App\Controllers\ClientController::create');
$router->get('/clients/edit', 'App\Controllers\ClientController::edit');
$router->post('/clients/update', 'App\Controllers\ClientController::update');
$router->get('/clients/delete', 'App\Controllers\ClientController::delete');

$router->get('/clients/address', 'App\Controllers\ClientAddressController::index');
$router->post('/clients/address/create', 'App\Controllers\ClientAddressController::create');
$router->get('/clients/address/delete', 'App\Controllers\ClientAddressController::delete');

$result = $router->handler();

if (!$result) {
    http_response_code(404);
    echo 'Página não encontrada!';
    die();
}

$twig = require(__DIR__ . '/renderer.php');

if ($result instanceof Closure) {
    echo $result($router->getParams());

} elseif (is_string($result)) {
    $result = explode('::', $result);

    $controller = new $result[0]($twig);

    $action = $result[1];

    echo $controller->$action($router->getParams());
}