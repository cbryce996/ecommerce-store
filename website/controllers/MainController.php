<?php

namespace app\controllers;

session_start();

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
            "jsonrpc" => "2.0",
            "method" => "getAllProducts",
            "params" => array(),
            "id" => "1"
        ));

        $curl = curl_init($this->config["host"]);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $decoded = json_decode($response, true);

        if ($decoded)
        {
            if (!isset($decoded["result"]))
            {
                return Application::$app->router->renderView("error", array ( "message" => "No results returned from server"));
            }

            return Application::$app->router->renderView("home", array ( "products" => $decoded["result"]));
        }

        return "Null result from server";
    }

    public function product()
    {
        $payload = json_encode(array(
            "jsonrpc" => "2.0",
            "method" => "getProduct",
            "params" => array(
                "id" => $_GET["id"]
            ),
            "id" => "1"
        ));

        $curl = curl_init($this->config["host"]);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $decoded = json_decode($response, true);

        if ($decoded)
        {
            if (!isset($decoded["result"]))
            {
                return Application::$app->router->renderView("error", array ( "message" => "No results returned from server"));
            }

            return Application::$app->router->renderView("product", array( "product" => array_pop($decoded["result"])));
        }

        return "Something went wrong";
    }

    public function basket()
    {
        if (!empty($_SESSION["basket"]))
        {
            $payload = json_encode(array(
                "jsonrpc" => "2.0",
                "method" => "getProduct",
                "params" => array(
                    "id" => reset($_SESSION["basket"]) ?? 0
                ),
                "id" => "1"
            ));
    
            $curl = curl_init($this->config["host"]);
    
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            $decoded = json_decode($response, true);
    
            if ($decoded)
            {
                if (!isset($decoded["result"]))
                {
                    return Application::$app->router->renderView("error", array ( "message" => "No results returned from server"));
                }
    
                return Application::$app->router->renderView("basket", array( "product" => array_pop($decoded["result"])));
            }
        }
        
        return Application::$app->router->renderView("basket");
    }

    public function basketAdd()
    {
        if (empty($_SESSION["basket"]))
        {
            array_push($_SESSION["basket"], $_GET["id"]);
        }

        header('Location: /basket');
    }

    public function basketDelete()
    {
        if (!empty($_SESSION["basket"]))
        {
            array_pop($_SESSION["basket"]);
        }

        header('Location: /basket');
    }
}
