<?php

use app\core\Application;

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

$app->router->register('getProduct', array($app->mainController, 'getProduct'));
$app->router->register('getAllProducts', array($app->mainController, 'getAllProducts'));
$app->router->register('getBasket', array($app->mainController, 'getBasket'));
$app->router->register('addProductToBasket', array($app->mainController, 'addProductToBasket'));
$app->router->register('deleteProductFromBasket', array($app->mainController, 'deleteProductFromBasket'));


echo $app->run(file_get_contents("php://input"));