<?php

// Router adapted from https://www.youtube.com/watch?v=6ERdu4k62wI
// Author: Zura Sekhniashvil
// Date: 26/11/2022

namespace app\core;

// Router is responsible for extracting and matching appropriate
// controller methods to be called from a request
// Responsible for:
// [] - ?

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
        // Associative array used to store callback function
        // according to method and path
        // GET /Contact = function {}
        // POST /User = function {}
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