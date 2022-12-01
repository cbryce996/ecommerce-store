<?php

namespace app\controllers;

use app\core\Application;
use app\models\Basket;
use app\models\Product;

class MainController
{
    public function __construct()
    {
    }

    public function getAllProducts()
    {
        $stmt = Application::$app->db->pdo->query('SELECT * FROM `Products`');

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getProduct($id)
    {
        $stmt = Application::$app->db->pdo->query('SELECT * FROM `Products` WHERE id =' . $id);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
}