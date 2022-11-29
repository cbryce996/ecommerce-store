<?php

namespace app\controllers;

use app\core\Application;

class MainController
{
    public array $config;

    public function __construct(array $_config)
    {
        $this->config = $_config;
    }

    public function home()
    {
        $payload = json_encode(array(
            'jsonrpc' => '2.0',
            'method' => 'getProducts',
            'params' => array(
                null
            ),
            'id' => '1'
        ));

        $curl = curl_init($this->config['host']);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $decoded = json_decode($response, true);

        var_dump($decoded);

        return Application::$app->router->renderView('home', $decoded['result']);
    }

    public function product()
    {
        var_dump($_GET['id']);
        return Application::$app->router->renderView('product');
    }

    public function basket()
    {
        $payload = json_encode(array(
            'jsonrpc' => '2.0',
            'method' => 'getProducts',
            'params' => array(
                null
            ),
            'id' => '1'
        ));

        $curl = curl_init($this->config['host']);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $decoded = json_decode($response, true);

        return Application::$app->router->renderView('basket', $decoded['result']);
    }

    /*
    public function getProducts()
    {
        $params = [
            'products' => $this->getProducts()
        ];

        return Application::$app->router->renderView('home', $params);
    }
    */
}