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

    public function registerGet($_path, callable $_callback)
    {
        $this->routes["get"][$_path] = $_callback;
    }

    public function registerPost($_path, callable $_callback)
    {
        $this->routes["post"][$_path] = $_callback;
    }

    // TODO: Pathing error on live server
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"];

        $position = strpos($path, "?");

        if ($position === false)
        {
            return $path;
        }
        
        return substr($path, 0, $position);
    }

    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function execute($_request)
    {
        $path = $this->getPath();
        $method = $this->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if (is_string($callback))
        {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($_view, $_params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($_view, $_params);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    public function layoutContent()
    {
        ob_start();
        include_once __DIR__ . "/../views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($_view, $_params)
    {
        foreach ($_params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "/../views/" . $_view . ".php";
        return ob_get_clean();
    }
}