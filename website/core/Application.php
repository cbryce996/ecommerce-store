<?php

namespace app\core;

use app\controllers\MainController;

class Application
{
    public Router $router;
    public static Application $app;
    public MainController $mainController;

    public function __construct(array $config)
    {
        self::$app = $this;
        $this->router = new Router();
        $this->mainController = new MainController($config['api']);
    }

    public function run($_request)
    {
        return $this->router->execute($_request);
    }
}