<?php

namespace app\core;

use Error;

class Router
{
    public array $procedures;

    public function __construct()
    {
        $this->procedures = [];
    }

    public function register($_method, callable $_callback)
    {
        $this->procedures[$_method] = $_callback;
    }

    public function execute($_request)
    {
        // Set header type for outputs to json
        header('Content-Type: application/json');

        $payload = $_request;

        if (empty($payload))
        {
            return json_encode(array(
                'error' => array(
                    'message' => 'Payload is empty',
                    'code' => '-32000'
                ),
                'id' => null
            ));
        }

        $decoded = json_decode($payload, true);

        // Check that request contains required fields  
        if (!isset($decoded['params']) ||
            !isset($decoded['method']) ||
            !isset($decoded['id']) ||
            $decoded['jsonrpc'] != '2.0')
        {
            return json_encode(array(
                'error' => array(
                    'message' => "Invalid request body format",
                    'code' => '-32000'
                ),
                'id' => null
            ));
        }

        // If method is not registered return error response
        if ($this->procedures[$decoded['method']] == null)
        {
            return json_encode(array(
                'error' => array(
                    'message' => 'Method not found',
                    'code' => '-32000'
                ),
                'id' => null
            ));
        }

        // TODO: Properly encode requests and reponses
        // Return json-rpc response with result and id
        return mb_convert_encoding(json_encode(array(
            'jsonrpc' => '2.0',
            'result' => call_user_func($this->procedures[$decoded['method']], $decoded['params']),
            'id' => $decoded['id']
        )), "utf-8");
    }
}