<?php

namespace app\core;

class Request
{
    // Extract current path from server global
    public function getPath()
    {
        // Get path from server global
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        // Store position of query, false if none
        $position = strpos($path, '?');
        if (!$position)
        {
            return $path;
        }
        return $path = substr($path, 0, $position);
    }

    public function getMethod()
    {

    }
}