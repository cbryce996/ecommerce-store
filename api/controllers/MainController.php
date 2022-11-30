<?php

namespace app\controllers;

use app\core\Application;
use app\models\Basket;
use app\models\Product;
use Throwable;

class MainController
{
    public function __construct()
    {
    }

    public function getAllProducts()
    {
        $stmt = Application::$app->db->pdo->query('SELECT * FROM `Products`');

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array(
            'products' => $result
        );
    }

    public function getProduct($_params)
    {
        // TODO: Check if null
        $stmt = Application::$app->db->pdo->query('SELECT * FROM `Products` WHERE id =' . $_params["id"]);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array(
            'products' => $result
        );
    }

    public function getBasket($_params)
    {
        $stmt = Application::$app->db->pdo->query('SELECT * FROM `Basket` INNER JOIN `Products` ON Basket.product_id = Products.id WHERE Basket.user_id = ' . $_params["user_id"]);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array(
            'products' => $result
        );
    }

    public function addProductToBasket($_params)
    {        
        $stmt = Application::$app->db->pdo->query('INSERT INTO Basket (`user_id`, `product_id`, `qty`) VALUES (' . $_params["user_id"] . ', ' . $_params["product_id"] . ', ' . $_params["qty"] . ' )');

        return array(
            $stmt
        );
    }

    public function deleteProductFromBasket($_params)
    {
        $stmt = Application::$app->db->pdo->query('DELETE FROM `Basket` WHERE user_id = '. $_params["product_id"] .' AND user_id = ' . $_params["user_id"]);

        return array(
            $stmt
        );
    }
}