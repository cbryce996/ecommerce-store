<?php

// Serves as public entry point for API
// Should contain an instance of the Application class
// and run call to execute a function

use app\controllers\MainController;
use app\core\Application;
use app\models\Product;
use app\models\Basket;

require_once __DIR__.'/vendor/autoload.php';

ini_set("display_errors", 1);
error_reporting(E_ALL); 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application($config);

$app->router->register('basket', [MainController::class, 'GetBasket']);

echo $app->run(file_get_contents("php://input"));