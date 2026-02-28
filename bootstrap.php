<?php

require 'config/constants.php';

use App\Infrastructure\Routing\RouteCollection;
use App\Infrastructure\Routing\Router;

$routeCollection = new RouteCollection();
$routeCollection->loadFromFile(__DIR__ . '/config/routes.php');

$app = new Router($routeCollection);
