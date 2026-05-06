<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use Dotenv\Dotenv;
use App\Infrastructure\Http\Request;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app->dispatch(new Request());
