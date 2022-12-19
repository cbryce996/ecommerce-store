<?php

namespace app\controllers;

use app\core\Application;
use app\core\Api;
use app\models\ProductViewModel;
use app\models\ErrorViewModel;

// Handles user authentication
class AuthController
{
    public array $config;

    public function __construct(array $_config)
    {
        $this->config = $_config;
    }

    public function login($username, $password)
    {
        //TODO: Move server config to API
        if (!isset($this->config["host"]))
        {
            http_response_code(500);
            return Application::$app->router->renderView("error", new ErrorViewModel(500, "Server not found"));
        }

        $api = new Api($this->config["host"]);

        $result = $api->execute("authUser", array($username, $password));

        var_dump($result);

        if (empty($result))
        {
            header("Location: /login");
            exit;
        }

        if ($result["result"]["auth"])
        {
            $_SESSION["user"] = $username;
            header("Location: /checkout");
            exit;
        }

        header("Location: /login");
    }
}