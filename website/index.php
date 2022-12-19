<?php

use app\core\Application;

require_once __DIR__."/vendor/autoload.php";

ini_set("display_errors", 1);
error_reporting(E_ALL);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

$config = [
    "api" => [
        "host" => $_ENV["API_HOST"],
    ]
];

$app = new Application($config);

$app->router->get("/", array($app->mainController, "home"));
$app->router->get("/product", array($app->mainController, "product"));
$app->router->get("/product/add", array($app->mainController, "productAdd"));
$app->router->get("/product/add/submit", array($app->mainController, "productAddSubmit"));      //TODO: Change to POST
$app->router->get("/logout", array($app->mainController, "logout"));
$app->router->get("/login", array($app->mainController, "login"));
$app->router->get("/admin", array($app->mainController, "admin"));
$app->router->get("/login/auth", array($app->authController, "login"));     //TODO: Change to POST
$app->router->get("/checkout", array($app->mainController, "checkout"));
$app->router->get("/basket", array($app->mainController, "basket"));
$app->router->get("/basket/add", array($app->mainController, "basketAdd"));     //TODO: Change to POST
$app->router->get("/basket/delete", array($app->mainController, "basketDelete"));       //TODO: Change to POST

echo $app->run(file_get_contents("php://input"));