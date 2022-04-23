<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use MamadouAlySy\SimpleFramework\Router\Router;

$router = new Router();

$router->register('GET, POST', '/', [HomeController::class, 'index'], 'home.index');

return $router;