<?php

namespace app\controllers;

use app\core\Application;
use app\core\Api;
use app\models\ProductViewModel;
use app\models\ErrorViewModel;

session_start();

// Handles rendering of views
class MainController
{
    public array $config;

    public function __construct(array $_config)
    {
        $this->config = $_config;
    }

    public function home()
    {
        if (!isset($this->config["host"]))
        {
            http_response_code(500);
            return Application::$app->router->renderView("error", new ErrorViewModel(500, "Server not found"));
        }

        $api = new Api($this->config["host"]);

        $result = $api->execute("getAllProducts", null);

        // TODO: Implement view models
        return Application::$app->router->renderView("home", array("products" => $result["result"]));
    }

    public function product($id)
    {
        if (!isset($this->config["host"]))
        {
            http_response_code(500);
            return Application::$app->router->renderView("error", new ErrorViewModel(500, "Server not found"));
        }

        $api = new Api($this->config["host"]);

        $result = $api->execute("getProduct", array($id));

        // TODO: Implement view models
        return Application::$app->router->renderView("product", array("products" => $result["result"]));
    }

    public function basket()
    {
        if (!empty($_SESSION["basket"]))
        {
            if (!isset($this->config["host"]))
            {
                http_response_code(500);
                return Application::$app->router->renderView("error", new ErrorViewModel(500, "Server not found"));
            }

            $api = new Api($this->config["host"]);

            $result = $api->execute("getProduct", array(reset($_SESSION["basket"])));

            return Application::$app->router->renderView("basket", array("products" => $result["result"]));
        }
        
        return Application::$app->router->renderView("basket");
    }

    // TODO: Move to Basket Controller
    public function basketAdd()
    {
        if ($_SESSION["basket"] == null)
        {
            $_SESSION["basket"] = array();
        }
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

        header("Location: /basket");
    }

    public function login()
    {
        return Application::$app->router->renderView("login");
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        header("Location: /login");
    }

    public function checkout()
    {
        if (!isset($_SESSION["user"]))
        {
           header("Location: /login");
           exit;
        }

        return Application::$app->router->renderView("checkout");
    }

    public function admin()
    {
        if (!isset($_SESSION["user"]))
        {
           header("Location: /login");
           exit;
        }

        return Application::$app->router->renderView("admin");
    }
}
