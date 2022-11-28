<?php

namespace app\core;

use Exception;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        try
        {
            $this->pdo = new \PDO($dsn, $user, $password);
        }
        catch(Exception $e)
        {
            echo "Could not connect to database: " . $e->getMessage();
        }
    }
}