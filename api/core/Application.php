<?php

namespace app\core;

use app\controllers\MainController;

class Application
{
    public Database $db;
    public Router $router;

    public function __construct(array $config)
    {
        $this->router = new Router();
        $this->db = new Database($config['db']);
    }

    public function run($_request)
    {
        return $this->router->execute($_request);
    }
}