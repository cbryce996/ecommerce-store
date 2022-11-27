<?php

// Serves as public entry point for API
// Should contain an instance of the Application class
// and run call to execute a function

require_once __DIR__.'/vendor/autoload.php';
use app\core\Application;
use app\models\Product;
use app\models\Basket;

$app = new Application();


// Route and callback function defined like this
$app->router->get('/', function() {
    echo 'Hello World';
});

$app->router->get('/test', function() {
    $product = new Product("Test", "Desc", 3, 5); 
    $basket = new Basket();
    $basket->AddProductToBasket($product);
    var_dump($basket);
});

$app->run();