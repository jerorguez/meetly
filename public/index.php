<?php

require('../vendor/autoload.php');

use Router\RouterHandler;
use App\Controllers\UserController;
use App\Controllers\LoginController;

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
        require_once('../views/frontPage.php');
        break;

    case 'user':
        $router->setMethod($_SERVER['REQUEST_METHOD']);
        $router->setData($_POST);
        $router->route(UserController::class, $id);
        break;
    
    case 'login':
        LoginController::login();
        break;

    default:
        require_once('../views/404.php');
        break;

}