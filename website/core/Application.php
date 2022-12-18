<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\AuthController;

class Application
{
    public array $config;
    public Router $router;
    public MainController $mainController;
    public AuthController $authController;
    public static Application $app;

    public function __construct(array $_config)
    {
        self::$app = $this;
        $this->router = new Router();
        $this->config = $_config;
        $this->mainController = new MainController($_config["api"]);
        $this->authController = new AuthController($_config["api"]);
    }
    
    public function run($_request)
    {
        return $this->router->execute($_request);
    }
}