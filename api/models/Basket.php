<?php

namespace api\models;

class Basket
{
    public array $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function AddProductToBasket(Product $_product)
    {
        array_push($this->products, $_product);
    }
}