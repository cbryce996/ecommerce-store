<?php

// Application adapted from https://www.youtube.com/watch?v=6ERdu4k62wI
// Author: Zura Sekhniashvil
// Date: 26/11/2022

namespace app\core;


// Application represents the core of the API
// Should be used as the main entry point to API
// Responsible for:
// [] - Initializing/DI of required objects
// [] - Defining routes
// [] - (De)Serialization of Requests/Reponses
// [] - Calling appriopriate controller methods

class Application
{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    // Starts the API and resolves which 
    // function should be called
    public function run()
    {
        $this->router->resolve();
    }
}