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
        $this->request->getPath();
        var_dump($this->request->getPath());
    }
}