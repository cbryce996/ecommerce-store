<?php

namespace app\models;

class ProductViewModel
{
    public string $name;
    public string $description;
    public int $cost;

    public function __construct(string $_name, string $_description, int $_cost)
    {
        $this->name = $_name;
        $this->description = $_description;
        $this->cost = $_cost;
    }
}