<?php

// Request adapted from https://www.youtube.com/watch?v=6ERdu4k62wI
// Author: Zura Sekhniashvil
// Date: 26/11/2022

namespace app\core;

// Request represents a HTTP request
// Used to pass HTTP information to controllers
// Responsible for:
// [] - ?

class Request
{
    // Extract current path from server global
    public function getPath()
    {
        // Get path from server global
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (!$position)
        {
            return $path;
        }
        
        return $path = substr($path, 0, $position);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}