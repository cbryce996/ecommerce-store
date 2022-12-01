<?php

namespace app\models;

class ErrorViewModel
{
    public int $code;
    public string $message;

    public function __construct(int $_code, string $_message)
    {
        $this->code = $_code;
        $this->message = $_message;
    }
}