<?php

namespace app\models;

class Product
{
    public string $name;
    public string $description;
    public int $cost;
    public int $stock;

    public function __construct(string $_name, string $_description, int $_cost, int $_stock)
    {
        $this->name = $_name;
        $this->description = $_description;
        $this->cost = $_cost;
        $this->stock = $_stock;
    }
}