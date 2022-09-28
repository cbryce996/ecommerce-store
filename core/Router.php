<?php

namespace app\core;

class Router
{
    public Request $request;
    // Assocaitive array for routes
    protected array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // Takes path and stores an associated callback function
    public function get($path, $callback)
    {
        // For this path store callback function
        $this->routes['get'][$path] = $callback;
    }

    // Determine current url and resolve against associative array
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        // Gets callback function from HTTP method and path
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback)
        {
            echo 'Path not found';
            exit;
        }
        call_user_func($callback);
    }
}