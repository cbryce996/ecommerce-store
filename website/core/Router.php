<?php

namespace app\core;

use Error;

class Router
{
    public array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function registerGet($_method, $_callback)
    {
        $this->routes['get'][$_method] = $_callback;
    }

    public function registerPost($_method, $_callback)
    {
        $this->routes['post'][$_method] = $_callback;
    }

    public function execute($_request)
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        $callback = $this->routes['get'][$path] ?? false;

        if (is_string($callback))
        {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($_view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($_view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function layoutContent()
    {
        ob_start();
        include_once __DIR__ . '/../views/layouts/main.php';
        return ob_get_clean();
    }

    public function renderOnlyView($_view)
    {
        ob_start();
        include_once __DIR__ . '/../views/' . $_view . '.php';
        return ob_get_clean();
    }
}