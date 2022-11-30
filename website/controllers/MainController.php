<?php

namespace app\controllers;

use app\core\Application;
use Throwable;

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
                $decoded = array(
                    "result" => array(
                        "message" => "Server error: either responded with unecpected result or no result at all."
                    )
                );
                return Application::$app->router->renderView("error", $decoded["result"]);
            }

            return Application::$app->router->renderView("home", $decoded["result"]);
        }

        return "Something went wrong";
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
                $decoded = array(
                    "result" => array(
                        "message" => "Server error: either responded with unecpected result or no result at all."
                    )
                );
                return Application::$app->router->renderView("error", $decoded["result"]);
            }

            return Application::$app->router->renderView("product", $decoded["result"]);
        }

        return "Something went wrong";
    }

    public function basket()
    {
        $payload = json_encode(array(
            "jsonrpc" => "2.0",
            "method" => "getProduct",
            "params" => array(
                null
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
                $decoded = array(
                    "result" => array(
                        "message" => "Server error: either responded with unecpected result or no result at all."
                    )
                );
                return Application::$app->router->renderView("error", $decoded["result"]);
            }

            return Application::$app->router->renderView("basket", $decoded["result"]);
        }

        return "Something went wrong";
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
