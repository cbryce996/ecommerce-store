<?php

use app\core\Application;

require_once __DIR__."/vendor/autoload.php";


$_SESSION["basket"] = array();

ini_set("display_errors", 1);
error_reporting(E_ALL); 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    "api" => [
        "host" => $_ENV["API_HOST"],
    ]
];

$app = new Application($config);

$app->router->get("/", array($app->mainController, "home"));
$app->router->get("/product", array($app->mainController, "product"));
$app->router->get("/basket", array($app->mainController, "basket"));
$app->router->post("/basket/add", array($app->mainController, "basketAdd"));
$app->router->post("/basket/delete", array($app->mainController, "basketDelete"));

echo $app->run(file_get_contents("php://input"));