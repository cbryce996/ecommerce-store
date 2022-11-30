<?php

namespace app\core;

use app\controllers\MainController;

class Application
{
    public array $config;
    public Router $router;
    public MainController $mainController;
    public static Application $app;

    public function __construct(array $_config)
    {
        self::$app = $this;
        $this->router = new Router();
        $this->config = $_config;
        $this->mainController = new MainController($_config["api"]);
    }
    
    public function run($_request)
    {
        return $this->router->execute($_request);
    }
}