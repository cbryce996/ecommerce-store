<?php

namespace app\core;

use app\models\ErrorViewModel;

class Router
{
    public array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function get($_path, callable $_callback)
    {
        $this->routes["get"][$_path] = $_callback;
    }

    public function post($_path, callable $_callback)
    {
        $this->routes["post"][$_path] = $_callback;
    }

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

     /*
    * Maps request parameters and checks if they match callback parameters
    */
    public function mapParameters(array $_request, array $_callback, array &$_params)
    {
        // Positional parameters
        if (array_keys($_request) === range(0, count($_request) - 1))
        {

            var_dump(count($_request), count($_callback));

            if (count($_request) !== count($_callback)) return false;
            $_params = $_request;

            return true;
        }

        // Named parameters
        foreach ($_callback as $p)
        {

            $name = $p->getName();

            if (isset($_request[$name])) {

                $_params[$name] = $_request[$name];
            }
            else {
                var_dump(count($_request), count($_callback));
                return false;
            }
        }

        return true;
    }

    public function execute($_request)
    {
        $path = $this->getPath();
        $method = $this->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        // Check if route is registered
        if (!$callback)
        {
            http_response_code(404);
            return $this->renderView("error", new ErrorViewModel(404, "Route not found"));
        }

        $reflection = new \ReflectionFunction(\Closure::fromCallable($callback));

        $parameters = $reflection->getParameters();

        $params = array();

        // If method is get check if params match
        if ($method == "get")
        {
            if (!$this->mapParameters($_GET, $parameters, $params))
            {
                http_response_code(400);
                return $this->renderView("error", new ErrorViewModel(400, "Invalid parameters"));
            }
        }
        // If method is post check if params match
        else if ($method == "post")
        {
            if (!$this->mapParameters($_POST, $parameters, $params))
            {
                http_response_code(400);
                return $this->renderView("error", new ErrorViewModel(400, "Invalid parameters"));
            }
        }
        else
        {
            http_response_code(405);
            return $this->renderView("error", new ErrorViewModel(400, "Method not supported"));
        }
        
        // Execute the callback and return response
        http_response_code(200);
        return $reflection->invokeArgs($params);
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