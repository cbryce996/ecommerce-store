<?php

namespace app\controllers;

use app\core\Application;

class MainController
{
    public static function home()
    {
        return Application::$app->router->renderView('home');
    }
}