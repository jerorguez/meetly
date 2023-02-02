<?php

require(__DIR__ . '/../vendor/autoload.php');

use Router\RouterHandler;
use App\Controllers\UserController;
use App\Controllers\EventController;
use App\Controllers\LoginController;
use App\Modules\Middleware;

session_start();

$dotenv = \Dotenv\Dotenv::createImmutable('../includes');
$dotenv->safeLoad();

$path = $_GET['path'] ?? '';
$path = explode('/', $path);

$resource = $path[0] === '' ? '/' : $path[0];
$id = $path[1] ?? null;

$router = new RouterHandler();

switch ($resource) {

    case '/':
    case 'index':
        // Middleware::access('/');
        require_once('../views/frontPage.php');
        break;

    case 'user':
        $router->setMethod($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
        $router->setData($_POST);
        $router->route(UserController::class, $resource, $id);
        break;
    
    case 'event':
        $router->setMethod($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
        $router->setData($_POST);
        $router->route(EventController::class, $resource, $id);
        break;
    
    case 'login':
        // Middleware::access('login');
        LoginController::login();
        break;

    case 'logout':
        LoginController::logout();
        break;

    default:
        require_once('../views/404.php');
        break;

}