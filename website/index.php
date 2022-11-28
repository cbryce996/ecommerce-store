<?php

use app\controllers\MainController;
use app\core\Application;

require_once __DIR__.'/vendor/autoload.php';

ini_set("display_errors", 1);
error_reporting(E_ALL); 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'api' => [
        'host' => $_ENV['API_HOST'],
    ]
];

$app = new Application($config);

$app->router->registerGet('/', [MainController::class, 'home']);

echo $app->run(file_get_contents("php://input"));