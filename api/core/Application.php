<?php

namespace app\core;

use app\controllers\MainController;

class Application
{
    public static Application $app; 
    public Database $db;
    public Router $router;
    public MainController $mainController;

    public function __construct(array $config)
    {
        self::$app = $this;
        $this->router = new Router();
        $this->db = new Database($config['db']);
        $this->mainController = new MainController();
    }

    public function run($_request)
    {
        return $this->router->execute($_request);
    }
}