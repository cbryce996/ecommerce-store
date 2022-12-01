<?php

namespace app\Core;

/*
* JSON-RPC Router
*/
class Router
{
    public array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    /*
    * Registers a get procedure
    */
    public function get($_procedure, callable $_callback)
    {
        $this->routes["get"][$_procedure] = $_callback;
    }

    /*
    * Registers a post procedure
    */
    public function post($_procedure, callable $_callback)
    {
        $this->routes["post"][$_procedure] = $_callback;
    }
    
    /*
    * Routes to endpoint and executes callback based on request
    */
    public function execute()
    {
        header('Content-Type: application/json');

        // Get request body
        $request = file_get_contents("php://input");

        // Decode and validate JSON
        $decoded = json_decode($request, true);

        if (json_last_error() !== JSON_ERROR_NONE)
        {
            return $this->error($decoded["id"] ?? null, "-32700", "Invalid Json format, could not parse");
        }
        
        // Check decoded result is in required format
        if (!isset($decoded["params"]) ||
        !isset($decoded["method"]) ||
        !isset($decoded["id"]) ||
        $decoded["jsonrpc"] != "2.0")
        {
            return $this->error($decoded["id"] ?? null, "-32600", "Request doesn't conform to JSON-RPC 2.0");
        }

        // Check callback function exists and check params are good
        $method = strtolower($_SERVER["REQUEST_METHOD"]);

        $callback = $this->routes[$method][$decoded["method"]] ?? false;

        if (!$callback)
        {
            return $this->error($decoded["id"] ?? null, "-32601", "Method not found");
        }

        $reflection = new \ReflectionFunction(\Closure::fromCallable($callback));

        $parameters = $reflection->getParameters();

        $params = array();

        if (!$this->mapParameters($decoded["params"], $parameters, $params))
        {
            return $this->error($decoded["id"] ?? null, "-32602", "Invalid method parameters");
        }

        // Execute the procedure and return response
        return $this->response($decoded["id"], $reflection->invokeArgs($params));
    }

    /*
    * Maps request parameters and checks if they match callback parameters
    */
    public function mapParameters(array $_request, array $_callback, array &$_params)
    {
        // Positional parameters
        if (array_keys($_request) === range(0, count($_request) - 1))
        {
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
                return false;
            }
        }

        return true;
    }

    /*
    * Processes and prepares error response
    */
    public function error($_id, $_code, $_message)
    {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "id" => $_id,
            "error" => array(
                "code" => $_code,
                "message" => $_message
            )
        ));
    }

    /*
    * Processes and prepares valid response
    */
    public function response($_id, $_result)
    {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "id" => $_id,
            "result" => $_result
        ));
    }
}