<?php

namespace app\core;

use app\models\ErrorViewModel;

class Api
{
    public string $host;

    public function __construct($_host)
    {
        $this->host = $_host;
    }

    public function execute($_method, $_params)
    {
        $id = uniqid();

        $payload = json_encode(array(
            "jsonrpc" => "2.0",
            "method" => "getAllProducts",
            "params" => array(),
            "id" => $id
        ));

        $curl = curl_init($this->host);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        return $this->response($response, $id);
    }

    public function response($_response, $_id)
    {
        $decoded = json_decode($_response, true);

        if (json_last_error() !== JSON_ERROR_NONE)
        {
            http_response_code(500);
            die(Application::$app->router->renderView("error", new ErrorViewModel(500, "Internal server error: failure to parse json")));
        }

        if (isset($decoded["error"]))
        {
            die(Application::$app->router->renderView("error", new ErrorViewModel(500, "API server error: ". $decoded["error"]["message"] ."")));
        }

        if (!isset($decoded["result"]) ||
        !isset($decoded["id"]) ||
        $decoded["jsonrpc"] != "2.0")
        {
            http_response_code(500);
            die(Application::$app->router->renderView("error", new ErrorViewModel(500, "Bad server response")));
        }

        if ($decoded["id"] !== $_id)
        {
            http_response_code(500);
            die(Application::$app->router->renderView("error", new ErrorViewModel(500, "Bad server response: resposne id does not match request id")));
        }

        return $decoded;
    }
}