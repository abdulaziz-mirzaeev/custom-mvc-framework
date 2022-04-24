<?php

use App\Controllers\TaskController;
use App\Core\Router;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/dotenv.php';
require_once __DIR__.'/../bootstrap/database.php';

$router = new Router(dirname(__DIR__));

$router->get('/about', function () {
    echo 'About us';
});

$router->get('/', [TaskController::class, 'index']);

$router->get('/list', [TaskController::class, 'list']);

$router->run();